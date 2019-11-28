<template>
	<div class="view" v-cloak>
		<h2 class="view__title">{{ title }}</h2>
		<div class="view__body" @click = "init360">
			<div class="view__back" :style="{ backgroundImage: 'url('+ preview +')'  }" v-if="!isLoaded"></div>
			<div id="spritespin" class="view__spritespin"></div>
			<transition name="preloader" v-if="carId != 16">
				<div class="view__preloader" v-if="!isLoaded">
					<img v-if="!isInit" class="view__img" src="/images/icons/360.svg">
					<div v-else class="view__progress">{{ progressFormatted }}%</div>
				</div>
			</transition>
			<div class="view__nav">
				<transition name="preloader-arrow">
					<a v-if="isInit" href="#" class="view__prev" @click.prevent="prev">
						<svg width="18" height="38" viewBox="0 0 18 38" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M17 37L1.59055 19.6644C1.25376 19.2855 1.25376 18.7145 1.59055 18.3356L17 1" stroke-width="2"/>
						</svg>
					</a>
				</transition>
				<transition name="preloader-arrow">
					<a v-if="isInit" href="#" class="view__next" @click.prevent="next">
						<svg width="18" height="38" viewBox="0 0 18 38" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 1L16.4095 18.3356C16.7462 18.7145 16.7462 19.2855 16.4095 19.6644L1 37" stroke-width="2"/>
						</svg>
					</a>
				</transition>
			</div>
		</div>
		<div class="view__bottom">
			<div class="colors">
				<div class="colors__current">{{ currentColor }}</div>
				<ul class="colors__list">
					<li class="colors__color" :data-name="color.nameRus + ' / ' + color.name" :class="{ active: activeColor === color.id }" v-for="color in colors" @click.prevent="setColor(color)" :style="{ backgroundColor: color.colorCode  }" :key="color.id"></li>
				</ul>
			</div>
		
			<a target="_blank" :href="'/configurator/car/' + carId" class="view__button df-button">Создать конфигурацию</a>
		</div>
		<notifier></notifier>
	</div>
</template>

<script>
import axios from 'axios'
import Notifier from '@/components/Notifier'
import * as SpriteSpin from "spritespin"

export default {
	name: "View360",
	components: { Notifier },
	props: ['title', 'carId', 'defaultColor'],
	data() {
		return {
			success: true,
			spritespinAPI: null,
			colorsAPI: [],
			activeColor: 0,
			prevColor: 0,
			spritespin: null,
			frame: 0,
			lastFrameSrc: 0,
			isLoaded: false,
			isFirstLoaded: false,
			isInit: false,
			progress: 0,
			currentCar: null,
			activeColorObj: null
		};
	},
	computed: {
        sourceArray: function () {
            var folder = this.spritespin[this.activeColor].folder;
            var ext = this.spritespin[this.activeColor].extension;
            var result = []
            for (var i = 0; i < 36; i++) {
                result.push(folder + '/' + i + '.' + ext)
            }

            return result
        },
        colors: function () {
            var colors = [];

            for (var group in this.colorsAPI) {
                for (var color in this.colorsAPI[group]) {
                    colors.push(this.colorsAPI[group][color])
                }
            }

            return colors;
        },
        currentColor: function () {
            for (var i = 0; i < this.colors.length; i++) {
                if (this.colors[i].id === this.activeColor) {
                    return this.colors[i].nameRus+' / '+this.colors[i].name+', '+ this.priceFormat(this.colors[i].cost)
                }
            }
        },
        preview: function () {
			if (this.carId == 16 && this.activeColorObj) {
				return this.activeColorObj.carImage;
			}
			if (this.prevColor !== 0 && this.isInit && this.isFirstLoaded) {
                return this.spritespin[this.prevColor].folder + '/' + this.frame + '.' + this.spritespin[this.prevColor].extension;
			}
            if (this.activeColor !== 0 && !this.isLoaded) {
                return this.spritespin[this.activeColor].folder + '/' + this.frame + '.' + this.spritespin[this.activeColor].extension;
            }
			if (this.activeColor === 0) {
				return ''
			}
        },
        progressFormatted: function () {
            return Math.round(this.progress) > 100 ? 100 : Math.round(this.progress)
        }
      },
    methods: {
        set360: function () {
            var that = this;

			$("#spritespin").spritespin('destroy')

            $("#spritespin").spritespin({
                source: that.sourceArray,
                animate: false,
                //behavior: 'drag',
                frames: 36,
                frameTime: 40,
                frame: that.frame,
                lanes: 1,
                //mods: ['drag', '360'],
                module: null,
                renderer: 'canvas',
                reverse: false,
                scrollThreshold: 500,
				responsive: true,
                onLoad: function () {
					that.isLoaded = true
					that.isFirstLoaded = true
				},
				onFrame: function () {
					that.frame = that.spritespinAPI.data.frame
					that.lastFrameSrc = that.spritespinAPI.data.source[that.frame]
				},
				onProgress: function () {
					that.progress += (100/36)
				}
            });

			this.spritespinAPI = $("#spritespin").spritespin('api');
        },
        getData: function () {
            var that = this;

            axios.get(this.$store.state.API.CAR + this.carId)
                .then(function (response) {
					that.currentCar = response.data;
                    that.colorsAPI = response.data.exterior.colors.groups;
                    that.spritespin = response.data.exterior.spritespin;

					let activeColor = 0;

					if (typeof that.defaultColor !== 'undefined') {
						activeColor = +that.defaultColor;
					} else {
						activeColor = response.data.exterior.colors.defaultColor;
					}
					
					for (var group in that.colorsAPI) {
						for (var color in that.colorsAPI[group]) {
							if (that.colorsAPI[group][color].id === activeColor) {
								that.setColor(that.colorsAPI[group][color]);
							}
						}
					}

                    that.success = true;
                })
                .catch(function (error) {
					that.success = false;
					that.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
                    console.log(error);
                });
        },
        prev: function() {
            this.spritespinAPI.prevFrame()
        },
        next: function() {
            this.spritespinAPI.nextFrame()
        },
        setColor: function (color) {
			this.prevColor = this.activeColor;
			this.activeColor = color.id;
			this.activeColorObj = color;
        },
        init360: function () {
            if (!this.isInit && this.carId != 16) {
                this.isInit = true;
                this.set360();
                //this.preloader();
            }
        },
        preloader: function () {
            // var t = new TimelineMax();

            // t
            //     .to(this, 2, {
            //         progress: 99
            //     })
		},
		priceFormat: function (value) {
			return value.toString().replace(/\D/g, '').replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' ') + ' ₽'
		}
    },
    mounted: function () {
        var that = this;

        this.getData();
        this.$nextTick(function () {
            
        })
    },
    watch: {
        activeColor: function () {
            if (this.isInit) {
                this.isLoaded = false;
                this.progress = 0;
                this.set360();
                //this.preloader();
            }
        }
    }
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'

.view
	display: flex
	flex-direction: column
	justify-content: space-between
	padding-top: 43px
	padding-left: 32px
	padding-right: 32px
	padding-bottom: 54px
	height: 100%
	&__title
		display: block
		text-align: center
	&__body
		flex: none
		position: relative
		margin: 0 auto
		max-width: 910px
		width: 100%
		&::after
			content: ''
			display: block
			top: 0
			left: 0
			padding-bottom: 45%
		#spritespin
			position: absolute!important
			top: 0
			left: 0
			width: 100%
			height: 100%
	&__back
		position: absolute
		top: 0
		left: 0
		width: 100%
		height: 100%
		background-size: 100%
	&__nav
		position: absolute
		display: flex
		align-items: center
		justify-content: space-between
		top: 50%
		left: 0
		width: 100%
		height: 0
	&__next, &__prev
		display: block
		transition: 0.3s
		svg
			stroke: #000
			transition: 0.3s
		&:hover
			svg
				stroke: #B7B7B7
	&__prev

	&__next

	&__preloader
		display: block
		position: absolute
		top: 0
		right: 0
		bottom: 0
		left: 0
		margin: auto
		width: 88px
		height: 88px
		border-radius: 50%
		background-color: rgba(#000000, 0.7)
		cursor: pointer
		img
			display: block
			position: absolute
			top: 0
			left: 0
			right: 0
			bottom: 0
			margin: auto
	&__progress
		display: block
		position: absolute
		top: 0
		left: 0
		right: 0
		bottom: 0
		margin: auto
		line-height: 88px
		font-size: 20px
		color: #fff
		font-weight: 500
		text-align: center
	&__bottom
		display: flex
		align-items: flex-end
		justify-content: space-between
    
.colors
	&__current
		font-size: 2rem
		line-height: 1.2
		font-weight: 500
		color: $text_black
		margin-bottom: 20px
	&__list
		display: flex
		align-items: center
	&__color
		position: relative
		width: 56px
		height: 56px
		cursor: pointer
		flex: none
		&::after
			content: ''
			display: block
			position: absolute
			top: -7px
			right: -4px
			width: 20px
			height: 20px
			border-radius: 50%
			background-color: $second_blue
			background-image: url('/images/icons/check.svg')
			background-repeat: no-repeat
			background-position: 50%
			background-size: 50%
			transform: scale(0)
			transition: transform 0.3s
		&:not(:last-of-type)
			margin-right: 8px
		&.active
			&::after
				transform: scale(1)
                
.preloader-arrow-enter
    opacity: 0

.preloader-leave-active
    opacity: 0

@media only screen and (max-width : $lg-max)
	.view
		padding: 40px
		&__bottom
			flex-wrap: wrap
			justify-content: center
		&__button
			margin-top: 40px
	
	.colors
		width: 100%

@media only screen and (max-width : $md-max)
	.view
		padding: 31px 16px 40px 16px
		&__button
			width: 100%
			margin-top: 32px
		&__preloader
			width: 48px
			height: 48px
		&__progress
			font-size: 14px
			line-height: 48px

	.colors
		&__current
			font-size: 16px
			margin-bottom: 0
		&__list
			overflow: auto
			padding-top: 20px
			min-width: 100%
			margin-right: -16px
		&__color
			width: 48px
			height: 48px
			margin-right: 8px
</style>