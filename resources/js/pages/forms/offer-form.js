//Содержит формы, которые могут быть в спецпредложениях

import Vue from 'vue'
import store from '../../vue/store-service/index'

Vue.component('offer-forms', require('../../vue/OfferForms.vue'));

const app = new Vue({
    el: '#offerforms',
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
