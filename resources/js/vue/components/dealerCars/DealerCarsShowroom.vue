<template>
	<div>
		<showroom-filters @filter="getArray"></showroom-filters>
		<showroom-list :filteredList="filteredArr"></showroom-list>
	</div>
</template>

<script>
import ShowroomFilters from './ShowroomFilters'
import ShowroomList from './ShowroomList'

export default {
	name: 'DealerCarsShowroom',
	components: { ShowroomFilters, ShowroomList },
	data () {
		return {
			filteredArr: []
		}
	},
	computed: {
		
	},
	methods: {
    	getArray: function(arr) {
			this.filteredArr = arr;
		}
	},
	mounted () {
		$(window).on('scroll', function() {
			this.$root.$emit('on-scroll')
		}.bind(this))
	}
}
</script>

<style lang="sass">
@import '../../../../sass/pages/dealer/cars/showroom.sass'
</style>
