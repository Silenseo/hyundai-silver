<template>
	<div>
		<div class="h-buttons" :class="{ fixed: fixed }">
			<ul class="h-buttons__list">
				<li class="h-buttons__item">
					<div class="h-buttons__link">
						<a class="h-buttons__button" href="#" @click.prevent="openQuestionForm = true" :class="{ isOpen: openQuestion }">
							<span>Задать вопрос</span>
						</a>
						<div class="h-buttons__icon" @click="openQuestion = !openQuestion">
							<svg width="13" height="22" viewBox="0 0 13 22" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M7.05141 15.1965V14.8468C7.05141 13.5116 7.41902 12.9711 8.72237 11.8902L10.2931 10.6821C11.6298 9.63295 13 8.13873 13 5.69075C13 2.38439 10.2596 0 6.55013 0C2.74036 0 0.66838 2.25722 0 4.67341L2.50643 5.62717C2.90746 3.84682 4.24422 2.7341 6.41645 2.7341C8.45501 2.7341 9.92545 4.00578 9.92545 5.84971C9.92545 6.96243 9.32391 7.8526 8.18766 8.77457L6.61697 9.98266C4.87918 11.3815 4.17738 12.4306 4.17738 14.0838C4.17738 14.4017 4.27763 14.8786 4.37789 15.1965H7.05141ZM3.74293 22H7.71979V18.2168H3.74293V22Z" fill="white"/>
							</svg>
						</div>
					</div>
				</li>
				<li class="h-buttons__item">
					<div class="h-buttons__link">
						<a class="h-buttons__button" href="#" @click.prevent="openCallBackForm = true" :class="{ isOpen: openCall }">
							<span>Обратный звонок</span>
						</a>
						<div class="h-buttons__icon" @click="openCall = !openCall">
							<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M17.342 13.3849L17.3715 13.4194L17.4041 13.4511L20.7589 16.7211C21.0363 16.9915 21.1184 17.5217 20.7713 18.0292L20.6945 18.1415L20.6505 18.2702C20.6396 18.3019 20.5917 18.3945 20.4638 18.5469C20.3434 18.6903 20.2038 18.8274 20.06 18.9677L20.0429 18.9843L20.0267 19.0017C18.8277 20.2872 17.1405 21 15.3064 21C13.4723 21 11.785 20.2872 10.5861 19.0017L10.573 18.9876L10.5593 18.9741L3.01098 11.4804L3.011 11.4803L3.00444 11.4739C0.331855 8.86892 0.331855 4.61115 3.00444 2.00614C3.43087 1.59049 3.64457 1.386 3.96958 1.1748C4.38815 0.902815 4.85096 0.947422 5.23643 1.31869L8.58319 4.71674L8.59035 4.72402L8.59766 4.73114C8.85581 4.98276 8.94364 5.58321 8.56042 6.06022L7.47938 7.11392L7.36226 7.22808L7.28761 7.3736C7.00084 7.93263 7.00084 8.54492 7.28761 9.10395L7.36226 9.24948L7.47938 9.36363L12.7097 14.4617C12.9955 14.8573 13.4442 15.0294 13.8386 15.0294C14.2331 15.0294 14.6818 14.8573 14.9676 14.4617L16.0044 13.4511L16.0369 13.4194L16.0664 13.3849C16.3662 13.0342 17.0422 13.0342 17.342 13.3849Z" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
							</svg>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<!-- Попапы -->
		<ask-question-form-popup v-if="questionFormVisible" :is-opened="openQuestionForm" :url="urlAskQuestion" @close-this="openQuestionForm = false" @open-rules="openRules = true" @open-success="openSuccess = true"></ask-question-form-popup>
		<call-back-form-popup v-if="callBackFormVisible" :is-opened="openCallBackForm" :from-hour="fromHour" :to-hour="toHour" :type="type" :centersList="centersList" :url="urlCallBack" @close-this="openCallBackForm = false" @open-rules="openRules = true" @open-success="openSuccess = true"></call-back-form-popup>
		<rules v-if="rulesVisible" :is-opened="openRules" @close="openRules = false"></rules>
		<simple-sent-successfully :is-opened="openSuccess" v-on:close-this="openSuccess = false"></simple-sent-successfully>
		<notifier></notifier>
	</div>
</template>

// Входные параметры:
// 	*from-hour: Number (Час начала работы для звонка клиенту)
// 	*to-hour: Number (Час окончания работы + 55 минут для звонка клиенту)
// 	*type: Number (Тип окна обратного звонка: 0 - без выбора дилерского центра, 1 - с выбором)
// 	centers-list: Array (Список дилерских центров)
// 	*url-call-back: String (URL для отправки формы обратного звонка)
// 	*url-ask-question: String (URL для отправки формы задать вопрос)

// 	* - обязательные параметры 

<script>
import { mapGetters } from "vuex";
import Notifier from '@/components/Notifier'
import SimpleSentSuccessfully from '@/components/common/SimpleSentSuccessfully'

export default {
	name: "HotButtonsDealer",
	components: {
		AskQuestionFormPopup: () => import('@/components/common/AskQuestionFormPopup'),
		CallBackFormPopup: () => import('@/components/common/CallBackFormPopup'),
		Rules: () => import('@/components/common/Rules.vue'),
		Notifier,
		SimpleSentSuccessfully
	},
	props: {
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
			required: false
		},
		urlCallBack: {
			type: String,
			required: true
		},
		urlAskQuestion: {
			type: String,
			required: true
		}
	},
	data() {
		return {
			init: false,
			fixed: false,
			openQuestion: true,
			openCall: true,
			openQuestionForm: false,
			openCallBackForm: false,
			openRules: false,
			openSuccess: false,
			state: {
				questionFormInit: false,
				callBackFormInit: false,
				rulesInit: false
			},
			popups: 0
		}
	},
	computed: {
		...mapGetters({
			openCalcMobileLine: "OPEN_START_MOBILE_LINE",
		}),
		scrollBarWidth: function() {
			var div = document.createElement('div');

			div.style.overflowY = 'scroll';
			div.style.width = '20px';
			div.style.height = '20px';

			div.style.visibility = 'hidden';

			document.body.appendChild(div);
			var scrollWidth = div.offsetWidth - div.clientWidth;
			document.body.removeChild(div);

			return scrollWidth
		},
		questionFormVisible: function () {
			if (this.openQuestionForm) {
				this.state.questionFormInit = true;
			}

			return this.state.questionFormInit;
		},
		callBackFormVisible: function () {
			if (this.openCallBackForm) {
				this.state.callBackFormInit = true;
			}

			return this.state.callBackFormInit;
		},
		rulesVisible: function () {
			if (this.openRules) {
				this.state.rulesInit = true;
			}

			return this.state.rulesInit;
		}
	},
	methods: {
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
		hotButtonsFix: function () {
			if (!this.fixed && $('.h-buttons').length > 0) {
				//Рассчитать положение кнопки
				let y = $('.h-buttons').offset().top;
				let x = $('.h-buttons').offset().left;
				let width = $('.h-buttons').width();
				let windowHeight = $(window).outerHeight();
				let windowWidth = $(window).outerWidth();

				$('.h-buttons').css({
					'right': (windowWidth - x - width - this.scrollBarWidth) + 'px',
					'bottom': (windowHeight - y - width) + 'px'
				});

				setTimeout(()=>{
					$('.h-buttons').css({
						'right': '40px',
						'bottom': '40px',
						'transition': '0.5s'
					});
				})

				this.openQuestion = false;
				this.openCall = false;
			}

			this.fixed = true
		}
	},
	mounted() {
		this.$root.$on('fixOverflow', this.fixOverflow);

		this.$nextTick(()=>{
			$(window).on('scroll', this.hotButtonsFix.bind(this))
		})
	},
	beforeDestroy () {
		$(window).off('scroll', this.hotButtonsFix.bind(this))
	},
	watch: {
		openCalcMobileLine: function () {
			if (this.openCalcMobileLine > 0) {
				$('.h-buttons').css({
					'bottom': (this.openCalcMobileLine + 10) + 'px',
				});
			} else {
				$('.h-buttons').css({
					'bottom': '40px',
				});
			}
		}
	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'

.h-buttons
	position: absolute
	display: block
	color: $text_white
	text-align: right
	z-index: 50
	font-size: 0
	&.fixed
		position: fixed
	&__list
		position: absolute
		right: 0
		bottom: 0px
		text-align: right
		font-size: 1.6rem
		line-height: 1.25
		border-radius: 24px
		overflow: hidden
		pointer-events: none
	&__item
		pointer-events: none
		&:not(:last-of-type)
			margin-bottom: 8px
	&__link
		display: inline-block
		position: relative
		overflow: hidden
		border-radius: 24px
		transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275)
		pointer-events: none
	&__icon
		display: block
		position: absolute
		top: 0
		right: 0
		width: 48px
		height: 48px
		border-radius: 24px
		background-color: $second_blue
		transition: 0.3s
		z-index: 1
		cursor: pointer
		pointer-events: auto
		svg
			display: block
			position: absolute
			top: 0
			left: 0
			right: 0
			bottom: 0
			margin: auto
	&__button
		display: block
		line-height: 48px
		border-radius: 24px
		padding-left: 16px
		padding-right: 60px
		background-color: rgba($second_blue, 0.6)
		transform: translateX(100%)
		transition: 0.3s
		pointer-events: auto
		span
			white-space: nowrap
		&.isOpen
			transform: translateX(0)

@media only screen and (max-width : $md-max)
	.h-buttons
		&.fixed
			right: 16px!important

</style>