import Vue from 'vue'
import VueRouter from 'vue-router'
import TradeinStep1 from '../TradeinStep1'
import store from '@/store-service/index'

const base = '/tradein/'

var scrollTop = 0;

const routes = [
	{ path: '/', redirect: { name: 'step-1' }},
	{ path: '/step-1', name: 'step-1', component: TradeinStep1, beforeEnter: (to, from, next) => {
		next();
	}},
	{ path: '/step-2', redirect: { name: 'step-1' }},
	{ path: '/step-2/:id', name: 'step-2', component: () => import('../TradeinStep2.vue'), beforeEnter: (to, from, next) => {
		next();
    }},
	{ path: '/step-3', name: 'step-3', component: () => import('../TradeinStep3.vue'), beforeEnter: (to, from, next) => {
		if (store.state.tradein.state.step1 && store.state.tradein.state.step2) {
			next();
		} else {
			router.push({ name: 'step-1' })
		}
    }},
	{ path: '/step-4', name: 'step-4', component: () => import('../TradeinStep4.vue'), beforeEnter: (to, from, next) => {
		if (store.state.tradein.state.step1 && store.state.tradein.state.step2 && store.state.tradein.state.step3) {
			next();
		} else {
			router.push({ name: 'step-1' })
		}
    }}
]

Vue.use(VueRouter)

const router = new VueRouter({
	base,
	routes,
	mode: 'history',
})

router.afterEach((to, from, next) => {
	setTimeout(()=>{
		var activeX = 0;
		var offset = $('.t-menu__list').position().left

		if ($('.router-link-active').length > 0) {
			activeX = $('.router-link-active').position().left

			$('.t-menu').animate({ scrollLeft: (activeX - offset) }, 500)
		}

		//Скролл окна в начальную позицию
		if (to.name !== 'step-1' || store.state.tradein.state.step1) {
			var containerX = $('#tradein').offset().top;

			if ($('.header-bottom__mobile-line').is(':visible')) {
				var offset = $('.header-bottom__mobile-line').outerHeight();

				$('html, body').animate({ scrollTop: containerX - offset }, 500)
			} else {
				$('html, body').animate({ scrollTop: containerX }, 500)
			}
		}
	}, 300)
})

export default router