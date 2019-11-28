<template>
	<section class="filters">
		<ul class="filters__list">
			<li v-for="filter in carcaseList" :key="filter.id">
				<label class="df-radiobutton filters__filter">
					<input class="df-radiobutton__input" type="radio" name="category" :value="filter" v-model="currentFilter" @change="setFilter">
					<div class="df-radiobutton__box"></div>
					<div class="df-radiobutton__description filters__description">{{ filter.name }}</div>
				</label>
			</li>
		</ul>
	</section>
</template>

<script>
import { mapGetters } from "vuex";

export default {
	name: "StartShowroomFilters",
	data() {
		return {
			currentFilter: {}
		};
	},
	computed: {
		...mapGetters({
			carcaseList: 'GET_START_CARCASE_LIST'
		})
	},
	methods: {
		setFilter: function() {
			this.$emit('set-filter', this.currentFilter);
		}
	},
	mounted: function() {
		this.currentFilter = this.carcaseList[0];
	}
};
</script>

<style lang="sass">

</style>