<template>
	<transition name="popup" v-on:enter="onEnter" v-on:leave="onLeave">
		<div class="p-new df-popup" v-show="isOpened">
			<div class="p-new__wrap df-popup__wrap" @mousedown.self="closeThis">
				<div class="p-new__center df-popup__center">
					<a href="#" @click.prevent="closeThis" class="p-new__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<h3 class="p-new__title">{{ popupTitle }}</h3>
					<div class="p-new__body">
						<input type="text" class="df-input-bordered p-new__input p-new__input--100" name="title" id="title" :placeholder="eventTitle" v-model="data.title" :class="{ 'invalid' : !validation.title }" @blur="focusLost('title')">
						<input type="text" class="df-input-bordered p-new__input p-new__input--100" name="description" id="description" :placeholder="eventDescription" v-model="data.description" :class="{ 'invalid' : !validation.description }" @blur="focusLost('description')">
						<input type="text" v-mask="{ regex: '[0-3]{1}[0-9]{1}\\.[0-1]{1}[0-9]{1}\\.[0-2]{1}[0-9]{1}[0-9]{1}[0-9]{1}' }" class="df-input-bordered p-new__input" name="date" id="date" :placeholder="eventDate" v-model="data.date" :class="{ 'invalid' : !validation.date }" @blur="focusLost('date')">
						<input type="text" class="df-input-bordered p-new__input" name="time" id="time" :placeholder="eventTime" v-model="data.time" :class="{ 'invalid' : !validation.time }" @blur="focusLost('time')">
						<input type="number" class="df-input-bordered p-new__input" name="members" id="members" :placeholder="eventParticipants" v-model="data.members" :class="{ 'invalid' : !validation.members }" @blur="focusLost('members')">
						<input type="text" class="df-input-bordered p-new__input" name="guests" id="guests" :placeholder="eventAvatar" v-model="data.guests" :class="{ 'invalid' : !validation.guests }" @blur="focusLost('guests')">
						<div class="file-upload">
							<label v-show="!fileExist">
								<input id="file" ref="getFile" @change="getFile($event)" class="file-upload__input" type="file" name="file">
								<div class="file-upload__button df-button">
									<span>{{ eventTiming }}</span>
								</div>
							</label>
							<div v-show="fileExist" class="file-upload__remove df-button" @click="removeFile">
								<span>{{'Удалить файл ' + fileName }}</span>
							</div>
						</div>
						<label class="p-new__catering">
							<input type="checkbox" v-model="data.catering" name="catering" id="catering">
							<div class="p-new__box">
								<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 5.2L5 8L9 1" stroke="#002C5F" stroke-width="2"/>
								</svg>
							</div>
							<div class="p-new__description">{{ catering }}</div>
						</label>
						<input type="text" class="df-input-bordered p-new__input p-new__input--100" name="fio" id="fio" :placeholder="orgName" v-model="data.fio" :class="{ 'invalid' : !validation.fio }" @blur="focusLost('fio')">
						<input type="email" class="df-input-bordered p-new__input" name="email" id="email" :placeholder="orgEmail" v-model="data.email" :class="{ 'invalid' : !validation.email }" @blur="focusLost('email')">
						<input type="tel"  v-mask="'+7(999)-999-99-99'" class="df-input-bordered p-new__input" name="tel" id="tel" :placeholder="orgPhone" v-model="data.tel" :class="{ 'invalid' : !validation.tel }" @blur="focusLost('tel')">
						<input type="text" class="df-input-bordered p-new__input p-new__input--100" name="about" id="about" :placeholder="orgCompany" v-model="data.about" :class="{ 'invalid' : !validation.about }" @blur="focusLost('about')">
						<label class="p-new__accept">
							<input type="checkbox" v-model="data.accept" :class="{ 'invalid' : !validation.accept }" name="accept" id="accept">
							<div class="p-new__box">
								<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 5.2L5 8L9 1" stroke="#002C5F" stroke-width="2"/>
								</svg>
							</div>
							<div class="p-new__description">{{ checkData }} <a href="#" @click.prevent="openRules" v-if="currentLang === 'ru'">Смотреть правила</a></div>
						</label>
						<label class="p-new__accept">
							<input type="checkbox" v-model="data.accept1" :class="{ 'invalid' : !validation.accept1 }" name="accept1" id="accept1">
							<div class="p-new__box">
								<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 5.2L5 8L9 1" stroke="#002C5F" stroke-width="2"/>
								</svg>
							</div>
							<div class="p-new__description">{{ checkRules }} <a href="/assets/pdf/motorstudio/ms_rules.pdf" target="_blank" v-if="currentLang === 'ru'">Смотреть правила</a></div>
						</label>
					</div>
					<div class="p-new__footer">
						<button class="df-button" @click="checkout" :disabled="sending">{{ sending ? sendingText : sendText }}</button>
					</div>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
import axios from 'axios'
import Inputmask from "inputmask";

export default {
	name: 'NewEventPopup',
	props: {
		isOpened: {
			type: Boolean,
			required: true
		},
	},
    directives: {
		mask: {
			bind: function(el, binding) {
				Inputmask(binding.value).mask(el);
			}
		}
	},
    data () {
        return {
			data: {
				title: '',
				description: '',
				date: '',
				time: '',
				members: '',
				guests: '',
				catering: false,
				fio: '',
				email: '',
				tel: '',
				about: '',
				accept: false,
				accept1: false
			},
			blur: {
				title: false,
				description: false,
				date: false,
				time: false,
				members: false,
				guests: false,
				fio: false,
				email: false,
				tel: false,
				about: false
			},
			fileExist: false,
			fileName: '',
			process: false,
			sending: false
        }
    },
    computed: {
		validation () {
			const reEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			return {
				email: reEmail.test(this.data.email) || (!this.blur.email && !this.process),
				title: this.data.title.trim() !== '' || (!this.blur.title && !this.process),
				description: this.data.description.trim() !== '' || (!this.blur.description && !this.process),
				date: this.data.date.trim() !== '' || (!this.blur.date && !this.process),
				time: this.data.time.trim() !== '' || (!this.blur.time && !this.process),
				members: this.data.members.trim() !== '' || (!this.blur.members && !this.process),
				guests: this.data.guests.trim() !== '' || (!this.blur.guests && !this.process),
				fio: this.data.fio.trim() !== '' || (!this.blur.fio && !this.process),
				tel: this.data.tel.trim() !== '' || (!this.blur.tel && !this.process),
				about: this.data.about.trim() !== '' || (!this.blur.about && !this.process),
				accept: this.data.accept || !this.process,
				accept1: this.data.accept1 || !this.process
			}
		},
		isValid () {
			return Object.keys(this.validation).every((key)=>{
				return this.validation[key];
			})
		},
		currentLang: function() {
			return lang.name
		},
		popupTitle: function () {
			if (lang.name === 'ru') {
				return 'Оставить заявку на мероприятие';
			}
			if (lang.name === 'en') {
				return 'Submit a request';
			}
		},
		eventTitle: function () {
			if (lang.name === 'ru') {
				return 'Название мероприятия';
			}
			if (lang.name === 'en') {
				return 'Event title';
			}
		},
		eventDescription: function () {
			if (lang.name === 'ru') {
				return 'Описание мероприятия';
			}
			if (lang.name === 'en') {
				return 'Event description';
			}
		},
		eventDate: function () {
			if (lang.name === 'ru') {
				return 'Дата проведения';
			}
			if (lang.name === 'en') {
				return 'Date of activity';
			}
		},
		eventTime: function () {
			if (lang.name === 'ru') {
				return 'Время проведения';
			}
			if (lang.name === 'en') {
				return 'Time of activity';
			}
		},
		eventParticipants: function () {
			if (lang.name === 'ru') {
				return 'Кол-во участников';
			}
			if (lang.name === 'en') {
				return 'Number of participants';
			}
		},
		eventAvatar: function () {
			if (lang.name === 'ru') {
				return 'Портрет гостя (например топ-менеджеры)';
			}
			if (lang.name === 'en') {
				return "Portrait of your guests (e.g. top managers)";
			}
		},
		eventTiming: function () {
			if (lang.name === 'ru') {
				return 'Загрузите файл с таймингом мероприятия (.docx, .xlsx)';
			}
			if (lang.name === 'en') {
				return "Upload event timing (.docx, .xlsx)";
			}
		},
		catering: function () {
			if (lang.name === 'ru') {
				return 'Нужен кейтеринг';
			}
			if (lang.name === 'en') {
				return "Catering required";
			}
		},
		orgName: function () {
			if (lang.name === 'ru') {
				return 'ФИО организатора';
			}
			if (lang.name === 'en') {
				return "Organizer’s name and last name";
			}
		},
		orgEmail: function () {
			if (lang.name === 'ru') {
				return 'Email организатора';
			}
			if (lang.name === 'en') {
				return "Organizer's email";
			}
		},
		orgPhone: function () {
			if (lang.name === 'ru') {
				return 'Телефон организатора';
			}
			if (lang.name === 'en') {
				return "Organizer's phone number";
			}
		},
		orgCompany: function () {
			if (lang.name === 'ru') {
				return 'Расскажите о вашей компании';
			}
			if (lang.name === 'en') {
				return "Tell us about your company";
			}
		},
		checkData: function () {
			if (lang.name === 'ru') {
				return 'Я согласен на обработку данных';
			}
			if (lang.name === 'en') {
				return "I agree with personal data policy";
			}
		},
		checkRules: function () {
			if (lang.name === 'ru') {
				return 'Я ознакомлен с правилами студии ';
			}
			if (lang.name === 'en') {
				return "I agree with the Studio rules";
			}
		},
		sendText: function () {
			if (lang.name === 'ru') {
				return 'Отправить';
			}
			if (lang.name === 'en') {
				return "Send";
			}
		},
		sendingText: function () {
			if (lang.name === 'ru') {
				return 'Отправка...';
			}
			if (lang.name === 'en') {
				return "Sending...";
			}
		},

    },
    methods: {
		closeThis: function () {
			this.$emit('close');
		},
		focusLost: function (name) {
			this.blur[name] = true;
		},
		openRules: function () {
			this.$emit('show-rules')
		},
		checkout: function () {
			var that = this;

			this.process = true;

			if (!this.fileExist) {
				this.$root.$emit('notify', { type: 'error', text: 'Ошибка, приложите файл с таймингом мероприятия' })

				return null;
			}
			if (this.isValid) {
				this.sending = true;

				var data = new FormData();

				var file = document.querySelector('#file');

				data.append('title', this.data.title);
				data.append('description', this.data.description);
				data.append('date', this.data.date);
				data.append('time', this.data.time);
				data.append('members', this.data.members);
				data.append('guests', this.data.guests);
				data.append('catering', this.data.catering);
				data.append('fio', this.data.fio);
				data.append('email', this.data.email);
				data.append('tel', this.data.tel);
				data.append('about', this.data.about);

				if (this.fileExist) {
					data.append('file', file.files[0]);
				}

				axios.post(this.$store.state.API.NEW_EVENT_MOTORSTUDION_FORM, data, {
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				})
					.then(function (response) {
						if (response.data.status === 1) {
							that.$emit('open-success');
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
		getFile: function() {
			var filename = this.$refs['getFile'].files[0].name;

			if (filename) {
				this.fileExist = true;
				this.fileName = filename;
			}
		},
		removeFile: function() {
			$(this.$refs['getFile']).val('');
			this.fileExist = false;
		},
		onEnter: function() {
			this.$root.$emit('fixOverflow', true)
		},
		onLeave: function() {
			this.$root.$emit('fixOverflow', false)
		}
    },
    filters: {

	},
    mounted () {
		var that = this;

		this.$nextTick(()=>{

		})
    },
    watch: {

    }
}
</script>
