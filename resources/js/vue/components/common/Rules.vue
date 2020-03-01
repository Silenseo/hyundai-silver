<template>
	<transition name="popup" v-on:enter="onEnter" v-on:leave="onLeave">
		<div class="rules df-popup" v-show="isOpened">
			<div class="df-popup__wrap" @click.self="closeRules">
				<div class="rules__center df-popup__center">
					<a href="#" @click.prevent="closeRules" class="rules__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<h3 class="rules__title">Правила обработки персональных данных</h3>
					<div class="rules__left df-text-main-16px">
						<p>
							Настоящим&nbsp;Я, в&nbsp;соответствии с&nbsp;требованиями Федерального закона от&nbsp;27.07.06 &#8470;&nbsp;152-ФЗ &laquo;О&nbsp;персональных данных&raquo; даю свое согласие лично, своей волей и&nbsp;в&nbsp;своем интересе на&nbsp;обработку (сбор, систематизацию, накопление, хранение, уточнение (обновление, изменение), использование, распространение, передачу (включая трансграничную передачу), обезличивание, блокирование и&nbsp;уничтожение) моих персональных данных, в&nbsp;том числе с&nbsp;использованием средств автоматизации.
						</p>
						<p>
							Такое согласие мною даётся в&nbsp;отношении следующих персональных данных: фамилии, имя, отчество; контактный адрес электронной почты (e-mail); контактный телефон; для определения потребностей в&nbsp;производственной мощности, мониторинга исполнения сервисными центрами гарантийной политики; ведения истории обращения в&nbsp;сервисные центры; проведения дилерами, дистрибьюторами, контрагентами маркетинговых исследований в&nbsp;области продаж, сервиса и&nbsp;послепродажного обслуживания; для рекламных, исследовательских, информационных, а&nbsp;также иных целей, в&nbsp;том числе, путем осуществления со&nbsp;мной прямых контактов по&nbsp;различным средствам связи.
						</p>
					</div>
					<div class="rules__right df-text-main-16px">
						<p>
							Согласие дается Hyundai Motor Company (Хёндэ Мотор Компани, 231 Янгджи-Донг, Сеочо-Гу, Сеул, 137-938, Республика Корея), ООО &laquo;Хендэ Мотор СНГ&raquo; (г. Москва, ул.Тестовская, д.10), ООО &laquo;Хендэ Мотор МануфактурингPус&raquo; (197706, Санкт-Петербург, г. Сестрорецк, Левашовское&nbsp;ш., д.&nbsp;20, литер&nbsp;А).
						</p>
						<p>
							Я&nbsp;даю свое согласие передавать мои персональные данные для обработки исследовательским агентствам: ООО &laquo;Международный институт маркетинговых и&nbsp;социальных исследований &laquo;ГФК-Русь&raquo; (г. Москва, 9-я Парковая улица, д.&nbsp;48, корп.&nbsp;4), ЗАО &laquo;Бизнес Аналитика&nbsp;МК&raquo; (г. Москва, ул. Новослободская, д.&nbsp;31, стр.&nbsp;2); АО&nbsp;&laquo;АВТОАССИСТАНС&raquo; (г.Москва, ул. Обручева д.&nbsp;52&nbsp;стр.3), ООО &laquo;Ипсос&raquo; (г. Москва, Гамсоновскийпереулок, д.&nbsp;5), а&nbsp;также любым другим третьим лицам, для целей, указанных в&nbsp;настоящем согласии.
						</p>
					</div>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
export default {
  name: "Rules",
  components: {},
  props: ['isOpened'],
  data() {
    return {

	};
  },
  computed: {

  },
  methods: {
	  closeRules: function () {
		  if (typeof this.$store.state.openRules !== 'undefined') {
			  this.$store.dispatch('OPEN_RULES', false);
		  }
		  this.$emit('close');
	  },
	  onEnter: function() {
			this.$root.$emit('fixOverflow', true)
	  },
	  onLeave: function() {
			this.$root.$emit('fixOverflow', false)
	  }
  },
  filters: {},
  mounted() {
	var that = this;

	this.$nextTick(function() {

	})
  },
  watch: {}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'
@import '../../../../sass/common/components/_rules.sass'
</style>
