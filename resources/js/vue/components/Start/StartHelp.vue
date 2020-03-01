<template>
	<section class="help">
		<h2 class="help__title">Помочь с настройками?</h2>
		<ul class="help__list">
			<li class="help__item" :key="index" v-for="(program, index) in programsList" v-if="!(program.id === 1 && currentCar.name === 'H-1')">
				<div class="help__inner">
					<label>
						<input type="checkbox" :value="program.id" @change="selectProgram(program.id, $event)" v-model="selectedPrograms">
						<div class="help__wrap">
							<div class="help__circle">
								<svg width="19" height="15" viewBox="0 0 19 15" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0.940674 8.6L4.822 12.4844C5.80039 13.4635 7.40545 13.4019 8.30586 12.3506L18.0273 1" stroke="white" stroke-width="2"/>
								</svg>
							</div>
							<div class="help__name">{{ program.name }}</div>
						</div>
					</label>
					<div class="help__more" @click="showMore(program.id, $event)">
						<span>Подробнее</span>
						<svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g clip-path="url(#clip0)">
							<path d="M11.4741 1.5L7.14309 5.39793C6.76278 5.74021 6.18546 5.74021 5.80516 5.39793L1.47412 1.5" stroke="#002C5F" stroke-width="2"/>
							</g>
							<defs>
							<clipPath id="clip0">
							<rect width="7" height="12" fill="white" transform="translate(12.4741 0.5) rotate(90)"/>
							</clipPath>
							</defs>
						</svg>
					</div>
				</div>

				<div class="help__dd" v-html="program.text" :ref="'program-'+program.id"></div>
			</li>
		</ul>
		<div class="help__footer">
			<a href="#" class="help__pass" @click.prevent="nextSlide('help', 'aPass')">Пропустить</a>
			<a href="#" class="help__next df-button" @click.prevent="nextSlide('help', 'aNext')">Продолжить</a>
		</div>
	</section>
</template>

<script>
import { mapGetters } from "vuex";

export default {
	name: "StartHelp",
	data() {
		return {
			programsList: [
				{
					id: 0,
					name: 'Хочу первый взнос 0%',
					text: 'Первый взнос - сумма, которую необходимо внести при покупке автомобиля.'
				},
				{
					id: 1,
					name: 'Хочу, чтобы КАСКО и ТО были включены',
					text: 'Чтобы годовая покупка КАСКО и&nbsp;очередное&nbsp;ТО не&nbsp;стали большим внеплановым расходом вашего бюджета, вы&nbsp;можете включить их&nbsp;в&nbsp;ежемесячные платежи. Стоимость годового полиса КАСКО и&nbsp;одного технического обслуживания в&nbsp;год делится на&nbsp;12&nbsp;месяцев, и&nbsp;полученная сумма прибавляется к&nbsp;вашему ежемесячному платежу. Возможность включения КАСКО и&nbsp;ТО в&nbsp;ежемесячные платежи доступна только для версии программы на&nbsp;36&nbsp;месяцев.'
				},
				{
					id: 2,
					name: 'Хочу выгодный остаточный платеж',
					text: 'Остаточный платеж&nbsp;&mdash; это часть стоимости автомобиля, которая фиксируется в&nbsp;договоре и&nbsp;выплачивается по&nbsp;окончании программы одним из&nbsp;выбранных способов. За&nbsp;счет&nbsp;остаточного платежа сумма кредита сокращается, позволяя уменьшить ежемесячный платеж. Регулируя остаточный платеж, вы&nbsp;можете менять сумму кредита, тем самым увеличивая/уменьшая ежемесячные платежи. На&nbsp;каждый шаг остаточного платежа действует индивидуальное ограничение по&nbsp;пробегу.'
				}
			],
			analytics: {}
		};
	},
	computed: {
		...mapGetters({
			currentCar: 'GET_START_CURRENT_CAR'
		}),
		selectedPrograms: {
			get: function() {
				return this.$store.state.start.selectedPrograms;
			},
			set: function(value) {
				this.$store.dispatch('SET_START_SELECTED_PROGRAMS', value);
			}
		}
	},
	methods: {
		selectProgram: function (id, e) {
			if (id === 0 && e.target.checked) {
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": "Помощь с настройками",
					"label": "Выбор первый взнос 0% " + this.currentCar.codeName
				});
			}
			if (id === 1 && e.target.checked) {
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": "Помощь с настройками",
					"label": "Включены КАСКО и ТО " + this.currentCar.codeName
				});
			}
			if (id === 2 && e.target.checked) {
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": "Помощь с настройками",
					"label": "Выгодный остаточный платеж " + this.currentCar.codeName
				});
			}
		},
		showMore: function (id, e) {
			var that = this;

			if (!$(e.target).closest('.help__more').hasClass('active')) {
				var act = $('.help__more.active').closest('.help__item').find('.help__dd').data('height') | 0;

				$('.owl-height').css('height', ($('.owl-height').outerHeight() + $(e.target).closest('.help__item').find('.help__dd').data('height') - act)+'px')
			} else {
				$('.owl-height').css('height', ($('.owl-height').outerHeight() - $(e.target).closest('.help__item').find('.help__dd').data('height'))+'px')
			}

			$(e.target).closest('.help__more').toggleClass('active');
			
			$('.help__dd').not(this.$refs['program-'+id]).slideUp();
			$('.help__dd').not(this.$refs['program-'+id]).closest('.help__item').find('.help__more').removeClass('active');

			$(this.$refs['program-'+id]).slideToggle(500, function(){
				that.$emit('refresh-carousel');
			});

			if (id === 0 && !this.analytics.event1) {
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": "Помощь с настройками",
					"label": " Пояснение Выбор первый взнос 0% " + this.currentCar.codeName
				});

				this.analytics.event1 = true
			}
			if (id === 1 && !this.analytics.event2) {
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": " Помощь с настройками",
					"label": "Пояснение Включены КАСКО и ТО " + this.currentCar.codeName
				});

				this.analytics.event2 = true
			}
			if (id === 2 && !this.analytics.event3) {
				dataLayer.push({
					"event": "custom_event",
					"category": "Страница программы start",
					"action": " Помощь с настройками",
					"label": "Пояснение Выгодный остаточный платеж " + this.currentCar.codeName
				});

				this.analytics.event3 = true
			}
		},
		nextSlide: function(flag, a) {
			this.$emit('next-slide', flag, a)
		}
	},
	mounted() {

	},
	watch: {}
};
</script>

<style lang="sass">

</style>