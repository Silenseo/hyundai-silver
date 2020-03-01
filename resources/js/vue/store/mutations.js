import Vue from 'vue'

export default {
  SET_APP_STATE (state, data) {
    Object.assign(state.applicationState, data)
  },
  PUSH_CARLIST (state, data) {
    state.cars = data.cars
    state.filter.cost = {
      min: data.minPrice,
      max: data.maxPrice
    }
    Vue.set(state.filter, 'carcases', data.carcaseList)
    state.filter.min_cost_limit = data.minPrice
    state.filter.max_cost_limit = data.maxPrice
  },
  UPDATE_FILTER_PURPOSE (state, value) {
    state.filter.purpose = value
  },
  UPDATE_FILTER_PREPAY_RANGE (state, value) {
    state.filter.prepayRange = value
  },
  UPDATE_FILTER_MONTHLY_RANGE (state, value) {
    state.filter.monthlyRange = value
  },
  UPDATE_MINCOST (state, value) {
    state.filter.cost.min = value
  },
  UPDATE_MAXCOST (state, value) {
    state.filter.cost.max = value
  },
  PUSH_CAR (state, data) {
    state.car = data
  },
  SET_CAR (state, options) {
    if (state.car === null) {
      throw new ReferenceError('Car objects is null.')
    }
    const defaults = {
      modification: state.car.defaultModificationId,
      complectation: state.car.modificationList[state.car.defaultModificationId].defaultComplectation,
      exteriorColor: (state.car.modificationList[state.car.defaultModificationId].complectations[state.car.modificationList[state.car.defaultModificationId].defaultComplectation].exterior_detail) ? state.car.modificationList[state.car.defaultModificationId].complectations[state.car.modificationList[state.car.defaultModificationId].defaultComplectation].exterior_detail.defaultColor : state.car.modificationList[state.car.defaultModificationId].complectations[state.car.modificationList[state.car.defaultModificationId].defaultComplectation].exterior.colors.defaultColor,

      interiorColor: (state.car.modificationList[state.car.defaultModificationId].complectations[state.car.modificationList[state.car.defaultModificationId].defaultComplectation].interior_detail) ? state.car.modificationList[state.car.defaultModificationId].complectations[state.car.modificationList[state.car.defaultModificationId].defaultComplectation].interior_detail.defaultColor : state.car.modificationList[state.car.defaultModificationId].complectations[state.car.modificationList[state.car.defaultModificationId].defaultComplectation].interior.colors.defaultColor,
      packets: []
    }
    // [!] TODO AND WARN
    // complectation may be incorrect, if options contains modification but no complectation
    // be sure that you're always pass non-default modification id only with the complectation!
    // otherwise exception is guaranteed
    state.configuration = Object.assign({}, defaults, options)
  },
  UPDATE_MODIFICATION (state, data) {
    state.full.complectations = null
    state.configuration.modification = data
    // update default interier/exterior colors
    state.configuration.exteriorColor = (state.car.modificationList[data].complectations[state.car.modificationList[data].defaultComplectation].exterior_detail) ? state.car.modificationList[data].complectations[state.car.modificationList[data].defaultComplectation].exterior_detail.defaultColor : state.car.modificationList[data].complectations[state.car.modificationList[data].defaultComplectation].exterior.colors.defaultColor
    state.configuration.interiorColor = (state.car.modificationList[data].complectations[state.car.modificationList[data].defaultComplectation].interior_detail) ? state.car.modificationList[data].complectations[state.car.modificationList[data].defaultComplectation].interior_detail.defaultColor : state.car.modificationList[data].complectations[state.car.modificationList[data].defaultComplectation].interior.colors.defaultColor
  },
  UPDATE_FULL_MODIFICATIONS (state, data) {
    state.full.modifications = data
  },
  UPDATE_COMPLECTATION (state, data) {
    state.configuration.packets = []
    state.configuration.complectation = data
    // update default interier/exterior colors
    state.configuration.exteriorColor = (state.car.modificationList[state.configuration.modification].complectations[data].exterior_detail) ? state.car.modificationList[state.configuration.modification].complectations[data].exterior_detail.defaultColor : state.car.modificationList[state.configuration.modification].complectations[data].exterior.colors.defaultColor
    state.configuration.interiorColor = (state.car.modificationList[state.configuration.modification].complectations[data].interior_detail) ? state.car.modificationList[state.configuration.modification].complectations[data].interior_detail.defaultColor : state.car.modificationList[state.configuration.modification].complectations[data].interior.colors.defaultColor
  },
  UPDATE_FULL_COMPLECTATIONS (state, data) {
    state.full.complectations = data
  },
  UPDATE_PACKETS (state, array) {
    state.configuration.packets = array
  },
  CLEAR_PACKETS (state) {
    state.configuration.packets = []
  },
  UPDATE_EXTERIOR_COLOR (state, data) {
    state.configuration.exteriorColor = data
  },
  UPDATE_INTERIOR_COLOR (state, data) {
    state.configuration.interiorColor = data
  },
  PUSH_SUMMARY (state, data) {
    state.summary = data
  },
  CLEAR_SUMMARY (state) {
    state.summary = null
  },
  CLEAR_CURRENT_CONFIGURATION (state) {
    if (state.car !== null) {
      state.car = null
    }
    // reset user configuration
    state.configuration = {
      modification: 0,
      complectation: 0,
      packets: [],
      exteriorColor: 0,
      interiorColor: 0
    }
    // clear full lists
    state.full = {
      complectations: null,
      modifications: null
    }
    // clear final step
    state.summary = null
  },
  OPEN_CALC (state, data) {
    state.calc = data
  },
  PUSH_CALCULATOR_DATA (state, { data, ID }) {
    Vue.set(state.calculator, ID, data)
  },
  PUSH_CALCULATION_DATA (state, { data, hash }) {
    Vue.set(state.calculations, hash, data)
  },
  HIDE_PROMO (state) {
    state.isPromoVisible = false
  },
  PUSH_DEALERS (state, data) {
    state.dealerList = data
  },
  PUSH_DEALERS_CREDIT (state, data) {
    state.dealerCreditList = data
  },
  SET_POPOVERS_STATE (state, value) {
    state.isPopoversVisible = value
  },
  SET_MOBILEMENU_STATE (state, value) {
    state.isMobileOpened = value
  },
  SET_SIMILAR (state, value) {
    state.similar = Object.assign({},value)
  }
}
