<template>
	<div class="presentation" :ref="id" :class="{ isEntered: enter, showIcons: showIcons }">
		<div class="presentation__head">
			<transition name="main" :duration="{ enter: 500, leave: 500 }" mode="out-in">
				<h2 v-if="!enter" class="presentation__main" key="big">
					<span v-html="title"></span>
				</h2>
				<h2 v-else class="presentation__main presentation__main--small" key="small">
					<span v-html="title"></span>
				</h2>
			</transition>
		</div>
		<div class="presentation__left" ref="presentation__left">
			<div v-if="beforeEnter" :style="{ 'background-image': 'url(' + backgroundTotal + ')' }" :ref="'back'" class="presentation__back"></div>
		</div>
		
		<div class="presentation__icons-holder" ref="presentation__icons-holder" @click.self="close">
			<a href="#" class="presentation__icon" @click.prevent="selectItem(index, slide.zoom, slide.correct.x, slide.correct.y, 24)" v-for="(slide, index) in slides" :key="index" :class="[ 'presentation__icon--' + index ]" :ref="'icon--' + index">
				<div class="presentation__center"></div>
			</a>
		</div>
		
		<div v-if="beforeEnter" class="presentation__aside" ref="presentation__aside">
			<a href="#" class="presentation__prev" ref="presentation__prev" @click.prevent="prevItem">
				<svg width="18" height="38" viewBox="0 0 18 38" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M17 37L1.59055 19.6644C1.25376 19.2855 1.25376 18.7145 1.59055 18.3356L17 1" stroke-width="2"/>
				</svg>
			</a>
			<a href="#" @click.prevent="nextItem" class="presentation__next" ref="presentation__next">
				<svg width="18" height="38" viewBox="0 0 18 38" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 1L16.4095 18.3356C16.7462 18.7145 16.7462 19.2855 16.4095 19.6644L1 37" stroke-width="2"/>
				</svg>
			</a>
			<a href="#" class="presentation__close"  @click.prevent="close" ref="presentation__close">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M24 0.8568L23.1432 0L12 11.1432L0.8568 0L0 0.8568L11.1432 12L0 23.1432L0.8568 24L12 12.8568L23.1432 24L24 23.1432L12.8568 12L24 0.8568Z"/>
				</svg>
			</a>
			<ul class="presentation__dots">
				<li class="presentation__dot" @click="selectItem(index, slides[index].zoom, slides[index].correct.x, slides[index].correct.y)" v-for="(dot, index) in slides" :key="index" :class="{ active: selectedId === index }">
				</li>
			</ul>
			<transition name="slide" :duration="{ enter: 1000, leave: 1000 }" mode="out-in">
				<component v-bind:is="currentComponent(slide)" :icon="slide[0].icon" :title="slide[0].title" :description="slide[0].description" :slides="slide[0].slides" :key="slide[0].title" :style="{ backgroundImage: 'url(' + slide[0].background + ')'  }"></component>
			</transition>
		</div>
	</div>
</template>

<script>
import PresentationSimpleSlide from '../../../vue/components/CarPageTemplate/presentationSlides/PresentationSimpleSlide.vue'
import PresentationTabsSlide from '../../../vue/components/CarPageTemplate/presentationSlides/PresentationTabsSlide.vue'

export default {
	name: "PresentationSection",
	components: { PresentationSimpleSlide, PresentationTabsSlide },
	props: ['title', 'background', 'backgroundMobile', 'slides'],
	data() {
		return {
			id: 0,
			beforeEnter: false,
			enter: false,
			showIcons: false,
			selectedId: 0,
			anim: null,
			out: null,
			controller: null,
			windowWidth: 0
		};
	},
	computed: {
		slide: function () {
			return this.slides.filter((slide, i)=>{ return i === this.selectedId  })
		},
		backgroundTotal: function () {
			if (this.windowWidth > 639) {
				return this.background;
			} else {
				return this.backgroundMobile
			}
		}
	},
	methods: {
		currentComponent: function (slide) {
			if (slide[0].tabs) {
				return 'PresentationTabsSlide'
			} else {
				return 'PresentationSimpleSlide'
			}
		},
        selectItem: function (index, zoom, cX, cY, r) {
            var back = this.$refs['back'],
                backHeight = $(back).outerHeight(),
                backWidth = $(back).outerWidth(),
                item = this.$refs['icon--' + index],
                r = r ? r : 0,
                itemY = $(item).position().top + r,
                itemX = $(item).position().left + r;

            this.selectedId = index;

            if (this.out) {
                this.out.kill();
                this.anim = null;
            }
            if (this.anim) {
                this.anim.kill();
                this.anim = null;
            }
            
            this.zoom(back, backWidth, backHeight, itemX, itemY, zoom, cX, cY);
        },
        nextItem: function () {
            if (this.selectedId < this.slides.length - 1) {
                this.selectItem(this.selectedId + 1, this.slides[this.selectedId + 1].zoom, this.slides[this.selectedId + 1].correct.x, this.slides[this.selectedId + 1].correct.y)
            } else {
                this.selectedId = 0;
                this.selectItem(this.selectedId, this.slides[this.selectedId].zoom, this.slides[this.selectedId].correct.x, this.slides[this.selectedId].correct.y)
            }
        },
        prevItem: function () {
            if (this.selectedId > 0) {
                this.selectItem(this.selectedId - 1, this.slides[this.selectedId - 1].zoom, this.slides[this.selectedId - 1].correct.x, this.slides[this.selectedId - 1].correct.y)
            } else {
                this.selectedId = this.slides.length - 1;
                this.selectItem(this.selectedId, this.slides[this.selectedId].zoom, this.slides[this.selectedId].correct.x, this.slides[this.selectedId].correct.y)
            }
        },
        close: function () {
            this.anim.kill();

            this.exit();
        },
        zoom: function (item, w, h, x, y, zoom, cX, cY) {
            //Анимация приближения области
            //Вычисляем размер сдвига по осям X, Y
            var cX = cX ? cX : 0;
            var cY = cY ? cY : 0;
            var dX = - (w / 2) / 2 - (x - (w / 2)) - cX;
            var dY = h / 2 - y - cY;
            var that = this;

            this.anim = new TimelineMax({
                onComplete: function () {
					that.showIcons = false;
                }
            });
            
            this.anim
                .to($(this.$refs['presentation__icons-holder']).find('.presentation__icon'), 0.3, {
                    opacity: 0
                })
                .add('start')
                .to(item, 1, {
                    ease: Expo.easeOut,
                    transform: 'translate(' + dX + 'px , ' + dY + 'px)'
                }, 'start')
                .to($(this.$refs['presentation__left']), 1, {
                    ease: Expo.easeOut,
                    transform: 'scale(' + zoom + ')'
                }, 'start')
                .set(item, {
                    willChange: 'auto'
                })
                .to($(this.$refs['presentation__aside']), 0.5, {
                    transform: 'translateX(0)'
				}, 'start')
                .to($(this.$refs['presentation__prev']), 0.3, {
                    opacity: 1
                }, 'start+=0.5')
                .to($(this.$refs['presentation__next']), 0.3, {
                    opacity: 1
                }, 'start+=0.5')
                .to($(this.$refs['presentation__close']), 0.3, {
                    opacity: 1
                }, 'start+=0.5')
        },
        exit: function () {
            var item = this.$refs['back'];
            var that = this;

            this.out = new TimelineMax({
                onComplete: function () {
                    that.showIcons = true;
                }
            });
            
            this.out
                .set($(this.$refs['presentation__icons-holder']).find('.presentation__icon'), {
                    opacity: 1
                })
                .to($(this.$refs['presentation__prev']), 0.3, {
                    opacity: 0
                })
                .to($(this.$refs['presentation__next']), 0.3, {
                    opacity: 0
                })
                .to($(this.$refs['presentation__close']), 0.3, {
                    opacity: 0
                })
                .set(item, {
                    willChange: 'transform'
				})
				.add('start')
                .to($(this.$refs['presentation__aside']), 0.5, {
                    transform: 'translateX(150%)'
                })
                .to($(this.$refs['presentation__left']), 1, {
                    ease: Expo.easeOut,
                    transform: 'scale(1)'
                }, 'start')
                .to(item, 1, {
                    ease: Expo.easeOut,
                    transform: 'translate(0,0)'
                }, 'start')
                .set(item, {
                    willChange: 'auto'
                })
        }

    },
    mounted: function () {
        var that = this;

		this.id = Date.now();

        this.$nextTick(function () {
			that.controller = new ScrollMagic.Controller({});

            var beforePresentation = new ScrollMagic.Scene({ triggerElement: that.$refs[that.id], duration: '0', triggerHook: '1', offset: -500 })
				//.addIndicators({ name: "presentation" })
				.addTo(that.controller);

			beforePresentation.on("enter", function (event) {
				that.beforeEnter = true;
				
				//Листаем слайды свайпом
				setTimeout(()=>{
					var square = that.$refs['presentation__aside'];
					var manager = new Hammer.Manager(square, {touchAction: 'pan-y'});
					var Swipe = new Hammer.Swipe();

					manager.add(Swipe);

					var deltaX = 0;
					var deltaY = 0;

					manager.on('swipe', function(e) {
						deltaX = deltaX + e.deltaX;
						var direction = e.offsetDirection;
						
						if (direction === 4) {
							that.prevItem()
						} else if (direction === 2) {
							that.nextItem()
						}
					});
				}, 300)

				beforePresentation.destroy();
            });

            var presentation = new ScrollMagic.Scene({ triggerElement: that.$refs[that.id], duration: '0', triggerHook: '0.45' })
				//.addIndicators({ name: "design" })
				.addTo(that.controller);
            
            presentation.on("enter", function (event) {
                that.enter = true;
                that.showIcons = true;
                presentation.destroy();
			});
			
			//Отслеживание ширины окна
			$(window).on('resize', function () {
				that.windowWidth = $(window).width();
			})

			that.windowWidth = $(window).width();
        })
    }
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'

.presentation
	position: relative
	overflow: hidden
	background-color: #000
	height: 40vw
	&.isEntered
		.presentation__back
			&::after
				opacity: 0.35
	&.showIcons
		.presentation__icon
			transform: scale(1)
			box-shadow: 0 0 0 12px rgba(#00AAD2, 0.5)
	&__head
		position: absolute
		top: 26px
		left: 32px
		overflow: hidden
		z-index: 10
	&__main
		color: #fff
		font-size: 7.6rem
		line-height: 1.05
		font-weight: 500
		transition: transform 0.5s
		&--small
			opacity: 0.6
			color: #C3BAB4
			font-size: 2rem
			line-height: 1.5
	&__left
		position: absolute
		top: 0
		left: 0
		bottom: 0
		width: 50%
	&__prev, &__next
		position: absolute
		display: block
		width: 80px
		height: 80px
		background-color: rgba(#000000, 0.25)
		z-index: 10
		opacity: 0
		svg
			display: block
			position: absolute
			top: 0
			left: 0
			right: 0
			bottom: 0
			margin: auto
			width: 16px
			height: 36px
			stroke: #fff
			transition: 0.3s
		&:focus
			background-color: rgba(#000000, 0.25)
		&:hover
			svg
				stroke: #666666
	&__next
		left: -80px
		bottom: 0
	&__prev
		left: -160px
		bottom: 0
	&__back
		position: absolute
		top: 0
		left: 0
		width: 100vw
		bottom: 0
		background-repeat: no-repeat
		background-position: 50%
		background-size: cover
		will-change: transform
		img
			display: block
			width: 100%
		&::after
			content: ''
			display: block
			position: absolute
			top: 0
			right: 0
			bottom: 0
			left: 0
			background-color: #000
			opacity: 0
			transition: opacity 0.5s
	&__icons-holder
		position: absolute
		top: 0
		left: 0
		right: 0
		bottom: 0
	&__icon
		position: absolute
		width: 48px
		height: 48px
		border-radius: 50%
		background-color: #00AAD2
		z-index: 10
		transform: scale(0)
		box-shadow: 0 0 0 0px rgba(#00AAD2, 0.5)
		transition: transform 0.3s, box-shadow 0.3s
		&:focus
			background-color: #00AAD2
		&:hover, &:active
			.presentation__center
				transform: scale(1.16)
		&::after, &::before
			content: ''
			display: block
			position: absolute
			top: 0
			right: 0
			bottom: 0
			left: 0
			margin: auto
			width: 16px
			height: 2px
			background-color: #fff
			z-index: 5
		&::after
			transform: rotate(90deg)
	&__center
		position: absolute
		top: 0
		left: 0
		width: 100%
		height: 100%
		border-radius: 50%
		background-color: #00AAD2
		transition: transform 0.3s
	&__aside
		position: absolute
		top: 0
		right: 0
		bottom: 0
		width: 50%
		background-color: #000
		transform: translateX(150%)
		z-index: 20
		touch-action: auto
	&__list
		height: 100%
	&__slide
		position: absolute
		top: 0
		right: 0
		left: 0
		bottom: 0
		color: #fff
		padding: 55px
		padding-top: 20px
		background-repeat: no-repeat
		background-position: 50% 50%
		background-size: cover
		opacity: 1
		transition: opacity 0.5s
	&__animation
		position: absolute
		top: 0
		left: 0
		right: 0
		bottom: 0
	&__frame
		position: absolute
		top: 0
		left: 0
		right: 0
		bottom: 0
		background-repeat: no-repeat
		background-position: 50%
		background-size: cover
		transition: 0.5s
	&__composition
		position: absolute
		left: 55px
		bottom: 55px
		max-width: 400px
	&__img
		position: relative
		width: 64px
		height: 64px
		border-radius: 50%
		background-color: #E4DCD3
		margin-bottom: 15px
		transition: opacity 0.3s
		img
			display: block
			position: absolute
			top: 0
			left: 0
			right: 0
			bottom: 0
			max-width: 80%
			max-height: 80%
			margin: auto
	&__title
		font-size: 3.6rem
		line-height: 1.11
		font-weight: 500
		margin-bottom: 30px
		overflow: hidden
		span
			display: block
			transition: transform 0.3s
	&__description
		font-size: 1.8rem
		line-height: 1.33
		overflow: hidden
		span
			display: block
			transition: transform 0.5s
	&__close
		position: absolute
		display: block
		top: 20px
		right: 30px
		width: 64px
		height: 64px
		border-radius: 50%
		background-color: rgba(#000000, 0.25)
		opacity: 0
		z-index: 10
		svg
			display: block
			position: absolute
			top: 0
			right: 0
			bottom: 0
			left: 0
			margin: auto
			width: 24px
			height: 24px
			fill: #fff
			transition: 0.5s
		&:hover
			svg
				fill: #666666
	&__controls
		position: relative
		margin-right: 50px
		z-index: 10
		ul
			display: flex
			align-items: center
		li
			width: 100%
		a
			display: block
			line-height: 56px
			text-align: center
			background-color: rgba(0, 0, 0, 0.25)
			color: #fff
			font-size: 1.8rem
			font-weight: 500
			transition: 0.3s
			&:hover
				color: #B7B7B7
			&.active
				background-color: #00AAD2
	&__dots
		display: flex
		align-items: center
		justify-content: center
		position: absolute
		bottom: 24px
		left: 0
		width: 100%
		z-index: 10
	&__dot
		width: 12px
		height: 12px
		border-radius: 50%
		background-color: #fff
		cursor: pointer
		transition: 0.3s
		&:not(:last-of-type)
			margin-right: 10px
		&.active
			background-color: #00AAD2

@for $i from 1 through 10
    .presentation__icon--#{$i - 1}
        transition-delay: $i * 0.2s, $i * 0.35s


//Анимации
.slide-enter
    opacity: 0.2
    .presentation__title, .presentation__description
        span
            transform: translateY(100%)

.slide-leave-active
    opacity: 0
    transition-delay: 0.5s
    .presentation__img
        opacity: 0
    .presentation__title, .presentation__description
        span
            transform: translateY(100%)

.main-enter
    transform: translateY(100%)

.main-leave-active
    transform: translateY(100%)

.frame-enter
    opacity: 0

.frame-leave-active
    opacity: 0

@media only screen and (max-width : $lg-max)
	.presentation
		height: 81vw
		&__head
			top: 30px
			left: 40px
		&__aside
			width: 100%
		&__prev, &__next
			&:focus
				background-color: rgba(#000000, 0.25)
			&:hover
				svg
					stroke: #fff
		&__next
			left: auto
			right: 0
		&__prev
			left: auto
			right: 80px
		&__close
			right: 40px
		&__composition
			left: 40px
			//bottom: 37px

@media only screen and (max-width : $md-max)
	.presentation
		&.showIcons
			.presentation__icon
				box-shadow: 0 0 0 10px rgba(0, 170, 210, 0.5)
		&__head
			top: 21px
			left: 16px
		&__main
			font-size: 36px
			&--small
				font-size: 16px
				line-height: 18px
		&__icon
			width: 37px
			height: 37px
		&__close
			width: 24px
			height: 24px
			top: 32px
			right: 16px
			background-color: transparent
		&__composition
			left: 16px
			right: 16px
			bottom: 63px
		&__img
			width: 48px
			height: 48px
		&__title
			font-size: 20px
			margin-bottom: 6px
		&__description
			font-size: 14px
		&__prev, &__next
			display: none
		&__slide
			padding-left: 16px
		&__controls
			margin-right: 0
			a
				font-size: 16px
				line-height: 48px

@media only screen and (max-width : 639px)
	.presentation
		height: 398px

</style>