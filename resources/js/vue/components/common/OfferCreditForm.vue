<template>
	<transition name="popup" v-on:enter="onEnter" v-on:leave="onLeave">
		<div class="contact-form df-popup" v-show="isOpened">
			<div class="df-popup__wrap" @mousedown.self="closeThis">
				<div class="contact-form__center df-popup__center">
					<a href="#" @click.prevent="closeThis" class="contact-form__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<h3 class="contact-form__title">Заявка на кредит</h3>
					<div class="service-form__dropdown df-select-bordered" :class="{ 'invalid' : !validation.car }">
        				<selectize v-model="model" :settings="settingsModel">
        					<option :value="model.code" v-for="model in data">{{ model.name }}</option>
        				</selectize>
        			</div>
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
					<input type="text" class="df-input-bordered contact-form__input capitalize" name="surname" id="surname" placeholder="Фамилия" v-model="user.surname" :class="{ 'invalid' : !validation.surname }" @blur="focusLost('surname')">
					<input type="text" class="df-input-bordered contact-form__input capitalize" name="name" id="name" placeholder="Имя" v-model="user.name" :class="{ 'invalid' : !validation.name }" @blur="focusLost('name')">
					<input type="email" class="df-input-bordered contact-form__input" name="email" id="email" placeholder="E-mail" v-model="user.email" :class="{ 'invalid' : !validation.email }" @blur="focusLost('email')">
					<input type="tel" v-mask="'+7(999) 999-99-99'" class="df-input-bordered contact-form__input" name="tel" id="tel" placeholder="Телефон" v-model="phone" :class="{ 'invalid' : !validation.phone }" @blur="focusLost('phone')">
					<label class="contact-form__accept">
						<input type="checkbox" v-model="agreement" :class="{ 'invalid' : !validation.agreement }" name="accept" id="accept">
						<div class="contact-form__box">
							<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 5.2L5 8L9 1" stroke="#002C5F" stroke-width="2"/>
							</svg>
						</div>
						<div class="contact-form__description">Я согласен с <a href="#" @click.prevent="openRules">правилами</a> обработки персональных данных</div>
					</label>
					<button @click.prevent="checkout" class="df-button contact-form__button">Отправить заявку</button>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
import Selectize from 'vue2-selectize'
import axios from 'axios'
import { mapGetters } from "vuex";
import Inputmask from "inputmask";

export default {
	name: "OfferCreditForm",
	components: { Selectize },
	props: ['isOpened', 'category'],
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
	directives: {
		mask: {
			bind: function(el, binding) {
				Inputmask(binding.value).mask(el);
			}
		}
	},
	computed: {
		...mapGetters({
			model: "GET_CAR_CODE",
			carID: "GET_CAR_ID",
			dealer: "GET_DEALER",
			dealersCities: 'GET_DEALERS_CITIES',
            dealers: 'GET_DEALERS',
			data: 'GET_DATA',
		}),
		validation () {
			const reEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			return {
				car: this.car !== '' || !this.process,
				dealer: this.dealer !== '' || !this.process,
				city: this.city !== '' || !this.process,
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
		closeThis: function () {
			this.$emit('close-this');
		},
		openRules: function () {
			this.$store.dispatch('OPEN_RULES', true);
		},
		focusLost: function (name) {
			this.blur[name] = true;
		},
		checkout: function () {
			var that = this;

			this.process = true;

			if (this.isValid) {
				axios.get(this.$store.state.API.OFFER_CREDIT_FORM, {
					params: {
						modelId: this.carID,
						modelCode: this.model,
						dealer: this.dealer,
						salutation: 'Mr.',
						name: this.user.name,
						sirname: this.user.surname,
						email: this.user.email,
						phone: this.phone
					}
				})
					.then(function (response) {
						if (response.data.status === 1) {

    						dataLayer.push({
                                "event": "custom_event",
                                'category':that.category,
                                'action':'Отправка заявки на кредит',
                                'label':that.model
                              });

							that.$store.dispatch('OPEN_SUCCESS', true);
							that.closeThis();
						} else {
							throw new Error('Ошибка');
						}
					})
					.catch(function (error) {
						that.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки формы, повторите попытку позднее' })
						console.log(error);
					})
			}
		},
		onEnter: function() {
			this.$root.$emit('fixOverflow', true)
		},
		onLeave: function() {
			this.$root.$emit('fixOverflow', false)
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
@import '../../../../sass/common/components/_contact-form.sass'
@import '../../../../libs/selectize/selectize.css'

.service-form__dropdown
    margin-bottom: 32px

.service-form__label
    margin-bottom: 20px

</style>
