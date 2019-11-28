import Vue from 'vue'
import store from '../../../vue/store-service'
import HotButtons from '../vue/components/common/HotButtons.vue'

new Vue({
	el: '#hotbuttons',
	components: {
		'hot-buttons': HotButtons
	}
});