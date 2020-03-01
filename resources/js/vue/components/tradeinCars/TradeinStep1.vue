<template>
	<ul class="t-showroom">
		<li class="t-car" :key="key" v-for="(car, key) in sortedList" @click="goToCar(car.id)">
			<div class="t-car__name">{{ car.name }}</div>
			<div class="t-car__price">{{ car.minPrice | currencyFormat }} <span v-if="car.maxPrice > 0">— {{ car.maxPrice | currencyFormat }}</span> ₽</div>
			<div class="t-car__profit">% {{ car.profitPrice | currencyFormat }} ₽</div>
			<div class="t-car__img" :style="'background-image: url(' + car.image + ')'"></div>
			<div class="t-car__link" @click.stop="toAbout(car.link)">о модели</div>
		</li>
	</ul>
</template>

<script>
export default {
	name: 'TradeinStep1',
	data () {
		return {
			list: []
		}
	},
	computed: {
		sortedList: function () {
			return this.list.sort((a, b)=>a.order - b.order)
		}
	},
	methods: {
    	goToCar: function(value) {
			this.$router.push({ name: 'step-2', params: { id: value } })
		},
		toAbout: function(value) {
			window.location = value
		}
	},
	created () {
		if (typeof carsList !== 'undefined') {
			this.list = carsList
		}
	},
	mounted () {
		
	}
}
</script>


