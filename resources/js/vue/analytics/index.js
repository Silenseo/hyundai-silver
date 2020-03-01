import Vue from 'vue'
import store from '@/store'

export default {
  sendGtmConfig (actionText, labelText, confState = 0) {
    let state = store.state
    let getters = store.getters
    if (!state.car) return false

    if (!store.getters.GET_ENV) {
      let priceCredit = Math.round((1 + (getters.GET_EXTERIOR_PRICE + getters.GET_CURRENT_PACKETS_PRICE) / getters.GET_COMPLECTATION_PRICE) * getters.GET_CREDIT_PAYMENT)
      let data = {
        event: 'custom_event',
        category: 'Конфигуратор',
        action: actionText,
        label: labelText,
        carComposedID: getters.GET_CURRENT_ID + '_' + state.configuration.complectation + '_' + state.configuration.packets.join('_') + '_' + state.configuration.exteriorColor,
        carID: getters.GET_CURRENT_ID,
        modID: state.configuration.modification,
        complID: state.configuration.complectation,
        exteriorColorID: state.configuration.exteriorColor,
        interiorColorID: state.configuration.interiorColor,
        price: getters.GET_SUMMARY_PRICE,
        price_credit: priceCredit,
        carLabel: state.car.name,
        modLabel: state.car.modificationList[state.configuration.modification].name,
        complLabel: state.car.modificationList[state.configuration.modification].complectations[state.configuration.complectation].name,
        packetsID: state.configuration.packets.join(','),
        exteriorColorLabel: getters.GET_COLOR_NAME,
        interiorColorLabel: getters.GET_INTERIOR_COLORS[getters.GET_INTERIOR_COLOR].name
      }

      if (confState !== 0) {
        data.confState = confState

        if (confState === 'complectation') {
          data.compList = ''

          let clist = getters.GET_COMPLECTATION_LIST
          Object.keys(clist).map((key) => {
            let compl = clist[key]
            if (data.compList.length > 0) {
              data.compList = data.compList + '|'
            }
            data.compList = data.compList + compl.id + '_' + compl.name + '_' + compl.price
          })
          console.log(data.compList)
        }

        if (confState === 'modification') {
          data.modList = ''

          let mlist = getters.GET_MODIFICATION_LIST
          Object.keys(mlist).map((key) => {
            let mod = mlist[key]
            if (data.modList.length > 0) {
              data.modList = data.modList + '|'
            }
            data.modList = data.modList + mod.id + '_' + mod.name + '_' + mod.minPrice
          })
        }
      }

	//   Vue.gtm.trackEvent(data)
	// console.log(data)
		dataLayer.push(data)
    }
  },

  sendGtmFilter (actionText, labelText) {
    if (!store.getters.GET_ENV) {
    //   Vue.gtm.trackEvent({
    //     event: 'custom_event',
    //     category: 'Конфигуратор',
    //     action: actionText,
    //     label: labelText
    //   })
	  dataLayer.push({
        event: 'custom_event',
        category: 'Конфигуратор',
        action: actionText,
        label: labelText
      })
    }
  }
}
