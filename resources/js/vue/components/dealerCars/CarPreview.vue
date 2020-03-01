<template>
	<div class="car-preview">
		<div class="car-preview__container" ref="car-container">
			<transition name="slider" mode="out-in">
				<div class="car-preview__img" v-for="(image, index) in filteredImages" :key="index" :style="'background-image: url(' + image + ')'"></div>
			</transition>
		</div>
		<ul class="car-preview__controller">
			<li class="car-preview__line" @mousemove="currentImage = index" v-for="(item, index) in images" :key="index"></li>
		</ul>
		<ul class="car-preview__nav">
			<li class="car-preview__item" v-for="(item, index) in images" :key="index" :class="{ active: currentImage === index }"></li>
		</ul>
	</div>
</template>

<script>

export default {
	name: 'CarPreview',
	props: {
		images: {
			type: Array,
			required: true
		}
	},
	data () {
		return {
			currentImage: 0,
			manager: null
		}
	},
	computed: {
		filteredImages: function() {
			return this.images.filter((image, i)=>i === this.currentImage)
		}
	},
	methods: {
		nextItem: function () {
			if (this.currentImage < this.images.length - 1) {
				this.currentImage++
			} else {
				this.currentImage = 0
			}
			
		},
		prevItem: function () {
			if (this.currentImage > 0) {
				this.currentImage--
			} else {
				this.currentImage = this.images.length - 1
			}
		}
	},
	beforeDestroy () {
		this.manager.destroy();
	},
	mounted () {
		var that = this;

		this.$nextTick(()=>{
			//Листаем слайды свайпом
			var square = this.$refs['car-container'];
			that.manager = new Hammer.Manager(square, {touchAction: 'pan-y'});
			var Swipe = new Hammer.Swipe();

			that.manager.add(Swipe);

			var deltaX = 0;
			var deltaY = 0;

			that.manager.on('swipe', function(e) {
				deltaX = deltaX + e.deltaX;
				var direction = e.offsetDirection;
				
				if (direction === 4) {
					that.prevItem()
				} else if (direction === 2) {
					that.nextItem()
				}
			});
		})
	}
}
</script>
