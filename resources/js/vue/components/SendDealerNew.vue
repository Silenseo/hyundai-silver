<template>
	<transition name="popup">
		<div class="p-td df-popup" v-show="isOpened">
			<div class="df-popup__wrap" @mousedown.self="closeThis">
				<div class="p-td__center df-popup__center">
					<a href="#" @click.prevent="closeThis" class="p-td__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<div class="td-form">
						<h3 class="td-form__title">Заявка дилеру</h3>
						<div class="td-form__left">
							<div class="td-form__label">Ваша модель</div>

							<div class="td-form__label">{{ carName }}</div>
							<div class="td-form__img">
								<img :src="carImage" :alt="carName">
							</div>
						</div>
						<div class="td-form__center">
							<div class="td-form__label">Выбор дилера</div>
							<div class="td-form__dropdown df-select-bordered" :class="{ 'invalid' : !validation.city }">
								<selectize :settings="settingsCity">
									<option :value="indexCity" v-for="(city, indexCity) in dealerCities">{{ city.name }}</option>
								</selectize>
							</div>
							<div class="td-form__dropdown df-select-bordered" :class="{ 'invalid' : !validation.dealer }">
								<selectize v-model="dealer" :settings="settingsDealer">
									<option :value="dealer.code" v-for="dealer in currentDealers">{{ dealer.name }}</option>
								</selectize>
							</div>
						</div>
						<div class="td-form__right">
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
							<input type="tel" v-mask="'+7(999)-999-99-99'" class="df-input-bordered td-form__input" name="tel" id="tel" placeholder="Телефон" v-model="user.phone" :class="{ 'invalid' : !validation.phone }" @blur="focusLost('phone')">
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
							<button @click.prevent="checkout" class="df-button td-form__button" :disabled="sending">{{ sending ? 'Отправка...' : 'Отправить'}}</button>
						</div>
					</div>
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
	name: "SendDealerNew",
	components: { Selectize },
	props: ['isOpened', 'pdfData'],
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
				email: '',
				phone: ''
			},
			agreement: false,
			process: false,
			dealerCityID: -1,
			ps: [],
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
				},
				onChange: function (value) {
					this.dealerCityID = +value
				}.bind(this)

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
			dealer: '',
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
			carName: 'GET_CAR_NAME',
			carImage: 'GET_CAR_PICTURE',
			carCode: 'GET_CAR_CODE',
			dealerCities: 'GET_DEALERS',
			pdfApi: 'GET_API_GET_PDF',
			dealerApi: 'GET_API_SEND_DEALER'
		}),
		validation () {
			const reEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			return {
				dealer: this.dealer !== '' || !this.process,
				city: this.dealerCityID >= 0 || !this.process,
				email: reEmail.test(this.user.email) || (!this.blur.email && !this.process),
				name: this.user.name.trim() !== '' || (!this.blur.name && !this.process),
				surname: this.user.surname.trim() !== '' || (!this.blur.surname && !this.process),
				phone: this.user.phone.trim() !== '' || (!this.blur.phone && !this.process),
				agreement: this.agreement || !this.process
			}
		},
		isValid () {
			const validation = this.validation;

			return Object.keys(validation).every(function (key) {
				return validation[key]
			})
		},
		currentDealers () {
			if (this.dealerCities[this.dealerCityID]) {
				return this.dealerCities && this.dealerCities[this.dealerCityID].dealers || []
			}
		},
		dealerData () {
			return {
				file: '', // - имя PDF-файла
				email: this.user.email, // - адрес электронной почты клиента, из формы
				name: this.user.name, // - имя из формы
				last_name: this.user.surname, // - фамилия из формы
				phone: this.user.phone, // - телефон клиента, из формы
				model: this.carName, // - название тачки
				modification: this.$store.getters.GET_MODIFICATION_NAME,
				dealer: this.dealer,  // - SAP-код дилера, есть в API по дилерам
				salutation: this.user.appeal, // - обращение, из формы (Mr. и Ms.),
			}
    	},
	},
	methods: {
		openRules: function () {
			this.$emit('show-rules');
		},
		focusLost: function (name) {
			this.blur[name] = true;
		},
		closeThis: function () {
			this.$emit('close');
		},
		checkout: function () {
			var that = this;

			this.process = true;

			if (this.isValid) {
				if (!this.pdfData) {
					this.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки запроса.\nПожалуйста, попробуйте позже.' })
					console.error('PDF data error.')
					return false
				}

				this.sending = true

				this.send()
					.then(function (response) {
						that.$emit('success');
						that.sending = false;

						if (typeof dataLayer !== 'undefined') {
							dataLayer.push({
								"event": "custom_event",
								"category" : "Конфигуратор",
								"action": "Отправка расчета дилеру",
								"label" : that.carCode
							});
						}
					})
					.catch(function (error) {
						that.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки формы, повторите попытку позднее' })
						console.log(error);
						that.sending = false
					})
			}
		},
		send () {
			return axios.get(this.pdfApi, { params: this.pdfData })
				.then((response) => {
					if (!response || !response.data || !response.data.success) {
						throw new Error('Error getting PDF.')
					}

					return axios.get(this.dealerApi, { params: Object.assign(this.dealerData, { file: response.data.file }) })
				})
				.then((response) => {
					if (!response || !response.data || !response.data.result) {
						throw new Error('Error sending request.')
					}
				})
		},
		psUpdate: function () {
			this.ps.forEach((item)=>{
				var item = item;

				setTimeout(()=>{
					item.update();
				})
			})
		},
		loadDealers () {
			this.$store.dispatch('LOAD_DEALERS').catch(error => {
				this.$root.$emit('notify', { type: 'error', text: 'Ошибка при попытке запроса дилеров.\nПожалуйста, попробуйте позже.' })
				console.error('Unable to load dealers: ', error)
			})
		}
	},
	mounted() {
		var that = this;

		this.loadDealers();

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
	}
};
</script>

<style lang="sass">

</style>