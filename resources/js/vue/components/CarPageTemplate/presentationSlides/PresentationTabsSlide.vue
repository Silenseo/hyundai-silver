<template>
	<div class="presentation__slide">
		<div class="presentation__controls">
			<ul>
				<li v-for="(slide, index) in slides" :key="index">
					<a href="#" :class="{ active: currentSlide === index }" @click.prevent="selectSlide(index)">{{ slide.name }}</a>
				</li>
			</ul>
		</div>
		<div class="presentation__carousel">
			<transition name="frame" mode="in-out">
				<div class="presentation__frame" v-for="(slide, index) in slides" :key="index" v-if="index === currentSlide" :style="{ backgroundImage: 'url(' + slide.img + ')'  }"></div>
			</transition>
		</div>
		<div class="presentation__composition">
			<div class="presentation__img">
				<img :src="icon">
			</div>
			<div class="presentation__title">
				<span>
					{{ title }}
				</span>
			</div>
			<div class="presentation__description">
				<span>
					{{ description }}
				</span>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: "PresentationTabsSlide",
	components: {},
	props: ['icon', 'title', 'description', 'slides'],
	data() {
		return {
			currentSlide: 0
		};
	},
	computed: {
		
	},
	methods: {
		selectSlide: function (slide) {
			this.currentSlide = slide;
		}
	},
	filters: {},
	mounted() {
		
	},
	watch: {
		
	}
};
</script>

<style lang="sass">

</style>