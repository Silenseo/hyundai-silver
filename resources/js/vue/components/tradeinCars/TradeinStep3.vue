<template>
	<div class="step3" role="form">
		<div class="steps__body">
			<div class="steps__input">
				<label>Имя</label>
				<input type="text" class="df-input-bordered capitalize" v-model="name" placeholder="Ваше имя" :class="{ 'invalid' : !validation.name }">
			</div>
			<div class="steps__input">
				<label>Фамилия</label>
				<input type="text" class="df-input-bordered capitalize" v-model="surname" placeholder="Ваша фамилия" :class="{ 'invalid' : !validation.surname }">
			</div>
			<div class="steps__input">
				<label>Отчество</label>
				<input type="text" class="df-input-bordered capitalize" v-model="patronymic" placeholder="Ваше отчество" :class="{ 'invalid' : !validation.patronymic }">
			</div>
			<div class="steps__input">
				<label>Телефон</label>
				<input type="tel" v-mask="'+7(999)-999-99-99'" class="df-input-bordered" v-model="tel" placeholder="Введите телефон" :class="{ 'invalid' : !validation.tel }">
			</div>
			<div class="steps__input">
				<label>E-mail</label>
				<input type="email" class="df-input-bordered" v-model="email" placeholder="Введите e-mail" :class="{ 'invalid' : !validation.email }">
			</div>
			<div class="steps__dropdown df-select-bordered" :class="{ 'invalid' : !validation.city }">
				<label>Город</label>
				<selectize v-model="city" :settings="dropdownSettings('Выберите город')">
					<option value=""> </option>
					<option :value="_city" v-for="_city in citysList">{{ _city }}</option>
				</selectize>
			</div>
		</div>
		<div class="steps__footer">
			<form-accept v-model="accept" :is-valid="validation.accept" @show-rules="openRules = true"></form-accept>
			<button class="steps__button steps__button--back df-button" @click.prevent="prevStep">Назад</button>
			<button class="steps__button steps__button--next df-button" @click.prevent="nextStep" :disabled="sending">{{ sending ? 'Отправка...' : 'Продолжить' }}</button>
		</div>
		<rules :is-opened="openRules" @close="openRules = false"></rules>
		<notifier></notifier>
	</div>
</template>

<script>
import Selectize from 'vue2-selectize'
import FormAccept from '@/components/common/FormAccept.vue'
import Rules from '@/components/common/Rules.vue'
import Notifier from '@/components/Notifier'
import { mapGetters } from "vuex"
import axios from 'axios'

export default {
	name: 'TradeinStep3',
	components: { Selectize, FormAccept, Rules, Notifier },
	data () {
		return {
			citysList: ['Москва', 'Киров'],
			settings: {
				placeholder: '',
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
			ps: [],
			accept: false,
			process: false,
			openRules: false,
			sending: false
		}
	},
	computed: {
		...mapGetters({
			sendUrl: 'GET_TRADEIN_URL',
			car: 'GET_TRADEIN_CAR',
			step2: 'GET_TRADEIN_STEP2',
			step3: 'GET_TRADEIN_STEP3',
		}),
		city: {
			get: function() {
				return this.$store.state.tradein.step3.city;
			},
			set: function(value) {
				this.$store.dispatch('SET_TRADEIN_STEP3', { city: value });
			}
		},
		name: {
			get: function() {
				return this.$store.state.tradein.step3.name;
			},
			set: function(value) {
				this.$store.dispatch('SET_TRADEIN_STEP3', { name: value });
			}
		},
		surname: {
			get: function() {
				return this.$store.state.tradein.step3.surname;
			},
			set: function(value) {
				this.$store.dispatch('SET_TRADEIN_STEP3', { surname: value });
			}
		},
		patronymic: {
			get: function() {
				return this.$store.state.tradein.step3.patronymic;
			},
			set: function(value) {
				this.$store.dispatch('SET_TRADEIN_STEP3', { patronymic: value });
			}
		},
		tel: {
			get: function() {
				return this.$store.state.tradein.step3.tel;
			},
			set: function(value) {
				this.$store.dispatch('SET_TRADEIN_STEP3', { tel: value });
			}
		},
		email: {
			get: function() {
				return this.$store.state.tradein.step3.email;
			},
			set: function(value) {
				this.$store.dispatch('SET_TRADEIN_STEP3', { email: value });
			}
		},
		milleage: {
			set (value) {
				//Переведём в числовой формат
				let fromNumber = value.split(' ').join('');

				this.$store.dispatch('SET_TRADEIN_STEP2', { milleage: +fromNumber });
			},
			get () {
				return this.$store.state.tradein.step2.milleage;
			}
		},
		validation () {
			const reEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			return {
				name: this.name.trim() !== '' || !this.process,
				surname: this.surname.trim() !== '' || !this.process,
				patronymic: this.patronymic.trim() !== '' || !this.process,
				tel: this.tel.trim() !== '' || !this.process,
				email: reEmail.test(this.email) || !this.process,
				city: this.city.trim() !== '' || !this.process,
				accept: this.accept || !this.process
			}
		},
		isValid () {
			return Object.keys(this.validation).every((key)=>{
				return this.validation[key];
			})
		},
	},
	methods: {
    	dropdownSettings: function (placeholder) {
			var set = {};

			Object.assign(set, this.settings);
			set.placeholder = placeholder;

			return set
		},
		psUpdate: function () {
			this.ps.forEach((item)=>{
				setTimeout(function () {
					item.update();
				}.bind(null, item))
			})
		},
		prevStep: function () {
			this.$router.go(-1)
		},
		nextStep: function () {
			this.process = true

			if (this.isValid) {
				this.$store.dispatch('SET_TRADEIN_STATE', { step3: true });
				this.sendData();
			} else {
				//Скролл к первому не валидному полю
				setTimeout(()=>{
					var st = $('.invalid:not([type="checkbox"])');

					if (st.length > 0) {
						st = st.eq(0).offset().top - 200;
					}

					if (st > 0) {
						$('html, body').animate({ scrollTop: st }, 500);
					}
				}, 300)
			}
		},
		sendData: function() {
			var that = this;

			this.sending = true;

			var data = {
				carName: this.car.name
			};

			Object.assign(data, this.step2, this.step3)

			axios.get(this.sendUrl, {
				params: data
			})
			.then(function (response) {
				if (response.data.status === 1) {
					that.sending = false
					that.$router.push({ name: 'step-4' })
				} else {
					throw new Error('Ошибка');
				}
			})
			.catch(function (error) {
				that.sending = false
				that.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки формы, повторите попытку позднее' })
				console.log(error);
			})
		}
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

			$(".tradein .selectize-input input").attr('readonly','readonly');
		})
	}
}
</script>