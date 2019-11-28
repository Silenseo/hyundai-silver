import Vue from 'vue'
import Vuex from 'vuex'
import state from './s-state'
import mutations from './s-mutations'
import actions from './s-actions'
import getters from './s-getters'

Vue.use(Vuex)

export default new Vuex.Store({
  state,
  mutations,
  actions,
  getters
})
