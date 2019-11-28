// import Vue from 'vue'
// import store from '../../vue/store-service'

// const VueInputMask = require('vue-inputmask').default

// Vue.use(VueInputMask)

// //Чтобы store был доступен из вне, для создания событий открытия окон
// window.vueStore = store;

// new Vue({
// 	el: '#forms',
// 	store,
// 	data () {
// 		return {
// 			isInit: false
// 		}
// 	},
// 	components: {
// 		'sign-up-test-drive-form-popup': () => import('../../vue/components/common/SignUpTestDriveFormPopup.vue'),
// 	},
// 	computed: {
// 		isVisible: function () {
// 			if (this.$store.state.openTestDrivePopup) {
// 				this.isInit = true;
// 			}

// 			return this.isInit;
// 		},
// 	}
// });