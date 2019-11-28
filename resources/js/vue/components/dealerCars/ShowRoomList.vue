<template>
	<div class="d-list">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="d-list__inner">
						<div class="d-list__top">
							<div class="d-list__sort">
								<dropdown-sort :selectedItem="currentSort" placeholder="Выберите тип сортировки" :options="sortOptions" @change="setSort"></dropdown-sort>
							</div>
							<div class="d-list__amount">
								{{ filteredList.length }} <span>{{ words }}</span>
							</div>
						</div>
						<ul class="d-list__list">
							<li class="d-list__item" v-for="(car, index) in sortedList" :key="index">
								<showroom-car :specifications="car"></showroom-car>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import ShowroomCar from './ShowroomCar'
import DropdownSort from '@/components/common/DropdownSort'

export default {
	name: 'ShowroomList',
	components: { ShowroomCar, DropdownSort },
	props: {
		filteredList: {
			type: Array,
			required: true
		}
	},
	data () {
		return {
			sortOptions: [
				'По актуальности',
				'По дате',
				'По цене (дешевле — дороже)',
				'По цене (дороже — дешевле)',
				'По году (новые — старые)',
				'По году (старые — новые)',
				'По пробегу',
				'По названию'
			],
			currentSort: -1
		}
	},
	computed: {
		sortedList: function () {
			switch (this.currentSort) {
				case 0:
					return this.filteredList.sort((a, b)=>a.relevance - b.relevance)

					break;
				case 1:
					return this.filteredList.sort((a, b)=>{
						var millisecondsA = Date.parse(a.date),
							millisecondsB = Date.parse(b.date);

						if (!isNaN(millisecondsA) && !isNaN(millisecondsB)) {
							return millisecondsA - millisecondsB
						} else {
							return 0
						}
					})

					break;
				case 2:
					return this.filteredList.sort((a, b)=>a.minPrice - b.minPrice)

					break;
				case 3:
					return this.filteredList.sort((a, b)=>b.minPrice - a.minPrice)

					break;
				case 4:
					return this.filteredList.sort((a, b)=>b.year - a.year)

					break;
				case 5:
					return this.filteredList.sort((a, b)=>a.year - b.year)

					break;
				case 6:
					return this.filteredList.sort((a, b)=>a.milleage > b.milleage ? 1 : a.milleage < b.milleage ? -1 : 0)

					break;
				case 7:
					return this.filteredList.sort((a, b)=>a.name > b.name ? 1 : a.name < b.name ? -1 : 0)

					break;
			
				default:
					return this.filteredList

					break;
			}
		},
		words: function() {
			let number = this.filteredList.length;
			let cases = [2, 0, 1, 1, 1, 2];
			let titles = ['автомобиль', 'автомобиля', 'автомобилей']

			return titles[(number%100>4 && number%100<20) ? 2 : cases[(number%10<5)?number%10:5]]; 
		}
	},
	methods: {
    	setSort: function(value) {
			this.currentSort = value
		},
		wr: function(number) {
			let cases = [2, 0, 1, 1, 1, 2];
			let titles = ['автомобиль', 'автомобиля', 'автомобилей']

			return titles[(number%100>4 && number%100<20) ? 2 : cases[(number%10<5)?number%10:5]]; 
		}
	}
}
</script>
