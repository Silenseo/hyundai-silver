import Vue from 'vue'
import store from '../../vue/store-service'
import StartCalc from '../../vue/components/Start/StartCalc.vue'

Vue.filter('currencyFormat', function (value) {
	return String(Math.round(value)).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ')
})

//Чтобы store был доступен из вне, для создания событий открытия окон
window.vueStore = store;

new Vue({
	el: '#calc',
	store,
	components: {
		'start-calc': StartCalc
	}
});
