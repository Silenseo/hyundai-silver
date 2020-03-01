<template>
	<div>
		<div class="car-page">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<a href="#" @click.prevent="goBack" class="df-back-link">
							Назад
							<svg>
								<use xlink:href="#back-link"></use>
							</svg>
						</a>
						<div class="car-page__inner">
							<div class="car-page__mobile">
								<div class="car-page__line car-page__line--top-mobile">
									<div class="h3 car-page__name">
										{{ car.name | output }}
									</div>
									<div class="car-page__year">
										{{ car.year | output }}
									</div>
								</div>
								<div class="car-page__line car-page__line--price-mobile">
									<div class="car-page__old-price" v-if="car.oldPrice">{{ car.oldPrice | currencyFormat }} ₽</div>
									<div class="car-page__price">{{ car.minPrice | currencyFormat }} ₽</div>
									<div class="car-page__month-payment">{{ car.monthPayment | currencyFormat }} ₽/мес.</div>
								</div>
							</div>
							<div class="car-page__images">
								<car-page-slider :is-popup="false" :key="car.id" :images="car.images" @open-popup="openCarPopup = true"></car-page-slider>
							</div>
							<div class="car-page__specifications">
								<div class="car-page__line car-page__line--top">
									<div class="h3 car-page__name">
										{{ car.name | output }}
									</div>
									<div class="car-page__year">
										{{ car.year | output }}
									</div>
								</div>
								<div class="car-page__line car-page__line--price">
									<div class="car-page__old-price" v-if="car.oldPrice">{{ car.oldPrice | currencyFormat }} ₽</div>
									<div class="car-page__price">{{ car.minPrice | currencyFormat }} ₽</div>
									<div class="car-page__month-payment">{{ car.monthPayment | currencyFormat }} ₽/мес.</div>
								</div>
								<div class="car-specifications">
									<div class="car-specifications__line">
										<div class="car-specifications__description">
											Коробка передач
										</div>
										<div class="car-specifications__value">
											{{ car.gearBox | output }}
										</div>
									</div>
									<div class="car-specifications__line">
										<div class="car-specifications__description">
											Двигатель
										</div>
										<div class="car-specifications__value">
											{{ car.engine | output }}
										</div>
									</div>
									<div class="car-specifications__line">
										<div class="car-specifications__description">
											Тип привода
										</div>
										<div class="car-specifications__value">
											{{ car.transmission | output }}
										</div>
									</div>
									<div class="car-specifications__line">
										<div class="car-specifications__description">
											Цвет кузова
										</div>
										<div class="car-specifications__value">
											{{ car.exteriorColor | output }}
										</div>
									</div>
									<div class="car-specifications__line">
										<div class="car-specifications__description">
											Цвет салона
										</div>
										<div class="car-specifications__value">
											{{ car.interiorColor | output }}
										</div>
									</div>
									<div class="car-specifications__line">
										<div class="car-specifications__description">
											Тип салона
										</div>
										<div class="car-specifications__value">
											{{ car.interiorType | output }}
										</div>
									</div>
									<div class="car-specifications__line">
										<div class="car-specifications__description">
											Пробег
										</div>
										<div class="car-specifications__value">
											{{ car.milleage | output }}
										</div>
									</div>
									<div class="car-specifications__line">
										<div class="car-specifications__description">
											VIN
										</div>
										<div class="car-specifications__value">
											{{ car.vin | output }}
										</div>
									</div>
								</div>
								<div class="car-page__line car-page__line--buttons">
									<button class="df-button car-page__book">Забронировать</button>
									<button class="df-button car-page__calc">Рассчет кредита</button>
								</div>
								<div class="car-page__line car-page__line--footer">
									<a href="#" @click.prevent="openTestDrivePopup" class="df-iconed-link df-iconed-link--small">
										Тест драйв
										<svg>
											<use xlink:href="#arrow-link"></use>
										</svg>
									</a>
									<a href="#" class="df-iconed-link df-iconed-link--small">
										Трейд-ин
										<svg>
											<use xlink:href="#arrow-link"></use>
										</svg>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Горячие кнопки -->
		<hot-buttons-dealer :key="car.id" :from-hour="10" :to-hour="18" :type="1" :centers-list="[{ name: 'Первый' }, { name: 'Второй' }, { name: 'Третий' }]" url-call-back="/" url-ask-question="/"></hot-buttons-dealer>
		</div>
		<!-- Если у авто есть id для загрузки характеристик, отображаем характеристики -->
		<div class="container" v-if="car.configId && loadingFeaturesSuccess">
			<div class="row">
				<div class="col-md-12">
					<specs-section :key="car.id" @error="loadingFeaturesSuccess = false" page="isDealerCarPage" :carId="car.configId" :model-type="car.type" :numberOfSeats="car.seats" :engine="car.engine" :drive="car.transmission" :gearBox="car.gearBox"></specs-section>
				</div>
			</div>
		</div>
		<!-- Попап галереи -->
		<transition name="popup" v-on:enter="onEnter" v-on:leave="onLeave">
			<div class="car-popup df-popup" v-show="openCarPopup">
				<div class="car-popup__wrap df-popup__wrap" @click.self="closeThis">
					<div class="car-popup__center df-popup__center">
						<a href="#" @click.prevent="closeThis" class="car-popup df-popup__close">
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
								<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
							</svg>
						</a>
						<car-page-slider :key="car.id" :event="openCarPopup" :is-popup="true" :images="car.images"></car-page-slider>
					</div>
				</div>
			</div>
		</transition>

		<sign-up-test-drive-form-popup v-if="tdVisible"></sign-up-test-drive-form-popup>
	</div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
	name: 'CarPage',
	components: { 
		SpecsSection: () => import('@/components/CarPageTemplate/SpecsSection'),
		CarPageSlider: () => import('./CarPageSlider'),
		HotButtonsDealer: () => import('@/components/common/HotButtonsDealer.vue'),
		SignUpTestDriveFormPopup: () => import('@/components/common/SignUpTestDriveFormPopup.vue') 
	},
	data () {
		return {
			car: {},
			loadingFeaturesSuccess: true,
			openCarPopup: false,
			tdInit: false
		}
	},
	computed: {
		...mapGetters({
			openTdPopup: "OPEN_TEST_DRIVE_POPUP",
			id: "GET_DEALER_CARS_CAR_ID"
		}),
		tdVisible: function () {
			if (this.openTdPopup) {
				this.tdInit = true;
			}

			return this.tdInit;
		}
	},
	methods: {
    	closeThis: function () {
			this.openCarPopup = false
		},
		onEnter: function() {
			this.$root.$emit('fixOverflow', true)
		},
		onLeave: function() {
			this.$root.$emit('fixOverflow', false)
		},
		openTestDrivePopup: function () {
			this.$store.dispatch('OPEN_TEST_DRIVE_POPUP', true);
		},
		goBack: function() {
			this.$router.push({ name: 'home' })
		},
		setCarObj: function () {
			if (typeof carsList !== 'undefined') {
				carsList.forEach(car => {
					if (car.id === +this.id) {
						this.car = car
					}
				});
			}
		}
	},
	activated: function () {
		this.setCarObj();
	},
	filters: {
		output: function (value) {
			return typeof value !== 'undefined' ? value : ''
		}
	}
}
</script>

<style lang="sass">
@import '../../../../sass/pages/dealer/cars/carpage.sass'
</style>
