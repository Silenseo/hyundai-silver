import Vue from 'vue'
import routes from '../routes'
import Router from 'vue-router'
import Vuex from 'vuex'
import store from '../store'
import analytics from '../analytics'
import smoothScroll from 'smoothscroll-polyfill'

smoothScroll.polyfill()

Vue.use(Router)
Vue.use(Vuex)

const base = '/configurator/'

const router = new Router({
  base,
  mode: 'history',
  routes
})

router.beforeEach((to, from, next) => {
  window.scroll({ top: 0, left: 0, behavior: 'smooth' })
  if (to.params.id === 'null') {
    next('/')
  } else {
    // first, check for the calculator's hash option
    if (to.meta.step > 0 && typeof to.params.id !== 'undefined') {
      if (to.hash && to.hash.toLowerCase() === '#calculator') {
        store.dispatch('OPEN_CALC')
      }
      // then check if we need to load a new car
      if (to.params.id.toString() !== store.getters.GET_CURRENT_ID.toString()) {
        store.dispatch('LOAD_CAR', to.params.id).then(result => {
          // clear query parameters after car is loaded
          router.push({ query: {} })
          _analyticsHandler(to, from)
        }).catch(error => {
          router.app.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки запроса.\nПожалуйста, попробуйте позже.' })
          console.error('Unable to load car data: ', error.message)
        })
      }
    }
    if (to.meta.step === 3 && !store.getters.GET_PACKETS_LIST) {
      next({ name: 'Modification', params: {id: to.params.id} })
    } else {
      next()
    }
    document.title = to.meta.title

    scrollNav(to)
  }

  const siteFooter = document.querySelector('.footer')
  // use meta param again, then toggle class on footer
  if (siteFooter && (to.meta.step === 0 || to.meta.step === 5 || to.meta.step === 6)) {
    siteFooter.classList.remove('is-hidden')
  } else {
    siteFooter.classList.add('is-hidden')
  }
})

//Скроллим навигацию, чтобы активный пункт был виден
function scrollNav (to) {
  var container = document.querySelector('.navigation');
  var target = document.querySelectorAll('.navigation__link');

  if (target) {
    for (var i = 0; i < target.length; i++) {
      if (to.name === target[i].dataset.step) {
        if (target[i].getBoundingClientRect().left < 0 || target[i].getBoundingClientRect().left + target[i].clientWidth > window.innerWidth) {
          container.scrollLeft = target[i].getBoundingClientRect().left + container.scrollLeft;
        }
      }
    }
  }
  
}

function _analyticsHandler (to, from) {
  if (typeof to.meta.confState !== 'undefined') {
	analytics.sendGtmConfig('Смена шага', to.meta.gtm, to.meta.confState)
  }
}

router.afterEach((to, from) => _analyticsHandler(to, from))

export default router