<template>
	<div class="calc-wrapper">
		<div class="steps__wrap" v-if="!isStepHelp && currentStep !== 3" :class="{ isDealer: ENV === 'dealer' && isSecondStep }">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="steps__top">
							<div class="steps__left" v-if="currentStep === 1">Калькулятор</div>
							<div class="steps__left" v-else>
								<a href="#" @click.prevent="prevSlide" class="df-back-link">
									Назад
									<svg>
										<use xlink:href="#back-link"></use>
									</svg>
								</a>
							</div>
							<div class="steps__right">Шаг {{ currentStep }} из 3</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<ul class="steps owl-carousel js-carousel1" @click="closeAll($event)">
			<li class="steps__item">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<start-showroom @set-car="setCar" @refresh-carousel="refreshCarousel" ref="showroom"></start-showroom>
						</div>
					</div>
				</div>
			</li>
			<li class="steps__item" :class="{ isDealer: ENV === 'dealer' }">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<start-config @next-slide="nextSlide" @show-compare="toShowCompare"></start-config>
						</div>
					</div>
				</div>
			</li>
			<li class="steps__item steps__item--anim steps__item--isHelp" v-if="stepHelp">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<start-help @refresh-carousel="refreshCarousel" @next-slide="nextSlide"></start-help>
						</div>
					</div>
				</div>
			</li>
			<li class="steps__item" :class="{ isDealer: ENV === 'dealer' }">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<start-summary @prev-slide="prevSlide" @show-info="showInfo" @open-credit-form="openCreditForm" :dealer-tel="dealerTel" :credit-approve="creditApprove" :dealer-credit-approve="dealerCreditApprove"></start-summary>
						</div>
					</div>
				</div>
			</li>
		</ul>
		<notifier></notifier>
		<transition name="popup">
			<div class="df-popup p-info" v-show="state.infoOpened">
				<div class="df-popup__wrap" @click.self="closeInfo">
					<div class="df-popup__center p-info__center">
						<a href="#" @click.prevent="closeInfo" class="df-popup__close">
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
								<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
							</svg>
						</a>
						<h3 class="p-info__title" v-html="infoTitle"></h3>
						<div class="p-info__text" v-html="infoText"></div>
					</div>
				</div>
			</div>
		</transition>
		<start-mobile-line :is-show="showMobileLine" @open-credit-form="openCreditForm" @line-height="setLineHeight" :dealer-tel="dealerTel" :credit-approve="creditApprove" :dealer-credit-approve="dealerCreditApprove"></start-mobile-line>
		<start-compare :show-compare="showCompare" @close-compare="toCloseCompare"></start-compare>
		<send-email-form @open-success="openSuccess" @show-rules="openRules = true" :send-url="sendEmailUrl" page="isStartPage"></send-email-form>
		<sign-up-test-drive-form-popup :no-default-car="true" v-if="isVisible" page="isStartPage"></sign-up-test-drive-form-popup>
		<credit-approval-form :modification="modification" :isOpened="isOpenedCreditForm" :currentCar="currentCar" :creditPack="creditPack" :term="term" @close="isOpenedCreditForm = false" page="isStartPage"></credit-approval-form>
		<rules :is-opened="openRules" @close="openRules = false"></rules>
		<simple-sent-successfully @close-this="closeSuccess" :is-opened="state.successOpened" inner-text="Форма успешно отправлена"></simple-sent-successfully>
	</div>
</template>

<script>
import axios from 'axios'
import Notifier from '@/components/Notifier'
import StartShowroom from '@/components/Start/StartShowroom'
import StartConfig from '@/components/Start/StartConfig'
import StartHelp from '@/components/Start/StartHelp'
import StartSummary from '@/components/Start/StartSummary'
import StartMobileLine from '@/components/Start/StartMobileLine'
import StartCompare from '@/components/Start/StartCompare'
import SendEmailForm from '@/components/common/SendEmailForm.vue'
import CreditApprovalForm from '@/components/common/CreditApprovalForm.vue'
import Rules from '@/components/common/Rules.vue'
import SimpleSentSuccessfully from '@/components/common/SimpleSentSuccessfully.vue'
import { mapGetters } from "vuex";
import { setTimeout } from 'timers';

export default {
	name: "StartCalc",
	components: { StartShowroom, StartConfig, StartHelp, StartSummary, StartMobileLine, StartCompare, SendEmailForm, SignUpTestDriveFormPopup: () => import('@/components/common/SignUpTestDriveFormPopup.vue'), CreditApprovalForm, Rules, SimpleSentSuccessfully, Notifier },
	props: {
		dealerTel: {
			type: String
		}
	},
	data() {
		return {
			initCarousel: false,
			carousel: null,
			currentStep: 1,
			isStepHelp: false,
			stepHelp: true, //Скрывает шаг с помощником после первого показа
			flag: '',
			state: {
				successOpened: false,
				infoOpened: false
			},
			showMobileLine: false,
			infoTitle: '',
			infoText: '',
			showCompare: false,
			isOpenedCreditForm: false,
			isInit: false,
			analytics: {},
			popups: 0,
			isSecondStep: false,
			openRules: false,
			lineHeight: 0,
			creditApprove: false,
			dealerCreditApprove: ''
		};
	},
	computed: {
		...mapGetters({
			ENV: "GET_ENV",
			currentCar: 'GET_START_CURRENT_CAR',
			creditPack: 'GET_START_CREDIT_PACK',
			term: 'GET_START_CURRENT_TERM',
			modification: 'GET_START_MODIFICATION',
			apiCheckCredit: 'GET_CHECK_CREDIT_API',
			carsIdLinks: 'GET_CARS_ID_LINKS'
		}),
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
			}
		},
		compareSelected: {
			get: function() {
				return this.$store.state.start.compareSelected;
			},
			set: function(value) {
				this.$store.dispatch('SET_START_COMPARE_SELECTED', value);
			}
		},
		sendEmailUrl: function() {
			return this.$store.state.API.START_CONTACT_FORM
		},
		isVisible: function () {
			if (this.$store.state.openTestDrivePopup) {
				this.isInit = true;
			}

			return this.isInit;
		},
	},
	methods: {
		masterInit: function() {
			var that = this;

			//Карусель
			this.carousel = $(".js-carousel1").owlCarousel({
				items: 1,
				smartSpeed: 700,
				nav: false,
				dots: false,
				autoHeight: true,
				pullDrag: false,
				mouseDrag: false,
				touchDrag: false,
				onTranslated: function(event) {
					if (that.flag === 'help' && that.stepHelp) {
						that.stepHelp = false;
						that.carousel.trigger('remove.owl.carousel', 2).trigger('refresh.owl.carousel').trigger('to.owl.carousel', [2,0]);

						console.log(that.selectedPrograms)
						that.$emit('setPrograms');
					}

					if (that.flag === 'prevNext' && !that.stepHelp) {
						//Очистим список выбранных программ
						that.$emit('clearPrograms');
					}

					that.carousel.trigger('refresh.owl.carousel')
				}
			});

			setTimeout(function() {
				that.carousel.trigger('refresh.owl.carousel');
			}, 1000)

			//Расчёт высоты аккордеона на шаге с помощью, чтобы при раскрытии/закрытии табов, подстаивалась высота карусели
			$('.help__dd').each(function(){
				$(this).data('height', $(this).outerHeight()).css('display','none')
			})

			//Фиксация шапки в попап сравнения модификаций
			var controller = new ScrollMagic.Controller({container: ".compare"});

			var scene = new ScrollMagic.Scene({triggerElement: ".compare__top", duration: 0, triggerHook: 0})
					.setPin(".compare__top")
					//.addIndicators({name: "1 (duration:0)"}) // add indicators (requires plugin)
					.addTo(controller);

			//Переход к нужной тачке
			var id = 0,
				isExist = false;

			if (typeof carCode !== 'undefined') {
				this.carsIdLinks.forEach(car => {
					if (car.link === carCode) {
						id = car.id
					}
				});
			}

			//Проверяем есть ли тачка с таким id
			for (let key in that.$refs.showroom.$refs) {
				if (key == id) {
					$(window).on('load', function() {
						$(that.$refs.showroom.$refs[key]).trigger('click');
					})

					isExist = true;
				}
			}

			if (!isExist) {
				console.log('wrong car id!');
			}
		},
		setCar: function(car) {
			$('.cars').addClass('loading');
			this.$emit('reset360');
			this.currentStep++;
			this.$store.dispatch('SET_START_CURRENT_CAR', car)
				.then(()=>{
					setTimeout(()=>{
						$('.cars').removeClass('loading');
						this.carousel.trigger('next.owl.carousel');
						this.carousel.trigger('refresh.owl.carousel');
						this.scrollTopChangeStep();
						this.showMobileLine = true;
						this.isSecondStep = true;
					}, 500)
				})
				.catch((err) => {
					$('.cars').removeClass('loading');
					this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
					console.log(err)
				})
		},
		prevSlide: function () {
			this.carousel.trigger('prev.owl.carousel');
			this.currentStep--;
			this.scrollTopChangeStep();
			if (this.currentStep === 1) {
				this.showMobileLine = false;
				this.isSecondStep = false;
			}
		},
		nextSlide: function (flag, a) {
			this.scrollTopChangeStep();
			var that = this;

			this.flag = flag;

			if (flag === 'prevNext' && that.stepHelp) {
				this.carousel.trigger('to.owl.carousel', [2,0]);
				this.carousel.trigger('refresh.owl.carousel');
				this.isStepHelp = true;
				this.showMobileLine = false;
			} else {
				this.currentStep++;
				this.carousel.trigger('next.owl.carousel');
				this.carousel.trigger('refresh.owl.carousel');
				this.showMobileLine = true;
			}

			if (flag === 'help' && that.stepHelp) {
				that.isStepHelp = false;
			}

			if (a === 'aPass') {
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": " Помощь с настройками " + this.currentCar.codeName,
					"label": "Нажатие кнопки Пропустить " + this.currentCar.codeName
				});
			}
			if (a === 'aNext') {
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": " Помощь с настройками",
					"label": "Нажатие кнопки Продолжить " + this.currentCar.codeName
				});
			}
		},
		scrollTopChangeStep: function () {
			setTimeout(function () {
				var offsetTop = $('#calc').offset().top;

				if ($(window).outerWidth() < 1263) {
					offsetTop = offsetTop - $('.header-main').outerHeight();
				}

				$('html, body').animate({ scrollTop: offsetTop }, 500);
			}, 100)
		},
		closeAll: function (e) {
			this.$emit('closeAll', e);
		},
		refreshCarousel: function() {
			this.$nextTick(()=>{
				this.carousel.trigger('refresh.owl.carousel');
			})
		},
		showInfo: function(title, text) {
			this.state.infoOpened = true;

			this.infoTitle = title;
			this.infoText = text;

			if (title === 'Каско и ТО' && !this.analytics.event4) {
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": "Ваш расчет",
					"label": "Пояснение Включить КАСКО и ТО " + this.currentCar.codeName
				});

				this.analytics.event4 = true;
			}
			if (title === 'Остаточный платеж' && !this.analytics.event5) {
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": "Ваш расчет " + this.currentCar.codeName,
					"label": "Пояснение Остаточный платеж"
				});

				this.analytics.event5 = true;
			}
		},
		closeInfo: function() {
			this.state.infoOpened = false;
		},
		toShowCompare: function(section) {
			this.showCompare = true;
			this.compareSelected = section;
			

			//Чтобы сразу скроллилось
			setTimeout(function() {
				$('body').css('overflow', 'hidden');
				$('.compare').focus()
			}, 1000)

			//Аналитика
			if (section === 'complectation') {
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": "Выбор комплектации",
					"label": "Нажатие кнопки Сравнить " + this.currentCar.codeName
				});
			}
		},
		toCloseCompare: function() {
			this.showCompare = false;
			$('body').css('overflow', 'auto');
		},
		openSuccess: function() {
			this.state.successOpened = true;
		},
		closeSuccess: function() {
			this.state.successOpened = false;
		},
		openCreditForm: function() {
			this.isOpenedCreditForm = true;
		},
		fixOverflow (makeFixed) {
			if (makeFixed === true) {
				document.body.style.overflow = 'hidden'
				this.popups++
			} else {
				this.popups--

				if (this.popups === 0) {
					document.body.style.overflow = ''
				}
			}
		},
		setLineHeight: function (value) {
			this.lineHeight = value || 0
		}
	},
	mounted() {
		//Получим список тачек
		this.$store.dispatch('GET_START_MODELS_LIST')
			.then(()=>{
				this.$nextTick(function () {
					setTimeout(()=>{
						this.masterInit();
					}, 150)
      			})
			})
			.catch((err) => {
				this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
				console.log(err)
			})

		this.$root.$on('fixOverflow', this.fixOverflow)

		//Проверяем показывать ли кнопку предодобрение кредита
		if (this.ENV === 'dealer') {
			axios.get(this.apiCheckCredit)
				.then(response=>{
					if (!response.data) {
						this.creditApprove = false
					} else if (response.data) {
						this.creditApprove = true
						this.dealerCreditApprove = response.data
					} else {
						throw new Error()
					}
				})
				.catch(error=>{
					this.creditApprove = false
					console.error(error)
				})
		}
	},
	watch: {
		showMobileLine: function () {
			//Для варианта расположения калькулятора на главной странице дилерской сборки, команжа горячим кнопкам подвинуться вверх, чтобы они не перекрывались плашкой
			if (this.showMobileLine) {
				this.$store.dispatch('OPEN_START_MOBILE_LINE', this.lineHeight);
			} else {
				this.$store.dispatch('OPEN_START_MOBILE_LINE', 0);
			}
		}
	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'
@import '../../../../sass/common/components/_placeholder.sass'
@import '../../../../sass/pages/start/_steps.sass'
@import '../../../../sass/pages/start/_filters.sass'
@import '../../../../sass/pages/start/_cars.sass'
@import '../../../../sass/pages/start/_view.sass'
@import '../../../../sass/pages/start/_config.sass'
@import '../../../../sass/pages/start/_calc.sass'
@import '../../../../sass/pages/start/_help.sass'
@import '../../../../sass/pages/start/_widget.sass'
@import '../../../../sass/pages/start/_compare.sass'

@import '../../../../sass/pages/start/_media.sass'
</style>