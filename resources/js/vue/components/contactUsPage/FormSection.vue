<template>
	<div class="form-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="form-section__center">
						<h2 class="form-section__title">Задайте вопрос</h2>
						<div class="form-section__note">
							Обращаем Ваше внимание, что при возникновении спорных вопросов, связанных с&nbsp;покупкой и&nbsp;обслуживанием автомобиля Hyundai, Вам необходимо обращаться к&nbsp;сотрудникам в&nbsp;клиентскую службу официальных дилерских центров Hyundai.
						</div>
						<div class="form-section__top" :class="{ 'nof': appeal !== 'Физическое лицо' && appeal !== ''}">
							<h4 class="form-section__subtitle">Личные данные</h4>
							<div class="form-section__item form-section__item--50 form-section__item--o1">
								<div class="df-select-bordered" :class="{ 'invalid' : !validation.appeal }">
									<selectize v-model="appeal" :settings="settingsAppeal">
										<option value="Физическое лицо">Физическое лицо</option>
										<option value="Юридическое лицо">Юридическое лицо</option>
										<option value="Государственный орган">Государственный орган</option>
									</selectize>
								</div>
							</div>
							<transition name="fade">
								<div v-show="appeal !== 'Физическое лицо' && appeal !== ''" class="form-section__item form-section__item--50 form-section__item--o2">
									<input type="text" class="df-input-bordered" name="company" id="company" placeholder="Наименование юридического лица или гос. органа" v-model="user.company" :class="{ 'invalid' : !validation.company }" @blur="focusLost('company')">
								</div>
							</transition>
							<div class="form-section__item form-section__item--50 form-section__item--o3">
								<input type="text" class="df-input-bordered capitalize" name="surname" id="surname" placeholder="Фамилия" v-model="user.surname" :class="{ 'invalid' : !validation.surname }" @blur="focusLost('surname')">
							</div>
							<div class="form-section__item form-section__item--50" :class="{ 'form-section__item--o4': appeal !== 'Физическое лицо' && appeal !== '',  'form-section__item--o2': appeal === 'Физическое лицо' || appeal === '' }">
								<input type="text" class="df-input-bordered" name="city" id="city" placeholder="Город" v-model="user.city" :class="{ 'invalid' : !validation.city }" @blur="focusLost('city')">
							</div>
							<div class="form-section__item form-section__item--50 form-section__item--o5">
								<input type="text" class="df-input-bordered capitalize" name="name" id="name" placeholder="Имя" v-model="user.name" :class="{ 'invalid' : !validation.name }" @blur="focusLost('name')">
							</div>
							<div class="form-section__item form-section__item--50" :class="{ 'form-section__item--o6': appeal !== 'Физическое лицо' && appeal !== '',  'form-section__item--o4': appeal === 'Физическое лицо' || appeal === '' }">
								<input v-mask="'+7(999)-999-99-99'" type="text" class="df-input-bordered" name="tel" id="tel" placeholder="Телефон" v-model="user.tel" :class="{ 'invalid' : !validation.tel }" @blur="focusLost('tel')">
							</div>
							<div class="form-section__item form-section__item--50 form-section__item--o7">
								<input type="text" class="df-input-bordered capitalize" name="patronymic" id="patronymic" placeholder="Отчество" v-model="user.patronymic" :class="{ 'invalid' : !validation.patronymic }" @blur="focusLost('patronymic')">
							</div>
							<div class="form-section__item form-section__item--50" :class="{ 'form-section__item--o8': appeal !== 'Физическое лицо' && appeal !== '',  'form-section__item--o6': appeal === 'Физическое лицо' || appeal === '' }">
								<input type="text" class="df-input-bordered" name="email" id="email" placeholder="E-mail" v-model="user.email" :class="{ 'invalid' : !validation.email }" @blur="focusLost('email')">
							</div>
						</div>
						<div class="form-section__bottom">
							<h4 class="form-section__subtitle">Ваше сообщение</h4>
							<div class="form-section__item">
								<div class="df-select-bordered" :class="{ 'invalid' : !validation.theme }">
									<selectize v-model="theme" :settings="settingsTheme">
										<option value="Вакансии">Вакансии</option>
										<option value="Вопрос по запчастям">Вопрос по запчастям</option>
										<option value="Гарантийное обслуживание">Гарантийное обслуживание</option>
										<option value="Другое">Другое</option>
										<option value="Комплектации автомобиля">Комплектации автомобиля</option>
										<option value="Вопрос/отзыв о дилере (Продажа)">Вопрос/отзыв о дилере (Продажа)</option>
										<option value="Вопрос/отзыв о дилере (Сервис)">Вопрос/отзыв о дилере (Сервис)</option>
										<option value="Работа сайта">Работа сайта</option>
										<option value="Функционирование автомобиля">Функционирование автомобиля</option>
										<option value="Мир Хёндэ">Мир Хёндэ</option>
									</selectize>
								</div>
							</div>
							<div class="form-section__item" v-if="text.text || text.dsclmr">
								<div class="form-section__text" v-if="text.text">{{ text.text }}</div>
								<div class="form-section__dsclmr" v-if="text.dsclmr">{{ text.dsclmr }}</div>
							</div>
							<div class="form-section__item form-section__item--50" v-show="cityVisible">
								<div class="df-select-bordered" :class="{ 'invalid' : !validation.cityDealer }">
									<selectize v-model="cityDealer" :settings="settingsCity">
										<option :value="city.city_id" v-for="city in dealersCities">{{ city.city_name }}</option>
									</selectize>
								</div>
							</div>
							<div class="form-section__item form-section__item--50" v-show="modelVisible">
								<div class="df-select-bordered" :class="{ 'invalid' : !validation.model }">
									<selectize v-model="model" :settings="settingsModel">
										<option :value="model.code" v-for="model in data">{{ model.name }}</option>
									</selectize>
								</div>
							</div>
							<div class="form-section__item form-section__item--50" v-show="dealerVisible">
								<div class="df-select-bordered" :class="{ 'invalid' : !validation.dealer }">
									<selectize v-model="dealer" :settings="settingsDealer">
										<option :value="dealer.code" v-for="dealer in filteredDealers">{{ dealer.name }}</option>
									</selectize>
								</div>
							</div>
							<div class="form-section__item form-section__item--50" v-show="vinVisible">
								<input type="text" class="df-input-bordered" name="vin" id="vin" placeholder="VIN - номер" v-model="vin" :class="{ 'invalid' : !validation.vin }" @blur="focusLost('vin')">
							</div>
							<div class="form-section__item form-section__item--50" v-show="dateVisible">
								<input type="text" class="df-input-bordered" name="date" id="date" placeholder="Дата приобретения автомобиля" v-model="date" :class="{ 'invalid' : !validation.date }" @blur="focusLost('date')">
							</div>
							<div class="form-section__item form-section__item--50" v-show="dateRequestVisible">
								<input type="text" class="df-input-bordered" name="dateRequest" id="dateRequest" placeholder="Дата обращения к дилеру" v-model="dateRequest" :class="{ 'invalid' : !validation.dateRequest }" @blur="focusLost('dateRequest')">
							</div>
							<div class="form-section__item form-section__item--50" v-show="dealerSolveVisible">
								<div class="df-select-bordered" :class="{ 'invalid' : !validation.dealerSolve }">
									<selectize v-model="dealerSolve" :settings="settingsDealerSolve">
										<option :value="dealer.code" v-for="dealer in filteredDealers">{{ dealer.name }}</option>
									</selectize>
								</div>
							</div>
							<div class="form-section__item form-section__item--50" v-show="mileageVisible">
								<input type="text" class="df-input-bordered" name="mileage" id="mileage" placeholder="Текущий пробег" v-model="mileage" :class="{ 'invalid' : !validation.mileage }" @blur="focusLost('mileage')">
							</div>
							<div class="form-section__item">
								<textarea type="text" class="df-input-bordered form-section__message" name="message" id="message" placeholder="Сообщение" v-model="user.message" :class="{ 'invalid' : !validation.message }" @blur="focusLost('message')"></textarea>
							</div>
							<!-- <div class="form-section__item">
								<input type="text" class="df-input-bordered" name="wish" id="wish" placeholder="Ваши пожелания" v-model="wish">
							</div> -->
						</div>
						<div class="form-section__footer">
							<form-accept v-model="agreement" :is-valid="validation.agreement" @show-rules="openRules"></form-accept>
							<button @click.prevent="checkout" class="df-button form-section__button" :disabled="sending">{{ sending ? 'Отправка...' : 'Отправить'}}</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import Selectize from 'vue2-selectize'
import FormAccept from '@/components/common/FormAccept.vue'
import axios from 'axios'
import { setTimeout } from 'core-js';

import { mapGetters } from "vuex";

export default {
    name: 'FormSection',
    components: {
		Selectize, FormAccept
    },
    data () {
        return {
			appeal: 'Физическое лицо',
			settingsAppeal: {
				placeholder: 'Вы обращаетесь как',
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
			theme: 'Вакансии',
			settingsTheme: {
				placeholder: 'Тема',
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
			settingsCity: {
				placeholder: 'Город',
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
			settingsModel: {
				placeholder: 'Модель',
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
			settingsDealer: {
				placeholder: 'Дилер, продавший вам автомобиль',
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
			settingsDealerSolve: {
				placeholder: 'Дилер, к которому обратились для решения вопроса',
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
			themesTexts: [
				{
					theme: 'Вопрос по запчастям',
					text: 'По вопросам продажи запасных частей и расходных материалов для автомобилей Hyundai (в том числе по вопросам подбора и наличиях) Вы можете обратиться к любому официальному дилеру Hyundai.'
				},
				{
					theme: 'Гарантийное обслуживание',
					text: 'Гарантийное обслуживание автомобилей Hyundai производится в соответствии с действующими гарантийными условиями, представленными в Сервисной книжке/Условиях гарантии* вашего автомобиля. По всем вопросам, связанным с обслуживанием и эксплуатацией автомобиля, рекомендуем обращаться в Официальные Дилерские центры Hyundai. Обращаем ваше внимание, что решение о необходимости и способе ремонта, в том числе, о его статусе, принимает исключительно официальный дилерский центр Hyundai по результатам диагностики.',
					dsclmr: '* - «Условия гарантии» - документ, выдаваемый первому покупателю при приобретении автомобиля Hyundai и подлежащий подписанию со стороны первого Покупателя и официального дилера Hyundai(продавца автомобиля), который содержит гарантийную политику (гарантийные условия на автомобиль) завода-изготовителя на территории Российской Федерации, информацию о первом покупателе и проданном автомобиле, дате начала гарантии на автомобиль, подпись первого покупателя автомобиля, необходимые отметки о предпродажном обслуживании приобретенного автомобиля. Условия гарантии должны быть переданы каждым покупателем автомобиля каждому последующему владельцу автомобиля при его дальнейшей перепродаже.'
				},
				{
					theme: 'Другое',
					text: 'Обращаем ваше внимание, что данная форма предназначена только для получения запросов и отзывов Клиентов Hyundai. Все рекламные предложения автоматически удаляются.'
				},
				{
					theme: 'Комплектации автомобиля',
					text: 'В случае, если Вы уже заключили договор купли-продажи автомобиля с официальным дилерским центром Hyundai, пожалуйста, укажите номер и дату договора, наименование продавца (либо ФИО, если продавец – физическое лицо) с дилером, а также VIN-номер в тексте Вашего обращения'
				},
				{
					theme: 'Вопрос/отзыв о дилере (Продажа)',
					text: 'В дилерских центрах Hyundai для взаимодействия с Клиентами при возникновении спорных ситуаций создано специализированное подразделение "Клиентская служба". С целью скорейшего разрешения вашего вопроса рекомендуем обратиться в Клиентскую службу официального дилерского центра Hyundai.'
				},
				{
					theme: 'Вопрос/отзыв о дилере (Сервис)',
					text: 'В дилерских центрах Hyundai для взаимодействия с Клиентами при возникновении спорных ситуаций создано специализированное подразделение "Клиентская служба". С целью скорейшего разрешения вашего вопроса рекомендуем обратиться в Клиентскую службу официального дилерского центра Hyundai.'
				},
				{
					theme: 'Функционирование автомобиля',
					text: 'Претензионные обращения, содержащие требования, предусмотренные Законом РФ от 07.02.1992 № 2300-1 «О защите прав потребителей», Гражданским кодексом РФ, иными нормативными правовыми актами, принимаются к рассмотрению только в случае направления их посредством почтового отправления, либо посредством курьерской доставки. Данное обстоятельство связано с невозможностью достоверно установить личность заявителя, а также наличие у него права на заявление вышеуказанных требований при направлении таких требований посредством формы обратной связи сайта Hyundai'
				}
			],
			blur: {
				city: false,
				tel: false,
				name: false,
				surname: false,
				patronymic: false,
				email: false,
				message: false,
				company: false,
				vin: false,
				date: false,
				dateRequest: false,
				mileage: false
			},
			user: {
				name: '',
				surname: '',
				patronymic: '',
				tel: '',
				email: '',
				city: '',
				message: '',
				company: ''
			},
			cityDealer: '',
			model: '',
			dealer: '',
			vin: '',
			date: '',
			cityQuestion: '',
			dateRequest: '',
			dealerSolve: '',
			mileage: '',
			wish: '',
			agreement: true,
			process: false,
			ps: [],
			sending: false
		}
    },
    computed: {
		...mapGetters({
			dealersCities: 'GET_DEALERS_CITIES',
			dealers: 'GET_DEALERS',
			data: 'GET_DATA'
		}),
		validation () {
			const reEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			return {
				email: reEmail.test(this.user.email) || (!this.blur.email && !this.process),
				city: this.user.city.trim() !== '' || (!this.blur.city && !this.process),
				name: this.user.name.trim() !== '' || (!this.blur.name && !this.process),
				surname: this.user.surname.trim() !== '' || (!this.blur.surname && !this.process),
				patronymic: this.user.patronymic.trim() !== '' || (!this.blur.patronymic && !this.process),
				tel: this.user.tel.trim() !== '' || (!this.blur.tel && !this.process),
				message: this.user.message.trim() !== '' || (!this.blur.message && !this.process),
				company: (this.user.company.trim() !== '' || this.appeal === 'Физическое лицо') || (!this.blur.company && !this.process),
				cityDealer: (this.cityDealer.trim() !== '' || !this.cityVisible) || !this.process,
				model: (this.model.trim() !== '' || !this.modelVisible) || !this.process,
				dealer: (this.dealer.trim() !== '' || !this.dealerVisible) || !this.process,
				vin: (this.vin.trim() !== '' || !this.vinVisible) || (!this.blur.vin && !this.process),
				date: (this.date.trim() !== '' || !this.dateVisible) || (!this.blur.date && !this.process),
				dateRequest: (this.dateRequest.trim() !== '' || !this.dateRequestVisible) || (!this.blur.dateRequest && !this.process),
				dealerSolve: (this.dealerSolve.trim() !== '' || !this.dealerSolveVisible) ||  !this.process,
				mileage: (this.mileage.trim() !== '' || !this.mileageVisible) || (!this.blur.mileage && !this.process),
				theme: this.theme !== '' || !this.process,
				appeal: this.appeal !== '' || !this.process,
				agreement: this.agreement || !this.process
			}
		},
		isValid () {
			return Object.keys(this.validation).every((key)=>{
				return this.validation[key];
			})
		},
		filteredDealers: function () {
			var result = [];

			if (this.cityDealer !== '') {
				this.dealers.forEach((dealer) => {
					if (dealer.city_id === this.cityDealer) {
						result.push(dealer)
					}
				});
			} else {
				return this.dealers;
			}

			return result;
		},
		text: function () {
			var res = '';

			this.themesTexts.forEach((item)=>{
				if (item.theme === this.theme) {
					res = item;
				}
			})

			return res;
		},
		cityVisible: function () {
			return false
		},
		modelVisible: function () {
			return this.theme === 'Вопрос по запчастям' || this.theme === 'Гарантийное обслуживание' || this.theme === 'Комплектации автомобиля' || this.theme === 'Вопрос/отзыв о дилере (Сервис)' || this.theme === 'Функционирование автомобиля'
		},
		dealerVisible: function () {
			return false
		},
		vinVisible: function () {
			return this.theme === 'Вопрос по запчастям' || this.theme === 'Гарантийное обслуживание' || this.theme === 'Комплектации автомобиля' || this.theme === 'Вопрос/отзыв о дилере (Сервис)' || this.theme === 'Функционирование автомобиля'
		},
		dateVisible: function () {
			return this.theme === 'Вопрос по запчастям' || this.theme === 'Гарантийное обслуживание' || this.theme === 'Комплектации автомобиля' || this.theme === 'Вопрос/отзыв о дилере (Сервис)' || this.theme === 'Функционирование автомобиля'
		},
		dateRequestVisible: function () {
			return this.theme === 'Вопрос по запчастям' || this.theme === 'Гарантийное обслуживание' || this.theme === 'Комплектации автомобиля' || this.theme === 'Вопрос/отзыв о дилере (Сервис)' || this.theme === 'Функционирование автомобиля'
		},
		dealerSolveVisible: function () {
			return false
		},
		mileageVisible: function () {
			return this.theme === 'Вопрос по запчастям' || this.theme === 'Гарантийное обслуживание' || this.theme === 'Комплектации автомобиля' || this.theme === 'Вопрос/отзыв о дилере (Сервис)' || this.theme === 'Функционирование автомобиля'
		}
    },
    methods: {
		focusLost: function (name) {
			this.blur[name] = true;
		},
		checkout: function () {
			var that = this;

			this.process = true;

			if (this.isValid) {
				this.sending = true

				axios.get(this.$store.state.API.CONTACT_US_FORM, {
					params: {
						human: 'Y',
						theme: this.theme,
						salutation: 'Mr.',
						name: this.user.name,
						surname: this.user.surname,
						middleName: this.user.patronymic,
						city: this.user.city,
						cityDealer: this.cityDealer,
						dealer: this.dealer,
						phone: this.user.tel,
						email: this.user.email,
						msg: this.user.message,
						model: this.model,
						vin: this.vin,
						status: this.appeal,
						organizaton: this.user.company,
						//wish: this.wish,
						date_buy: this.date,
						date_request: this.dateRequest,
						dealer_solve: this.dealerSolve
					}
				})
					.then(function (response) {
						if (response.data.status === 1) {
							that.$store.dispatch('OPEN_SUCCESS', true);
							that.sending = false;

							dataLayer.push({
								"event": "custom_event",
								"category" : "Обратная связь",
								"action": "Отправка формы",
							});

						} else {
							throw new Error('Ошибка');
						}
					})
					.catch(function (error) {
						that.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки формы, повторите попытку позднее' })
						console.log(error);
						that.sending = false
					})
			} else {
				//Скролл к первому не валидному полю
				setTimeout(()=>{
					var st = $('.invalid').eq(0).offset().top - 200;

					if (st > 0) {
						$('html, body').animate({ scrollTop: st }, 500);
					}
				}, 300)
			}
		},
		psUpdate: function () {
			this.ps.forEach((item)=>{
				var item = item;

				setTimeout(()=>{
					item.update();
				})
			})
		},
		openRules: function () {
			this.$emit('show-rules');
		}
    },
    filters: {

    },
    mounted () {
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
		})
    },
    watch: {

    }
}
</script>

<style lang="sass">

</style>
