import Vue from 'vue'
import store from '@/store-service/index'
import DealerAbout from '@/DealerAbout'

const VueInputMask = require('vue-inputmask').default

Vue.use(VueInputMask)

Vue.filter('currencyFormat', function (value) {
	return String(Math.round(value)).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ')
})

const app = new Vue({
	el: '#dealer',
	components: { 
		'dealer-about': DealerAbout 
	},
	store
});

window.dealerApp = app;

$(function() {
	$('.js-open-callBack').on('click', function() {
		window.dealerApp.$emit('openPopup', $(this).data('id'))
	})
})