<template>
	<section id="calendar" class="calendar-section">
		<h2 class="calendar-section__title">{{ calendarTitle }}</h2>
		<calendar-section-nav  @set-date="setDate" @change-view="changeView" @prev-slide="prevSlide" @next-slide="nextSlide"></calendar-section-nav>
		<transition name="calendar-anim">
			<calendar-section-calendar v-if="currentView === 'calendar'" :current-month="currentMonth" :current-year="currentYear"></calendar-section-calendar>
			<calendar-section-list :current-month="currentMonth" :current-year="currentYear" :slide="slideChange" v-if="currentView === 'list'"></calendar-section-list>
		</transition>
		<div class="new-event" v-if="currentLang === 'ru'">
			<div class="new-event__inner">
				<div class="new-event__text">
					Хотите организовать свое мероприятие в&nbsp;пространстве Hyundai Motorstudio?
				</div>
				<button class="df-button new-event__button" @click="openPopup">Оставить заявку</button>
			</div>
		</div>
		<div class="new-event" v-if="currentLang === 'en'">
			<div class="new-event__inner">
				<div class="new-event__text">
					Do you want to organize your event in Hyundai Motorstudio?
				</div>
				<button class="df-button new-event__button" @click="openPopup">Submit a request</button>
			</div>
		</div>
		<new-event-popup v-if="isInit" :is-opened="isOpened" @close="isOpened = false" @open-success="successOpened = true" @show-rules="showRules"></new-event-popup>
		<simple-sent-successfully innerText="Ваша заявка принята" :is-opened="successOpened" @close-this="successOpened = false"></simple-sent-successfully>
		<h2 class="slider__title">{{ sliderTitle }}</h2>
	</section>
</template>

<script>
import CalendarSectionNav from '@/components/motorstudio/CalendarSectionNav.vue'
import CalendarSectionCalendar from '@/components/motorstudio/CalendarSectionCalendar.vue'
import CalendarSectionList from '@/components/motorstudio/CalendarSectionList.vue'
import SimpleSentSuccessfully from '@/components/common/SimpleSentSuccessfully.vue'

export default {
    name: 'CalendarSection',
    components: {
		CalendarSectionNav,
		CalendarSectionCalendar,
		CalendarSectionList,
		SimpleSentSuccessfully,
		NewEventPopup:  () => import('@/components/motorstudio/NewEventPopup.vue'),
    },
    data () {
        return {
			currentMonth: 0,
			currentYear: '',
			currentView: 'list',
			slideChange: '',
			isInit: false,
			isOpened: false,
			successOpened: false
        }
    },
    computed: {
		calendarTitle: function () {
			if (lang.name === 'ru') {
				return 'Календарь мероприятий';
			}
			if (lang.name === 'en') {
				return 'Events calendar';
			}
		},
		sliderTitle: function () {
			if (lang.name === 'ru') {
				return 'Пространство';
			}
			if (lang.name === 'en') {
				return 'Area';
			}
		},
		currentLang: function() {
			return lang.name
		}
    },
    methods: {
		setDate: function (date) {
			this.currentMonth = date.getMonth();
			this.currentYear = date.getFullYear();
		},
		changeView: function (value) {
			this.currentView = value
		},
		prevSlide: function () {
			this.slideChange = 'prev'
		},
		nextSlide: function () {
			this.slideChange = 'next'
		},
		openPopup: function () {
			if (!this.isInit) {
				this.isInit = true;
			}

			this.isOpened = true;
		},
		showRules: function () {
			this.$emit('show-rules')
		}
    },
    mounted () {
        this.$root.$on('open-new-event', this.openPopup)
    }
}
</script>

<style lang="sass">

</style>
