<template>
	<div class="form-section">
		<div class="form-section__top">
			<h4 class="form-section__title">Контактные данные</h4>
			<div class="form-section__group">
				<div class="form-section__item form-section__item--md50">
					<label for="name" class="df-label">Имя</label>
					<input type="text" class="df-input form-section__input capitalize non_numeric" name="name" id="name" placeholder="Введите имя" v-model="user.name" :class="{ 'invalid' : !validation.name }" @blur="focusLost('name')">
				</div>
				<div class="form-section__item form-section__item--md50">
					<label for="surname" class="df-label">Фамилия</label>
					<input type="text" class="df-input form-section__input capitalize non_numeric" name="surname" id="surname" placeholder="Введите фамилию" v-model="user.surname" :class="{ 'invalid' : !validation.surname }" @blur="focusLost('surname')">
				</div>
				<div class="form-section__item form-section__item--md50">
					<label for="patronymic" class="df-label">Отчество</label>
					<input type="text" class="df-input form-section__input capitalize non_numeric" name="patronymic" id="patronymic" placeholder="Введите отчество" v-model="user.patronymic" :class="{ 'invalid' : !validation.patronymic }" @blur="focusLost('patronymic')">
				</div>
			</div>
			<div class="form-section__group">
				<div class="form-section__item form-section__item--50">
					<label for="email" class="df-label">Email</label>
					<input type="email" class="df-input form-section__input" name="email" id="email" placeholder="Введите email" v-model="user.email" :class="{ 'invalid' : !validation.email }" @blur="focusLost('email')">
				</div>
				<div class="form-section__item form-section__item--50">
					<label for="tel" class="df-label">Телефон</label>
					<input type="tel" v-mask="'+7(999)-999-99-99'" class="df-input form-section__input" name="tel" id="tel" placeholder="Введите телефон" v-model="user.phone" :class="{ 'invalid' : !validation.phone }" @blur="focusLost('phone')">
				</div>
			</div>
		</div>
		<div class="form-section__bottom">
			<h4 class="form-section__title">Образование</h4>
			<div class="form-section__group">
				<div class="form-section__item">
					<label for="otherinstitute" class="df-label">Вуз</label>
					<div class="df-select" :class="{ 'invalid' : !validation.institute }">
						<selectize v-model="user.institute" :settings="settingsInstitute">
							<option :value="institute" v-for="institute in institutes">{{ institute }}</option>
						</selectize>
					</div>
				</div>
				<div class="form-section__item" v-if="user.institute === 'Другой.'">
					<label for="otherinstitute" class="df-label">Укажите название ВУЗа</label>
					<input type="text" class="df-input form-section__input" name="otherinstitute" id="otherinstitute" placeholder="Введите название вуза" v-model="user.otherinstitute" :class="{ 'invalid' : !validation.otherinstitute }" @blur="focusLost('otherinstitute')">
				</div>
				<div class="form-section__item">
					<label for="specialty" class="df-label">Специальность</label>
					<input type="text" class="df-input form-section__input" name="specialty" id="specialty" placeholder="Введите специальность" v-model="user.specialty" :class="{ 'invalid' : !validation.specialty }" @blur="focusLost('specialty')">
				</div>
				<div class="form-section__item">
					<label for="level" class="df-label">Уровень образования</label>
					<div class="df-select" :class="{ 'invalid' : !validation.level }">
						<selectize v-model="user.level" :settings="settingsLevel">
							<option :value="level" v-for="level in levels">{{ level }}</option>
						</selectize>
					</div>
				</div>
				<div class="form-section__item">
					<label for="stage" class="df-label">Курс</label>
					<input type="text" class="df-input form-section__input" name="stage" id="stage" placeholder="Укажите курс" v-model="user.stage" :class="{ 'invalid' : !validation.stage }" @blur="focusLost('stage')">
				</div>
				<div class="form-section__item">
					<label for="lang" class="df-label">Укажите уровень владения английским языком</label>
					<div class="df-select" :class="{ 'invalid' : !validation.lang }">
						<selectize v-model="user.lang" :settings="settingsLang">
							<option :value="lang" v-for="lang in languages">{{ lang }}</option>
						</selectize>
					</div>
				</div>
				<div class="form-section__item">
					<div class="file-upload" :class="{ fileexist: fileExist, error: fileError }">
						<label>
							<input id="file" class="file-upload__input" type="file" name="file" ref="file" @change="getFile">
							<div class="file-upload__button">
								<svg width="10" height="20" viewBox="0 0 10 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M9 15V17C9 18.1046 8.10457 19 7 19H3C1.89543 19 1 18.1046 1 17V3C1 1.89543 1.89543 1 3 1H7C8.10457 1 9 1.89543 9 3V12H5V5.5" stroke-width="2"/>
								</svg>
								<span>{{ fileExist ? fileName : 'Прикрепить резюме' }}</span>
							</div>
						</label>
					</div>
				</div>
			</div>
			
		</div>
		<div class="form-section__footer">
			<label class="form-section__rules">
				<input type="checkbox" name="accept" v-model="agreement" :class="{ 'invalid' : !validation.agreement }">
				<div class="form-section__square"></div>
				<div class="form-section__rules-text">
					Отправляя анкету, вы даете согласие ООО «Хендэ Мотор СНГ» на <a href="#" @click.prevent="openRules" class="form-section__link">обработку персональных данных</a> в соответствии с Федеральным законом от 27 июля 2006 года №152-ФЗ «О персональных данных»
				</div>
			</label>
			<button @click.prevent="checkout" class="df-button form-section__button" :disabled="sending">{{ sending ? 'Отправка...' : 'Отправить'}}</button>
		</div>
	</div>
</template>

<script>
import Selectize from 'vue2-selectize'
import FormAccept from '@/components/common/FormAccept.vue'
import axios from 'axios'
import { setTimeout } from 'core-js';
import Inputmask from "inputmask";

export default {
    name: 'FormSection',
    components: {
		Selectize, FormAccept
    },
    data () {
        return {
			appeal: '',
			settingsInstitute: {
				placeholder: 'Выберите название вуза',
				onDropdownOpen: this.psUpdate
			},
			institutes: [
				'Всероссийская академия внешней торговли (ВАВТ)',
				'Высшая школа экономики (НИУ ВШЭ)',
				'Государственный университет управления (ГУУ)',
				'Московский авиационный институт (Государственный университет МАИ)',
				'Московский автомобильно-дорожный государственный технический университет (МАДИ)',
				'Московский государственный институт международных отношений (МГИМО)',
				'Московский государственный институт радиотехники, электроники и автоматики (технический университет МИРЭА)',
				'Московский государственный технический университет им. Н.Э. Баумана (МГТУ)',
				'Московский государственный университет (МГУ им. Ломоносова)',
				'Московский государственный университет экономики, статистики и информатики (МЭСИ)',
				'Московский педагогический государственный университет (МПГУ)',
				'Московский политехнический университет (бывш. МАМИ)',
				'Московский технический университет связи и информатики (МТУСИ)',
				'Московский Энергетический Институт (Технический университет МЭИ)',
				'Российская академия народного хозяйства и государственной службы при Президенте Российской Федерации (РАНХиГС)',
				'Российская экономическая академия им. Г.В. Плеханова (РЭА им. Г.В. Плеханова)',
				'Российский государственный гуманитарный университет (РГГУ)',
				'Российский государственный социальный университет (РГСУ)',
				'Российский университет дружбы народов (РУДН)',
				'Финансовый университет при Правительстве РФ',
				'Другой.'
			],
			settingsLevel: {
				placeholder: 'Выберите ваш текущий уровень образования'
			},
			levels: [
				'Бакалавриат',
				'Магистратура',
				'Специалитет'
			],
			settingsLang: {
				placeholder: 'Выберите уровень английского',
				onDropdownOpen: this.psUpdate
			},
			languages: [
				'Не владею',
				'Elementary',
				'Intermediate',
				'Upper-intermediate',
				'Advanced'
			],
			blur: {
				phone: false,
				name: false,
				surname: false,
				patronymic: false,
				email: false,
				institute: false,
				otherinstitute: false,
				specialty: false,
				stage: false
			},
			user: {
				name: '',
				surname: '',
				patronymic: '',
				phone: '',
				email: '',
				institute: '',
				otherinstitute: '',
				specialty: '',
				level: '',
				stage: '',
				lang: ''
			},
			defaultUser: {
				name: '',
				surname: '',
				patronymic: '',
				phone: '',
				email: '',
				institute: '',
				otherinstitute: '',
				specialty: '',
				level: '',
				stage: '',
				lang: ''
			},
			agreement: false,
			process: false,
			ps: [],
			sending: false,
			fileExist: false,
			fileName: '',
			fileError: false
        }
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
				surname: this.user.surname.trim() !== '' || (!this.blur.surname && !this.process),
				patronymic: this.user.patronymic.trim() !== '' || (!this.blur.patronymic && !this.process),
				institute: this.user.institute.trim() !== '' || !this.process,
				otherinstitute: (this.user.otherinstitute.trim() !== '' || this.user.institute !== 'Другой.') || (!this.blur.otherinstitute && !this.process),
				specialty: this.user.specialty.trim() !== '' || (!this.blur.specialty && !this.process),
				level: this.user.level.trim() !== '' || !this.process,
				stage: this.user.stage.trim() !== '' || (!this.blur.stage && !this.process),
				lang: this.user.lang.trim() !== '' || !this.process,
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
		focusLost: function (name) {
			this.blur[name] = true;
		},
		checkout: function () {
			var that = this;

			this.process = true;

			var data = new FormData();

			var file = document.querySelector('#file');

			data.append('name', this.user.name);
			data.append('surname', this.user.surname);
			data.append('patronymic', this.user.patronymic);
			data.append('email', this.user.email);
			data.append('tel', this.user.phone);
			data.append('institute', this.user.institute);
			data.append('otherinstitute', this.user.otherinstitute);
			data.append('specialty', this.user.specialty);
			data.append('level', this.user.level);
			data.append('stage', this.user.stage);
			data.append('lang', this.user.lang);
			data.append('file', file.files[0]);

			if (this.isValid) {
				this.sending = true

				axios.post(this.$store.state.API.VACANCY_FORM, data, {
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				})
					.then(function (response) {
						if (response.data.status === 1) {
							that.$store.dispatch('OPEN_SUCCESS', true);
							that.sending = false
							that.clearForm();
							that.process = false;
						} else if (response.data.status === 2) {
							that.$root.$emit('notify', { type: 'error', text: 'Вы уже отправляли заявку на стажировку' })
							that.sending = false
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
					if ($('.invalid:not([type="checkbox"])').length > 0) $('html, body').animate({ scrollTop: $('.invalid:not([type="checkbox"])').eq(0).offset().top - $('.header-main').height() }, 500);
				}, 300)
			}
		},
		openRules: function () {
			this.$emit('show-rules');
		},
		psUpdate: function () {
			this.ps.forEach((item)=>{
				var item = item;

				setTimeout(()=>{
					item.update();
				})
			})
		},
		getFile: function () {
			this.fileName = this.$refs['file'].files[0].name;

			if (this.fileName) {
				this.fileExist = true;
				this.fileError = false;
			} else {
				this.fileName = 'не удалось прикрепить файл';
				this.fileError = true;
				this.fileExist = false;
			}
		},
		clearForm () {
			this.user = Object.assign({}, this.defaultUser)
			this.fileName = ''
			this.fileExist = false
			document.querySelector('#file').value = ''
			
			Object.keys(this.blur).forEach((key)=>{this.blur[key] = false})
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
