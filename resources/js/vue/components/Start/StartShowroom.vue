<template>
	<section class="cars" :class="{ isDealer: ENV === 'dealer' }">
		<h2 class="cars__title" v-if="ENV !== 'dealer'">Выберите автомобиль</h2>
		<h2 class="cars__title" v-else>Выберите свой Hyundai</h2>
		<start-showroom-filters v-if="ENV === 'dealer'" @set-filter="setFilter"></start-showroom-filters>
		<ul class="cars__list" :class="{ isDealer: ENV === 'dealer' }">
			<li class="cars__item" :key="car.id" :ref="car.id" :class="{ active: car.id === currentCar.id }" v-for="car in filteredCars" @click="setCar(car)">
				<div class="cars__name">{{ car.name }}</div>
				<div class="cars__price">
					<span>{{ car.minPrice | currencyFormat }}</span>
					<span>&mdash;</span>
					<span>{{ car.maxPrice | currencyFormat }}</span>
					<span>₽</span>
				</div>
				<div class="cars__img">
					<img :src="car.image" :alt="car.name">
				</div>
				<div class="cars__program">{{ car.programName }}</div>
				<div class="cars__fp">от {{ car.payment | currencyFormat }} ₽/мес</div>
			</li>
		</ul>
	</section>
</template>

<script>
import { mapGetters } from "vuex";

export default {
	name: "StartShowroom",
	components: { StartShowroomFilters: () => import('./StartShowroomFilters') },
	data() {
		return {
			currentFilter: {}
		};
	},
	computed: {
		...mapGetters({
			ENV: "GET_ENV",
			currentCar: 'GET_START_CURRENT_CAR',
			modelsList: 'GET_START_MODELS_LIST'
		}),
		sortedCars: function() {
			return this.modelsList.map((car)=>{
				if (car.id === 22) {
					car.superOrder = 1;
				}
				if (car.id === 26) {
					car.superOrder = 2;
				}
				if (car.id === 25) {
					car.superOrder = 3;
				}
				if (car.id === 23) {
					car.superOrder = 4;
				}
				if (car.id === 27) {
					car.superOrder = 5;
				}
				if (car.id === 24) {
					car.superOrder = 6;
				}
				if (car.id === 7) {
					car.superOrder = 7;
				}
				if (car.id === 16) {
					car.superOrder = 8;
				}

				return car
			}).sort(function(a, b) {
				return a.superOrder - b.superOrder
			}).filter((function(item){ return item.id !== 28 }));
		},
		filteredCars: function() {
			if ('id' in this.currentFilter) {
				if (this.currentFilter.id == 0) {
					return this.sortedCars
				} else {
					return this.sortedCars.filter(car=>car.carcaseId == this.currentFilter.id)
				}
			} else {
				return this.sortedCars
			}
		}
	},
	methods: {
		priceFormat: function (value) {
            return value.toString().replace(/\D/g, '').replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' ') + ' ₽'
		},
		setCar: function(car) {
			this.$emit('set-car', car);

			dataLayer.push({
              "event": "custom_event",
              "category": "Страница программы start",
              "action": "Выбор автомобиля",
              "label": car.codeName
  			});
		},
		setFilter: function(filter) {
			this.currentFilter = filter;

			setTimeout(()=>{
				this.$emit('refresh-carousel');
			}, 500);
		}
	},
	mounted() {

	},
	watch: {}
};
</script>

<style lang="sass">

</style>