<template>
	<transition name="popup">
		<div class="contact-form bc-form df-popup" v-show="isOpened">
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
					<input type="text" class="df-input-bordered contact-form__input capitalize" name="patronymic" id="patronymic" placeholder="Отчество" v-model="user.patronymic" :class="{ 'invalid' : !validation.patronymic }" @blur="focusLost('patronymic')">
					<input type="email" class="df-input-bordered contact-form__input" name="email" id="email" placeholder="E-mail" v-model="user.email" :class="{ 'invalid' : !validation.email }" @blur="focusLost('email')">
					<div class="bc-form__line">
						<input type="tel" v-mask="'+7(999)-999-99-99'" class="df-input-bordered contact-form__input" name="tel" id="tel" placeholder="Телефон" v-model="user.tel" :class="{ 'invalid' : !validation.tel }" @blur="focusLost('tel')">
						<input type="text" v-mask="{ regex: '[0-3]{1}[0-9]{1}\\.[0-1]{1}[0-9]{1}\\.[0-2]{1}[0-9]{1}[0-9]{1}[0-9]{1}' }" class="df-input-bordered contact-form__input" name="date" id="date" placeholder="Дата рождения" v-model="user.date" :class="{ 'invalid' : !validation.date }" @blur="focusLost('date')">
					</div>
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
import Inputmask from "inputmask";

export default {
	name: "BackCallForm",
	components: {},
	props: ['isOpened'],
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
			process: false
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
		validation () {
			const reEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			return {
				email: reEmail.test(this.user.email) || (!this.blur.email && !this.process),
				name: this.user.name.trim() !== '' || (!this.blur.name && !this.process),
				patronymic: this.user.patronymic.trim() !== '' || (!this.blur.patronymic && !this.process),
				surname: this.user.surname.trim() !== '' || (!this.blur.surname && !this.process),
				tel: this.user.tel.trim() !== '' || (!this.blur.tel && !this.process),
				date: this.user.date.trim() !== '' || (!this.blur.date && !this.process),
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
			this.$store.dispatch('OPEN_BACK_CALL', false);
		},
		openRules: function () {
			this.$store.dispatch('OPEN_RULES', true);
		},
		focusLost: function (name) {
			this.blur[name] = true;
		},
		checkout: function () {
			this.process = true;

			if (this.isValid) {
				this.$store.dispatch('OPEN_SUCCESS', true);
			}
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

<style lang="sass">

</style>