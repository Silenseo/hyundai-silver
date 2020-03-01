<template>
	<section class="calc">
		<div class="calc__main">
			<div class="steps__top steps__top--summary">
				<div class="steps__left">
					<a href="#" @click.prevent="prevSlide" class="df-back-link">
						Назад
						<svg>
							<use xlink:href="#back-link"></use>
						</svg>
					</a>
				</div>
				<div class="steps__right">Шаг 3 из 3</div>
			</div>
			<h2 class="calc__title">Ваш расчет</h2>
			<div class="calc__list">
				<div class="calc__item">
					<label for="term">Срок кредита</label>
					<div class="calc__line">
						<ul class="term">
							<li class="term__item" :class="{ active: currentTerm === term }" v-for="term in termsList" @click="setTerm(term)">
								{{ term }}
							</li>
						</ul>
						<div class="options" @click="toggleNote" :class="{ showNote: showNote, hide: !(currentTerm === 36 && currentCar.name !== 'H-1'), active: includeKASKO }">
							<label>
								<input type="checkbox" v-model="includeKASKO">
								<div class="options__box">
									<svg width="14" height="13" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
									</svg>
								</div>
								<div class="options__description">Включить КАСКО и ТО</div>
							</label>
							<!-- При смене title, поменяй условие для статистики в методе -->
							<a href="#" class="info" @click.prevent="showInfo('Каско и ТО', 'Чтобы годовая покупка КАСКО и&nbsp;очередное&nbsp;ТО не&nbsp;стали большим внеплановым расходом вашего бюджета, вы&nbsp;можете включить их&nbsp;в&nbsp;ежемесячные платежи. Стоимость годового полиса КАСКО и&nbsp;одного технического обслуживания в&nbsp;год делится на&nbsp;12&nbsp;месяцев, и&nbsp;полученная сумма прибавляется к&nbsp;вашему ежемесячному платежу. Возможность включения КАСКО и&nbsp;ТО в&nbsp;ежемесячные платежи доступна только для&nbsp;версии программы на&nbsp;36&nbsp;месяцев.')">
								<svg width="2" height="10" viewBox="0 0 2 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 10.0001H2V4.00006H0V10.0001ZM0 2.00006H2V6.10352e-05H0V2.00006Z"/>
								</svg>
							</a>
							<div class="options__note" :class="{ active: state.noteOpened }">
								<span v-if="currentCar.name !== 'H-1'">Доступно только для версии программы на&nbsp;36&nbsp;месяцев</span>
								<span v-else>Недоступно для данной модели</span>
							</div>
						</div>
					</div>
				</div>
				<div class="calc__item range">
					<div class="range__top">
						<div class="range__line">
							<label for="last">Остаточный платеж</label>
							<!-- При смене title, поменяй условие для статистики в методе -->
							<a href="#" class="info" @click.prevent="showInfo('Остаточный платеж', 'Остаточный платеж&nbsp;&mdash; это часть стоимости автомобиля, которая фиксируется в&nbsp;договоре и&nbsp;выплачивается по&nbsp;окончании программы одним из&nbsp;выбранных способов. За&nbsp;счет остаточного платежа сумма кредита сокращается, позволяя уменьшить ежемесячный платеж. Регулируя остаточный платеж, вы&nbsp;можете менять сумму кредита, тем самым увеличивая/уменьшая ежемесячные платежи. На&nbsp;каждый шаг остаточного платежа действует индивидуальное ограничение по&nbsp;пробегу.')">
								<svg width="2" height="10" viewBox="0 0 2 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 10.0001H2V4.00006H0V10.0001ZM0 2.00006H2V6.10352e-05H0V2.00006Z" fill="white"/>
								</svg>
							</a>
						</div>
						<div class="range__value">{{ lastPaymentValue | currencyFormat }} ₽</div>
					</div>
					<div class="range--last"></div>
					<div class="range__bottom">
						<div class="range__min">{{ lastPayment.min }}</div>
						<div class="range__center">{{ lastPayment.center }}</div>
						<div class="range__max">{{ lastPayment.max }}</div>
					</div>
				</div>
				<div class="calc__item range range--fp">
					<div class="range__top">
						<div class="range__line">
							<label for="first">Первый взнос</label>
						</div>
						<div class="range__value">{{ firstPaymentValue | currencyFormat }} ₽</div>
					</div>
					<div class="range--first"></div>
					<div class="range__bottom">
						<div class="range__min">{{ firstPayment.min }}</div>
						<div class="range__max">{{ firstPayment.max }}</div>
					</div>
				</div>
			</div>
		</div>
		<div class="aside">
			<div class="aside__name">{{ currentCar.name }}</div>
			<div class="aside__img">
				<img :src="activeColorObj.carImage" alt="">
			</div>
			<div class="aside__line">
				<div class="aside__label">Общая стоимость</div>
				<div class="aside__value">{{ totalCost | currencyFormat }} ₽</div>
			</div>
			<div class="aside__line">
				<div class="aside__label">Первый взнос</div>
				<div class="aside__value">{{ firstPaymentValue | currencyFormat }} ₽</div>
			</div>
			<div class="aside__line">
				<div class="aside__label">КАСКО и ТО</div>
				<div class="aside__value">{{ addCost | currencyFormat }} ₽</div>
			</div>
			<div class="aside__line">
				<div class="aside__label">{{ milleage }}</div>
				<div class="aside__value">{{ milleageValue }}</div>
			</div>
			<hr>
			<div class="aside__line aside__line--total">
				<div class="aside__label">Итого</div>
				<div class="aside__value aside__value--large">{{ totalMonthPay | currencyFormat }} ₽/мес</div>
			</div>
			<a v-if="creditApprove || ENV !== 'dealer'" href="#" class="aside__button" @click.prevent = "openCreditForm">Предодобрение кредита</a>
			<div class="aside__bottom">
				<a href="#" class="aside__mail" @click.prevent = "openSendForm">
					<svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M12.011 0.749942H1.93098C1.77255 0.749936 1.61568 0.781419 1.46943 0.842349C1.32319 0.903279 1.19046 0.992553 1.0789 1.10504C0.967337 1.21754 0.879153 1.351 0.819439 1.49774C0.759724 1.64449 0.729678 1.8016 0.730999 1.96002V11.14C0.72913 11.4606 0.854298 11.769 1.07917 11.9976C1.30405 12.2262 1.61032 12.3566 1.93098 12.36H15.111C15.4316 12.3566 15.7379 12.2262 15.9628 11.9976C16.1877 11.769 16.3129 11.4606 16.311 11.14V1.96002C16.3123 1.8016 16.2822 1.64449 16.2225 1.49774C16.1628 1.351 16.0746 1.21754 15.9631 1.10504C15.8515 0.992553 15.7188 0.903279 15.5725 0.842349C15.4263 0.781419 15.2694 0.749936 15.111 0.749942H12.011Z" stroke-width="1.5"/>
						<path d="M1.61108 1.62006L8.5311 6.54999L16.1421 1.62006" stroke-width="1.5"/>
					</svg>

					<span>Отправить на почту</span>
				</a>
				<a href="#" @click.prevent = "openTestDrive" class="aside__dealers">
					<span>Тест-драйв</span>
					<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 1L4.89793 5.33104C5.24021 5.71134 5.24021 6.28866 4.89793 6.66896L1 11" stroke-width="2"/>
					</svg>
				</a>
			</div>
			<div class="aside__dealer" v-if="ENV === 'dealer' && dealerTel">
				<a :href="'tel:' + dealerTel" class="aside__dealers aside__dealers--call">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.37487 7.2508L1.37486 7.25077C0.995357 6.2444 0.800791 5.31741 0.800002 4.53869C0.799218 3.76326 0.991315 3.10864 1.41634 2.68392L1.37487 7.2508ZM1.37487 7.2508C2.21015 9.46468 3.85385 11.8612 5.99643 14.0037C8.13837 16.1457 10.5343 17.7894 12.7482 18.6241C13.7579 19.0051 14.687 19.2 15.467 19.2C16.2397 19.2 16.8928 19.0079 17.3151 18.5851C17.4068 18.4939 17.5044 18.4009 17.6066 18.3035C17.6216 18.2892 17.6367 18.2747 17.652 18.2602L17.6575 18.255C18.011 17.9194 18.4048 17.5455 18.7034 17.1245C19.0057 16.6981 19.2216 16.2081 19.1983 15.6401L19.1983 15.6401C19.1657 14.8531 18.6785 14.1256 17.793 13.414C16.5023 12.3764 15.5769 12.0482 14.8113 12.17C14.0664 12.2885 13.5335 12.8292 13.0239 13.3462L13.0012 13.3692L13.0009 13.3696L12.8112 13.5611C12.8111 13.5611 12.811 13.5612 12.811 13.5613C12.7803 13.5918 12.7303 13.6148 12.641 13.6151C12.5493 13.6154 12.4338 13.591 12.3012 13.544C12.0367 13.4502 11.751 13.2839 11.5389 13.1461C10.8696 12.7111 10.0219 11.985 9.01825 10.9813C7.47978 9.44287 6.81151 8.48822 6.5457 7.91005C6.41334 7.62216 6.38693 7.44066 6.39231 7.33452C6.39736 7.23498 6.43019 7.19802 6.43884 7.1893C6.43893 7.18921 6.43902 7.18912 6.43911 7.18903L6.62752 7.00243C6.6276 7.00235 6.62768 7.00227 6.62776 7.0022C6.63589 6.99419 6.64403 6.98618 6.65217 6.97816C7.16991 6.46846 7.71126 5.93553 7.83053 5.19091C7.95325 4.42473 7.6253 3.49881 6.58675 2.2072C5.87521 1.32181 5.14717 0.833904 4.36131 0.801358V0.801354L4.36017 0.801314C3.79271 0.781071 3.30347 0.996428 2.87737 1.2978C2.45461 1.59681 2.07956 1.99123 1.74233 2.34587L1.74157 2.34667L1.74143 2.34682M1.37487 7.2508L1.74143 2.34682M1.74143 2.34682L1.7315 2.35728M1.74143 2.34682L1.7315 2.35728M2.47043 3.0394L2.47041 3.03942L2.45894 3.05148C2.34708 3.16918 2.23643 3.28559 2.12722 3.39481L2.12714 3.39488C1.91013 3.61165 1.78397 4.04236 1.80824 4.6723C1.83209 5.2915 2.00023 6.05961 2.3158 6.89649C3.09634 8.96521 4.65343 11.239 6.7079 13.2934C8.76181 15.3467 11.0344 16.9038 13.1037 17.6837L13.1038 17.6838C13.9406 17.9999 14.7087 18.1679 15.3278 18.1916C15.9577 18.2157 16.3883 18.0894 16.6048 17.8729C16.7178 17.76 16.8383 17.6456 16.9604 17.5302C17.274 17.2322 17.5926 16.9288 17.8308 16.6107C18.0693 16.2922 18.2071 15.9847 18.1944 15.6803C18.1769 15.2595 17.8642 14.7588 17.164 14.1962L17.164 14.1962C16.1021 13.3422 15.4779 13.1153 15.0267 13.1675C14.8035 13.1933 14.6027 13.2894 14.3925 13.4468C14.1788 13.6069 13.9673 13.8208 13.7174 14.0742L13.7171 14.0745L13.5233 14.2701L13.5228 14.2707C13.2352 14.5586 12.8594 14.6629 12.4274 14.6043C12.0046 14.5469 11.5236 14.334 10.9916 13.9882L10.9915 13.9882C10.2523 13.5074 9.34854 12.7322 8.30799 11.691C8.30797 11.691 8.30795 11.691 8.30793 11.691M2.47043 3.0394L8.44939 11.5496L8.30793 11.691M2.47043 3.0394C2.76197 2.73259 3.05865 2.42099 3.36951 2.18453C3.68104 1.94756 3.98242 1.80541 4.28039 1.80541C4.29657 1.80541 4.30837 1.80543 4.31951 1.80585C4.74035 1.82402 5.24036 2.13694 5.80408 2.83636M2.47043 3.0394L5.80408 2.83636M8.30793 11.691C7.02425 10.4076 6.16091 9.35784 5.7214 8.51725C5.50138 8.09646 5.37956 7.71328 5.37487 7.36989C5.37007 7.01863 5.4884 6.71731 5.72867 6.47649L5.72972 6.47544L5.72973 6.47544L5.92286 6.28473L5.92313 6.28447C6.17716 6.03457 6.39154 5.82304 6.55203 5.60926C6.7099 5.39897 6.80634 5.19804 6.83236 4.9747C6.88496 4.5233 6.65829 3.89878 5.80408 2.83636M8.30793 11.691L5.80408 2.83636M1.7315 2.35728C1.62207 2.4726 1.51824 2.58202 1.41639 2.68387L1.7315 2.35728Z" stroke-width="0.4"/>
					</svg>
					<span>Позвонить дилеру</span>
				</a>
				<div class="aside__phone">{{ dealerTel }}</div>
			</div>
		</div>
	</section>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";

export default {
	name: "StartSummary",
	props: ['dealerTel', 'creditApprove', 'dealerCreditApprove'],
	data() {
		return {
			termsList: [24, 36],
			state: {
				noteOpened: false
			},
			firstPayment: {
				obj: null,
				min: 0,
				max: 50
			},
			lastPayment: {
				obj: null,
				min: 50,
				center: 55,
				max: 60
			},
			lastPaymentPercent: 0,
			firstPaymentPercent: 0,
			calculationResponse: null,
			packetsSummCost: 0,
			showNote: false
		};
	},
	computed: {
		...mapGetters({
			ENV: "GET_ENV",
			currentCar: 'GET_START_CURRENT_CAR',
			selectedPackets: 'GET_START_SELECTED_PACKETS',
			modification: 'GET_START_MODIFICATION',
			complectation: 'GET_START_COMPLECTATION',
			activeColorObj: 'GET_START_ACTIVE_COLOR_OBJ',
			milleage: 'GET_START_MILLEAGE',
			milleageValue: 'GET_START_MILLEAGE_VALUE'
		}),
		currentTerm: {
			get: function() {
				return this.$store.state.start.currentTerm;
			},
			set: function(value) {
				this.$store.dispatch('SET_START_CURRENT_TERM', value);
			}
		},
		selectedPrograms: {
			get: function() {
				return this.$store.state.start.selectedPrograms;
			},
			set: function(value) {
				this.$store.dispatch('SET_START_SELECTED_PROGRAMS', value);
			}
		},
		includeKASKO: {
			get: function() {
				return this.$store.state.start.includeKASKO;
			},
			set: function(value) {
				this.$store.dispatch('SET_START_INCLUDE_KASKO', value);

				if (value) {
					dataLayer.push({
						"event": "custom_event",
						"category": "Страница программы start",
						"action": "Ваш расчет",
						"label": "Включить КАСКО и ТО " + this.currentCar.codeName
					})
				}
			}
		},
		lastPaymentValue: function () { //Остаточный платёж в рублях
			return Math.round(this.totalCost * this.lastPaymentPercent)
		},
		firstPaymentValue: function () { //Первый платёж в рублях
			var fp = Math.round(this.totalCost * this.firstPaymentPercent);

			// if (typeof popups !== 'undefined') {
			// 	popups.$data.firstPay = fp;
			// }

			return fp;
		},
		totalCost: function () {
			//Стоимость выбранных пакетов
			var summPrice = 0;

			for (var i = 0; i < this.selectedPackets.length; i++ ) {
				summPrice += this.selectedPackets[i].price;
			}

			this.packetsSummCost = summPrice;

			var tc = this.complectation.price + this.activeColorObj.cost + summPrice;

			if (isNaN(tc)) {
				tc = 0;
			}

			// if (typeof popups !== 'undefined') {
			// 	popups.$data.totalCost = tc;
			// }

			console.log(this.complectation.price, this.activeColorObj.cost, summPrice);

			return tc;
		},
		totalMonthPay: function () {
			if (this.calculationResponse) {
				var result;

				if (this.includeKASKO && this.currentTerm === 36) {
					result = this.calculationResponse[this.currentTerm][Math.round(this.firstPaymentPercent * 100)].minSP;
				} else {
					result = this.calculationResponse[this.currentTerm][Math.round(this.firstPaymentPercent * 100)].min;
				}

				if (!isNaN(result) && typeof result !== 'undefined') {
					return result
				} else {
					return 0
				}
			} else {
				return 0
			}
		},
		addCost: function () {
			if (this.calculationResponse) {
				var programs = this.calculationResponse[this.currentTerm][Math.round(this.firstPaymentPercent * 100)].addCosts;
				var result;

				for (var program in programs) {
					if (programs[program] !== 0) {
						result = programs[program];
					}
				}

				if (typeof result !== 'undefined') {
					if (this.includeKASKO) {
						return result
					} else {
						return 0
					}
				} else {
					return 0
				}
			} else {
				return 0
			}
		},
		changeInputParameters: function () {
			return [this.complectation.id, this.activeColorObj.cost, this.packetsSummCost, this.lastPaymentPercent]
		},
		changeCreditPack: function () {
			return {
				pay: this.totalMonthPay,
				prepay: Math.round(this.firstPaymentPercent * 100),
				prepayRub: this.firstPaymentValue,
				sum: this.totalCost,
				addCost: this.addCost,
				lastPay: Math.round(this.lastPaymentPercent * 100)
			}
		}
	},
	methods: {
		setTerm: function (term) {
			this.currentTerm = term

			if (term === 24) {
				this.includeKASKO = false;

				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": "Ваш расчет",
					"label": "Нажатие кнопки 24 " + this.currentCar.codeName
				});	  
			}
			if (term == 36) {
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": "Ваш расчет",
					"label": "Нажатие кнопки 36 " + this.currentCar.codeName
				});
			}
		},
		getCalculation: function () {
			var that = this;

			//Запрос на расчёт
			if (typeof this.complectation.id === 'undefined' || typeof this.activeColorObj.cost === 'undefined' || typeof this.packetsSummCost === 'undefined' || typeof this.lastPaymentPercent === 'undefined') {
				return null;
			}

			console.log(this.complectation.id + '/' + this.activeColorObj.cost + '/' + this.packetsSummCost + '/' + Math.round(this.lastPaymentPercent * 100));

			axios.get(this.$store.state.API.START_CALC_COST + this.complectation.id + '/' + this.activeColorObj.cost + '/' + this.packetsSummCost + '/' + Math.round(this.lastPaymentPercent * 100))
				.then(function (response) {
					that.calculationResponse = response.data;

					console.log(response.data);
				})
				.catch(function (error) {
					console.log(error);
					this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
				})
		},
		prevSlide: function() {
			this.$emit('prev-slide');
		},
		showInfo: function(title, text) {
			this.$emit('show-info', title, text);
		},
		openTestDrive: function () {
			this.$store.dispatch('OPEN_TEST_DRIVE_POPUP', true);

			this.lastPositionLastPayment();
		},
		openSendForm: function () {
			this.$store.dispatch('OPEN_SEND_EMAIL_POPUP', true);

			this.lastPositionLastPayment();

			dataLayer.push({
				"event": "custom_event",
				"category" : "Страница программы start",
				"action": "Отправка заявки",
				"label" : "Отправка на почту " + this.currentCar.name
			});
		},
		openCreditForm: function () {
			// this.$store.dispatch('OPEN_SEND_APPROVAL_POPUP', true);

			if (this.ENV === 'dealer') {
				window.open('https://credit-approval.ecredit.one/?car=' + this.currentCar.name + '&fee=' + Math.round(this.firstPaymentPercent*100) + '&sum=' + this.totalCost + '&term=' + this.currentTerm + '&dealer=' + this.dealerCreditApprove, '_blank');
			} else {
				this.$emit('open-credit-form');

				this.lastPositionLastPayment();
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": "Ваш расчет",
					"label": "Клик по кнопке Предодобрение кредита " + this.currentCar.codeName + ', ' + this.modification.id
				});
			}
		},
		toggleNote: function () {
			if ($(window).outerWidth() < 1263) {
				this.showNote = !this.showNote;
			}
		},
		lastPositionLastPayment: function () {
			dataLayer.push({
				"event": "custom_event",
				"category": "Страница программы start",
				"action": "Ваш расчет",
				"label": "Остаточный платеж " + Math.round(this.lastPaymentPercent * 100) + ', ' + this.currentCar.codeName
			})
		}
	},
	mounted() {
		var that = this;

		this.debouncedGetCalculation = _.debounce(this.getCalculation, 500)

		this.$parent.$on('setPrograms', ()=>{
			if (that.selectedPrograms.indexOf(1) >= 0) {
				that.includeKASKO = true;
			}
			if (that.selectedPrograms.indexOf(0) >= 0) {
				that.firstPayment.obj.noUiSlider.set(0);
			} else {
				if (typeof that.complectation.defaultPV !== 'undefined') {
					that.firstPayment.obj.noUiSlider.set(that.complectation.defaultPV);
				}
			}
			if (that.selectedPrograms.indexOf(2) >= 0) {
				that.lastPayment.obj.noUiSlider.set(that.lastPayment.max);
			}
		})
		this.$parent.$on('clearPrograms', ()=>{
			that.selectedPrograms = [];
			that.includeKASKO = false;
			that.lastPayment.obj.noUiSlider.set(that.lastPayment.min);
			if (typeof that.complectation.defaultPV !== 'undefined') {
				that.firstPayment.obj.noUiSlider.set(that.complectation.defaultPV);
			}
		})

		this.$nextTick(()=>{
			//Slider firstPayment
			that.firstPayment.obj = document.querySelector('.range--first');

			noUiSlider.create(that.firstPayment.obj, {
				start: [that.firstPayment.min],
				connect: [true, false],
				range: {
					'min': that.firstPayment.min,
					'max': that.firstPayment.max
				},
				step: 1,
			})

			//Добавляем значение внутрь маркера
			$(that.firstPayment.obj).find('.noUi-handle').append('<div class="range__mark"></div>')

			that.firstPayment.obj.noUiSlider.on('update', function (values, handle, unencoded) {
				that.firstPaymentPercent = Math.round(unencoded[0])/100;
				//Обновим значение внутри маркера
				if (unencoded[0] === that.firstPayment.min || unencoded[0] === that.firstPayment.max) {
					$('.range__mark').hide();
				} else {
					$('.range__mark').html(Math.round(unencoded[0]) + '%').show();
				}

				//Ограничим размер первого взноса, исходя из начения остаточного платежа (первый взнос не может быть больше 100% - остаточный платёж)
				if (Math.round(that.firstPaymentPercent * 100) > Math.round((1 - that.lastPaymentPercent) * 100)) {
					that.firstPayment.obj.noUiSlider.set(Math.round(100 - that.lastPaymentPercent * 100));
				}
			});

			that.firstPayment.obj.noUiSlider.on('change', function () {
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": "Ваш расчет",
					"label": "Взаимодействие с ползунком Первый взнос " + that.currentCar.codeName
				})		
			})

			//SliderlastPayment
			that.lastPayment.obj = document.querySelector('.range--last');

			noUiSlider.create( that.lastPayment.obj, {
				start: [that.lastPayment.min],
				connect: [true, false],
				range: {
					'min': that.lastPayment.min,
					'max': that.lastPayment.max
				},
				step: 5,
			})

			//Добавляем значение внутрь маркера
			//$(that.lastPayment.obj).find('.noUi-handle').append('<div class="range__mark1"></div>')
			$('.range--fp .noUi-target').append('<div class="limit"></div>')

			that.lastPayment.obj.noUiSlider.on('update', function (values, handle, unencoded) {
				that.lastPaymentPercent = Math.round(unencoded[0])/100;

				if (Math.round(that.firstPaymentPercent * 100) > Math.round((1 - that.lastPaymentPercent) * 100)) {
					//Ограничим размер первого взноса, исходя из значения остаточного платежа (первый взнос не может быть больше 100% - остаточный платёж)
					that.firstPayment.obj.noUiSlider.set(Math.round(100 - that.lastPaymentPercent * 100));
				}

				//Эффект полоски
				var limit = 50 - Math.round((1 - that.lastPaymentPercent) * 100);

				that.firstPayment.obj.noUiSlider.updateOptions(
					{
						padding: [0, limit]
					},
					true
				);

				var lineWidth = $('.range--fp .noUi-target').outerWidth();

				$('.range--fp .noUi-target .limit').css('width', (lineWidth * limit / 50) + 'px')
			});
		})
	},
	watch: {
		changeInputParameters: function () {
			//Расчёт итогового значения
			this.debouncedGetCalculation();
		},
		changeCreditPack: function () {
			this.$store.dispatch('SET_START_CREDIT_PACK', this.changeCreditPack);
		}
	}
};
</script>

<style lang="sass">

</style>