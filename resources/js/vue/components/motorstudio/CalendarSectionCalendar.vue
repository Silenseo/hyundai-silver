<template>
	<section class="calendar">
		<div class="calendar__center">
			<ul class="calendar__head">
				<li class="df-lead-text-22px" v-for="(name, index) in daysName" :key="index">{{ name }}</li>
			</ul>
			<div class="calendar__body" v-if="getWidth">
				<li class="day" :class="{
					today: day.isNow,
					past: day.isPast,
					weekEnd: day.isWeekEnd,
					nextMonth: day.isStartMonthDays
				}" 
				@click.prevent="openPopup(day.eventsList)"
				v-for="(day, index) in daysList" :key="index">
					<div class="day__number df-lead-text-22px">{{ day.dayNumder }}</div>
					<div class="day__holder">
						<a href="#" class="day__event" 
							:class="{
								long: event.isLong,
								short: event.isShort,
								altLong: event.altLong,
								start: event.start,
								monday: day.dayOfWeek === 1,
								pastFuture: pastFuture(day, event)
							}"
							:style="{
								width: event.isLong ? eventEndOnThisWeek(day, event) : ''
							}"
							@click.stop.prevent="openPopup(event)"
						v-for="(event, index) in day.eventsList" :key="index"><span>{{ event.calendar_name }}</span></a>
					</div>
				</li>
			</div>
		</div>
	</section>
</template>

<script>
import { Day } from './day.js'

export default {
    name: 'CalendarSectionCalendar',
    components: {
	},
	props: ['currentMonth', 'currentYear'],
    data () {
        return {
			day: 1,
			prevMonthDay: 0,
			nextMonthDay: 1,
			getWidth: false,
			dayWidth: '',
			daysNameRu: ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
			daysNameEn: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su']
        }
    },
    computed: {
		daysName: function () {
			if (lang.name === 'ru') {
				return this.daysNameRu;
			}
			if (lang.name === 'en') {
				return this.daysNameEn;
			}
		},
		daysList: function () {
			//Отрисовка сетки календаря согласно текущему месяцу
			let calendar = [];

			this.day = 1;
			this.prevMonthDay = 0;
			this.nextMonthDay = 1;

			if (this.dayWidth) {};

			//Вычисляем количество строк в календаре, в каждом месяце может быть разное, т.к. первый день месяца - это разый день недели
            let strCount = Math.ceil((this.daysInMonth + this.dayOfWeek) / 7);

			for (var i = 0; i < strCount * 7; i++) {

				 //Создаём новый день
				let day = new Day();
				
				if (i >= this.dayOfWeek && this.day <= this.daysInMonth) {
										
					day.init(this.day, this.month, this.year);

					calendar.push(day);

                    this.day++;
                } else if (i < this.dayOfWeek) {
					day.init(this.daysInPrevMonth - this.dayOfWeek + 1 + this.prevMonthDay, this.month - 1, this.year)

                    calendar.push(day);

                    this.prevMonthDay++;
                } else {
					day.init(this.nextMonthDay, this.month + 1, this.year, this.currentMonth, this.currentYear);

                    calendar.push(day);

                    this.nextMonthDay++;
				}

				//Работа с событиями
				day.setEvents(itemsJson);
			}
			
			return calendar
		},
		month: function () {
			return this.currentMonth ? this.currentMonth : 0
		},
		year: function () {
			let year;
			let now = new Date();

			if (this.currentYear === '') {
                year = now.getFullYear();
            } else {
                year = this.currentYear;
			}
			
			return  year;
		},
		daysInMonth: function () {
			var currentDate,
                newDate,
                delta;

            currentDate = new Date(this.year, this.month, 1);
            newDate = new Date(this.year, this.month + 1, 1);
            delta = newDate - currentDate;

            return Math.floor(delta / (3600 * 24 * 1000));
		},
		daysInPrevMonth: function () {
			var currentDate,
                newDate,
                delta;

            currentDate = new Date(this.year, this.month - 1, 1);
            newDate = new Date(this.year, this.month, 1);
            delta = newDate - currentDate;

            return Math.floor(delta / (3600 * 24 * 1000));
		},
		dayOfWeek: function () {
			var currentDate;

            currentDate = new Date(this.year, this.month, 1);

            return (currentDate.getDay() - 1) >= 0 ? (currentDate.getDay() - 1) : 6;
		}
    },
    methods: {
		eventEndOnThisWeek: function (day, event) {
			//Закончится ли событие на этой неделе?
			var today7 = new Date(+day.currentDate), //чтобы не обновлять объект с датой
				today = new Date(+day.currentDate),
				day = day.dayOfWeek,
				dayEnd = event.endDay;

			today7.setDate(today.getDate() + 6);

			if (event.to - today7 >= 0 || dayEnd < day) {
				return (this.dayWidth * (7 - day + 1)) + 'px';
			} else {
				return (this.dayWidth * (dayEnd - day + 1)) + 'px';
			}
		},
		pastFuture: function (day, event) {
			//Начало события в прошлом, конец в будущем
			var fromDate = new Date(event.from),
				toDate = new Date(event.to),
				nowDate = new Date(),
				nowDay = nowDate.getDay(),
				fromDay = fromDate.getDay();

			if (nowDay == 0) {
				nowDay = 7;
			}
			if (fromDay == 0) {
				fromDay = 7;
			}

			nowDate.setHours(0, 0, 0, 0);

			if ((fromDate < nowDate) && (toDate >= nowDate) && nowDate - day.currentDate > 0) {

				if (((nowDate - day.currentDate) / (3600 * 24 * 1000)) < nowDay) {
					return true
				}
			}
		},
		openPopup: function (arr) {
			if (Array.isArray(arr) && arr.length === 0) {
				return null;
			}
			this.$store.dispatch('SET_SELECTED_EVENTS', arr)
			this.$store.dispatch('OPEN_EVENT_POPUP', true)
		}
    },
    filters: {

    },
    mounted () {
        this.$nextTick(function () {
			//Вычислим ширину ячейки календаря
			this.dayWidth = $('.calendar__head').find('li').eq(0).outerWidth();
			this.getWidth = true;
			$(window).on('resize', ()=>{
				this.dayWidth = $('.calendar__head').find('li').eq(0).outerWidth();
			})
        })
    },
    watch: {

    }
}
</script>

<style lang="sass">

</style>
