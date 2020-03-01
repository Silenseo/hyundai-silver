<template>
    <div>
		<!-- <banner-section></banner-section> -->
		<nav-section></nav-section>
		<calendar-section @show-rules="openRules = true"></calendar-section>
		<slider-section></slider-section>
		<event-popup></event-popup>
		<checkout-form @show-rules="openRules = true"></checkout-form>
		<rules :is-opened="openRules" @close="openRules = false"></rules>
		<simple-sent-successfully innerText="Вы успешно записались на мероприятие" :is-opened="openSuccess" @close-this="closeSuccess"></simple-sent-successfully>
		
		<!-- Для добавления функции выбора языка, раскомментируй код ниже -->
		<!-- <lang-select></lang-select> -->
		
		<notifier></notifier>
		<closed-popup :is-opened="isClosed" :text="closedText" @close="isClosed = false;"></closed-popup>
    </div>
</template>

<script>
import BannerSection from '@/components/motorstudio/BannerSection.vue'
import NavSection from '@/components/motorstudio/NavSection.vue'
import CalendarSection from '@/components/motorstudio/CalendarSection.vue'
import SliderSection from '@/components/motorstudio/SliderSection.vue'
import EventPopup from '@/components/motorstudio/EventPopup.vue'
import CheckoutForm from '@/components/motorstudio/CheckoutForm.vue'
import Rules from '@/components/common/Rules.vue'
import SimpleSentSuccessfully from '@/components/common/SimpleSentSuccessfully.vue'
import LangSelect from '@/components/motorstudio/LangSelect.vue'
import Notifier from '@/components/Notifier'
import ClosedPopup from '@/components/motorstudio/ClosedPopup.vue'
import urlParamsParse from '@/components/common/urlParamsParse.js'

import { mapGetters } from "vuex";

export default {
	name: 'MotorStudio',
	components: { Notifier, Rules, BannerSection, NavSection, CalendarSection, EventPopup, SliderSection, CheckoutForm, SimpleSentSuccessfully, LangSelect, ClosedPopup },
	data () {
		return {
			isClosed: false,
			closedText: '',
			popups: 0,
			openRules: false
		}
	},
	computed: {
		...mapGetters({
			openSuccess: "OPEN_SUCCESS"
		}),
	},
	methods: {
		closeSuccess: function () {
			this.$store.dispatch('OPEN_SUCCESS', false);
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
		}
	},
	filters: {

	},
	mounted () {
		this.$root.$on('fixOverflow', this.fixOverflow)
		
		//Проверим открыта ли студия
		if (typeof popupData !== 'undefined') {
			if (popupData.open === 1) {
				this.isClosed = true;
				this.closedText = popupData.text;
			}
		} else {
			console.error('Отсутствует переменная popupData');
		}


		this.$nextTick(()=>{
			//Если есть хэш с id события, отобразить карточку этого события или ещё что-то
			var eventId = urlParamsParse().event_id;

			if (eventId) {
				if (itemsJson.some(function(event){ return event.id == eventId })) {
					itemsJson.forEach((event)=>{
						if (event.id == eventId) {
							this.$store.dispatch('SET_SELECTED_EVENTS', event)
							this.$store.dispatch('OPEN_EVENT_POPUP', true)
						}
					})
				} else {
					console.log('event not found');
				}
			}

			if (window.location.hash != '') {
				var hash = window.location.hash.substr(1);

				if (hash == 'calendar') {
					$(window).on('load', function() {
						$('a.scroll[href="#calendar"]').trigger('click')
					})
				} else if (hash == 'test_event') {
					this.$store.commit('SET_SELECTED_EVENTS', testEvent)
					this.$store.dispatch('OPEN_EVENT_POPUP', true)
				} else {
					console.log('event not found');
				}
			}

			$('.bottom-wrap').append($('.footer'));
		})
	}
}
</script>

<style lang="scss">

</style>
