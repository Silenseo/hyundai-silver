<template>
	<div class="h-buttons" :class="{ oneButton: oneButton, fixed: fixed }">
		<ul class="h-buttons__list" :class="{ show: showList, showButton: showButton }">
			<li v-if="buttons[3]" class="h-buttons__item">
				<div class="h-buttons__link">
					<a class="h-buttons__button" :href="linkFromId"><span>Кредит</span></a>

					<div class="h-buttons__icon" @click="toggleButton">
						<svg width="36" height="24" viewBox="0 0 36 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="29.2259" cy="16.8064" r="5.77419" stroke="white" stroke-width="2"/>
							<path d="M28.2373 16.9291C28.9665 16.9291 29.5067 16.4145 29.5067 15.739C29.5067 15.0635 28.9665 14.5488 28.2373 14.5488C27.508 14.5488 26.9678 15.0635 26.9678 15.739C26.9678 16.4145 27.508 16.9291 28.2373 16.9291ZM28.2373 16.2408C27.9334 16.2408 27.7241 16.0092 27.7241 15.739C27.7241 15.4688 27.9334 15.2372 28.2373 15.2372C28.5411 15.2372 28.7505 15.4688 28.7505 15.739C28.7505 16.0092 28.5411 16.2408 28.2373 16.2408ZM28.19 18.9878H28.9868L31.3637 14.6132H30.5737L28.19 18.9878ZM31.3434 19.065C32.0727 19.065 32.6129 18.5503 32.6129 17.8748C32.6129 17.1993 32.0727 16.6847 31.3434 16.6847C30.6142 16.6847 30.074 17.1993 30.074 17.8748C30.074 18.5503 30.6142 19.065 31.3434 19.065ZM31.3434 18.3766C31.0396 18.3766 30.8303 18.145 30.8303 17.8748C30.8303 17.6046 31.0396 17.373 31.3434 17.373C31.6473 17.373 31.8566 17.6046 31.8566 17.8748C31.8566 18.145 31.6473 18.3766 31.3434 18.3766Z" fill="white"/>
							<path d="M21.3669 19.0645H2C1.44771 19.0645 1 18.6168 1 18.0645V2C1 1.44772 1.44772 1 2 1H31.6129C32.1652 1 32.6129 1.44772 32.6129 2V9.67805" stroke="white" stroke-width="2"/>
							<path d="M1.56458 6.48779H32.613" stroke="white" stroke-width="2"/>
						</svg>
					</div>
				</div>
			</li>
			<li v-if="buttons[0]" class="h-buttons__item">
				<div class="h-buttons__link">
					<a class="h-buttons__button" href="#" @click.prevent="testDrive"><span>Тест-драйв</span></a>

					<div class="h-buttons__icon" @click="toggleButton">
						<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="18" cy="18" r="13" stroke="white" stroke-width="2"/>
							<circle cx="18" cy="18" r="17" stroke="white" stroke-width="2"/>
							<circle r="2" transform="matrix(1 0 0 -1 18 17)" fill="white"/>
							<path d="M6 13L10.2389 11.9403C15.3345 10.6664 20.6655 10.6664 25.7611 11.9403L30 13" stroke="white" stroke-width="2"/>
							<path d="M5 18V18C11.0751 18 16 22.9249 16 29V31" stroke="white" stroke-width="2"/>
							<path d="M31 18V18C24.9249 18 20 22.9249 20 29V31" stroke="white" stroke-width="2"/>
						</svg>
					</div>
				</div>
			</li>
			<li v-if="buttons[1]" class="h-buttons__item">
				<div class="h-buttons__link">
					<a class="h-buttons__button" :href="'/configurator/car/'+carId"><span>Конфигуратор</span></a>

					<div class="h-buttons__icon" @click="toggleButton">
						<svg width="28" height="22" viewBox="0 0 28 22" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect x="13" y="9" width="2" height="13" fill="white"/>
							<rect x="3" width="2" height="12" fill="white"/>
							<rect x="3" y="18" width="2" height="4" fill="white"/>
							<rect x="23" width="2" height="11" fill="white"/>
							<rect x="23" y="17" width="2" height="5" fill="white"/>
							<circle cx="4" cy="16" r="3" stroke="white" stroke-width="2"/>
							<circle cx="24" cy="14" r="3" stroke="white" stroke-width="2"/>
							<circle cx="14" cy="6" r="3" stroke="white" stroke-width="2"/>
							<rect x="13" width="2" height="3" fill="white"/>
						</svg>
					</div>
				</div>
			</li>
		</ul>
		<a href="#" @click.prevent="toggleShowList" :class="{ show: showList }" class="h-buttons__main"></a>

		<sign-up-test-drive-form-popup v-if="isVisible" :page="page"></sign-up-test-drive-form-popup>
	</div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
	name: "HotButtons",
	components: {
		'sign-up-test-drive-form-popup': () => import('@/components/common/SignUpTestDriveFormPopup.vue')
	},
	props: {
		carId: Number,
		model: String,
		buttons: Array,
		page: String
	},
	data() {
		return {
			showList: false,
			showButton: false,
			init: false,
			fixed: false,
			initTdPopup: false,
			popups: 0
		}
	},
	computed: {
		...mapGetters({
			ENV: "GET_ENV",
			carsIdLinks: 'GET_CARS_ID_LINKS'
		}),
		isVisible: function () {
			if (this.$store.state.openTestDrivePopup) {
				this.initTdPopup = true;
			}

			return this.initTdPopup;
		},
		oneButton: function () {
			var count = 0;

			this.buttons.forEach(item => {
				count += item;
			});

			if (count === 1) {
				return true;
			} else {
				return false;
			}
		},
		scrollBarWidth: function() {
			var div = document.createElement('div');

			div.style.overflowY = 'scroll';
			div.style.width = '20px';
			div.style.height = '20px';

			div.style.visibility = 'hidden';

			document.body.appendChild(div);
			var scrollWidth = div.offsetWidth - div.clientWidth;
			document.body.removeChild(div);

			return scrollWidth
		},
		linkFromId () {
			if (this.carsIdLinks.filter(car=>car.id == this.carId).length > 0) {
				return '/start/' + this.carsIdLinks.filter(car=>car.id == this.carId)[0].link
			} else {
				return '/start'
			}
		}
	},
	methods: {
		toggleShowList: function () {
			this.showList = !this.showList;
			this.init = true;
		},
		testDrive: function () {
			if (typeof this.model !== 'undefined' && this.ENV !== 'dealer') {
				this.$store.dispatch('OPEN_TEST_DRIVE_POPUP', true);
				this.$store.dispatch('SET_SAVED_MODEL', this.model);
			} else {
				window.location = '/test-drive'
			}
		},
		toggleButton: function () {
			this.showButton = !this.showButton;
			this.init = true;
		},
		fixOverflow (makeFixed) {
			if (makeFixed === true) {
				document.body.style.overflow = 'hidden'
				this.popups++
			} else {
				this.popups--

				if (this.popups === 0) {
					document.body.style.overflow = ''
				}
			}
		}
	},
	mounted() {
		this.$root.$on('fixOverflow', this.fixOverflow)

		this.$nextTick(()=>{
			this.showList = true;
			this.showButton = true;

			$(window).on('scroll', ()=>{
				if (!this.init && !this.oneButton) {
					this.showList = false;
				}
				if (!this.init && this.oneButton) {
					this.showButton = false;
				}

				if (!this.fixed) {
					//Рассчитать положение кнопки
					let y = $('.h-buttons').offset().top;
					let x = $('.h-buttons').offset().left;
					let width = $('.h-buttons').width();
					let windowHeight = $(window).outerHeight();
					let windowWidth = $(window).outerWidth();

					$('.h-buttons').css({
						'right': (windowWidth - x - width - this.scrollBarWidth) + 'px',
						'bottom': (windowHeight - y - width) + 'px'
					});

					setTimeout(()=>{
						$('.h-buttons').css({
							'right': '40px',
							'bottom': '40px',
							'transition': '0.5s'
						});
					})
				}

				this.fixed = true
			})
		})
	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'

.h-buttons
	display: block
	color: $text_white
	// overflow: hidden
	z-index: 600
	font-size: 0
	border-radius: 24px
	//transition: 0.5s
	&.fixed
		position: fixed
	&__main
		display: inline-block
		position: relative
		width: 56px
		height: 56px
		border-radius: 50%
		background-color: $fire_Red
		&::after, &::before
			content: ''
			display: block
			position: absolute
			top: 0
			left: 0
			right: 0
			bottom: 0
			margin: auto
			background-color: #fff
			transition: 0.3s
		&::after
			width: 16px
			height: 2px
		&::before
			height: 16px
			width: 2px
		&.show
			&::after
				transform: rotate(-45deg)
			&::before
				transform: rotate(-45deg)
	&__list
		position: absolute
		right: 0
		padding-top: 50px
		padding-bottom: 72px
		bottom: 0px
		text-align: right
		font-size: 1.6rem
		line-height: 1.25
		border-radius: 56px
		pointer-events: none
		overflow: hidden
		&.show
			pointer-events: auto
			.h-buttons__link
				transform: translate(0, 0)
				will-change: transform
			.h-buttons__icon
				transform: scale(1)
				will-change: transform
			.h-buttons__button
				transform: translateX(0)
				will-change: transform
	&__item
		&:not(:last-of-type)
			margin-bottom: 8px
	&__link
		display: inline-block
		position: relative
		overflow: hidden
		border-radius: 24px
		transform: translate(0, 400%)
		transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275)
	&__icon
		display: block
		position: absolute
		top: 0
		right: 0
		width: 48px
		height: 48px
		border-radius: 24px
		background-color: $second_blue
		transform: scale(0)
		transition: 0.3s
		z-index: 1
		pointer-events: none
		svg
			display: block
			position: absolute
			top: 0
			left: 0
			right: 0
			bottom: 0
			margin: auto
	&__button
		display: block
		line-height: 48px
		border-radius: 24px
		padding-left: 16px
		padding-right: 60px
		background-color: rgba($second_blue, 0.6)
		transform: translateX(100%)
		transition: 0.3s
		span
			white-space: nowrap

.oneButton
	.h-buttons__main
		display: none
	.h-buttons__icon
		pointer-events: auto
	.h-buttons__list
		pointer-events: none
		.h-buttons__button
			transform: translateX(100%)
			transition-delay: 0s!important
	.h-buttons__list.showButton
		pointer-events: auto
		.h-buttons__button
			transform: translateX(0)


@for $i from 1 through 4
	.h-buttons__list.show
		.h-buttons__item:nth-of-type(#{$i}n)
			.h-buttons__link
				transition-delay: (4 - $i) * 0.1s
			.h-buttons__icon
				transition-delay: (4 - $i) * 0.1s
			.h-buttons__button
				transition-delay: (4 - $i) * 0.15s

	.h-buttons__list
		.h-buttons__item:nth-of-type(#{$i}n)
			.h-buttons__link
				transition-delay: (4 - $i) * 0.15s
			.h-buttons__icon
				transition-delay: (4 - $i) * 0.15s
			.h-buttons__button
				transition-delay: (4 - $i) * 0.1s

@media only screen and (max-width : $md-max)
	.h-buttons
		&.fixed
			right: 16px!important

</style>
