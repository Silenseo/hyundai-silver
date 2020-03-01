<template>
	<transition name="popup" v-on:enter="onEnter">
		<div class="contact-form bc-form df-popup" v-show="isOpened">
			<div class="df-popup__wrap" @mousedown.self="closeThis">
				<div class="contact-form__center df-popup__center">
					<a href="#" @click.prevent="closeThis" class="contact-form__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<h3 class="contact-form__title">Пожалуйста, укажите Ваши контактные данные<sup>*</sup></h3>
					<input type="text" class="df-input-bordered contact-form__input capitalize" name="surname" id="surname" placeholder="Фамилия" v-model="user.surname" :class="{ 'invalid' : !validation.surname }" @blur="focusLost('surname')">
					<input type="text" class="df-input-bordered contact-form__input capitalize" name="name" id="name" placeholder="Имя" v-model="user.name" :class="{ 'invalid' : !validation.name }" @blur="focusLost('name')">
					<input type="text" class="df-input-bordered contact-form__input capitalize" name="patronymic" id="patronymic" placeholder="Отчество" v-model="user.patronymic" :class="{ 'invalid' : !validation.patronymic }" @blur="focusLost('patronymic')">
					<input type="email" class="df-input-bordered contact-form__input" name="email" id="email" placeholder="E-mail" v-model="user.email" :class="{ 'invalid' : !validation.email }" @blur="focusLost('email')">
					<div class="bc-form__line">
						<input type="tel" v-mask="'+7(999)-999-99-99'" class="df-input-bordered contact-form__input" name="tel" id="tel" placeholder="Телефон" v-model="user.tel" :class="{ 'invalid' : !validation.tel }" @blur="focusLost('tel')">
						<input type="text" v-mask="{ regex: '[0-3]{1}[0-9]{1}\\.[0-1]{1}[0-9]{1}\\.[0-2]{1}[0-9]{1}[0-9]{1}[0-9]{1}' }" class="df-input-bordered contact-form__input" name="date" id="date" placeholder="Дата рождения" v-model="user.date" :class="{ 'invalid' : !validation.date }" @blur="focusLost('date')">
					</div>
					<div class="contact-form__note">* Необходимо зарегистрировать каждого участника встречи</div>
					<form-accept v-model="agreement" :is-valid="validation.agreement" @show-rules="openRules"></form-accept>
					<button @click.prevent="checkout" class="df-button contact-form__button" :disabled="sending"><div class="df-loader" v-if="sending"></div>{{ sending ? sendingText : buttonText }}</button>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
import axios from 'axios'
import FormAccept from '@/components/common/FormAccept.vue'
import { mapGetters } from "vuex";
import Inputmask from "inputmask";

export default {
	name: "CheckoutForm",
	components: { FormAccept },
	data() {
		return {
			blur: {
				surname: false,
				name: false,
				patronymic: '',
				email: false,
				tel: false,
				date: false
			},
			user: {
				surname: '',
				name: '',
				patronymic: '',
				email: '',
				tel: '',
				date: ''
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
			isOpened: 'OPEN_CHECKOUT_EVENT_POPUP',
			id: 'GET_SELECTED_EVENT',
			selectedEvents: 'GET_SELECTED_EVENTS'
		}),
		validation () {
			const reEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			let year = this.user.date.split('.')[2];
			let date = new Date();
			const nowYear = date.getFullYear();
			let statusYear = false;

			if ((nowYear - year) <= 80 && (nowYear - year) >= 0) {
				statusYear = true
			}

			return {
				email: reEmail.test(this.user.email) || (!this.blur.email && !this.process),
				name: this.user.name.trim() !== '' || (!this.blur.name && !this.process),
				patronymic: this.user.patronymic.trim() !== '' || (!this.blur.patronymic && !this.process),
				surname: this.user.surname.trim() !== '' || (!this.blur.surname && !this.process),
				tel: this.user.tel.trim() !== '' || (!this.blur.tel && !this.process),
				date: statusYear || (!this.blur.date && !this.process),
				agreement: this.agreement || !this.process
			}
		},
		isValid () {
			return Object.keys(this.validation).every((key)=>{
				return this.validation[key];
			})
		},
		buttonText () {
			return lang.register || 'Записаться'
		},
		sendingText () {
			if (lang.name === 'ru') {
				return 'Отправка...';
			}
			if (lang.name === 'en') {
				return 'Sending...';
			}
		},
		eventName: function () {
			return this.selectedEvents.filter(event=>event.id == this.id)[0].name
		}
	},
	methods: {
		closeThis: function () {
			this.$store.dispatch('OPEN_CHECKOUT_EVENT_POPUP', false);
			this.$root.$emit('fixOverflow', false);
		},
		openRules: function () {
			this.$emit('show-rules');
		},
		focusLost: function (name) {
			this.blur[name] = true;
		},
		checkout: function () {
			var that = this;
			
			this.process = true;

			if (this.isValid) {
				this.sending = true;

				axios.get(this.$store.state.API.MOTORSTUDIO_CHECKOUT_FORM, {
					params: {
						id: this.id,
						name: this.user.name,
						surname: this.user.surname,
						patronymic: this.user.patronymic,
						email: this.user.email,
						tel: this.user.tel,
						age: this.user.date
					}
				})
					.then(function (response) {
						if (response.data.status === 1) {
							that.$store.dispatch('OPEN_SUCCESS', true);
							that.clearForm();
							that.sending = false;
							dataLayer.push({
								"event": "custom_event",
								"category" : "Motor Studio",
								"action": "Запись на мероприятие",
								"label" : that.eventName
							});
						} else if (response.data.status === 2) {
							that.sending = false;
							that.$root.$emit('notify', { type: 'error', text: 'Вы уже зарегистрированы на мероприятие.' })
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
		clearForm: function () {
			this.user = {
				surname: '',
				name: '',
				patronymic: '',
				email: '',
				tel: '',
				date: ''
			}
			this.blur = {
				surname: false,
				name: false,
				patronymic: '',
				email: false,
				tel: false,
				date: false
			}
			this.agreement = false;
			this.process = false;
			this.closeThis();
		},
		onEnter: function() {
			this.$root.$emit('fixOverflow', true)
		}
	},
	filters: {},
	mounted() {
		var that = this;

		this.$nextTick(function() {
			
		})
	},
	watch: {

	}
};
</script>