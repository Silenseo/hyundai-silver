// Компонент используется в калькуляторе ТО
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
					<h3 class="contact-form__title">Пожалуйста, укажите Ваши контактные данные</h3>
					<input type="text" class="df-input-bordered contact-form__input capitalize" name="surname" id="surname" placeholder="Фамилия" v-model="user.surname" :class="{ 'invalid' : !validation.surname }" @blur="focusLost('surname')">
					<input type="text" class="df-input-bordered contact-form__input capitalize" name="name" id="name" placeholder="Имя" v-model="user.name" :class="{ 'invalid' : !validation.name }" @blur="focusLost('name')">
					<input type="email" class="df-input-bordered contact-form__input" name="email" id="email" placeholder="E-mail" v-model="user.email" :class="{ 'invalid' : !validation.email }" @blur="focusLost('email')">
					<input type="tel" v-mask="'+7(999)-999-99-99'" class="df-input-bordered contact-form__input" name="tel" id="tel" placeholder="Телефон" v-model="phone" :class="{ 'invalid' : !validation.phone }" @blur="focusLost('phone')">
					<label class="contact-form__accept">
						<input type="checkbox" v-model="agreement" :class="{ 'invalid' : !validation.agreement }" name="accept" id="accept">
						<div class="contact-form__box">
							<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 5.2L5 8L9 1" stroke="#002C5F" stroke-width="2"/>
							</svg>
						</div>
						<div class="contact-form__description">Я согласен с <a href="#" @click.prevent="openRules">правилами</a> обработки персональных данных</div>
					</label>
					<button @click.prevent="checkout" class="df-button contact-form__button" :disabled="sending">{{ sending ? 'Отправка...' : 'Отправить заявку'}}</button>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
import axios from 'axios'
import { mapGetters } from "vuex";
import Inputmask from "inputmask";

export default {
	name: "ContactForm",
	components: {},
	props: ['isOpened'],
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
				email: ''
			},
			defaultUser: {
				surname: '',
				name: '',
				email: ''
			},
			agreement: false,
			process: false,
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
			ENV: "GET_ENV",
			model: "GET_CAR_CODE",
			carID: "GET_CAR_ID",
			dealer: "GET_DEALER"
		}),
		validation () {
			const reEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			return {
				email: reEmail.test(this.user.email) || (!this.blur.email && !this.process),
				name: this.user.name.trim() !== '' || (!this.blur.name && !this.process),
				surname: this.user.surname.trim() !== '' || (!this.blur.surname && !this.process),
				phone: this.phone.trim() !== '' || (!this.blur.phone && !this.process),
				agreement: this.agreement || !this.process
			}
		},
		isValid () {
			return Object.keys(this.validation).every((key)=>{
				return this.validation[key];
			})
		},
		phone : {
			get () {
                return this.$store.state.user.phone;
            },
            set (value) {
				if (typeof value !== 'undefined') {
					this.$store.dispatch('SET_USER_PHONE', value);
				}
            }
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
				this.sending = true;

				let params = {
						modelId: this.carID,
						modelCode: this.model,
						salutation: 'Mr.',
						name: this.user.name,
						sirname: this.user.surname,
						email: this.user.email,
						phone: this.phone
					}

				if (this.ENV !== 'dealer') {
					params.dealer = this.dealer
				}

				axios.get(this.$store.state.API.CONTACT_FORM, {
					params: params
				})
					.then(function (response) {
						if (response.data.status === 1) {
							that.$store.dispatch('OPEN_SUCCESS', true);
							that.clearForm()
							that.closeThis();
							that.sending = false;
						} else {
							throw new Error('Ошибка');
						}
					})
					.catch(function (error) {
						that.sending = false;
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
		clearForm () {
			this.user = Object.assign({}, this.defaultUser);

			for (var name in this.blur) {
				this.blur[name] = false
			}

			this.phone = ''
			this.agreement = false
			this.process = false
		}
	},
	mounted() {
		var that = this;

		this.$nextTick(function() {
			
		})
	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'
@import '../../../../sass/common/components/_contact-form.sass'
</style>