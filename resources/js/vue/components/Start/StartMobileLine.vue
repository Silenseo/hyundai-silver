<template>
	<div class="widget" :class="{ show: isShow, active: isOpened }">
		<div class="widget__overlay" @click.self="isOpened = false"></div>
		<div class="widget__holder">
			<div class="widget__main" :class="{ noButton: !creditApprove && ENV === 'dealer' }">
				<div class="widget__top" ref="top">
					<div class="widget__img">
						<img :src="activeColorObj.carImage" alt="">
					</div>
					<div class="widget__info">
						<div class="widget__car-name">{{ currentCar.name }}</div>
						<div class="widget__month-pay">{{ creditPack.pay | currencyFormat }} ₽/мес<sup>*</sup></div>
					</div>
					<a href="#" class="widget__toggle" @click.prevent="toggleWidget"></a>
				</div>
				<div class="widget__body">
					<div class="widget__line">
						<div class="widget__label">Общая стоимость</div>
						<div class="widget__value">{{ creditPack.sum | currencyFormat }} ₽</div>
					</div>
					<div class="widget__line">
						<div class="widget__label">Первый взнос</div>
						<div class="widget__value">{{ creditPack.prepayRub | currencyFormat }} ₽</div>
					</div>
					<div class="widget__line">
						<div class="widget__label">КАСКО и ТО</div>
						<div class="widget__value">{{ creditPack.addCost | currencyFormat }} ₽</div>
					</div>
					<div class="widget__line">
						<div class="widget__label">{{ milleage }}</div>
						<div class="widget__value">{{ milleageValue }}</div>
					</div>
				</div>
				<div class="widget__footer">
					<div class="widget__line widget__line--total">
						<div class="widget__label">Итого</div>
						<div class="widget__value widget__value--large">{{ creditPack.pay | currencyFormat }} ₽/мес<sup>*</sup></div>
					</div>
					<a v-if="creditApprove || ENV !== 'dealer'" href="#" class="widget__button" @click.prevent = "openCreditForm">Предодобрение кредита</a>
					<div class="widget__line widget__line--bottom">
						<div class="widget__line-l">
							<a href="#" class="widget__mail" @click.prevent = "openSendForm">
								<img src="/images/start/icons/mail.png" alt="">

								<span>Отправить на почту</span>
							</a>
							<a href="#" @click.prevent = "openTestDrive" class="widget__dealers">
								<span>Тест-драйв</span>
								<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 1L4.89793 5.33104C5.24021 5.71134 5.24021 6.28866 4.89793 6.66896L1 11" stroke-width="2" stroke="#fff"/>
								</svg>
							</a>
						</div>
						<div class="widget__line-r" v-if="ENV === 'dealer' && dealerTel">
							<a :href="'tel:' + dealerTel" class="widget__call">
								<img src="/images/start/icons/phone.png" alt="">

								<span>Позвонить дилеру</span>
							</a>
							<div class="widget__phone">
								{{ dealerTel }}
							</div>
						</div>
					</div>
				</div>
			</div>
			<a v-if="creditApprove || ENV !== 'dealer'" href="#" class="widget__button widget__button--statick" @click.prevent = "openCreditForm" ref="button">Предодобрение кредита</a>
		</div>
	</div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
	name: "StartMobileLine",
	props: ['isShow', 'dealerTel', 'creditApprove', 'dealerCreditApprove'],
	data() {
		return {
			isOpened: false
		};
	},
	computed: {
		...mapGetters({
			ENV: "GET_ENV",
			currentCar: 'GET_START_CURRENT_CAR',
			modification: 'GET_START_MODIFICATION',
			activeColorObj: 'GET_START_ACTIVE_COLOR_OBJ',
			creditPack: 'GET_START_CREDIT_PACK',
			currentTerm: 'GET_START_CURRENT_TERM',
			milleage: 'GET_START_MILLEAGE',
			milleageValue: 'GET_START_MILLEAGE_VALUE'
		})
	},
	methods: {
		toggleWidget: function() {
			this.isOpened = !this.isOpened
		},
		openTestDrive: function () {
			this.$store.dispatch('OPEN_TEST_DRIVE_POPUP', true);

			this.lastPositionLastPayment();
		},
		openSendForm: function () {
			this.$store.dispatch('OPEN_SEND_EMAIL_POPUP', true);

			dataLayer.push({
				"event": "custom_event",
				"category" : "Страница программы start",
				"action": "Отправка заявки",
				"label" : "Отправка на почту " + this.currentCar.name
			});

			this.lastPositionLastPayment();
		},
		openCreditForm: function () {
			// this.$store.dispatch('OPEN_SEND_APPROVAL_POPUP', true);
			
			if (this.ENV === 'dealer') {
				window.open('https://credit-approval.ecredit.one/?car=' + this.currentCar.name + '&fee=' + this.creditPack.prepay + '&sum=' + this.creditPack.sum + '&term=' + this.currentTerm + '&dealer=' + this.dealerCreditApprove, '_blank');
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
		lastPositionLastPayment: function () {
			dataLayer.push({
				"event": "custom_event",
				"category": "Страница программы start",
				"action": "Ваш расчет",
				"label": "Остаточный платеж " + this.creditPack.lastPay + ', ' + this.currentCar.codeName
			})
		}
	},
	mounted() {
		this.$nextTick(()=>{
			setTimeout(()=>{
				var buttonHeight = 0;

				if (this.$refs['button']) {
					buttonHeight = $(this.$refs['button']).outerHeight()
				}

				var lineHeight = $(this.$refs['top']).outerHeight() + buttonHeight;

				this.$emit('line-height', lineHeight)
			}, 1000)
		})
	},
	watch: {}
};
</script>

<style lang="sass">

</style>