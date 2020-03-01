import Vue from 'vue'
import store from '../../../vue/store-service'
import View360 from '../../../vue/components/CarPageTemplate/View-360.vue'
import PresentationSection from '../../../vue/components/CarPageTemplate/PresentationSection.vue'
import SpecsSection from '../../../vue/components/CarPageTemplate/SpecsSection.vue'
import HotButtons from '../../../vue/components/common/HotButtons.vue'

//Чтобы store был доступен из вне, для создания событий открытия окон
window.vueStore = store;

new Vue({
	el: '#hotbuttons',
	store,
	components: {
		'hot-buttons': HotButtons
	}
});

new Vue({
	el: '#view360',
	store,
	components: {
		'view-360': View360
	}
});

new Vue({
	el: '#design',
	components: {
		'presentation-section': PresentationSection,
	}
});

new Vue({
	el: '#comfort',
	components: {
		'presentation-section': PresentationSection,
	}
});

new Vue({
	el: '#specs',
	store,
	components: {
		'specs-section': SpecsSection,
	}
});

//Открыть попап записи на тестдрайв
$('.js-open-p-td').on('click', function (e) {
	e.preventDefault();

	if (store.getters.GET_ENV === 'dealer') {
		window.location = '/test-drive'
	} else {
		//Установим активной модель. Св-во code!!!!!!
		store.dispatch('SET_SAVED_MODEL', 'santa fe');
		store.dispatch('OPEN_TEST_DRIVE_POPUP', true);
	}
})