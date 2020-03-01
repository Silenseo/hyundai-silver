import Vue from 'vue'
import store from '../../vue/store-service/index'

Vue.component('find-dealer-page', require('../../vue/FindDealerPage.vue'));

const app = new Vue({
    el: '#finddealer',
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