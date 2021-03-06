import Vue from 'vue'
import store from '../../vue/store-service/index'

const VueInputMask = require('vue-inputmask').default

Vue.use(VueInputMask)

Vue.component('contact-us-page', require('../../vue/ContactUsPage.vue'));

const app = new Vue({
    el: '#contactus',
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