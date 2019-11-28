<template>
	<section class="config">
		<h2 class="config__title">Выберите конфигурацию</h2>
		<div class="config__body">
			<div class="config__left">
				<section class="view">
					<div class="view__body" @click = "init360">
						<div class="view__back" :style="{ backgroundImage: 'url('+ preview +')'  }" v-if="!isLoaded"></div>
						<div id="spritespin" class="view__spritespin" v-if="currentCar.name !== 'H-1'"></div>
						<transition name="preloader">
							<div class="view__preloader" v-if="!isLoaded && currentCar.name !== 'H-1'">
								<img v-if="!isInit" class="view__img" src="/images/start/icons/360.png">
								<div v-else class="view__progress">{{ progressFormatted }}%</div>
							</div>
						</transition>
						<transition name="preloader-arrow">
							<a v-if="isInit && currentCar.name !== 'H-1'" href="#" class="view__prev" @click.prevent="prev">
								<svg width="18" height="38" viewBox="0 0 18 38" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M17 37L1.59055 19.6644C1.25376 19.2855 1.25376 18.7145 1.59055 18.3356L17 1" stroke-width="2"/>
								</svg>
							</a>
						</transition>
						<transition name="preloader-arrow">
							<a v-if="isInit && currentCar.name !== 'H-1'" href="#" class="view__next" @click.prevent="next">
								<svg width="18" height="38" viewBox="0 0 18 38" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 1L16.4095 18.3356C16.7462 18.7145 16.7462 19.2855 16.4095 19.6644L1 37" stroke-width="2"/>
								</svg>
							</a>
						</transition>
					</div>
					<div class="view__bottom">
						<div class="colors">
							<ul class="colors__groups">
								<li class="colors__group" :key="index" v-for="(group, key, index) in colorsAPI">
									<div class="colors__group-name">{{ key }}, <span>{{ group[Object.keys(group)[0]].cost | currencyFormat }} ₽</span></div>
									<ul class="colors__list">
										<li class="colors__color" :key="index" v-for="(color, index) in group" :style="'background-color:' + color.colorCode" :class="{ active: color.id === activeColor }" @click="setColor(color, true)">

										</li>
									</ul>
								</li>
							</ul>
							<div class="colors__current">{{ currentColor }}</div>
						</div>
					</div>
				</section>
			</div>
			<div class="config__right">
				<div class="config__item">
					<label for="mod">Модификация</label>
					<div class="selector" :class="{ active: state.modOpened }">
						<a href="#" class="selector__head" @click.prevent="toggleSelector('mod', $event)">
							<span class="selector__current">{{ modification.name }}</span>
							<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z"/>
							</svg>
						</a>
						<div class="selector__holder">
							<div class="selector__dd" ref='mod'>
								<div class="selector__inner">
									<ul class="selector__list">
										<li class="selector__item" :key="key" v-for="(mod, key) in modificationList">
											<label>
												<input type="radio" name="modification" v-bind:value="mod" v-model="modification" @change="setModA">
												<div class="selector__option">{{ mod.name }}</div>
												<div class="selector__value">{{ mod.minPrice | currencyFormat}} ₽</div>
											</label>
										</li>
									</ul>
									<hr>
									<a href="#" class="selector__button" @click.prevent="toShowCompare('modification')">Сравнить</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="config__item">
					<label for="comp">Комплектация</label>
					<div class="selector" :class="{ active: state.complOpened }">
						<a href="#" class="selector__head" @click.prevent="toggleSelector('compl', $event)">
							<span class="selector__current">{{ complectation.name }}</span>
							<span class="selector__sep">|</span>
							<span class="selector__current selector__current--price">{{ complectation.price | currencyFormat }} ₽</span>
							<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z"/>
							</svg>
						</a>
						<div class="selector__holder">
							<div class="selector__dd" ref='compl'>
								<div class="selector__inner">
									<ul class="selector__list">
										<li class="selector__item" :key="key" v-for="(comp, key) in complectationList">
											<label>
												<input type="radio" name="complectation" v-bind:value="comp" v-model="complectation" @change="setComplA">
												<div class="selector__option">{{ comp.name }}</div>
												<div class="selector__value">{{ comp.price | currencyFormat}} ₽</div>
											</label>
										</li>
									</ul>
									<hr>
									<a href="#" class="selector__button" @click.prevent="toShowCompare('complectation')">Сравнить</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="config__item config__item--options">
					<label for="options">Опции</label>
					<div class="selector" :class="{ active: state.optionsOpened, isDisabled: Object.keys(packets).length === 0 }">
						<a href="#" class="selector__head" @click.prevent="toggleSelector('options', $event)">
							<div class="selector__c-option" v-if="proxySelectedPackets.length > 0">
								<ul>
									<li :key="index" v-for="(pack, index) in proxySelectedPackets">{{ pack.name }}</li>
								</ul>
							</div>
							<div class="selector__c-option" v-else>Выбрать</div>
							<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z"/>
							</svg>
						</a>
						<div class="selector__holder">
							<div class="selector__dd" ref='options'>
								<div class="selector__inner">
									<ul class="selector__list">
										<li class="selector__item" :key="key" v-for="(packet, key) in packets">
											<label>
												<input type="checkbox" name="packet" v-bind:value="packet" v-model="proxySelectedPackets">
												<div class="selector__option">{{ packet.name }}</div>
												<div class="selector__value">{{ packet.price | currencyFormat }} ₽</div>
											</label>
										</li>
									</ul>
									<hr>
									<a href="#" class="selector__button" @click.prevent="toShowCompare('packets')">Сравнить</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="config__item config__item--color">
					<label for="options">Цвет</label>
					<div class="selector" :class="{ active: state.colorsOpened }">
						<a href="#" class="selector__head" @click.prevent="toggleSelector('colors', $event)">
							<span class="selector__current">{{ activeColorObj.nameRus }}</span>
							<span class="selector__sep">|</span>
							<span class="selector__current selector__current--price">{{ activeColorObj.cost | currencyFormat }} ₽</span>
							<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z"/>
							</svg>
						</a>
						<div class="selector__holder">
							<div class="selector__dd" ref='colors'>
								<div class="selector__inner">
									<ul class="selector__list">
										<li class="selector__item" :key="key" v-for="(color, key) in colors">
											<label>
												<input type="radio" name="color" v-bind:value="color" v-model="activeColorObj">
												<div class="selector__option">{{ color.nameRus }}</div>
												<div class="selector__value">{{ color.cost | currencyFormat }} ₽</div>
											</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="config__footer">
				<a href="#" @click.prevent="nextSlide('prevNext')" class="config__next df-button">Продолжить</a>
			</div>
		</div>
	</section>
</template>

<script>
import * as SpriteSpin from "spritespin";
import { mapGetters } from "vuex";

export default {
	name: "StartConfig",
	data() {
		return {
			success: true,
			spritespinAPI: null,
			frame: 0,
			lastFrameSrc: 0,
			isLoaded: false,
			isFirstLoaded: false,
			isInit: false,
			progress: 0,
			state: {
				modOpened: false,
				complOpened: false,
				optionsOpened: false,
				colorsOpened: false
			},
			selectedPackets: [],
			ps: []
		};
	},
	computed: {
		...mapGetters({
			currentCar: 'GET_START_CURRENT_CAR',
			currentCarSpec: 'GET_START_CURRENT_CAR_SPEC',
			colorsAPI: 'GET_START_COLORS_API',
			spritespin: 'GET_START_SPRITESPIN',
			modificationList: 'GET_START_MODIFICATION_LIST',
			complectationList: 'GET_START_COMPLECTATION_LIST',
			packets: 'GET_START_PACKETS'
		}),
		modification: {
			get: function() {
				return this.$store.state.start.modification;
			},
			set: function(value) {
				this.$store.dispatch('SET_START_MODIFICATION', value)
					.then(()=>{
						//Закроем дропдаун после выбора
						this.state.modOpened = false;
						$(this.$refs["mod"]).slideUp(200);
					})
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
					.then(()=>{
						//Закроем дропдаун после выбора
						this.state.complOpened = false;
						$(this.$refs["compl"]).slideUp(200);
					})
					.catch((err) => {
						this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
						console.log(err)
					})
			}
		},
		activeColor: {
			get: function() {
				return this.$store.state.start.activeColor;
			},
			set: function(value) {
				this.$store.dispatch('SET_START_ACTIVE_COLOR', value)
			}
		},
		prevColor: {
			get: function() {
				return this.$store.state.start.prevColor;
			},
			set: function(value) {
				this.$store.dispatch('SET_START_PREV_COLOR', value)
			}
		},
		activeColorObj: {
			get: function() {
				return this.$store.state.start.activeColorObj;
			},
			set: function(value) {
				this.$store.dispatch('SET_START_ACTIVE_COLOR_OBJ', value)
				this.activeColor = value.id;
				//Закроем дропдаун после выбора
				this.state.colorsOpened = false;
				$(this.$refs["colors"]).slideUp(200);

				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": "Выбор цвета ",
					"label": this.currentCar.codeName + ', ' + value.id
				});
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

				//Закроем дропдаун
				this.state.optionsOpened = false;
				$(this.$refs["options"]).slideUp(200);

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
					"label": pList.join() + ', ' + this.currentCar.codeName
				});
			}
		},
		sourceArray: function () {
            var folder = this.spritespin[this.activeColor].folder;
            var ext = this.spritespin[this.activeColor].extension;
            var result = []
            for (var i = 0; i < 36; i++) {
                result.push(folder + '/' + i + '.' + ext)
            }

            return result
        },
        colors: function () {
            var colors = [];

            for (var group in this.colorsAPI) {
                for (var color in this.colorsAPI[group]) {
                    colors.push(this.colorsAPI[group][color])
                }
            }

            return colors;
        },
        currentColor: function () {
            for (var i = 0; i < this.colors.length; i++) {
                if (this.colors[i].id === this.activeColor) {
                    return this.colors[i].nameRus+' / '+this.colors[i].name+', '+ this.priceFormat(this.colors[i].cost)
                }
            }
        },
        preview: function () {
			if (this.currentCar.name === 'H-1') {
				return this.activeColorObj.carImage;
			}
			if (this.prevColor !== 0 && this.isInit && this.isFirstLoaded && this.spritespin) {
                return this.spritespin[this.prevColor].folder + '/' + this.frame + '.' + this.spritespin[this.prevColor].extension;
			}
            if (this.activeColor !== 0 && !this.isLoaded && this.spritespin) {
                return this.spritespin[this.activeColor].folder + '/' + this.frame + '.' + this.spritespin[this.activeColor].extension;
            }
			if (this.activeColor === 0) {
				return ''
			}
        },
        progressFormatted: function () {
            return Math.round(this.progress) > 100 ? 100 : Math.round(this.progress)
        }
	},
	methods: {
		set360: function () {
            var that = this;

			$("#spritespin").spritespin('destroy')

            $("#spritespin").spritespin({
                source: that.sourceArray,
                animate: false,
                //behavior: 'drag',
                frames: 36,
                frameTime: 40,
                frame: that.frame,
                lanes: 1,
                //mods: ['drag', '360'],
                module: null,
                renderer: 'canvas',
                reverse: false,
                scrollThreshold: 500,
				responsive: true,
                onLoad: function () {
					that.isLoaded = true
					that.isFirstLoaded = true
				},
				onFrame: function () {
					that.frame = that.spritespinAPI.data.frame
					that.lastFrameSrc = that.spritespinAPI.data.source[that.frame]
				},
				onProgress: function () {
					that.progress += (100/36)
				}
            });

			this.spritespinAPI = $("#spritespin").spritespin('api');
        },
        prev: function() {
            this.spritespinAPI.prevFrame()
        },
        next: function() {
            this.spritespinAPI.nextFrame()
        },
        setColor: function (color) {
			this.prevColor = this.activeColor;
			this.activeColor = color.id;
			this.activeColorObj = color;
        },
        init360: function () {
            if (!this.isInit && this.currentCar.name !== 'H-1') {
                this.isInit = true;
				this.set360();
				
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": "Взаимодействие с 360 " + this.currentCar.codeName
				});
            }
		},
		priceFormat: function (value) {
			return value.toString().replace(/\D/g, '').replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' ') + ' ₽'
		},
		toggleSelector: function (id, e) {
			$('.selector__dd').not($(e.target).closest('.selector').find('.selector__dd')).slideUp(200)
			$(e.target).closest('.selector').find('.selector__dd').slideToggle(200);

			if (id === 'mod') {
				this.state.modOpened = !this.state.modOpened;
				this.state.complOpened = false;
				this.state.optionsOpened = false;
				this.state.colorsOpened = false;
			}
			if (id === 'compl') {
				this.state.complOpened = !this.state.complOpened;
				this.state.modOpened = false;
				this.state.optionsOpened = false;
				this.state.colorsOpened = false;
			}
			if (id === 'options') {
				this.state.optionsOpened = !this.state.optionsOpened;
				this.state.complOpened = false;
				this.state.modOpened = false;
				this.state.colorsOpened = false;
			}
			if (id === 'colors') {
				this.state.colorsOpened = !this.state.colorsOpened;
				this.state.complOpened = false;
				this.state.modOpened = false;
				this.state.optionsOpened = false;
			}

			//Обновить значение perfectscroll
			this.psUpdate();
		},
		psUpdate: function () {
			this.ps.forEach(function(item){
				var item = item;

				setTimeout(function(){
					item.update();
				})
			})
		},
		nextSlide: function(flag) {
			this.$emit('next-slide', flag)
		},
		toShowCompare: function(section) {
			this.$emit('show-compare', section);
			//Закроем дропдаун после выбора
			this.state.modOpened = false;
			$(this.$refs["mod"]).slideUp(200);

			this.state.complOpened = false;
			$(this.$refs["compl"]).slideUp(200);

			this.state.optionsOpened = false;
			$(this.$refs["options"]).slideUp(200);
		},
		setModA: function () {
			dataLayer.push({
				"event": "custom_event",
				"category": "Страница программы start",
				"action": "Выбор модификации ",
				"label": this.currentCar.codeName + ', ' + this.modification.id
			})
		},
		setComplA: function () {
			dataLayer.push({
				"event": "custom_event",
				"category": "Страница программы start",
				"action": "Выбор комплектации ",
				"label": this.currentCar.codeName + ', ' + this.complectation.id
			})
		},
	},
	mounted() {
		var that= this;

		this.$parent.$on('reset360', ()=>{
			this.isLoaded = false
			this.isFirstLoaded = false
			this.isInit = false
			$("#spritespin").spritespin('destroy')
		})
		this.$parent.$on('closeAll', (e)=>{
			if ($(e.target).closest('.selector').length === 0) {
				this.state.modOpened = false;
				this.state.complOpened = false;
				this.state.optionsOpened = false;
				this.state.colorsOpened = false;
				$('.selector__dd').slideUp(200);
			}
		})

		this.$nextTick(()=>{
			$('.selector__inner').each(function(){
				var psb = new PerfectScrollbar(this, {
					wheelSpeed: 0.3
				});

				that.ps.push(psb);
			})
		})
	},
	updated() {

	},
	watch: {
		activeColor: function () {
            if (this.isInit) {
                this.isLoaded = false;
                this.progress = 0;
                this.set360();
            }
        }
	}
};
</script>

<style lang="sass">

</style>