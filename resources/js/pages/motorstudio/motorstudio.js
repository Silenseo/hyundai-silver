import Vue from 'vue'
import store from '../../vue/store-service/index'

const VueInputMask = require('vue-inputmask').default

Vue.use(VueInputMask)

Vue.component('motor-studio', require('../../vue/MotorStudio.vue'));

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
