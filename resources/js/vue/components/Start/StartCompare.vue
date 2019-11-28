<template>
	<section class="compare" :class="{ showCompare: showCompare }">
		<div class="compare__top">
			<div class="compare__header">
				<ul class="compare__menu">
					<li class="compare__item">
						<label>
							<input type="radio" name="compare" v-model="compareSelected" v-bind:value="'modification'">
							<div>Модификации</div>
						</label>
					</li>
					<li class="compare__item">
						<label>
							<input type="radio" name="compare" v-model="compareSelected" v-bind:value="'complectation'">
							<div>Комплектации</div>
						</label>
					</li>
					<li class="compare__item" v-if="Object.keys(packets).length != 0">
						<label>
							<input type="radio" name="compare" v-model="compareSelected" v-bind:value="'packets'">
							<div>Пакеты</div>
						</label>
					</li>
				</ul>
				<a href="#" class="compare__close" @click.prevent="toCloseCompare">
					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						viewBox="0 0 30 30" style="enable-background:new 0 0 30 30;" xml:space="preserve">

					<path class="st0" d="M17.4,15L29.5,2.8c0.6-0.6,0.6-1.7,0-2.4c-0.6-0.6-1.7-0.6-2.4,0L15,12.6L2.8,0.5c-0.6-0.6-1.7-0.6-2.4,0
						c-0.6,0.6-0.6,1.7,0,2.4L12.6,15L0.5,27.2c-0.6,0.6-0.6,1.7,0,2.4c0.6,0.7,1.7,0.7,2.4,0L15,17.4l12.2,12.2c0.6,0.7,1.7,0.7,2.4,0
						c0.6-0.6,0.6-1.7,0-2.4L17.4,15z"/>
					</svg>
				</a>
			</div>
			<div class="compare__options">
				<ul class="c-list" v-show="compareSelected === 'modification'">
					<li class="c-list__item" :key="key" v-for="(mod, key) in modificationList">
						<label>
							<input type="radio" name="compare-mod" v-bind:value="mod" v-model="modification">
							<div class="c-list__wrap">
								<div class="c-list__container">
									<div class="c-list__name">{{ mod.name }}</div>
									<div class="c-list__price">от {{ mod.minPrice | currencyFormat }} ₽</div>
								</div>

								<div class="c-list__arrow">
									<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											viewBox="0 0 26 18" style="enable-background:new 0 0 26 18;" xml:space="preserve">
										<path d="M9.5,18c-0.9,0-1.8-0.3-2.5-1l-6.3-6.3c-1-1-1-2.7,0-3.7c1-1,2.7-1,3.7,0l5.1,5.1l12-11.3c1-1,2.7-1,3.7,0c1,1,1,2.7,0,3.7
											L12,17C11.3,17.7,10.4,18,9.5,18z"/>
									</svg>
								</div>
							</div>
						</label>
					</li>
				</ul>
				<ul class="c-list" v-show="compareSelected === 'complectation'">
					<li class="c-list__item" :key="key" v-for="(comp, key) in complectationList">
						<label>
							<input type="radio" name="compare-com" v-bind:value="comp" v-model="complectation">
							<div class="c-list__wrap">
								<div class="c-list__container">
									<div class="c-list__name">{{ comp.name }}</div>
									<div class="c-list__price">от {{ comp.price | currencyFormat }} ₽</div>
								</div>

								<div class="c-list__arrow">
								<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										viewBox="0 0 26 18" style="enable-background:new 0 0 26 18;" xml:space="preserve">
									<path d="M9.5,18c-0.9,0-1.8-0.3-2.5-1l-6.3-6.3c-1-1-1-2.7,0-3.7c1-1,2.7-1,3.7,0l5.1,5.1l12-11.3c1-1,2.7-1,3.7,0c1,1,1,2.7,0,3.7
										L12,17C11.3,17.7,10.4,18,9.5,18z"/>
								</svg>
							</div>
							</div>
						</label>
					</li>
				</ul>
				<ul class="c-list" v-show="compareSelected === 'packets'">
					<li class="c-list__item" :key="key" v-for="(pack, key) in packets">
						<label>
							<input type="checkbox" name="compare-pack" v-bind:value="pack" v-model="proxySelectedPackets">
							<div class="c-list__wrap">
								<div class="c-list__container">
									<div class="c-list__name">{{ pack.name }}</div>
									<div class="c-list__price">от {{ pack.price | currencyFormat }} ₽</div>
								</div>

								<div class="c-list__arrow">
									<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											viewBox="0 0 26 18" style="enable-background:new 0 0 26 18;" xml:space="preserve">
										<path d="M9.5,18c-0.9,0-1.8-0.3-2.5-1l-6.3-6.3c-1-1-1-2.7,0-3.7c1-1,2.7-1,3.7,0l5.1,5.1l12-11.3c1-1,2.7-1,3.7,0c1,1,1,2.7,0,3.7
											L12,17C11.3,17.7,10.4,18,9.5,18z"/>
									</svg>
								</div>
							</div>
						</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="compare__table">
			<div class="table">
				<div class="table__top">
					<label class="table__diff" v-if="(compareSelected === 'modification') || (compareSelected === 'complectation')">
						<input type="checkbox" name="diff" v-model="onlyDiff">
						<div class="table__icon">
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								viewBox="0 0 26 18" style="enable-background:new 0 0 26 18;" xml:space="preserve">
							<path d="M9.5,18c-0.9,0-1.8-0.3-2.5-1l-6.3-6.3c-1-1-1-2.7,0-3.7c1-1,2.7-1,3.7,0l5.1,5.1l12-11.3c1-1,2.7-1,3.7,0c1,1,1,2.7,0,3.7
								L12,17C11.3,17.7,10.4,18,9.5,18z"/>
							</svg>
						</div>
						<span>Только различия</span>
					</label>
				</div>
				<div class="table__body">
					<ul class="table__categories" v-if="(compareSelected === 'modification') || (compareSelected === 'complectation')">
						<li class="category" v-show="specification.data.length>0" v-for="(specification, index) in compareOptionsList">
							<a href="#" class="category__name isOpened" @click.prevent="openDropdown($event)">
								<span>{{ specification.name }}</span>
								<div class="category__arrow">
									<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										viewBox="0 0 8 5" style="enable-background:new 0 0 8 5;" xml:space="preserve">
									<path class="st0" d="M0,0.9c0-0.2,0.1-0.4,0.2-0.6c0.3-0.3,0.9-0.3,1.2,0L4,2.9l2.6-2.6c0.3-0.3,0.9-0.3,1.2,0
										c0.3,0.3,0.3,0.9,0,1.2L4.6,4.7C4.4,4.9,4.2,5,4,5S3.6,4.9,3.4,4.7L0.2,1.5C0.1,1.3,0,1.1,0,0.9z"/>
									</svg>
								</div>
							</a>
							<div class="category__dropdown">
								<ul class="category__props">
									<li class="property" v-for="property in specification.data">
										<div class="property__name" v-html="property.name.name ? property.name.name : property.name"></div>
										<ul class="property__values">
											<li class="value" v-for="value in property.values">
												<span v-if="value !== true && value !== false">{{ value }}</span>
												<div class="value__true" v-if="value === true">
													<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
														viewBox="0 0 26 18" style="enable-background:new 0 0 26 18;" xml:space="preserve">
													<path d="M9.5,18c-0.9,0-1.8-0.3-2.5-1l-6.3-6.3c-1-1-1-2.7,0-3.7c1-1,2.7-1,3.7,0l5.1,5.1l12-11.3c1-1,2.7-1,3.7,0c1,1,1,2.7,0,3.7
														L12,17C11.3,17.7,10.4,18,9.5,18z"/>
													</svg>
												</div>
												<div class="value__false" v-if="value === false">
												</div>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</li>
					</ul>
					<ul class="table__categories" v-show="compareSelected === 'packets'">
						<li class="category">
							<div class="category__dropdown">
								<ul class="category__props">
									<li class="property" v-for="property in compareOptionsList">
										<div class="property__name">{{ property.name }}</div>
										<ul class="property__values">
											<li class="value" v-for="value in property.packets">
												<span v-if="value.value !== true && value.value !== false">{{ value.value }}</span>
												<div class="value__true" v-if="value.value === true">
													<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
														viewBox="0 0 26 18" style="enable-background:new 0 0 26 18;" xml:space="preserve">
													<path d="M9.5,18c-0.9,0-1.8-0.3-2.5-1l-6.3-6.3c-1-1-1-2.7,0-3.7c1-1,2.7-1,3.7,0l5.1,5.1l12-11.3c1-1,2.7-1,3.7,0c1,1,1,2.7,0,3.7
														L12,17C11.3,17.7,10.4,18,9.5,18z"/>
													</svg>
												</div>
												<div class="value__false" v-if="value.value === false">
												</div>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
import { mapGetters } from "vuex";

export default {
	name: "StartCompare",
	props: ['showCompare'],
	data() {
		return {
			onlyDiff: false,
			selectedPackets: []
		};
	},
	computed: {
		...mapGetters({
			currentCar: 'GET_START_CURRENT_CAR',
			modificationList: 'GET_START_MODIFICATION_LIST',
			complectationList: 'GET_START_COMPLECTATION_LIST',
			packets: 'GET_START_PACKETS',
			dataModifications: 'GET_START_DATA_MODIFICATIONS',
			dataComplectations: 'GET_START_DATA_COMPLECTATIONS',
		}),
		compareSelected: {
			get: function() {
				return this.$store.state.start.compareSelected;
			},
			set: function(value) {
				this.$store.dispatch('SET_START_COMPARE_SELECTED', value);
			}
		},
		modification: {
			get: function() {
				return this.$store.state.start.modification;
			},
			set: function(value) {
				this.$store.dispatch('SET_START_MODIFICATION', value)
					.catch((err) => {
						this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
						console.log(err)
					})
			}
		},
		complectation: {
			get: function() {
				return this.$store.state.start.complectation;
			},
			set: function(value) {
				this.$store.dispatch('SET_START_COMPLECTATION', value)
					.catch((err) => {
						this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
						console.log(err)
					})
			}
		},
		proxySelectedPackets: {
			get: function () {
				return this.$store.state.start.selectedPackets;
			},
			set: function (packets) {
				var that = this,
					packet = {};

				//добавили пакет
				if (packets.length > this.selectedPackets.length) {
					packets.forEach(function(item) {
						if (that.selectedPackets.indexOf(item) < 0) {
							packet = item;
						}
					})

					//Выбран уникальный пакет
					if (packet.unique) {
						this.selectedPackets = [];

						this.selectedPackets.push(packet);
					}
					//Выбран не уникальный пакет, но в списке уже есть уникальные
					if (!packet.unique && this.selectedPackets.some(function(p) { return p.unique })) {
						this.selectedPackets = [];

						this.selectedPackets.push(packet);
					} else if (!packet.unique) {
						this.selectedPackets.push(packet);
					}
					//Выбран пакет с зависимостью
					if (packet.dependency) {
						for (var pack in this.packets) {
							if (this.packets[pack].id === packet.dependency) {
								if (!this.selectedPackets.some(function (p) { return p.id === that.packets[pack].id })) {
									this.selectedPackets.push(this.packets[pack]);
								}
							}
						}
					}
				} else
				//убрали пакет
				if (packets.length < this.selectedPackets.length) {
					this.selectedPackets.forEach(function(item) {
						if (packets.indexOf(item) < 0) {
							packet = item;
						}
					})

					//При отключении пакета проверяем были ли от него зависимые, если да, то их тоже отключаем
					for (var i = 0; i < this.selectedPackets.length; i++) {
						if (this.selectedPackets[i].dependency === packet.id) {
							this.selectedPackets.splice(i, 1);
						}
					}
					for (var i = 0; i < this.selectedPackets.length; i++) {
						if (this.selectedPackets[i].id === packet.id) {
							this.selectedPackets.splice(i, 1);
						}
					}
				}

				console.log(this.selectedPackets)

				this.$store.dispatch('SET_START_SELECTED_PACKETS', this.selectedPackets)

				//Аналитика
				var pList = [];

				this.selectedPackets.forEach(function(packet){
					pList.push(packet.name);
				})

				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": "Выбор опции",
					"label": pList.join() + ', ' + this.currentCar.name
				});
			}
		},
		compareOptionsList: function() {
			//Скролим список вверх при смене категории
			$('.compare').scrollTop(0);

			if (this.compareSelected === 'modification') {
				if (this.onlyDiff) {
					var arr = this.dataModifications.specifications.filter(function (item) {
						return item.hasDiff;
					})

					arr = arr.map(function(item){
						item.data = item.data.filter(function(i){
							return i.diff;
						})

						return item;
					})

					return arr;
				} else {
					return this.dataModifications.specifications;
				}
			}
			if (this.compareSelected === 'complectation') {
				if (this.onlyDiff) {
					var arr = this.dataComplectations.specifications.filter(function (item) {
						return item.hasDiff;
					})

					arr = arr.map(function (item) {
						item.data = item.data.filter(function (i) {
							return i.diff;
						})

						return item;
					})

					return arr;
				} else {
					return this.dataComplectations.specifications;
				}
			}
			if (this.compareSelected === 'packets') {
				//Соберём спецификации отдельных пакетов в один массив
				var specifications = [],
					that = this;

				for (var packet in this.packets) {
					for (var i = 0; i < this.packets[packet].specifications.length; i++) {
						if (!specifications.some(function (s) {  return s.name == that.packets[packet].specifications[i].name })) {
							var obj = {
								name: that.packets[packet].specifications[i].name,
								packets: {}
							}

							for (var pack in this.packets) {
								obj.packets[pack] = {};

								for (var j = 0; j < this.packets[pack].specifications.length; j++) {
									if (this.packets[pack].specifications[j].name === obj.name) {
										obj.packets[pack].value = this.packets[pack].specifications[j].value
									}
								}

								if (!'value' in obj.packets[pack]) {
									obj.packets[pack].value = false;
								}
							}

							specifications.push(obj);
						}
					}
				}

				//console.log(specifications);


				return specifications;
			}
		}
	},
	methods: {
		toCloseCompare: function() {
			this.$emit('close-compare')
		},
		openDropdown: function(e, index) {
			$(e.target).closest('.category__name').toggleClass('isOpened');
			$(e.target).closest('.category').find('.category__dropdown').slideToggle();
		}
	},
	mounted() {
		
	},
	watch: {}
};
</script>

<style lang="sass">

</style>