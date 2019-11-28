<template>
	<div class="service-form">
		<h3 class="service-form__title">Запись на сервис</h3>
		<div class="service-form__left">
			<div class="service-form__label">Автомобиль</div>
			<div class="service-form__dropdown df-select-bordered" :class="{ 'invalid' : !validation.model }">
				<selectize v-model="model" :settings="settingsModel">
					<option :value="model.code" v-for="model in data">{{ model.name }}</option>
				</selectize>
			</div>
			<template v-if="ENV !== 'dealer'">
				<div class="service-form__label service-form__label--dealer">Дилер</div>
				<div class="service-form__dropdown df-select-bordered" :class="{ 'invalid' : !validation.city }">
					<selectize v-model="city" :settings="settingsCity">
						<option :value="city.city_id" v-for="city in dealersCities">{{ city.city_name }}</option>
					</selectize>
				</div>
				<div class="service-form__dropdown df-select-bordered" :class="{ 'invalid' : !validation.dealer }">
					<selectize v-model="dealer" :settings="settingsDealer">
						<option :value="dealer.code" v-for="dealer in filteredDealers">{{ dealer.name }}</option>
					</selectize>
				</div>
				<div class="service-form__map">
					<a href="#" @click.prevent="openMap">
						<svg>
							<use xlink:href="#icon-map"></use>
						</svg>
						<span>Показать на карте</span>
					</a>
				</div>
			</template>
		</div>
		<div class="service-form__right">
			<div class="service-form__label">Ваши данные</div>
			<ul class="service-form__list">
				<li class="service-form__item">
					<label class="appeal">
						<input type="radio" value="Mr." v-model="user.appeal" name="appeal" checked>
						<div class="appeal__circle"></div>
						<div class="appeal__description">Уважаемый</div>
					</label>
				</li>
				<li class="service-form__item">
					<label class="appeal">
						<input type="radio" value="Ms." v-model="user.appeal" name="appeal">
						<div class="appeal__circle"></div>
						<div class="appeal__description">Уважаемая</div>
					</label>
				</li>
			</ul>
			<input type="text" class="df-input-bordered service-form__input capitalize" name="surname" id="surname" placeholder="Фамилия" v-model="user.surname" :class="{ 'invalid' : !validation.surname }" @blur="focusLost('surname')">
			<input type="text" class="df-input-bordered service-form__input capitalize" name="name" id="name" placeholder="Имя" v-model="user.name" :class="{ 'invalid' : !validation.name }" @blur="focusLost('name')">
			<input type="email" class="df-input-bordered service-form__input" name="email" id="email" placeholder="E-mail" v-model="user.email" :class="{ 'invalid' : !validation.email }" @blur="focusLost('email')">
			<input type="tel" v-mask="'+7(999)-999-99-99'" class="df-input-bordered service-form__input" name="tel" id="tel" placeholder="Телефон" v-model="phone" :class="{ 'invalid' : !validation.phone }" @blur="focusLost('phone')">
		</div>
		<div class="service-form__footer">
			<label class="service-form__accept">
				<input type="checkbox" v-model="agreement" :class="{ 'invalid' : !validation.agreement }" name="accept" id="accept">
				<div class="service-form__box">
					<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 5.2L5 8L9 1" stroke="#002C5F" stroke-width="2"/>
					</svg>
				</div>
				<div class="service-form__description">Я согласен с <a href="#" @click.prevent="openRules">правилами</a> обработки персональных данных</div>
			</label>
			<button @click.prevent="checkout" class="df-button service-form__button" :disabled="sending">{{ sending ? 'Отправка...' : 'Отправить заявку'}}</button>
		</div>
	</div>
</template>

<script>
import Selectize from 'vue2-selectize'
import axios from 'axios'
import { mapGetters } from "vuex"

export default {
	name: "SignUpServiceForm",
	components: { Selectize },
	props: [],
	data() {
		return {
			blur: {
				surname: false,
				name: false,
				email: false,
				phone: false
			},
			user: {
				surname: '',
				name: '',
				email: '',
				appeal: 'Mr.'
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
			sending: false
		};
	},
	computed: {
		...mapGetters({
			ENV: "GET_ENV",
            dealersCities: 'GET_DEALERS_CITIES',
            dealers: 'GET_DEALERS',
			data: 'GET_DATA',
			carId: 'GET_CAR_ID'
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
				this.dealers.forEach((dealer) => {
					if (dealer.city_id === this.city) {
						result.push(dealer)
					}
				});
			} else {
				return this.dealers;
			}

			return result;
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

			this.process = true;

			if (this.isValid) {
				this.sending = true

				axios.get(this.$store.state.API.SERVICE_FORM, {
					params: {
						modelId: this.carId,
						modelCode: this.model,
						dealer: this.dealer,
						salutation: this.user.appeal,
						name: this.user.name,
						sirname: this.user.surname,
						email: this.user.email,
						phone: this.phone
					}
				})
					.then(function (response) {
						if (response.data.status === 1) {
							that.$emit('open-success');
							that.sending = false

							dataLayer.push({
								"event": "custom_event",
								"category" : "Сервис",
								"action": "Отправка заявки",
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
			} else {
				//Скролл к первому не валидному полю
				if ($('.service-form').closest('.df-popup').length === 0) {
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
		}
	},
	filters: {},
	mounted() {
		var that = this;

		this.$nextTick(function() {
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

	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'
@import '../../../../sass/common/components/_sign-up-service-form.sass'
</style>