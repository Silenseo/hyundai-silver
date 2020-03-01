<template>
	<section class="calendar-nav">
		<div class="calendar-nav__center">
			<div id="month_controls" class="month-selector" v-show="currentView === 'calendar' || isMobile">
				<a href="#" class="month-selector__prev" @click.prevent="prevMonth">
					<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6 11L2.10207 6.66896C1.75979 6.28866 1.75979 5.71134 2.10207 5.33103L6 1" stroke="#002C5F" stroke-width="2"/>
					</svg>
				</a>
				<div class="month-selector__wrap">
					<transition :name="animMonth" appear>
						<div class="month-selector__item" :key="monthCalc">{{ monthCalc }}</div>
					</transition>
				</div>
				<a href="#" class="month-selector__next" @click.prevent="nextMonth">
					<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 1L4.89793 5.33104C5.24021 5.71134 5.24021 6.28866 4.89793 6.66896L1 11" stroke="#002C5F" stroke-width="2"/>
					</svg>
				</a>
			</div>
			<div id="carousel_controls" class="month-selector" v-show="currentView === 'list' && !isMobile">
				<!-- <a href="#" class="month-selector__prev month-selector__prev--pr" @click.prevent="prevSlide">
					<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6 11L2.10207 6.66896C1.75979 6.28866 1.75979 5.71134 2.10207 5.33103L6 1" stroke="#002C5F" stroke-width="2"/>
					</svg>
				</a>
				<a href="#" class="month-selector__next" @click.prevent="nextSlide">
					<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 1L4.89793 5.33104C5.24021 5.71134 5.24021 6.28866 4.89793 6.66896L1 11" stroke="#002C5F" stroke-width="2"/>
					</svg>
				</a> -->
			</div>
			<div class="calendar-nav__buttons">
				<a href="#" class="calendar-nav__calendar" :class="{ active: currentView === 'calendar' }" @click.prevent="changeView('calendar')">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="1" y="8" width="18" height="11" stroke-width="2"/>
						<path d="M5 6V0M15 6V0M10 6V0" stroke-width="2"/>
						<path d="M5 12L7 12" stroke-width="2"/>
						<path d="M5 15H7" stroke-width="2"/>
						<path d="M9 12L11 12" stroke-width="2"/>
						<path d="M9 15H11" stroke-width="2"/>
						<path d="M13 12L15 12" stroke-width="2"/>
						<path d="M13 15H15" stroke-width="2"/>
						<rect x="1" y="3" width="18" height="5" stroke-width="2"/>
					</svg>
				</a>
				<a href="#" class="calendar-nav__list" :class="{ active: currentView === 'list' }"  @click.prevent="changeView('list')">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="1" y="1" width="7" height="7" stroke-width="2"/>
						<rect x="12" y="1" width="7" height="7" stroke-width="2"/>
						<rect x="1" y="12" width="7" height="7" stroke-width="2"/>
						<rect x="12" y="12" width="7" height="7" stroke-width="2"/>
					</svg>
				</a>
			</div>
		</div>
	</section>
</template>

<script>
export default {
    name: 'CalendarSectionNav',
    components: {

    },
    data () {
        return {
			months: lang.monthArr || ['январь','февраль','март','апрель','май','июнь','июль','август','сентябрь','октябрь','ноябрь','декабрь'],
			currentMonth: 0,
			animMonth: 'month-next',
			date: '',
			currentView: 'list',
			isMobile: false
        }
    },
    computed: {
		monthCalc: function () {
			var month = '';

			this.months.forEach((item, i)=>{
				if (i === this.currentMonth) {
					month = item;
				}
			})

			return month
		}
    },
    methods: {
		init: function () {
			let now = new Date();

			this.currentMonth = now.getMonth();
			this.dateMonth = this.currentMonth;
			this.date = now;

			this.setDate();
		},
		setDate: function (duration) {
			let month = this.date.getMonth();

			if (duration === 'next') {
				this.date.setMonth(month + 1)
			}
			if (duration === 'prev') {
				this.date.setMonth(month - 1)
			}

			this.$emit('set-date', this.date);
		},
		nextMonth: function () {
			this.animMonth='month-next';
			if (this.currentMonth >= this.months.length - 1) {
				this.currentMonth = 0;
			} else {
				this.currentMonth++;
			}
			this.setDate('next')
		},
		prevMonth: function () {
			this.animMonth='month-prev';
			if (this.currentMonth <= 0) {
				this.currentMonth = 11;
			} else {
				this.currentMonth--;
			}
			this.setDate('prev')
		},
		prevSlide: function () {
			this.$emit('prev-slide')
		},
		nextSlide: function () {
			this.$emit('next-slide')
		},
		changeView: function (value) {
			this.currentView = value;
			this.$emit('change-view', value)
		},
		checkMobile: function () {
			if ($(window).outerWidth() < 1263) {
				this.isMobile = true;
			} else {
				this.isMobile = false;
			}
		}
    },
    filters: {

    },
    mounted () {
		var that = this;

		this.init();

        this.$nextTick(function () {
			//Листаем месяцы свайпом
			var square = document.querySelector('#month_controls');
            var manager = new Hammer.Manager(square);
			var Swipe = new Hammer.Swipe();

			manager.add(Swipe);

			var deltaX = 0;
			var deltaY = 0;

			manager.on('swipe', function(e) {
				deltaX = deltaX + e.deltaX;
				var direction = e.offsetDirection;
				
				if (direction === 4) {
					that.prevMonth()
				} else if (direction === 2) {
					that.nextMonth()
				}
			});

			//Проверка для отображения селектора месяцев на мобилке в любом режиме (календарь или лист).
			that.checkMobile();

			$(window).on('resize', function () {
				that.checkMobile();
			})
        })
    },
    watch: {

    }
}
</script>

<style lang="sass">

</style>
