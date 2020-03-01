<template>
	<transition name="popup" v-on:enter="onEnter" v-on:leave="onLeave">
		<div class="callback-form df-popup" v-show="isOpened">
			<div class="df-popup__wrap callback-form__wrap" @mousedown.self="closeThis">
				<div class="callback-form__center df-popup__center" role="form">
					<a href="#" @click.prevent="closeThis" class="callback-form__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<h3 class="callback-form__title">{{ later ? 'Неудобно принять звонок прямо сейчас? Мы&nbsp;вам перезвоним.' : 'Здравствуйте! Хотите, мы&nbsp;свяжемся с&nbsp;Вами и&nbsp;всё обсудим?' }}</h3>
					<div class="callback-form__body">
						<div class="callback-form__left callback-form__left--mb">
							<label for="name" class="callback-form__label">Ваше имя</label>
							<input type="text" class="df-input-bordered callback-form__input capitalize" name="name" id="name" placeholder="Введите имя" v-model="user.name" :class="{ 'invalid' : !validation.name }" @blur="focusLost('name')">
						</div>
						<div class="callback-form__right">
							<label for="tel" class="callback-form__label">Ваш телефон</label>
							<input type="tel" v-mask="'+7(999)-999-99-99'" class="df-input-bordered callback-form__input" name="tel" id="tel" placeholder="Введите телефон" v-model="user.phone" :class="{ 'invalid' : !validation.phone }" @blur="focusLost('phone')">
						</div>
					</div>
					<div class="callback-form__line" v-if="type === 1">
						<div class="callback-form__left">
							<div class="callback-form__dropdown callback-form__dropdown--center df-select-bordered" :class="{ 'invalid' : !validation.center }">
								<selectize v-model="center" :settings="settingsCenter">
									<option value=""> </option>
									<option :value="c.name" v-for="c in centersList">{{ c.name }}</option>
								</selectize>
							</div>
							<div class="callback-form__note">
								Выберите Дилерский центр, из&nbsp;которого поступит звонок
							</div>
						</div>
					</div>
					<div class="callback-form__time" v-show='later'>
						<div class="callback-form__dropdown df-select-bordered" :class="{ 'invalid' : !validation.hours }">
							<selectize v-model="hours" :settings="settingsTime">
								<option :value="hour" v-for="hour in hoursList">{{ hour }}</option>
							</selectize>
						</div>
						<div class="callback-form__dropdown df-select-bordered" :class="{ 'invalid' : !validation.minutes }">
							<selectize v-model="minutes" :settings="settingsTime">
								<option :value="min" v-for="min in minutesList">{{ min }}</option>
							</selectize>
						</div>
						<div class="callback-form__note">
							Выберите удобное время для звонка
						</div>
					</div>
					<div class="callback-form__line">
						<form-accept v-model="agreement" :is-valid="validation.agreement" @show-rules="openRules"></form-accept>
						<button @click.prevent="checkout" class="df-button callback-form__button" :disabled="sending">{{ sending ? 'Отправка...' : 'Отправить заявку'}}</button>
					</div>
					<div class="callback-form__footer">
						<a href="#" class="callback-form__later" @click.prevent="later = !later">{{ later ? 'Готовы поговорить прямо сейчас?' : 'Сейчас неудобно? Выберите удобное время для звонка.' }}</a>
					</div>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
import Selectize from 'vue2-selectize'
import axios from 'axios'
import FormAccept from '@/components/common/FormAccept.vue'

export default {
	name: "CallBackFormPopup",
	components: { Selectize, FormAccept },
	props: {
		 isOpened: {
			type: Boolean,
			required: true
		},
		fromHour: {
			type: Number,
			required: true
		},
		toHour: {
			type: Number,
			required: true
		},
		type: {
			type: Number, //0 or 1
			required: true
		},
		centersList: {
			type: Array,
			required: true,
			validator: function (value) {
				let flag = value.every(item=>
					typeof item.name !== 'undefined'
				)
				return flag
			}
		},
		url: {
			type: String,
			required: true
		}
	},
	data() {
		return {
			blur: {
				name: false,
				email: false,
				phone: false
			},
			user: {
				name: '',
				email: '',
				phone: ''
			},
			hours: '',
			minutes: '',
			center: '',
			hoursList: [],
			minutesList: [],
			agreement: false,
			process: false,
			sending: false,
			later: false,
			settingsTime: {
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
			settingsCenter: {
				placeholder: 'Дилерский центр',
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
			ps: []
		};
	},
	computed: {
		validation () {
			const reEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			return {
				name: this.user.name.trim() !== '' || (!this.blur.name && !this.process),
				phone: this.user.phone.trim() !== '' || (!this.blur.phone && !this.process),
				hours: this.hours !== '' || (!this.later || !this.process),
				minutes: this.minutes !== '' || (!this.later || !this.process),
				center: this.center !== '' || (this.type === 0 || !this.process),
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
						name: this.user.name,
						tel: this.user.phone,
						center: this.center,
						time: this.later ? this.hours + ':' + this.minutes : '',
					}
				})
					.then(function (response) {
						if (response.data.status === 1) {
							that.$emit('open-success');
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
		},
		psUpdate: function () {
			this.ps.forEach((item)=>{
				var item = item;

				setTimeout(()=>{
					item.update();
				})
			})
		},
		formatTime: function (input) {
			if ((input+'').length < 2) {
				return '0' + input;
			} else {
				return '' + input;
			}
		},
		setHoursList: function() {
			for (let i = this.fromHour; i < this.toHour; i++) {
				
				this.hoursList.push(this.formatTime(i))
			}

			this.hours = this.hoursList[0];
		},
		setMinutesList: function() {
			for (let i = 0; i < 60; i++) {

				if (i % 5 === 0) {
					this.minutesList.push(this.formatTime(i))
				}
			}

			this.minutes = this.minutesList[0];
		}
	},
	beforeMount() {
		this.setHoursList();
		this.setMinutesList();
	},
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

			$(".callback-form .selectize-input input").attr('readonly','readonly');
		})
	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'
@import '../../../../sass/common/components/_callback-form.sass'
</style>