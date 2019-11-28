<template>
	<div class="td-form">
		<h3 class="td-form__title">Тест-драйв автомобилей Hyundai</h3>
		<div class="td-form__left" :class="{ isDealer: ENV === 'dealer' }">
			<div class="td-form__label">Автомобиль</div>

			<template v-if="typeof page === 'undefined' || page !== 'isStartPage'">
				<div class="td-form__dropdown df-select-bordered" :class="{ 'invalid' : !validation.model }">
					<selectize v-model="model" :settings="settingsModel">
						<option :value="model.code" v-for="model in data">{{ model.name }}</option>
					</selectize>
				</div>
				<div class="td-form__img">
					<img :src="carImg" alt="">
				</div>
			</template>
			<template v-if="page === 'isStartPage'">
				<div class="td-form__label">{{ carName }}</div>
				<div class="td-form__img">
					<img :src="activeColorObj.carImage" alt="">
				</div>
			</template>
			
			
			<div v-if="typeof carLink !== 'undefined'" class="td-form__info">
				<a :href="carLink" class="df-iconed-link">
					Описание модели
					<svg>
						<use xlink:href="#arrow-link"></use>
					</svg>
				</a>
			</div>
		</div>
		<div class="td-form__center" v-if="ENV !== 'dealer'">
			<div class="td-form__label">Выбор дилера</div>
			<div class="td-form__dropdown df-select-bordered" :class="{ 'invalid' : !validation.city }">
				<selectize v-model="city" :settings="settingsCity">
					<option :value="city.city_id" v-for="city in proxyDealersCities">{{ city.city_name }}</option>
				</selectize>
			</div>
			<div class="td-form__dropdown df-select-bordered" :class="{ 'invalid' : !validation.dealer }">
				<selectize v-model="dealer" :settings="settingsDealer">
					<option :value="dealer.code" v-for="dealer in filteredDealers">{{ dealer.name }}</option>
				</selectize>
			</div>
			<div class="td-form__map">
				<a href="#" @click.prevent="openMap">
					<svg>
						<use xlink:href="#icon-map"></use>
					</svg>
					<span>Показать на карте</span>
				</a>
			</div>
		</div>
		<div class="td-form__right" :class="{ isDealer: ENV === 'dealer' }">
			<div class="td-form__label">Ваши данные</div>
			<ul class="td-form__list">
				<li class="td-form__item">
					<label class="appeal">
						<input type="radio" value="Mr." v-model="user.appeal" name="appeal" checked>
						<div class="appeal__circle"></div>
						<div class="appeal__description">Уважаемый</div>
					</label>
				</li>
				<li class="td-form__item">
					<label class="appeal">
						<input type="radio" value="Ms." v-model="user.appeal" name="appeal">
						<div class="appeal__circle"></div>
						<div class="appeal__description">Уважаемая</div>
					</label>
				</li>
			</ul>
			<input type="text" class="df-input-bordered td-form__input capitalize" name="name" id="name" placeholder="Имя" v-model="user.name" :class="{ 'invalid' : !validation.name }" @blur="focusLost('name')">
			<input type="text" class="df-input-bordered td-form__input capitalize" name="surname" id="surname" placeholder="Фамилия" v-model="user.surname" :class="{ 'invalid' : !validation.surname }" @blur="focusLost('surname')">
			<input type="tel" v-mask="'+7(999)-999-99-99'" class="df-input-bordered td-form__input" name="tel" id="tel" placeholder="Телефон" v-model="phone" :class="{ 'invalid' : !validation.phone }" @blur="focusLost('phone')">
			<input type="email" class="df-input-bordered td-form__input" name="email" id="email" placeholder="E-mail" v-model="user.email" :class="{ 'invalid' : !validation.email }" @blur="focusLost('email')">
		</div>
		<div class="td-form__footer">
			<label class="td-form__accept">
				<input type="checkbox" v-model="agreement" :class="{ 'invalid' : !validation.agreement }" name="accept" id="accept">
				<div class="td-form__box">
					<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 5.2L5 8L9 1" stroke="#002C5F" stroke-width="2"/>
					</svg>
				</div>
				<div class="td-form__description">Я согласен с <a href="#" @click.prevent="openRules">правилами</a> обработки персональных данных</div>
			</label>
			<button @click.prevent="checkout" class="df-button td-form__button" :disabled="sending">{{ sending ? 'Отправка...' : 'Отправить заявку'}}</button>
		</div>
	</div>
</template>

<script>
import Selectize from 'vue2-selectize'
import axios from 'axios'
import { mapGetters } from "vuex";

export default {
	name: "SignUpTestDriveForm",
	components: { Selectize },
	props: ['page'],//page - название страницы, на которой размещён попап, может быть undefined
	data() {
		return {
			blur: {
				surname: false,
				name: false,
				email: false,
				phone: false
			},
			user: {
				appeal: 'Mr.',
				surname: '',
				name: '',
				email: ''
			},
			agreement: false,
			process: false,
			ps: [],
			settingsModel: {
				placeholder: 'Выберите автомобиль',
				onDropdownOpen: this.psUpdate,
				openOnFocus: false,
				onInitialize: function () {
					var that = this;

					this.$control.on("click", function () {
						if (!that.opened) {
							that.open()
							that.opened = true
						}
					});
				},
				onDropdownClose: function () {
					setTimeout(()=>{
						this.opened = false
					}, 300)
				}
			},
			settingsCity: {
				placeholder: 'Выберите город',
				onDropdownOpen: this.psUpdate,
				openOnFocus: false,
				onInitialize: function () {
					var that = this;

					this.$control.on("click", function () {
						if (!that.opened) {
							that.open()
							that.opened = true
						}
					});
				},
				onDropdownClose: function () {
					setTimeout(()=>{
						this.opened = false
					}, 300)
				}
			},
			settingsDealer: {
				placeholder: 'Выберите дилера',
				onDropdownOpen: this.psUpdate,
				openOnFocus: false,
				onInitialize: function () {
					var that = this;

					this.$control.on("click", function () {
						if (!that.opened) {
							that.open()
							that.opened = true
						}
					});
				},
				onDropdownClose: function () {
					setTimeout(()=>{
						this.opened = false
					}, 300)
				}
			},
			i30nDealers: [],
			i30nDealerCities: [],
			sending: false,
			utm_campaign: '',
			utm_term: ''
		};
	},
	computed: {
		...mapGetters({
			ENV: "GET_ENV",
            dealersCities: 'GET_DEALERS_CITIES',
            dealers: 'GET_DEALERS',
			data: 'GET_DATA',
			carName: 'GET_CAR_NAME',
			carId: 'GET_CAR_ID',
			carImg: 'GET_CAR_IMG',
			carLink: 'GET_CAR_LINK',
			complectation: 'GET_START_COMPLECTATION',
			modification: 'GET_START_MODIFICATION',
			currentTerm: 'GET_START_CURRENT_TERM',
			cityName: 'GET_CITY_NAME',
			activeColorObj: 'GET_START_ACTIVE_COLOR_OBJ',
		}),
		validation () {
			const reEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			return {
				model: this.model !== '' || !this.process,
				dealer: this.dealer !== '' || (!this.process || this.ENV === 'dealer'),
				city: this.city !== '' || (!this.process || this.ENV === 'dealer'),
				email: reEmail.test(this.user.email) || (!this.blur.email && !this.process),
				name: this.user.name.trim() !== '' || (!this.blur.name && !this.process),
				surname: this.user.surname.trim() !== '' || (!this.blur.surname && !this.process),
				phone: this.phone.trim() !== '' || (!this.blur.phone && !this.process),
				agreement: this.agreement || !this.process
			}
		},
		isValid () {
			const validation = this.validation;

			return Object.keys(validation).every(function (key) {
				return validation[key]
			})
		},
		model: {
            get () {
                return this.$store.state.car.code;
            },
            set (value) {
				if (value) {
					this.$store.dispatch('SET_MODEL', value);
				}
            }
        },
		city: {
			get () {
                return this.$store.state.city;
            },
            set (value) {
                this.$store.dispatch('SET_CITY', value);
            }
		},
		dealer: {
			get () {
                return this.$store.state.dealer;
            },
            set (value) {
				if (value) {
					this.$store.dispatch('SET_DEALER', value);
				}
            }
		},
		phone : {
			get () {
                return this.$store.state.user.phone;
            },
            set (value) {
				if (value) {
					this.$store.dispatch('SET_USER_PHONE', value);
				}
            }
		},
		filteredDealers: function () {
			var result = [];

			if (this.city !== '') {
				this.proxyDealers.forEach((dealer) => {
					if (dealer.city_id === this.city) {
						result.push(dealer)
					}
				});
			} else {
				return this.proxyDealers;
			}

			return result;
		},
		proxyDealers: function () {
			return this.i30nDealers.length ? this.i30nDealers : this.dealers;
		},
		proxyDealersCities: function() {
			return this.i30nDealerCities.length ? this.i30nDealerCities : this.dealersCities;
		}
	},
	methods: {
		openRules: function () {
			this.$emit('open-rules');
		},
		focusLost: function (name) {
			this.blur[name] = true;
		},
		openMap: function () {
			this.$store.dispatch('OPEN_FIND_DEALER', true);
		},
		checkout: function () {
			var that = this;
			var campaignCode = '';

			this.process = true;

			if (this.utm_campaign === 'enileev' && this.utm_term === 'i30n') {
				campaignCode = 'HMCIS0007016'
			}

			if (this.isValid) {
				this.sending = true

				if (typeof this.page === 'undefined' || this.page !== 'isStartPage') {
					axios.get(this.$store.state.API.TD_FORM, {
							params: {
								modelId: this.carId,
								modelCode: this.model,
								dealer: this.dealer,
								salutation: this.user.appeal,
								name: this.user.name,
								sirname: this.user.surname,
								email: this.user.email,
								phone: this.phone,
								campaignCode: campaignCode
							}
						})
						.then(function (response) {
							if (response.data.status === 1) {
								that.$emit('open-success');
								that.sending = false;

								if (that.page === 'isModelPage') {
									dataLayer.push({
										"event": "custom_event",
										"category" : "Страница модели " + that.model,
										"action": "Отправка заявки на тест-драйв",
										"label" : "Отправка заявки из модального окна"
									});
								}
								if (that.page === 'isTestDrivePage') {
									dataLayer.push({
										"event": "custom_event",
										"category" : "Тест-драйв",
										"action": "Отправка заявки",
										"label" : that.model
									});
								}
								if (that.page === 'isConfiguratorPage') {
									dataLayer.push({
										"event": "custom_event",
										"category" : "Конфигуратор",
										"action": "Запись на тест-драйв",
										"label" : that.model
									});
								}
							} else {
								throw new Error('Ошибка');
							}
						})
						.catch(function (error) {
							that.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки формы, повторите попытку позднее' })
							console.log(error);
							that.sending = false
						})
				} else if (this.page === 'isStartPage') {
					axios.get(this.$store.state.API.TD_FORM, {
							params: {
								city: this.cityName,
								dealer: this.dealer,
								email: this.user.email,
								from_url: document.location.href,
								modelCode: this.carName,
								name: this.user.name,
								sirname: this.user.surname,
								phone: this.phone,
								salutation: this.user.appeal,
								// googleId: gid,
								// yandexId: yClientID
							}
						})
						.then(function (response) {
							console.log(response);
							if (response.data.status === 1) {
								that.$emit('open-success');
								that.sending = false

								dataLayer.push({
									"event": "custom_event",
									"category" : "Страница программы start",
									"action": "Запись на тест-драйв",
									"label" : that.model
								});
							} else {
								throw new Error('Ошибка');
							}
						})
						.catch(function (error) {
							that.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки формы, повторите попытку позднее' })
							console.log(error);
							that.sending = false
						})
				}
			} else {
				//Скролл к первому не валидному полю
				if ($('.td-form').closest('.df-popup').length === 0) {
					setTimeout(()=>{
						if ($('.invalid').eq(0)[0].type !== 'checkbox') {
							$('html, body').animate({ scrollTop: $('.invalid').eq(0).offset().top - 200 }, 500);
						}
					}, 300)
				} else {
					setTimeout(()=>{
						if ($('.invalid').eq(0)[0].type !== 'checkbox') {
							$('.df-popup').animate({ scrollTop: $('.invalid').eq(0).position().top - 200 }, 500);
						}
					}, 300)
				}
			}
		},
		psUpdate: function () {
			this.ps.forEach((item)=>{
				var item = item;

				setTimeout(()=>{
					item.update();
				})
			})
		},
		getAllUrlParams: function (url) {
			// извлекаем строку из URL или объекта window
			var queryString = url ? url.split('?')[1] : window.location.search.slice(1);
			
			// объект для хранения параметров
			var obj = {};
			
			// если есть строка запроса
			if (queryString) {
			
				// данные после знака # будут опущены
				queryString = queryString.split('#')[0];
			
				// разделяем параметры
				var arr = queryString.split('&');
			
				for (var i=0; i<arr.length; i++) {
					// разделяем параметр на ключ => значение
					var a = arr[i].split('=');
				
					// обработка данных вида: list[]=thing1&list[]=thing2
					var paramNum = undefined;
					var paramName = a[0].replace(/\[\d*\]/, function(v) {
						paramNum = v.slice(1,-1);
						return '';
					});
				
					// передача значения параметра ('true' если значение не задано)
					var paramValue = typeof(a[1])==='undefined' ? true : a[1];
				
					// если ключ параметра уже задан
					if (obj[paramName]) {
						// преобразуем текущее значение в массив
						if (typeof obj[paramName] === 'string') {
						obj[paramName] = [obj[paramName]];
						}
						// если не задан индекс...
						if (typeof paramNum === 'undefined') {
						// помещаем значение в конец массива
						obj[paramName].push(paramValue);
						}
						// если индекс задан...
						else {
						// размещаем элемент по заданному индексу
						obj[paramName][paramNum] = paramValue;
						}
					}
					// если параметр не задан, делаем это вручную
					else {
						obj[paramName] = paramValue;
					}
				}
			}
			
			return obj;
		}
	},
	filters: {},
	mounted() {
		var that = this;

		this.$nextTick(function() {
			that.utm_campaign = that.getAllUrlParams().utm_campaign;
			that.utm_term = that.getAllUrlParams().utm_term;
			
			//Scrollbars
			$('.selectize-control .selectize-dropdown-content').each(function(){
				var psb = new PerfectScrollbar(this, {
					wheelSpeed: 1,
					minScrollbarLength: 20
				});

				that.ps.push(psb);
			})
		})
	},
	watch: {
		model: function() {
			if (this.model === 'i30n') {
				var cities = [];

				this.i30nDealers = this.dealers.filter(item=>item.i30n == '1');

				this.i30nDealers.forEach(function(item){
					if (!cities.some((i)=>{ return item.city_id == i.city_id })) {
						cities.push({
							'city_id': item.city_id,
							'city_name': item.city_name
						})
					}
				})

				this.i30nDealerCities = cities;

				//Обновим карту
				this.$emit('set-i30n', true);
			} else {
				this.i30nDealers = [];
				this.i30nDealerCities = [];

				//Обновим карту
				this.$emit('set-i30n', false);
			}
		}
	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'
@import '../../../../sass/common/components/_sign-up-test-drive-form.sass'
</style>