//Например на странице Старт
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
					<form-accept v-model="agreement" :is-valid="validation.agreement" @show-rules="openRules"></form-accept>
					<button @click.prevent="checkout" class="df-button contact-form__button">Отправить</button>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
import axios from 'axios'
import FormAccept from '@/components/common/FormAccept.vue'
import { mapGetters } from "vuex";

export default {
	name: "SendEmailForm",
	components: { FormAccept },
	props: ['sendUrl', 'page'],
	data() {
		return {
			blur: {
				surname: false,
				name: false,
				email: false
			},
			user: {
				surname: '',
				name: '',
				email: ''
			},
			agreement: false,
			process: false
		};
	},
	computed: {
		...mapGetters({
			isOpened: 'OPEN_SEND_EMAIL_POPUP',
			currentCar: 'GET_START_CURRENT_CAR',
			modification: 'GET_START_MODIFICATION',
			complectation: 'GET_START_COMPLECTATION',
			creditPack: 'GET_START_CREDIT_PACK',
			term: 'GET_START_CURRENT_TERM'
		}),
		validation () {
			const reEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			return {
				email: reEmail.test(this.user.email) || (!this.blur.email && !this.process),
				name: this.user.name.trim() !== '' || (!this.blur.name && !this.process),
				surname: this.user.surname.trim() !== '' || (!this.blur.surname && !this.process),
				agreement: this.agreement || !this.process
			}
		},
		isValid () {
			return Object.keys(this.validation).every((key)=>{
				return this.validation[key];
			})
		}
	},
	methods: {
		closeThis: function () {
			this.$store.dispatch('OPEN_SEND_EMAIL_POPUP', false);
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
				axios.get(this.sendUrl, {
						params: {
							carid: this.currentCar.id,
							mod: this.modification.name,
							compl: this.complectation.name,
							pay: this.creditPack.pay,
							term: this.term,
							prepay: this.creditPack.prepay,
							sum: this.creditPack.sum,
							prepay_rub: this.creditPack.prepayRub,
							addCost: this.creditPack.addCost,
							last_name: this.user.surname,
							name: this.user.name,
							email: this.user.email,
							agree: 'Y', //Потому что в противном случае ничего не отправится
							// googleId: gid,
							// yandexId: yClientID
						}
					})
					.then(function (response) {
						if (response.data.status === 1) {
							that.$emit('open-success');
							that.clearForm();

							if (that.page === 'isStartPage') {
								dataLayer.push({
									"event": "custom_event",
									"category" : "Страница программы start",
									"action": "Отправка заявки",
									"label" : "Отправка на почту " + that.currentCar.codeName + ', ' + that.modification.id
								})
							}
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
		clearForm: function () {
			this.user = {
				surname: '',
				name: '',
				email: '',
			}
			this.blur = {
				surname: false,
				name: false,
				email: false,
			}
			this.agreement = false;
			this.process = false;
			this.closeThis();
		},
		onEnter: function() {
			this.$root.$emit('fixOverflow', true)
		},
		onLeave: function() {
			this.$root.$emit('fixOverflow', false)
		}
	},
	mounted() {

	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'
@import '../../../../sass/common/components/_contact-form.sass'
</style>