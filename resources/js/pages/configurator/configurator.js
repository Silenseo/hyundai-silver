import Vue from 'vue'
import { sync } from 'vuex-router-sync'
import store from '../../vue/store'
import * as store1 from '../../vue/store-service'
import router from '../../vue/router'
import CheckboxRadio from 'vue-checkbox-radio'
import VueCookie from 'vue-cookie'
import Vuebar from 'vuebar'
// import VueGtm from 'vue-gtm'

//require('./bootstrap');

//window.Vue = require('vue');

Vue.filter('priceFormat', function (value) {
return value.toString().replace(/\D/g, '').replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' ') + ' ₽'
})
Vue.filter('priceBaseFormat', function (value) {
return value.toString().replace(/\D/g, '').replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' ')
})

Vue.directive('fade-in', {
bind: function (el) {
    el.style.opacity = '0'
    el.style.transition = 'opacity .25s ease-in-out 0s'
    el.onload = function () {
    el.style.opacity = ''
    el.style.transition = ''
    }
}
})
//Vue.directive('mask', VueMaskDirective)
Vue.directive('filter', {
bind: function (el, binding) {
    el.inputHandler = function (e) {
    var ch = String.fromCharCode(e.which)
    var re = new RegExp(binding.value)
    if (!ch.match(re)) {
        e.preventDefault()
    }
    }
    el.addEventListener('keypress', el.inputHandler)
},
unbind: function (el) {
    el.removeEventListener('keypress', el.inputHandler)
},
inputHandler: null
})

Vue.use(CheckboxRadio)
Vue.use(VueCookie)
Vue.use(Vuebar)
// Vue.use(VueGtm, {
//   id: 'GTM-PGXFGG',
//   debug: true // process.env.NODE_ENV !== 'production', // Whether or not display console logs debugs (optional)
//   // vueRouter: router // Pass the router instance to automatically sync with router (optional)
//   // ignoredViews: ['homepage'], // If router, you can exclude some routes name (case insensitive) (optional)
// })

Vue.config.productionTip = false

Vue.component('configurator', require('../../vue/Configurator.vue'));

sync(store, router)

const app = new Vue({
    el: '#app',
    store,
    router
});

//Чтобы store был доступен из вне, для создания событий открытия окон
window.vueStore = store1.default;

new Vue({
	el: '#forms',
	store: store1.default,
	data () {
		return {
			isInit: false,
			popups: 0
		}
	},
	components: {
		'sign-up-test-drive-form-popup': () => import('../../vue/components/common/SignUpTestDriveFormPopup.vue'),
	},
	computed: {
		isVisible: function () {
			if (this.$store.state.openTestDrivePopup) {
				this.isInit = true;
			}

			return this.isInit;
		},
	},
	methods: {
		fixOverflow (makeFixed) {
			if (makeFixed === true) {
				document.body.style.overflow = 'hidden'
				this.popups++
			} else {
				this.popups--

				if (this.popups === 0) {
					document.body.style.overflow = ''
				}
			}
		}
	},
	mounted: function() {
		this.$root.$on('fixOverflow', this.fixOverflow)
	}
});