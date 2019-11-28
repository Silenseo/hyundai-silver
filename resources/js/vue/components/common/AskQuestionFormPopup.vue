<template>
	<transition name="popup" v-on:enter="onEnter" v-on:leave="onLeave">
		<div class="question-form df-popup" v-show="isOpened">
			<div class="df-popup__wrap question-form__wrap" @mousedown.self="closeThis">
				<div class="question-form__center df-popup__center" role="form">
					<a href="#" @click.prevent="closeThis" class="question-form__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<h3 class="question-form__title">Оставьте свое сообщение в&nbsp;этой форме, мы&nbsp;получим его на&nbsp;e-mail и&nbsp;обязательно ответим!</h3>
					<textarea type="text" class="df-input-bordered question-form__message" name="message" id="message" placeholder="Сообщение" v-model="user.message" :class="{ 'invalid' : !validation.message }" @blur="focusLost('message')"></textarea>
					<input type="text" class="df-input-bordered question-form__input capitalize" name="name" id="name" placeholder="Имя" v-model="user.name" :class="{ 'invalid' : !validation.name }" @blur="focusLost('name')">
					<input type="email" class="df-input-bordered question-form__input" name="email" id="email" placeholder="E-mail" v-model="user.email" :class="{ 'invalid' : !validation.email }" @blur="focusLost('email')">
					<input type="tel" v-mask="'+7(999)-999-99-99'" class="df-input-bordered question-form__input" name="tel" id="tel" placeholder="Телефон" v-model="user.phone" :class="{ 'invalid' : !validation.phone }" @blur="focusLost('phone')">
					<form-accept v-model="agreement" :is-valid="validation.agreement" @show-rules="openRules"></form-accept>
					<button @click.prevent="checkout" class="df-button question-form__button" :disabled="sending">{{ sending ? 'Отправка...' : 'Отправить'}}</button>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
import axios from 'axios'
import FormAccept from '@/components/common/FormAccept.vue'

export default {
	name: "AskQuestionFormPopup",
	components: { FormAccept },
	props: {
		 isOpened: {
			type: Boolean,
			required: true
		},
		url: {
			type: String,
			required: true
		}
	},
	data() {
		return {
			blur: {
				message: false,
				name: false,
				email: false,
				phone: false
			},
			user: {
				message: '',
				name: '',
				email: '',
				phone: ''
			},
			agreement: false,
			process: false,
			sending: false
		};
	},
	computed: {
		validation () {
			const reEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			return {
				message: this.user.message.trim() !== '' || (!this.blur.message && !this.process),
				email: reEmail.test(this.user.email) || (!this.blur.email && !this.process),
				name: this.user.name.trim() !== '' || (!this.blur.name && !this.process),
				phone: this.user.phone.trim() !== '' || (!this.blur.phone && !this.process),
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
			this.$emit('close-this');
		},
		openRules: function () {
			this.$emit('open-rules')
		},
		focusLost: function (name) {
			this.blur[name] = true;
		},
		checkout: function () {
			var that = this;

			this.process = true;

			if (this.isValid) {
				this.sending = true;

				axios.get(this.url, {
					params: {
						message: this.user.message,
						email: this.user.email,
						name: this.user.name,
						tel: this.user.phone
					}
				})
					.then(function (response) {
						if (response.data.status === 1) {
							that.$emit('open-success', true);
							that.closeThis();
							that.sending = false;
						} else {
							throw new Error('Ошибка');
						}
					})
					.catch(function (error) {
						that.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки формы, повторите попытку позднее' })
						console.log(error);
						that.sending = false;
					})
			}
		},
		onEnter: function() {
			this.$root.$emit('fixOverflow', true)
		},
		onLeave: function() {
			this.$root.$emit('fixOverflow', false)
		}
	},
	filters: {},
	mounted() {
		
	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'
@import '../../../../sass/common/components/_question-form.sass'
</style>