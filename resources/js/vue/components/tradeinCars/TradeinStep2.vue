<template>
	<div class="step2" role="form">
		<div class="steps__body">
			<div class="steps__dropdown df-select-bordered" :class="{ 'invalid' : !validation.brand }">
				<label>Бренд</label>
				<selectize v-model="brand" :settings="dropdownSettings('Выберите бренд')">
					<option value=""> </option>
					<option :value="_brand" v-for="_brand in brandsList">{{ _brand }}</option>
				</selectize>
			</div>
			<div class="steps__dropdown df-select-bordered" :class="{ 'invalid' : !validation.model }">
				<label>Марка</label>
				<selectize v-model="model" :settings="dropdownSettings('Выберите марку')">
					<option value=""> </option>
					<option :value="_model" v-for="_model in modelsList">{{ _model }}</option>
				</selectize>
			</div>
			<div class="steps__dropdown df-select-bordered" :class="{ 'invalid' : !validation.age }">
				<label>Поколение</label>
				<selectize v-model="age" :settings="dropdownSettings('Выберите поколение')">
					<option value=""> </option>
					<option :value="_age" v-for="_age in agesList">{{ _age }}</option>
				</selectize>
			</div>
			<div class="steps__dropdown df-select-bordered" :class="{ 'invalid' : !validation.year }">
				<label>Год выпуска</label>
				<selectize v-model="year" :settings="dropdownSettings('Выберите год выпуска')">
					<option value=""> </option>
					<option :value="_year" v-for="_year in yearsList">{{ _year }}</option>
				</selectize>
			</div>
			<div class="steps__dropdown df-select-bordered" :class="{ 'invalid' : !validation.complectation }">
				<label>Уровень оснащения</label>
				<selectize v-model="complectation" :settings="dropdownSettings('Выберите уровень оснащения')">
					<option value=""> </option>
					<option :value="_complectation" v-for="_complectation in complectationsList">{{ _complectation }}</option>
				</selectize>
			</div>
			<div class="steps__dropdown df-select-bordered" :class="{ 'invalid' : !validation.body }">
				<label>Тип кузова</label>
				<selectize v-model="body" :settings="dropdownSettings('Выберите тип кузова')">
					<option value=""> </option>
					<option :value="_body" v-for="_body in bodysList">{{ _body }}</option>
				</selectize>
			</div>
			<div class="steps__dropdown df-select-bordered" :class="{ 'invalid' : !validation.condition }">
				<label>Состояние</label>
				<selectize v-model="condition" :settings="dropdownSettings('Выберите состояние автомобиля')">
					<option value=""> </option>
					<option :value="_condition" v-for="_condition in conditionsList">{{ _condition }}</option>
				</selectize>
			</div>
			<div class="steps__input">
				<label>Пробег</label>
				<input type="text" class="df-input-bordered" v-model.lazy="milleage" v-money="typeof milleage !== 'undefined' ? money : null" placeholder="Введите реальный пробег" :class="{ 'invalid' : !validation.milleage }">
			</div>
			<div class="steps__input">
				<label>VIN</label>
				<input type="text" class="df-input-bordered" v-model="vin" placeholder="Введите VIN автомобиля" :class="{ 'invalid' : !validation.vin }">
			</div>
		</div>
		<div class="steps__footer">
			<label class="step2__accept">
				<input type="checkbox" v-model="accept" :class="{ 'invalid' : !validation.accept }">
				<div class="step2__box">
					<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 5.2L5 8L9 1" stroke="#002C5F" stroke-width="2"/>
					</svg>
				</div>
				<div class="step2__description">Мой автомобиль <a href="#" @click.prevent="openPopup">подходит</a> под все технические требования</div>
			</label>
			<router-link to="/step-1" tag="button" class="steps__button steps__button--back df-button">Назад</router-link>
			<button class="steps__button steps__button--next df-button" @click.prevent="nextStep">Продолжить</button>
		</div>

		<tradein-step2-popup :key="id" :is-opened="openRequirements" @close="openRequirements = false"></tradein-step2-popup>
	</div>
</template>

<script>
import Selectize from 'vue2-selectize'
import { mapGetters } from "vuex"
import { VMoney } from 'v-money'
import TradeinStep2Popup from './TradeinStep2Popup'

export default {
	name: 'TradeinStep2',
	components: { Selectize, TradeinStep2Popup },
	directives: { money: VMoney },
	data () {
		return {
			id: 0,
			list: [],
			brandsList: ['Audi', 'BMW'],
			modelsList: ['Audi1', 'BMW1'],
			agesList: ['Первое', 'Второе'],
			yearsList: ['2019', '2018', '2017', '2016', '2015', '2014', '2013', '2012'],
			complectationsList: ['Первая', 'Вторая'],
			bodysList: ['Седан', 'Универсал'],
			conditionsList: ['Отличное', 'Хорошее'],
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
			money: {
				thousands: ' ',
				precision: 0,
				masked: false
			},
			process: false,
			openRequirements: false
		}
	},
	computed: {
		brand: {
			get: function() {
				return this.$store.state.tradein.step2.brand;
			},
			set: function(value) {
				this.$store.dispatch('SET_TRADEIN_STEP2', { brand: value });
			}
		},
		model: {
			get: function() {
				return this.$store.state.tradein.step2.model;
			},
			set: function(value) {
				this.$store.dispatch('SET_TRADEIN_STEP2', { model: value });
			}
		},
		age: {
			get: function() {
				return this.$store.state.tradein.step2.age;
			},
			set: function(value) {
				this.$store.dispatch('SET_TRADEIN_STEP2', { age: value });
			}
		},
		year: {
			get: function() {
				return this.$store.state.tradein.step2.year;
			},
			set: function(value) {
				this.$store.dispatch('SET_TRADEIN_STEP2', { year: value });
			}
		},
		complectation: {
			get: function() {
				return this.$store.state.tradein.step2.complectation;
			},
			set: function(value) {
				this.$store.dispatch('SET_TRADEIN_STEP2', { complectation: value });
			}
		},
		body: {
			get: function() {
				return this.$store.state.tradein.step2.body;
			},
			set: function(value) {
				this.$store.dispatch('SET_TRADEIN_STEP2', { body: value });
			}
		},
		condition: {
			get: function() {
				return this.$store.state.tradein.step2.condition;
			},
			set: function(value) {
				this.$store.dispatch('SET_TRADEIN_STEP2', { condition: value });
			}
		},
		vin: {
			get: function() {
				return this.$store.state.tradein.step2.vin;
			},
			set: function(value) {
				this.$store.dispatch('SET_TRADEIN_STEP2', { vin: value });
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
			return {
				brand: this.brand.trim() !== '' || !this.process,
				model: this.model.trim() !== '' || !this.process,
				age: this.age.trim() !== '' || !this.process,
				year: this.year.trim() !== '' || !this.process,
				complectation: this.complectation.trim() !== '' || !this.process,
				body: this.body.trim() !== '' || !this.process,
				condition: this.condition.trim() !== '' || !this.process,
				milleage: typeof this.milleage !== 'undefined' || !this.process,
				vin: this.vin.trim() !== '' || !this.process,
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
		nextStep: function () {
			this.process = true

			if (this.isValid) {
				this.$store.dispatch('SET_TRADEIN_STATE', { step2: true });
				this.$router.push({ name: 'step-3' })
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
		openPopup: function () {
			this.openRequirements = true
		}
	},
	created () {
		if (typeof carsList !== 'undefined') {
			this.list = carsList
		}

		this.openRequirements = true
	},
	activated () {
		this.id = this.$route.params.id;
		this.list.forEach(item=>{
			if (item.id == this.id) {
				this.$store.dispatch('SET_TRADEIN_CURRENT_CAR', item);
			}
		})
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