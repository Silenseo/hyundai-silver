import Vue from 'vue'
import store from '@/store-service/index'
import router from '@/components/dealerCars/router/index'
import DealerCars from '@/DealerCars'

const VueInputMask = require('vue-inputmask').default

Vue.use(VueInputMask)

Vue.filter('currencyFormat', function (value) {
	return String(Math.round(value)).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ')
})

const app = new Vue({
	el: '#dealercars',
	components: { 
		'dealer-cars': DealerCars 
	},
	store,
	router,
	data () {
		return {
			init: false
		}
	},
	mounted () {
        this.init = true;
    }
});