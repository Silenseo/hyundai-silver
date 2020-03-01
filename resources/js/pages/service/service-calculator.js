import Vue from 'vue'
import store from '../../vue/store-service/index'

Vue.filter('priceFormat', function (value) {
return value.toString().replace(/\D/g, '').replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' ') + ' ₽'
})
Vue.filter('priceBaseFormat', function (value) {
return value.toString().replace(/\D/g, '').replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' ')
})

window.vueStore = store;

Vue.component('service-calculator', require('../../vue/ServiceCalculator.vue'));

const app = new Vue({
    el: '#app',
	store,
	data () {
		return {
			init: false
		}
	},
	mounted () {
        this.init = true;
    }
});
