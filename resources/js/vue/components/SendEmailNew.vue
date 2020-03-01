//Например на странице Старт
<template>
	<transition name="popup">
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
					<button @click.prevent="checkout" class="df-button contact-form__button" :disabled="sending">{{ sending ? 'Отправка...' : 'Отправить'}}</button>
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
	name: "SendEmailNew",
	components: { FormAccept },
	props: ['isOpened', 'pdfData', 'from'],
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
			process: false,
			sending: false
		};
	},
	computed: {
		...mapGetters({
			pdfApi: 'GET_API_GET_PDF',
			emailApi: 'GET_API_SEND_EMAIL',
			carCode: 'GET_CAR_CODE'
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
		},
		emailData () {
			return {
				email: this.user.email, // - мыло из формы
				file: '', // - имя файла из предыдущего запроса
				name: this.user.name, // - имя из формы
				last_name: this.user.surname, // - фамилия из формы
				car_id: this.$store.getters.GET_CURRENT_ID, // - ID тачки.
				car_name: this.$store.getters.GET_CAR_NAME
			}
		}
	},
	methods: {
		closeThis: function () {
			this.$emit('close');
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
				if (!this.pdfData) {
					this.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки запроса.\nПожалуйста, попробуйте позже.' })
					console.error('PDF data error.')
					return false
				}

				this.sending = true

				this.send()
					.then(function (response) {
						that.sending = false;
						that.$emit('success');
						that.closeThis();

						if (typeof dataLayer !== 'undefined') {
							if (that.from === 'calculator') {
								dataLayer.push({
									"event": "custom_event",
									"category" : "Конфигуратор",
									"action": "Отправка письма на e mail",
									"label" : that.carCode
								});
							} else if (that.from === 'summary') {
								dataLayer.push({
									"event": "custom_event",
									"category" : "Конфигуратор",
									"action": "Отправка на почту",
									"label" : that.carCode
								});
							}	
						}
					})
					.catch(function (error) {
						that.sending = false
						that.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки формы, повторите попытку позднее' })
						console.error(error)
					})
			}
		},
		send () {
			return axios.get(this.pdfApi, { params: this.pdfData })
				.then((response) => {
					if (!response || !response.data || !response.data.success) {
						throw new Error('Error getting PDF.')
					}

					return axios.get(this.emailApi, { params: Object.assign(this.emailData, { file: response.data.file }) })
				})
				.then((response) => {
					if (!response || !response.data || !response.data.result) {
						throw new Error('Error sending request.')
					}
				})
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
		}
	},
	mounted() {

	}
};
</script>

<style lang="sass">
@import '../../../sass/common/_variables.scss'
@import '../../../sass/common/components/_contact-form.sass'
</style>