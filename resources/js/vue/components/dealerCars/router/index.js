import Vue from 'vue'
import VueRouter from 'vue-router'
import DealerCarsShowroom from '../DealerCarsShowroom'

const base = '/dealercars/'

var scrollTop = 0;

const routes = [
	{ path: '/', name: 'home', component: DealerCarsShowroom, beforeEnter: (to, from, next) => {
		next();

		$('html, body').animate({ scrollTop: scrollTop }, 500);
    }},
	{ path: '/car/:id', name: 'car', component: () => import('../CarPage.vue'), beforeEnter: (to, from, next) => {
		scrollTop = $(window).scrollTop();
		next();
		$('html, body').animate({ scrollTop: 0 }, 500);
    }},
]

Vue.use(VueRouter)

const router = new VueRouter({
	base,
	routes,
	mode: 'history',
})

export default router