<template>
	<div class="car-slider">
		<div class="car-slider__wrapper">
			<ul :id="gallery" class="car-slider__list">
				<li class="car-slider__item" @click="openPopup" :class="{ pointer: !isPopup }" :key="index" v-for="(image, index) in images" :data-image="image" :style="'background-image: url(' + image + ')'"></li>
			</ul>
		</div>
		<div class="car-slider__nav">
			<ul :id="nav" class="car-slider__nav-list">
				<li class="car-slider__nav-item" :key="index" v-for="(image, index) in images" :style="'background-image: url(' + image + ')'"></li>
			</ul>
		</div>
	</div>
</template>

<script>
export default {
	name: 'CarPageSlider',
	props: {
		images: {
			type: Array,
			required: true
		},
		isPopup: {
			type: Boolean,
			required: true
		},
		event
	},
	data () {
		return {
			gallery: '',
			nav: ''
		}
	},
	methods: {
    	openPopup: function () {
			this.$emit('open-popup')
		}
	},
	created () {
		this.gallery = Math.floor(Math.random()*1000000)
		this.nav = Math.floor(Math.random()*1000000)
	},
	mounted () {
		this.$nextTick(()=>{
			$('#' + this.gallery).slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: true,
				fade: true,
				asNavFor: '#' + this.nav,
				infinite: true,
				lazyLoad: 'ondemand',
			});
			$('#' + this.nav).slick({
				slidesToShow: 5,
				slidesToScroll: 1,
				asNavFor: '#' + this.gallery,
				dots: false,
				centerMode: false,
				arrows: false,
				focusOnSelect: true
			});
		})
	},
	watch: {
		event: function () {
			$('#' + this.gallery).slick('refresh');
			$('#' + this.nav).slick('refresh');
		}
	}
}
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'

.car-slider
	height: 100%
	&__wrapper
		width: 100%
		height: 80%
	&__list, .slick-list, .slick-track
		height: 100%
	&__item
		height: 100%
		background-repeat: no-repeat
		background-position: 50%
		background-size: contain
		outline: none
		background-color: transparent
		&.pointer
			background-color: #fff
			cursor: pointer
	&__nav
		width: 100%
		height: calc(20% - 12px)
		margin-top: 12px
	&__nav-list, .slick-list, .slick-track
		height: 100%
	&__nav-item
		position: relative
		height: 100%
		background-repeat: no-repeat
		background-position: 50%
		background-size: cover
		outline: none
		margin-right: 10px
		&:not(.slick-current)
			&::after
				content: ''
				display: block
				position: absolute
				top: 0
				left: 0
				right: 0
				bottom: 0
				background-color: rgba(0, 0, 0, 0.32)
	.slick-prev, .slick-next
		width: 40px
		height: 40px
		background-color: rgba(0, 0, 0, 0.4)
		background-repeat: no-repeat
		background-size: 22%
		background-position: 50%
		z-index: 10
		&::before
			content: ''
	.slick-prev
		left: 0
		background-image: url('/images/santaFe/svg/left_slider.png')
	.slick-next
		right: 0
		background-image: url('/images/santaFe/svg/right_slider.png')

@media only screen and (max-width : $md-max)
	.car-slider
		&__wrapper
			height: 100%
		&__nav
			display: none
</style>
