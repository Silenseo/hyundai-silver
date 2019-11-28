import Vue from 'vue'
import store from '../../../vue/store-service'
// import View360 from '../../../vue/components/CarPageTemplate/View-360.vue'
// import PresentationSection from '../../../vue/components/CarPageTemplate/PresentationSection.vue'
// import SpecsSection from '../../../vue/components/CarPageTemplate/SpecsSection.vue'
// import SignUpTestDriveFormPopup from '../../../vue/components/common/SignUpTestDriveFormPopup.vue'
import HotButtons from '../../../vue/components/common/HotButtons.vue'

const VueInputMask = require('vue-inputmask').default

Vue.use(VueInputMask)

//Чтобы store был доступен из вне, для создания событий открытия окон
window.vueStore = store;

new Vue({
	el: '#hotbuttons',
	store,
	components: {
		'hot-buttons': HotButtons
	}
});

new Vue({
	el: '#view360',
	store,
	components: {
		'view-360': () => import('../../../vue/components/CarPageTemplate/View-360.vue'),
	}
});

new Vue({
	el: '#design',
	components: {
		'presentation-section': () => import('../../../vue/components/CarPageTemplate/PresentationSection.vue'),
	}
});

new Vue({
	el: '#comfort',
	components: {
		'presentation-section': () => import('../../../vue/components/CarPageTemplate/PresentationSection.vue'),
	}
});

new Vue({
	el: '#specs',
	store,
	components: {
		'specs-section': () => import('../../../vue/components/CarPageTemplate/SpecsSection.vue'),
	}
});

new Vue({
	el: '#tdpopup',
	store,
	data () {
		return {
			isInit: false,
			popups: 0
		}
	},
	components: {
		'sign-up-test-drive-form-popup': () => import('../../../vue/components/common/SignUpTestDriveFormPopup.vue')
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