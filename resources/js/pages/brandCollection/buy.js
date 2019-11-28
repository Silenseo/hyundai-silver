import Vue from 'vue'
import store from '../../vue/store-service/index'
import WhereBuy from '../../vue/components/brandCollection/WhereBuy.vue'

if (typeof buy !== 'undefined') {
	new Vue({
		el: '#buy',
		store,
		components: {
			'where-buy': WhereBuy
		}
	});
}

if (typeof buyPopup !== 'undefined') {
	new Vue({
		el: '#buyPopup',
		store,
		components: {
			'where-buy': WhereBuy
		}
	});
}
