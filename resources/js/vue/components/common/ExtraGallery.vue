<template>
	<div class="e-gallery" ref="touch">
		<div class="e-gallery__body" v-if="init">
			<div class="e-gallery__last">
				<transition :name="animation">
					<div class="e-gallery__slide" v-if="lastSlide === index" v-for="(photo, index) in photos" :key="index" :style="'background-image: url(' + photo + ')'"></div>
				</transition>
			</div>
			<div class="e-gallery__second">
				<transition :name="animation">
					<div class="e-gallery__slide" v-if="secondSlide === index" v-for="(photo, index) in photos" :key="index" :style="'background-image: url(' + photo + ')'"></div>
				</transition>
			</div>
			<div class="e-gallery__first">
				<transition :name="animation">
					<div class="e-gallery__slide" v-if="currentSlide === index" v-for="(photo, index) in photos" :key="index" :style="'background-image: url(' + photo + ')'"></div>
				</transition>
			</div>
		</div>
		<div class="e-gallery__footer">
			<a href="#" class="e-gallery__button e-gallery__button--prev" @click.prevent="prevSlide">
				<svg width="34" height="14" viewBox="0 0 34 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8 13L4.3698 7.5547C4.14587 7.2188 4.14587 6.7812 4.3698 6.4453L8 1" stroke="#002C5F" stroke-width="2"/>
					<path d="M5 7L34 7" stroke="#002C5F" stroke-width="2"/>
				</svg>
			</a>
			<a href="#" class="e-gallery__button e-gallery__button--next" @click.prevent="nextSlide">
				<svg width="34" height="14" viewBox="0 0 34 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M26 1L29.6302 6.4453C29.8541 6.7812 29.8541 7.2188 29.6302 7.5547L26 13" stroke="#002C5F" stroke-width="2"/>
					<path d="M29 7L0 7" stroke="#002C5F" stroke-width="2"/>
				</svg>
			</a>
		</div>
	</div>
</template>

<script>
export default {
	name: "ExtraGallery",
	components: {},
	props: {
		photos: Array
	},
	data() {
		return {
			init: false,
			currentSlide: 0,
			animation: 'slide'
		};
	},
	computed: {
		lastSlide: function() {
			if (this.currentSlide + 2 <= this.photos.length - 1) {
				return this.currentSlide + 2;
			} else {
				return 0;
			}
		},
		secondSlide: function() {
			if (this.currentSlide + 1 <= this.photos.length - 1) {
				return this.currentSlide + 1;
			} else {
				return 0;
			}
		}
	},
	methods: {
		nextSlide: function() {
			this.animation = 'slide';

			if (this.currentSlide < this.photos.length - 1) {
				this.currentSlide++;
			} else {
				this.currentSlide = 0;
			}
		},
		prevSlide: function() {
			this.animation = 'slidePrev';

			if (this.currentSlide > 0) {
				this.currentSlide--;
			} else {
				this.currentSlide = this.photos.length - 1;
			}
		}
	},
	mounted() {
		var that = this;

		this.$nextTick(()=>{
			//Отложенная загрузка картинок
			var controller = new ScrollMagic.Controller();

			var gallery =new ScrollMagic.Scene({triggerElement: ".e-gallery", triggerHook: 1 })
				//.addIndicators({name: "gallery (duration: 0)"}) // add indicators (requires plugin)
				.addTo(controller);

			gallery.on("enter", function () {
				that.init = true;
			});

			//Листаем слайды свайпом
			setTimeout(()=>{
				var square = that.$refs['touch'];
				var manager = new Hammer.Manager(square, {touchAction: 'pan-y'});
				var Swipe = new Hammer.Swipe();

				manager.add(Swipe);

				var deltaX = 0;
				var deltaY = 0;

				manager.on('swipe', function(e) {
					deltaX = deltaX + e.deltaX;
					var direction = e.offsetDirection;
					
					if (direction === 2) {
						that.prevSlide()
					} else if (direction === 4) {
						that.nextSlide()
					}
				});
			}, 300)
		})
	},
	watch: {

	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'
@import '../../../../sass/common/components/_extra-gallery.sass'
</style>