<template>
	<section class="calendar-list">
		<ul class="calendar-list__list js-slider owl-carousel">
			<li class="event" :class="{ promo: event.promo }" v-for="(event, index) in actualEvents" :key="index">
				<a href="#" class="event__link" @click.prevent="openPopup(event)">
					<div class="event__img" :style="'background-image: url('+ event.img + ')'">
					</div>
					<div class="event__line">
						<div class="event__from h6">{{ event.from | dateFormat }}</div>
						<div class="evant__separator h6" v-if="event.from !== event.to">&nbsp;&mdash;</div>
						<div class="event__to h6" v-if="event.from !== event.to">{{ event.to | dateFormat }}</div>
					</div>
					<div class="event__name">
						{{ event.name }}
					</div>
				</a>
			</li>
		</ul>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="event promo d-lg-none d-sm-block" v-if="promoEvent.length > 0">
						<a href="#" class="event__link" @click.prevent="openPopup(promoEvent[0])">
							<div class="event__img" :style="'background-image: url('+ promoEvent[0].img + ')'">
							</div>
							<div class="event__right">
								<div class="event__line">
									<div class="event__from h6">{{ promoEvent[0].from | dateFormat }}</div>
									<div class="evant__separator h6" v-if="promoEvent[0].from !== promoEvent[0].to">&nbsp;&mdash;</div>
									<div class="event__to h6" v-if="promoEvent[0].from !== promoEvent[0].to">{{ promoEvent[0].to | dateFormat }}</div>
								</div>
								<div class="event__name">
									{{ promoEvent[0].name }}
								</div>
							</div>
						</a>
					</div>
					<ul class="calendar-list__list calendar-list__list--mobile">
						<li class="event event--mobile" v-for="(event, index) in actualEventsWithoutPromo" :key="index">
							<a href="#" class="event__link" @click.prevent="openPopup(event)">
								<div class="event__img" :style="'background-image: url('+ event.img + ')'">
								</div>
								<div class="event__right">
									<div class="event__line">
										<div class="event__from h6">{{ event.from | dateFormat }}</div>
										<div class="evant__separator h6" v-if="event.from !== event.to">&nbsp;&mdash;</div>
										<div class="event__to h6" v-if="event.from !== event.to">{{ event.to | dateFormat }}</div>
									</div>
									<div class="event__name">
										{{ event.name }}
									</div>
									<div class="event__description" v-html="event.description">
									</div>
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
export default {
    name: 'CalendarSectionList',
    components: {

	},
	props: ['slide', 'currentMonth', 'currentYear'],
    data () {
        return {
			events: [],
			owl: null
        }
    },
    computed: {
		actualEvents: function () {
			return this.events.filter((event)=>{
				let today = new Date();

				today.setHours(0, 0, 0, 0);

				return new Date(Date.parse(event.to+'T00:00:00.000+03:00')) - today >= 0;
			})
		},
		currentMonthEvents: function () {
			//События, которые актуальны в этом месяце
			return this.actualEvents.filter((event)=>{
				let from = new Date(Date.parse(event.from+'T00:00:00.000+03:00'));
				let to = new Date(Date.parse(event.to+'T00:00:00.000+03:00'));
				let firstMonthDay = new Date(this.year, this.month, 1, 0, 0, 0, 0);
				let lastMonthDay = new Date(this.year, this.month + 1, 0, 0, 0, 0, 0);

				return (lastMonthDay - from >= 0) && (to - firstMonthDay >= 0);
			})
		},
		promoEvent: function () {
			return this.currentMonthEvents.filter((event)=>{
				return event.promo;
			})
		},
		actualEventsWithoutPromo: function () {
			return this.currentMonthEvents.filter((event)=>{
				return !event.promo;
			})
		},
		month: function () {
			return this.currentMonth ? this.currentMonth : 0
		},
		year: function () {
			let year;
			let now = new Date();

			if (this.currentYear === '') {
                year = now.getFullYear();
            } else {
                year = this.currentYear;
			}
			
			return  year;
		}
    },
    methods: {
		openPopup: function (arr) {
			this.$store.dispatch('SET_SELECTED_EVENTS', arr)
			this.$store.dispatch('OPEN_EVENT_POPUP', true)
		}
    },
    filters: {
		dateFormat: function (dateString) {
			var date = Date.parse(dateString+'T00:00:00.000+03:00'),
            objDate = new Date(date),
            month = objDate.getMonth(),
			day = objDate.getDate();

			switch (month) {
				case 0:
					month = window.lang.monthArrNum[0] || 'января';
					break;
				case 1:
					month = window.lang.monthArrNum[1] || 'февраля';
					break;
				case 2:
					month = window.lang.monthArrNum[2] || 'марта';
					break;
				case 3:
					month = window.lang.monthArrNum[3] || 'апреля';
					break;
				case 4:
					month = window.lang.monthArrNum[4] || 'мая';
					break;
				case 5:
					month = window.lang.monthArrNum[5] || 'июня';
					break;
				case 6:
					month = window.lang.monthArrNum[6] || 'июля';
					break;
				case 7:
					month = window.lang.monthArrNum[7] || 'августа';
					break;
				case 8:
					month = window.lang.monthArrNum[8] || 'сентября';
					break;
				case 9:
					month = window.lang.monthArrNum[9] || 'октября';
					break;
				case 10:
					month = window.lang.monthArrNum[10] || 'ноября';
					break;
				case 11:
					month = window.lang.monthArrNum[11] || 'декабря';
					break;
			}

			return day + ' ' + month;
		}
    },
    mounted () {
		var that = this;

		this.events = itemsJson;

        this.$nextTick(function () {
			//Карусель
			that.owl = $(".js-slider");

			$('#carousel_controls').html('');

			that.owl.owlCarousel({
				items: 3,
				nav: true,
				dots: false,
				margin: 32,
				autoWidth: true,
				navText: ['<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 11L2.10207 6.66896C1.75979 6.28866 1.75979 5.71134 2.10207 5.33103L6 1" stroke="#002C5F" stroke-width="2"/></svg>', '<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L4.89793 5.33104C5.24021 5.71134 5.24021 6.28866 4.89793 6.66896L1 11" stroke="#002C5F" stroke-width="2"/></svg>'],
				navContainer: '#carousel_controls'
			});

        })
    },
    watch: {
		slide: function () {
			if (this.slide == 'prev') {
				this.owl.trigger('prev.owl.carousel');
			}
			if (this.slide == 'next') {
				this.owl.trigger('next.owl.carousel');
			}
		}
    }
}
</script>

<style lang="sass">

</style>
