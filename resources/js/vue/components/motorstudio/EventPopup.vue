<template>
	<transition name="popup" v-on:enter="onEnter" v-on:before-enter="beforeEnter" v-on:after-enter="afterEnter" v-on:leave="leave">
		<div class="p-event df-popup" v-show="isOpened">
			<div class="p-event__wrap df-popup__wrap" @mousedown.self="closeEvent">
				<div class="p-event__center df-popup__center">
					<a href="#" @click.prevent="closeEvent" class="p-event__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<ul class="p-event__list" :style="{ transform: 'translateX(' + (-100 * currentEvent) + '%)' }">
						<li class="p-event__event" v-for="event in selectedEvents" :key="event.id">
							<div class="p-event__img">
								<picture>
									<source media="(max-width: 1023px)"
											:srcset="event.img_mobile">   
									<source media="(min-width: 1024px)"
											:srcset="event.img">   
									<img :src="event.img" 
											:alt="event.name">
								</picture>
								<div class="p-event__nav">
									<a href="#" class="p-event__prev" @click.prevent="prevEvent" :class="{ visible: currentEvent > 0 }">
										<svg width="9" height="18" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M8 1L1.57619 8.3415C1.24629 8.71852 1.24629 9.28148 1.57619 9.6585L8 17" stroke="white" stroke-width="2"/>
										</svg>
									</a>
									<a href="#" class="p-event__next" @click.prevent="nextEvent" :class="{ visible: currentEvent < selectedEvents.length - 1 }">
										<svg width="9" height="18" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M1 17L7.42381 9.6585C7.75371 9.28148 7.75371 8.71852 7.42381 8.3415L1 0.999999" stroke="white" stroke-width="2"/>
										</svg>
									</a>
								</div>
							</div>
							<div class="p-event__description">
								<div class="p-event__top df-lead-text-22px">
									<div class="p-event__from">{{ event.from | dateFormat }}</div>
									<div class="p-event__separator" v-if="event.from !== event.to">&nbsp;&mdash;</div>
									<div class="p-event__to" v-if="event.from !== event.to">{{ event.to | dateFormat }}</div>
								</div>
								<h2 class="p-event__name">{{ event.name }}</h2>
								<div class="p-event__text" v-html="event.description">
								</div>
								<button @click.prevent="checkout(event.id)" v-if="event.available" class="p-event__button df-button">{{ buttonText }}</button>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
import { mapGetters } from "vuex";
import { setTimeout } from 'core-js';

export default {
    name: 'EventPopup',
    components: {

	},
    data () {
        return {
			currentEvent: 0,
			managers: [],
			deltaX: 0,
			deltaY: 0
        }
    },
    computed: {
		...mapGetters({
			isOpened: 'OPEN_EVENT_POPUP',
			selectedEvents: 'GET_SELECTED_EVENTS'
		}),
		buttonText () {
			return lang.registration || 'Записаться'
		}
    },
    methods: {
		closeEvent: function () {
			this.$store.dispatch('OPEN_EVENT_POPUP', false);
			this.$root.$emit('fixOverflow', false)
		},
		beforeEnter: function () {
			this.currentEvent = 0;
		},
		afterEnter: function () {
			//Листаем события свайпом
			var square = document.querySelectorAll('.p-event__img');
            
			var Swipe = new Hammer.Swipe();

			for (var i=0; i < square.length; i++) {
				let manager = new Hammer.Manager(square[i], {touchAction: 'pan-y'});

				manager.add(Swipe);
				manager.on('swipe', this.swipe);

				this.managers.push(manager);
			}
		},
		leave: function () {
			this.managers.forEach((manager)=>{
				manager.off('swipe', this.swipe);
			})
		},
		swipe: function (e) {
			var that = this;

			that.deltaX = that.deltaX + e.deltaX;
			var direction = e.offsetDirection;

			console.log(direction)
			
			if (direction === 4) {
				that.prevEvent()
			} else if (direction === 2) {
				that.nextEvent()
			}
		},
		prevEvent: function () {
			if (this.currentEvent > 0) {
				this.currentEvent--;
			}
		},
		nextEvent: function () {
			if (this.currentEvent < this.selectedEvents.length - 1) {
				this.currentEvent++;
			}
		},
		checkout: function (id) {
			this.$store.dispatch('OPEN_CHECKOUT_EVENT_POPUP', true);
			this.$store.dispatch('SET_SELECTED_EVENT', id);
		},
		onEnter: function() {
			this.$root.$emit('fixOverflow', true)
		}
    },
    filters: {
		dateFormat: function (dateString) {
			var date = Date.parse(dateString+'T00:00:00.000+03:00'),
            objDate = new Date(date),
            month = objDate.getMonth() + 1,
			day = objDate.getDate();

			if (day < 10) {
				day = '0' + day;
			}

			if (month < 10) {
				month = '0' + month;
			}

			return day + '.' + month;
		}
	},
    mounted () {
		var that = this;

		this.$nextTick(()=>{
			
		})
    },
    watch: {

    }
}
</script>

<style lang="sass">

</style>
