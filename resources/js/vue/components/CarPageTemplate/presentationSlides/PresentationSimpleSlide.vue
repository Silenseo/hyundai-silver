<template>
	<div class="presentation__slide">
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
	name: "PresentationSimpleSlide",
	components: {},
	props: ['icon', 'title', 'description'],
	data() {
		return {
			
		};
	},
	computed: {
		
	},
	methods: {
		
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