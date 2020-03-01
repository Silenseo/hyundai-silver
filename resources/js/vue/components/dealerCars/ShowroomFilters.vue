<template>
	<div class="filters">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="filters__inner">
						<div class="filters__top">
							<h1 class="filters__title h3">Автомобили в наличии</h1>
							<div class="age">
								<ul class="age__list">
									<li class="age__item" :key="key" v-for="(age, key) in ages">
										<label>
											<input type="radio" name="age" :value="age.value" v-model="currentAge">
											<div class="age__box">
												{{ age.name }}
											</div>
										</label>
									</li>
								</ul>
							</div>
						</div>
						<div class="filters__list">
							<div class="filters__dd">
								<dropdown-multi-select @change="setModels" :selectedItems="currentModels" placeholder="Модель" :options="models"></dropdown-multi-select>
							</div>
							<div class="filters__dd">
								<dropdown-multi-select @change="setYears" :selectedItems="currentYears" placeholder="Год выпуска" :options="years"></dropdown-multi-select>
							</div>
							<div class="filters__dd">
								<dropdown-multi-select @change="setGearBox" :selectedItems="currentGearboxes" placeholder="Коробка передач" :options="gearBoxes"></dropdown-multi-select>
							</div>
							<div class="filters__dd">
								<dropdown-range-select placeholder="Цена" :from="priceFrom" :to="priceTo" @change-from="setFrom" @change-to="setTo"></dropdown-range-select>
							</div>

							<div class="filters__dd" v-show="showAll">
								<dropdown-multi-select @change="setEngine" :selectedItems="currentEngines" placeholder="Двигатель" :options="engines"></dropdown-multi-select>
							</div>
							<div class="filters__dd" v-show="showAll">
								<dropdown-multi-select @change="setComplectation" :selectedItems="currentComplectations" placeholder="Комплектация" :options="complectations"></dropdown-multi-select>
							</div>
							<div class="filters__dd" v-show="showAll">
								<dropdown-multi-select @change="setTransmission" :selectedItems="currentTransmissions" placeholder="Тип привода" :options="transmissions"></dropdown-multi-select>
							</div>
							<div class="filters__dd" v-show="showAll">
								<dropdown-range-select placeholder="Пробег" :from="milleageFrom" :to="milleageTo" @change-from="setFromMileage" @change-to="setToMileage"></dropdown-range-select>
							</div>
							<div class="filters__dd" v-show="showAll">
								<dropdown-multi-select @change="setExteriorColor" :selectedItems="currentExteriorColors" placeholder="Цвет кузова" :options="exteriorColors"></dropdown-multi-select>
							</div>
							<div class="filters__dd" v-show="showAll">
								<dropdown-multi-select @change="setInteriorColor" :selectedItems="currentInteriorColors" placeholder="Цвет салона" :options="interiorColors"></dropdown-multi-select>
							</div>
						</div>
						<div class="filters__footer">
							<a href="#" class="filters__more" @click.prevent="toggleView" :class="{ all: showAll }">
								<span>Все параметры</span>
								<svg width="13" height="7" viewBox="0 0 13 7" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1.5 5.5L5.83103 1.60207C6.21134 1.25979 6.78866 1.25979 7.16896 1.60207L11.5 5.5" stroke="currentColor" stroke-width="2"/>
								</svg>
							</a>
							<a href="#" @click.prevent="clearFilters" class="filters__clear">
								<span>Сбросить</span>
								<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect y="10.9091" width="15.4277" height="1.54277" transform="rotate(-45 0 10.9091)" fill="#666666"/>
									<rect x="1.0918" width="15.4277" height="1.54277" transform="rotate(45 1.0918 0)" fill="#666666"/>
								</svg>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import DropdownMultiSelect from '@/components/common/DropdownMultiSelect'
import DropdownRangeSelect from '@/components/common/DropdownRangeSelect'

export default {
	name: 'ShowroomFilters',
	components: { Selectize, DropdownMultiSelect, DropdownRangeSelect },
	data () {
		return {
			list: [],
			currentAge: 'all',
			ages: [
				{
					name: 'Все',
					value: 'all'
				},
				{
					name: 'Новые',
					value: 'new'
				},
				{
					name: 'С пробегом',
					value: 'old'
				}
			],
			currentModels: [],
			currentYears: [],
			currentGearboxes: [],
			currentEngines: [],
			currentComplectations: [],
			currentTransmissions: [],
			currentExteriorColors: [],
			currentInteriorColors: [],
			priceFrom: '0',
			priceTo: '0',
			milleageFrom: '0',
			milleageTo: '0',
			showAll: false
		}
	},
	computed: {
		filteredList: function () {
			return this.list
			.filter(item=>{
				if (
					(this.currentAge === item.age || this.currentAge === 'all')
					&&
					(this.currentModels.length === 0 ? true : this.currentModels.indexOf(item.name) >= 0)
					&&
					(this.currentYears.length === 0 ? true : this.currentYears.indexOf(item.year) >= 0)
					&&
					(this.currentGearboxes.length === 0 ? true : this.currentGearboxes.indexOf(item.gearBox) >= 0)
					&&
					(this.currentEngines.length === 0 ? true : this.currentEngines.indexOf(item.engine) >= 0)
					&&
					(this.currentComplectations.length === 0 ? true : this.currentComplectations.indexOf(item.complectation) >= 0)
					&&
					(this.currentTransmissions.length === 0 ? true : this.currentTransmissions.indexOf(item.transmission) >= 0)
					&&
					(this.currentExteriorColors.length === 0 ? true : this.currentExteriorColors.indexOf(item.exteriorColor) >= 0)
					&&
					(this.currentInteriorColors.length === 0 ? true : this.currentInteriorColors.indexOf(item.interiorColor) >= 0)
					&&
					(item.minPrice >= this.proxyPriceFrom && (item.minPrice <= this.proxyPriceTo ||  this.proxyPriceTo === 0))
					&&
					((item.milleage >= this.proxyMilleageFrom || this.proxyMilleageFrom === 0) && (item.milleage <= this.proxyMilleageTo || this.proxyMilleageTo === 0))
				) {
					return true
				} else {
					return false
				}
			})
		},
		activeFilters: function () {
			return {
				name: this.currentModels,
				year: this.currentYears,
				gearBox: this.currentGearboxes,
				engine: this.currentEngines,
				complectation: this.currentComplectations,
				transmission: this.currentTransmissions,
				exteriorColor: this.currentExteriorColors,
				interiorColor: this.currentInteriorColors
			}
		},
		forFiltersList: function () {
			return this.list
			.filter(item=>{
				if (
					(this.currentAge === item.age || this.currentAge === 'all')
					&&
					(item.minPrice >= this.proxyPriceFrom && (item.minPrice <= this.proxyPriceTo ||  this.proxyPriceTo === 0))
					&&
					((item.milleage >= this.proxyMilleageFrom || this.proxyMilleageFrom === 0) && (item.milleage <= this.proxyMilleageTo || this.proxyMilleageTo === 0))
				) {
					return true
				} else {
					return false
				}
			})
		},
		models: function () {
			return this.getOptions('name').sort()
		},
		years: function () {
			return this.getOptions('year').sort((a, b)=>a.year - b.year)
		},
		gearBoxes: function () {
			return this.getOptions('gearBox').sort()
		},
		engines: function () {
			return this.getOptions('engine').sort()
		},
		complectations: function () {
			return this.getOptions('complectation').sort()
		},
		transmissions: function () {
			return this.getOptions('transmission').sort()
		},
		exteriorColors: function () {
			return this.getOptions('exteriorColor').sort()
		},
		interiorColors: function () {
			return this.getOptions('interiorColor').sort()
		},
		proxyPriceFrom: function () {
			return +this.priceFrom.split(' ').join('');
		},
		proxyPriceTo: function () {
			return +this.priceTo.split(' ').join('');
		},
		proxyMilleageFrom: function () {
			return +this.milleageFrom.split(' ').join('');
		},
		proxyMilleageTo: function () {
			return +this.milleageTo.split(' ').join('');
		}
	},
	methods: {
		getOptions: function(name) {
			let result = [];
			let list = this.forFiltersList.map(item=>item);

			//Скрываем опции, которые не доступны из-за применения других фильтров
			for (var filter in this.activeFilters) {
				if (filter !== name && this.activeFilters[filter].length > 0) {
					list = list.filter(item=>
						this.activeFilters[filter].indexOf(item[filter]) >= 0
					)
				}
			}

			list.forEach(item=>{
				if (result.indexOf(item[name]) < 0 && typeof item[name] !== 'undefined' && item[name] !== '') {
					result.push(item[name])
				}
			})

			return result
		},
    	setYears: function (value) {
			this.currentYears = value
		},
    	setModels: function (value) {
			this.currentModels = value
		},
		setGearBox: function (value) {
			this.currentGearboxes = value
		},
		setEngine: function (value) {
			this.currentEngines = value
		},
		setComplectation: function (value) {
			this.currentComplectations = value
		},
		setTransmission: function (value) {
			this.currentTransmissions = value
		},
		setExteriorColor: function (value) {
			this.currentExteriorColors = value
		},
		setInteriorColor: function (value) {
			this.currentInteriorColors = value
		},
		setFrom: function (value) {
			this.priceFrom = value
		},
		setTo: function (value) {
			this.priceTo = value
		},
		setFromMileage: function (value) {
			this.milleageFrom = value
		},
		setToMileage: function (value) {
			this.milleageTo = value
		},
		clearFilters: function () {
			this.currentYears = [];
			this.currentModels = [];
			this.currentGearboxes = [];
			this.currentEngines = [];
			this.currentComplectations = [];
			this.currentTransmissions = [];
			this.currentExteriorColors = [];
			this.currentInteriorColors = [];
			this.priceFrom = '0';
			this.priceTo = '0';
			this.milleageFrom = '0';
			this.milleageTo = '0';
		},
		toggleView: function() {
			this.showAll = !this.showAll
		}
	},
	created () {
		if (typeof carsList !== 'undefined') {
			this.list = carsList
		}
	},
	mounted () {
		this.$nextTick(function() {
			//Scrollbars
			$('.dropdown__list').each(function(){
				new PerfectScrollbar(this, {
					wheelSpeed: 1,
					minScrollbarLength: 20
				});
			})
		})
	},
	watch: {
		filteredList: function() {
			this.$emit('filter', this.filteredList)
		}
	}
}
</script>
