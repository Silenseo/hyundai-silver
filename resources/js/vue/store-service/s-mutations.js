import Vue from 'vue'

export default {
	SET_CAR_DATA (state, data) {
		Object.assign(state.car, data);
	},
	SET_SAVED_MODEL (state, data) {
		state.savedModel = data;
	},
	SET_ENGINE (state, data) {
		state.engine = data;
	},
	SET_ENGINES (state, data) {
		state.engines = data;
	},
	SET_V_ENGINE (state, data) {
		state.vEngine = data;
	},
	SET_V_ENGINES (state, data) {
		state.vEngines = data;
	},
	SET_MILEAGE (state, data) {
		state.mileage = data;
	},
	SET_USER_PHONE (state, data) {
		state.user.phone = data;
	},
	SET_DEALER (state, data) {
		state.dealer = data;
	},
	SET_CITY (state, data) {
		state.city = data;
	},
	SET_COST (state, data) {
		state.cost = Object.assign({},data)
	},
	SET_SERVICE_PARTS (state, data) {
		state.serviceParts = data
	},
	SET_DATA (state, data) {
		state.data = data;
	},
	SET_DATA_ENGINES (state, data) {
		state.dataEngines = data;
	},
	SET_DEALERS_DATA (state, data) {
		state.dealersData = data;
	},
	SET_DEALERS (state, data) {
		state.dealers = data;
	},
	SET_DEALERS_CITIES (state, data) {
		state.dealersCities = data;
	},
	SET_SELECTED_EVENTS (state, data) {
		state.selectedEvents = data;
	},
	SET_SELECTED_EVENT (state, data) {
		state.selectedEvent = data;
	},
	SET_START_CARCASE_LIST (state, data) {
		state.start.carcaseList = data;
	},
	SET_START_MODELS_LIST (state, data) {
		state.start.modelsList = data;
	},
	SET_START_CURRENT_CAR (state, data) {
		state.start.currentCar = data;
	},
	SET_START_CURRENT_CAR_SPEC (state, data) {
		state.start.currentCarSpec = data
	},
	SET_START_ACTIVE_COLOR_OBJ (state, data) {
		state.start.activeColorObj = data;
	},
	SET_START_COLORS_API (state, data) {
		state.start.colorsAPI = data;
	},
	SET_START_SPRITESPIN (state, data) {
		state.start.spritespin = data;
	},
	SET_START_ACTIVE_COLOR (state, data) {
		state.start.activeColor = data;
	},
	SET_START_PREV_COLOR (state, data) {
		state.start.prevColor = data;
	},
	SET_START_MODIFICATION_LIST (state, data) {
		state.start.modificationList = data;
	},
	SET_START_MODIFICATION (state, data) {
		state.start.modification = data;
	},
	SET_START_DATA_MODIFICATION (state, data) {
		state.start.dataModifications = data;
	},
	SET_START_COMPLECTATION_LIST (state, data) {
		state.start.complectationList = data;
	},
	SET_START_COMPLECTATION (state, data) {
		state.start.complectation = data;
	},
	SET_START_DATA_COMPLECTATIONS (state, data) {
		state.start.dataComplectations = data;
	},
	SET_START_PACKETS (state, data) {
		state.start.packets = data;
	},
	SET_START_SELECTED_PACKETS (state, data) {
		state.start.selectedPackets = data;
	},
	SET_START_SELECTED_PROGRAMS (state, data) {
		state.start.selectedPrograms = data;
	},
	SET_START_CURRENT_TERM (state, data) {
		state.start.currentTerm = data;
	},
	SET_START_INCLUDE_KASKO (state, data) {
		state.start.includeKASKO = data;
	},
	SET_START_COMPARE_SELECTED (state, data) {
		state.start.compareSelected = data;
	},
	SET_START_CREDIT_PACK (state, data) {
		Object.assign(state.start.creditPack, data);
	},
	SET_DEALER_CARS_CAR_ID (state, data) {
		state.dealerCars.carId = data;
	},
	SET_TRADEIN_STATE (state, data) {
		Object.assign(state.tradein.state, data);
	},
	SET_TRADEIN_CURRENT_CAR (state, data) {
		state.tradein.currentCar = data;
	},
	SET_TRADEIN_STEP2 (state, data) {
		Object.assign(state.tradein.step2, data);
	},
	SET_TRADEIN_STEP3 (state, data) {
		Object.assign(state.tradein.step3, data);
	},
	SET_TRADEIN_URL (state, data) {
		state.tradein.sendUrl = data;
	},
	OPEN_START_MOBILE_LINE (state, data) {
		state.start.openMobileLine = data;
	},
	OPEN_FIND_DEALER (state, data) {
		state.openFindDealerPopup = data;
	},
	OPEN_SEND_DEALER (state, data) {
		state.openSendDealerPopup = data;
	},
	OPEN_OFFER_CREDIT (state, data) {
		state.openOfferCreditPopup = data;
	},
	OPEN_BACK_CALL (state, data) {
		state.openBackCallPopup = data;
	},
	OPEN_SEND_EMAIL_POPUP (state, data) {
		state.openSendEmailPopup = data;
	},
	OPEN_SEND_APPROVAL_POPUP (state, data) {
		state.openSendApprovalPopup = data;
	},
	OPEN_RULES (state, data) {
		state.openRules = data;
	},
	OPEN_SUCCESS (state, data) {
		state.openSuccess = data;
	},
	OPEN_EVENT_POPUP (state, data) {
		state.openEventPopup = data;
	},
	OPEN_CHECKOUT_EVENT_POPUP (state, data) {
		state.openCheckoutEventPopup = data;
	},
	OPEN_TEST_DRIVE_POPUP (state, data) {
		state.openTestDrivePopup = data;
	}
}
