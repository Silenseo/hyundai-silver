import Carlist from '../components/Carlist/Index'
import Car from '../components/Car/Index'
import Modification from '../components/Car/Modification'
import Complectation from '../components/Car/Complectation'
import Packets from '../components/Car/Packets'
import Design from '../components/Car/Design'
import Summary from '../components/Car/Summary'
import Favourites from '../components/Favourites/Index'

import store from '../store'

export default [
  {
    path: '/',
    name: 'Carlist',
    component: Carlist,
    meta: {
      title: 'Конфигуратор Hyundai',
      step: 0
    }
  },
  {
    path: '/car/:id',
    name: 'Car',
    component: Car,
    props: true,
    redirect: '/car/:id/modification',
    // beforeEnter: (to, from, next) => {
    //   store.dispatch('LOAD_CAR', to.params.id)
    //   next()
    // },
    children: [
      {
        path: 'modification',
        name: 'Modification',
        component: Modification,
        meta: {
          title: 'Выбор модификации | Конфигуратор',
          step: 1,
          confState: 'modification',
          gtm: 'Выбор модификации'
        }
      },
      {
        path: 'complectation',
        name: 'Complectation',
        component: Complectation,
        meta: {
          title: 'Выбор комплектации | Выбор модификации',
          step: 2,
          confState: 'complectation',
          gtm: 'Выбор комплектации'
        }
      },
      {
        path: 'packets',
        name: 'Packets',
        component: Packets,
        meta: {
          title: 'Выбор опций | Конфигуратор',
          step: 3,
          confState: 'packets',
          gtm: 'Выбор опций'
        }
      },
      {
        path: 'design',
        name: 'Design',
        component: Design,
        meta: {
          title: 'Дизайн | Конфигуратор',
          step: 4,
          confState: 'design',
          gtm: 'Выбор цвета'
        },
        beforeEnter: (to, from, next) => {
          if (store.getters.GET_APP_STATE && store.getters.GET_APP_STATE.isDesignReady === false) {
            store.dispatch('LOAD_CACHE')
          }
          next()
        }
      },
      {
        path: 'summary',
        name: 'Summary',
        component: Summary,
        meta: {
          title: 'Итог | Конфигуратор',
          confState: 'final',
		  step: 5,
		  gtm: 'Итого'
        }
        // beforeEnter: (to, from, next) => {
          // console.log('to.params.id', to.params.id)
          // if (store.getters.GET_SUMMARY !== null && to.params.id) {
          //   store.dispatch('LOAD_SUMMARY', to.params.id)
          // }
          // next()
        // }
      }
    ]
  },
  {
    path: '/favourites',
    name: 'Favourites',
    component: Favourites,
    meta: {
      title: 'Мои конфигурации',
      step: 6
    }
  },
  {
    path: '*',
    redirect: '/'
  }
]
