import Vue from 'vue'
import store from '../../vue/store-service'

const VueInputMask = require('vue-inputmask').default

Vue.use(VueInputMask)

Vue.filter('currencyFormat', function (value) {
	return String(Math.round(value)).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ')
})


new Vue({
	el: '#hotbuttons',
	store,
	components: {
		'hot-buttons-dealer': () => import('../../vue/components/common/HotButtonsDealer.vue')
	}
});

new Vue({
	el: '#calc',
	store,
	components: {
		'start-calc': () => import('../../vue/components/Start/StartCalc.vue')
	},
	data () {
		return {
			init: false
		}
	},
	mounted () {
        this.init = true;
    }
});
