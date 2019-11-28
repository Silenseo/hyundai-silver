<template>
	<transition name="popup" v-on:enter="onEnter" v-on:leave="onLeave">
		<div class="p-close df-popup" v-show="isOpened">
			<div class="p-close__wrap df-popup__wrap" @mousedown.self="closeThis">
				<div class="p-close__center df-popup__center">
					<a href="#" @click.prevent="closeThis" class="p-close__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<div class="p-close__back"></div>
					<div class="p-close__body">
						<h3 class="p-close__title">Уважаемые посетители!</h3>
						<div class="p-close__text" v-html="text"></div>
					</div>
					<div class="p-close__footer">
						Будем рады видеть вас снова после возобновления работы Студии!
					</div>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
export default {
	name: 'ClosedPopup',
	props: {
		isOpened: {
			type: Boolean,
			required: true
		},
		text: {
			type: String,
			required: true
		}
	},
    components: {

	},
    data () {
        return {
			
        }
    },
    computed: {
		
    },
    methods: {
		closeThis: function () {
			this.$emit('close');
		},
		onEnter: function() {
			this.$root.$emit('fixOverflow', true)
		},
		onLeave: function() {
			this.$root.$emit('fixOverflow', false)
		}
    },
    filters: {
		
	},
    mounted () {
		
    },
    watch: {

    }
}
</script>
