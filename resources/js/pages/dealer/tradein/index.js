import Vue from 'vue'
import store from '@/store-service/index'
import router from '@/components/tradeinCars/router/index'
import TradeinSteps  from '@/TradeinSteps'
import TradeinMenu  from '@/components/tradeinCars/TradeinMenu'

const VueInputMask = require('vue-inputmask').default

Vue.use(VueInputMask)

Vue.filter('currencyFormat', function (value) {
	return String(Math.round(value)).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ')
})

new Vue({
	el: '#hotbuttons',
	store,
	components: {
		'hot-buttons-dealer': () => import('@/components/common/HotButtonsDealer.vue')
	}
});

const app = new Vue({
	el: '#tradein',
	components: { 
		'tradein-steps': TradeinSteps,
		'tradein-menu': TradeinMenu
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