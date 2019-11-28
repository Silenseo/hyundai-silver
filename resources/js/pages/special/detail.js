import Vue from 'vue'
import store from '../../vue/store-service'
import HotButtons from '../../vue/components/common/HotButtons.vue'
import OfferForms from '../../vue/OfferForms.vue'

const VueInputMask = require('vue-inputmask').default

Vue.use(VueInputMask)

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
	el: '#offerPage',
	store,
	components: {
		'offer-forms': OfferForms
	}
});
