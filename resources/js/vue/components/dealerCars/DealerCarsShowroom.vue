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
		
	}
}
</script>

<style lang="sass">
@import '../../../../sass/pages/dealerCars/showroom.sass'
</style>
