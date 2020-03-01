//Содержит 2 формы: засись на сервис и на тест-драйв
//v-bind:form="'service'"
//v-bind:form="'test-drive'"

import Vue from 'vue'
import store from '../../vue/store-service/index'

Vue.component('signup-forms', require('../../vue/SignUpForms.vue'));

const app = new Vue({
    el: '#signup',
	store,
	data () {
		return {
			init: false,
			popups: 0
		}
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
		},
		formInit () {
			this.init = true;
		}
	},
	mounted () {
		this.$root.$on('form-init', this.formInit)
		this.$root.$on('fixOverflow', this.fixOverflow)
    }
});