<template>
	<transition name="popup">
		<div class="p-lang df-popup" v-show="isOpened">
			<div class="df-popup__wrap" @click.self="closeThis">
				<div class="p-lang__center df-popup__center">
					<a href="#" @click.prevent="closeThis" class="p-lang__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<h3 class="p-lang__title">
						Пожалуйста,
						<br>выберите язык
					</h3>
					<div class="p-lang__subtitle">Please, choose language</div>
					<div class="p-lang__buttons">
						<button @click.prevent="closeThis('ru')" class="p-lang__button df-button">Русский</button>
						<button @click.prevent="goToEng" class="p-lang__button df-button">English</button>
					</div>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
// import VueCookie from 'vue-cookie'

export default {
	name: "LangSelect",
	// components: { VueCookie },
	data() {
		return {
			isOpened: false
		};
	},
	computed: {

	},
	methods: {
		closeThis: function (lang) {
			this.isOpened = false;
			//Запоминаем выбор пользователя
			if (lang === 'ru') {
				// VueCookie.set('currentLang', 'ru');
				sessionStorage.setItem('currentLang', 'ru');
			}
		},
		goToEng: function () {
			document.location.href = '/motorstudio_moscow_en';
		}
	},
	filters: {},
	mounted() {
		//Проверяем нет ли сохранённого выбора
		// let savedLang = VueCookie.get('currentLang');
		let savedLang = sessionStorage.getItem('currentLang');

		if (savedLang === 'ru' || lang.name === 'en') {
			this.isOpened = false;
		} else {
			this.isOpened = true;
		}
	},
	watch: {}
};
</script>

<style lang="sass">

</style>