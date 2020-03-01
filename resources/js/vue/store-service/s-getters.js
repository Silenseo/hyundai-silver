export default {
  GET_ENV: (state) => {
    return process.env.MIX_BUILD
  },
  GET_CAR_CODE: (state) => {
    return state.car.code
  },
  GET_CAR_NAME: (state) => {
    return state.car.name
  },
  GET_CAR_ID: (state) => {
    return state.car.id
  },
  GET_CAR_LINK: (state) => {
    return state.car.link
  },
  GET_CAR_IMG: (state) => {
    return state.car.image
  },
  GET_ENGINE: (state) => {
    return state.engine
  },
  GET_ENGINES: (state) => {
    return state.engines
  },
  GET_V_ENGINES: (state) => {
    return state.vEngines
  },
  GET_USER_PHONE: (state) => {
	return state.user.phone
  },
  GET_CITY: (state) => {
    return state.city
  },
  GET_CITY_NAME: (state) => {
	let cityName = ''

	state.dealersCities.forEach((city)=>{
		if (city.city_id === state.city) {
			cityName = city.city_name;
		}
	})

    return cityName
  },
  GET_DEALER: (state) => {
    return state.dealer
  },
  GET_COST: (state) => {
    return state.cost
  },
  GET_SERVICE_PARTS: (state) => {
    return state.serviceParts
  },
  GET_DEALERS: (state) => {
    return state.dealers
  },
  GET_DEALERS_CITIES: (state) => {
	state.dealersCities.sort((a, b)=>{
		if (a.city_name > b.city_name) {
			return 1
		} else if (a.city_name < b.city_name) {
			return -1
		} else {
			return 0
		}
	})

	state.dealersCities.sort((a, b)=>{
		return (a.city_id == '1' || a.city_id == '2') ? -1 : (b.city_id == '1' || b.city_id == '2') ? 1 : 0
	})

	state.dealersCities.sort((a, b)=>{
		return a.city_id == '1' ? -1 : 0
	})

    return state.dealersCities
  },
  GET_DATA: (state) => {
    return state.data
  },
  GET_DATA_SERVICE: (state) => {
    return state.dataService
  },
  GET_SELECTED_EVENTS: (state) => {
    return state.selectedEvents
  },
  GET_SELECTED_EVENT: (state) => {
    return state.selectedEvent
  },
  GET_START_CARCASE_LIST (state, data) {
	return state.start.carcaseList
  },
  GET_START_MODELS_LIST: (state) => {
    return state.start.modelsList
  },
  GET_START_CURRENT_CAR: (state) => {
    return state.start.currentCar
  },
  GET_START_CURRENT_CAR_SPEC: (state) => {
    return state.start.currentCarSpec
  },
  GET_START_ACTIVE_COLOR_OBJ: (state) => {
    return state.start.activeColorObj
  },
  GET_START_COLORS_API (state, data) {
	return state.start.colorsAPI
  },
  GET_START_SPRITESPIN (state, data) {
	return state.start.spritespin
  },
  GET_START_ACTIVE_COLOR (state, data) {
	return state.start.activeColor
  },
  GET_START_PREV_COLOR (state, data) {
	return state.start.prevColor
  },
  GET_START_MODIFICATION_LIST: (state) => {
    return state.start.modificationList
  },
  GET_START_MODIFICATION: (state) => {
    return state.start.modification
  },
  GET_START_COMPLECTATION_LIST: (state) => {
    return state.start.complectationList
  },
  GET_START_COMPLECTATION: (state) => {
    return state.start.complectation
  },
  GET_START_PACKETS: (state) => {
    return state.start.packets
  },
  GET_START_SELECTED_PACKETS: (state) => {
    return state.start.selectedPackets
  },
  GET_START_DATA_MODIFICATIONS: (state) => {
    return state.start.dataModifications
  },
  GET_START_DATA_COMPLECTATIONS: (state) => {
    return state.start.dataComplectations
  },
  GET_START_SELECTED_PROGRAMS (state) {
	return state.start.selectedPrograms
  },
  GET_START_CURRENT_TERM (state) {
	return state.start.currentTerm
  },
  GET_START_INCLUDE_KASKO (state) {
	return state.start.includeKASKO
  },
  GET_START_COMPARE_SELECTED (state) {
	return state.start.compareSelected
  },
  GET_START_CREDIT_PACK (state) {
	return state.start.creditPack
  },
  GET_START_MILLEAGE (state) {
	if (state.start.currentTerm === 24) {
		return 'Макс. пробег за 2 года'
	} else if (state.start.currentTerm === 36) {
		return 'Макс. пробег за 3 года'
	}
  },
  GET_START_MILLEAGE_VALUE (state) {
	if (state.start.currentTerm === 24) {
		if (state.start.creditPack.lastPay === 50) {
			return '90 000 км'
		}
		if (state.start.creditPack.lastPay === 55) {
			return '60 000 км'
		}
		if (state.start.creditPack.lastPay === 60) {
			return '45 000 км'
		}
	}
	if (state.start.currentTerm === 36) {
		if (state.start.creditPack.lastPay === 50) {
			return '90 000 км'
		}
		if (state.start.creditPack.lastPay === 55) {
			return '60 000 км'
		}
		if (state.start.creditPack.lastPay === 60) {
			return '45 000 км'
		}
	}
  },
  GET_DEALER_CARS_CAR_ID (state) {
	return state.dealerCars.carId
  },
  GET_TRADEIN_STATE (state) {
	return state.tradein.state
  },
  GET_TRADEIN_STEP2 (state) {
	return state.tradein.step2
  },
  GET_TRADEIN_STEP3 (state) {
	return state.tradein.step3
  },
  GET_TRADEIN_URL (state) {
	return state.tradein.sendUrl
  },
  GET_TRADEIN_CAR (state) {
	return state.tradein.currentCar
  },
  OPEN_START_MOBILE_LINE (state) {
	return state.start.openMobileLine
  },
  OPEN_FIND_DEALER: (state) => {
	  return state.openFindDealerPopup
  },
  OPEN_OFFER_CREDIT_FORM: (state) => {
	  return state.openOfferCreditPopup
  },
  OPEN_SEND_DEALER: (state) => {
	  return state.openSendDealerPopup
  },
  OPEN_BACK_CALL: (state) => {
	  return state.openBackCallPopup
  },
  OPEN_SEND_EMAIL_POPUP: (state) => {
	  return state.openSendEmailPopup
  },
  OPEN_SEND_APPROVAL_POPUP: (state) => {
	  return state.openSendApprovalPopup
  },
  OPEN_RULES: (state) => {
	  return state.openRules
  },
  OPEN_SUCCESS: (state) => {
	  return state.openSuccess
  },
  OPEN_EVENT_POPUP: (state) => {
	return state.openEventPopup
  },
  OPEN_CHECKOUT_EVENT_POPUP: (state) => {
	return state.openCheckoutEventPopup
  },
  OPEN_TEST_DRIVE_POPUP: (state) => {
	return state.openTestDrivePopup
  },
  GET_CHECK_CREDIT_API: (state) => {
	return state.API.CHECK_CREDIT
  },
  GET_CARS_ID_LINKS: (state) => {
	return state.carsIdLinks
  }
}
