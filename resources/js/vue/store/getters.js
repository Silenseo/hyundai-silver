export default {
	GET_ENV: (state) => {
		return process.env.MIX_BUILD
	},
  GET_NAVIGATION: (state) => {
    return state.navigation
  },
  GET_CURRENT_STEP: (state) => {
    return state.route.name
  },
  GET_CURRENT_STEP_ID: (state) => {
    return state.route.meta.step
  },
  GET_APP_STATE: (state) => {
    return state.applicationState
  },
  GET_CURRENT_ID: (state) => {
    return state.route.params.id || 'null'
  },
  GET_API_CARLIST: (state) => {
    return state.API.CAR_LIST
  },
  GET_API_CAR: (state) => {
    return state.API.CAR
  },
  GET_API_MODIFICATIONS: (state) => {
    return state.API.MODIFICATIONS
  },
  GET_API_COMPLECTATIONS: (state) => {
    return state.API.COMPLECTATIONS
  },
  GET_API_SUMMARY: (state) => {
    return state.API.SUMMARY
  },
  GET_API_CALCULATOR: (state, getters) => {
    return getters.GET_CURRENT_ID !== 'null' ? state.API.CALCULATOR + getters.GET_CURRENT_ID : null
  },
  GET_API_CALCULATIONS: (state, getters) => {
    return getters.GET_COMPLECTATION_ID !== 0 ? state.API.CALCULATIONS + getters.GET_COMPLECTATION_ID + '/' + getters.GET_EXTERIOR_PRICE + '/' + getters.GET_CURRENT_PACKETS_PRICE : null
  },
  GET_API_SEND_EMAIL: (state, getters) => {
    return state.API.SEND_EMAIL
  },
  GET_API_GET_PDF: (state, getters) => {
    return state.API.GET_PDF
  },
  GET_API_SEND_DEALER: (state, getters) => {
    return state.API.SEND_DEALER
  },
  GET_API_DEALERS: (state, getters) => {
    return state.API.GET_DEALERS
  },
  GET_API_DEALERS_CREDIT: (state, getters) => {
    return state.API.GET_DEALERS_CREDIT
  },
  GET_API_COMPARE: (state, getters) => {
    return state.API.COMPARE
  },
  GET_API_TESTDRIVE: (state, getters) => {
    return state.API.SEND_TESTDRIVE
  },
  GET_CARS: (state) => {
    return state.cars
  },
  GET_FILTERED_CARS: (state) => {
    // TODO: ADD DEBOUNCE

    const carslist = state.cars
    if (!carslist) {
      return null
    }

    const prepay = state.filter.prepayRange
    const monthly = state.filter.monthlyRange
    const P = 0.35 / 12
    const _term = 36
    const dv = (Math.pow((1 + P), _term) - 1) / (Math.pow((1 + P), _term) * P)
    let credMin = (monthly[0] * dv) + prepay[0]
    let credMax = (monthly[1] * dv) + prepay[1]

    const credBorderTop = prepay[1] * 5
    const credBorderBottom = Math.round(prepay[0] / 0.9)

    if (credBorderBottom > credMin) {
      credMin = credBorderBottom
    }
    if (credBorderTop < credMax) {
      credMax = credBorderTop
    }

    let priceMin = state.filter.cost.min // Значение из инпута минимальной цены
    let priceMax = state.filter.cost.max // Значение из инпута максимальной цены

    if (credMin > priceMin) priceMin = credMin
    if (credMax < priceMax) priceMax = credMax

    let purpose = state.filter.purpose

    // Костыли:
    // Если ежемесяыный платеж указан как до 2500 - то выводим соляру
    // Если первоначальный взнос указан как до 0 - то выводим соляру
    // Я могу тупить, но кажется соляру мы выводим всегда, если она доступна по стоимости и по другим параметрам

    return Object.keys(carslist).map((key) => {
      let item = Object.assign({}, carslist[key])
      item.active = true
      if (item.id === 23) {
        if (item.maxPrice <= state.filter.cost.min || item.minPrice >= state.filter.cost.max) {
          item.active = false
        }
      } else {
        if (item.maxPrice <= priceMin || item.minPrice >= priceMax) {
          item.active = false
        }
      }

      if (purpose !== '' && parseInt(item.carcaseId) !== parseInt(purpose)) {
        item.active = false
      }
      // А тут закостылим кредитный фильтр
      if (monthly[1] === 2500 && item.id !== 23) {
        item.active = false
      }
      return item
    }).filter(item => {
      return item.active === true
    })
  },
  GET_CARCASES: (state) => {
    return state.filter.carcases
  },
  GET_MIN_COST_LIMIT: (state) => {
    return state.filter.min_cost_limit
  },
  GET_MAX_COST_LIMIT: (state) => {
    return state.filter.max_cost_limit
  },
  GET_FILTER_PURPOSE: (state) => {
    return state.filter.purpose
  },
  GET_FILTER_PREPAY_RANGE: (state) => {
    return state.filter.prepayRange
  },
  GET_FILTER_PREPAY_MIN: (state) => {
    return state.filter.prepay_min
  },
  GET_FILTER_PREPAY_MAX: (state) => {
    return state.filter.prepay_max
  },
  GET_FILTER_MONTHLY_RANGE: (state) => {
    return state.filter.monthlyRange
  },
  GET_FILTER_MONTHLY_MIN: (state) => {
    return state.filter.month_min
  },
  GET_FILTER_MONTHLY_MAX: (state) => {
    return state.filter.month_max
  },
  GET_CAR: (state) => {
    return state.car
  },
  GET_CAR_CODE: (state) => {
    if (state.car) {
      return state.car.codeName
    }
  },
  GET_CAR_NAME: (state) => {
    if (state.car) {
      return state.car.name
    }
  },
  GET_CAR_BGNAME: (state) => {
    if (state.car) {
      return state.car.bgName
    }
  },
  GET_CAR_PICTURE: (state) => {
    if (state.car) {
      return state.car.picture
    }
  },
  GET_CREDIT_AVAIBILITY: (state, getters) => {
    return (getters.GET_CAR !== null) ? getters.GET_CAR.creditAvailable : false
  },
  GET_MODIFICATION_ID: (state) => {
    return state.configuration.modification
  },
  GET_MODIFICATION_LIST: (state) => {
    if (state.car) {
      return state.car.modificationList
    } else {
      return null
    }
  },
  GET_FULL_MODIFICATIONS: (state) => {
    return state.full.modifications
  },
  GET_MODIFICATION_NAME: (state, getters) => {
    if (getters.GET_MODIFICATION_LIST && getters.GET_MODIFICATION_LIST[getters.GET_MODIFICATION_ID]) {
      return getters.GET_MODIFICATION_LIST[getters.GET_MODIFICATION_ID].name
    }
  },
  GET_MODIFICATION_PRICE: (state, getters) => {
    if (getters.GET_MODIFICATION_LIST && getters.GET_MODIFICATION_LIST[getters.GET_MODIFICATION_ID]) {
      return getters.GET_MODIFICATION_LIST[getters.GET_MODIFICATION_ID].minPrice
    } else {
      return 0
    }
  },
  GET_COMPLECTATION_LIST: (state, getters) => {
    if (getters.GET_MODIFICATION_LIST && getters.GET_MODIFICATION_LIST[getters.GET_MODIFICATION_ID]) {
      return getters.GET_MODIFICATION_LIST[getters.GET_MODIFICATION_ID].complectations
    } else {
      return null
    }
  },
  GET_COMPLECTATION_ID: (state) => {
    return state.configuration.complectation
  },
  GET_FULL_COMPLECTATIONS: (state) => {
    return state.full.complectations
  },
  GET_COMPLECTATION_OBJECT: (state, getters) => {
    if (getters.GET_COMPLECTATION_LIST && getters.GET_COMPLECTATION_ID) {
      return getters.GET_COMPLECTATION_LIST[getters.GET_COMPLECTATION_ID]
    } else {
      return null
    }
  },
  GET_COMPLECTATION_NAME: (state, getters) => {
    if (getters.GET_COMPLECTATION_OBJECT) {
      return getters.GET_COMPLECTATION_OBJECT.name
    } else {
      return null
    }
  },
  GET_COMPLECTATION_PRICE: (state, getters) => {
    if (getters.GET_COMPLECTATION_OBJECT) {
      return getters.GET_COMPLECTATION_OBJECT.price
    } else {
      return 0
    }
  },
  GET_PACKETS_LIST: (state, getters) => {
    if (getters.GET_COMPLECTATION_OBJECT) {
      return getters.GET_COMPLECTATION_OBJECT.packets || null
    } else {
      return null
    }
  },
  GET_CURRENT_PACKETS: (state) => {
    if (state.configuration.packets.length > 0) {
      return state.configuration.packets
    } else {
      return null
    }
  },
  GET_CURRENT_PACKETS_PRICE: (state, getters) => {
    if (getters.GET_CURRENT_PACKETS !== null && getters.GET_PACKETS_LIST !== null) {
      const packets = getters.GET_CURRENT_PACKETS
      let priceValue = 0
      // get and summ price for every packet's id from the current selected array of packets
      for (var i = packets.length - 1; i >= 0; i--) {
        priceValue += getters.GET_PACKETS_LIST[packets[i]].price
      }
      return priceValue
    } else {
      return 0
    }
  },
  GET_GALLERY: (state) => {
    if (state.car) {
      return state.car.photos
    } else {
      return null
    }
  },
  GET_GALLERY_NEW: (state, getters) => {
    if (state.car) {
      let mod = state.car.modificationList[+state.configuration.modification]
      if (mod) {
        let complect = mod.complectations[+state.configuration.complectation]
        if (complect) {
          if ('interior' in complect) {
            if ('colors' in complect.interior) {
              if ('colorObj' in complect.interior.colors) {
                if (complect.interior.colors.colorObj[+state.configuration.interiorColor].interior_image) {
                  return [complect.interior.colors.colorObj[+state.configuration.interiorColor].interior_image]
                } else {
                  return getters.GET_GALLERY
                }
              } else {
                return getters.GET_GALLERY
              }
            } else { // Если в комплектации нет цветов, то берём их из старого источника
              return getters.GET_GALLERY
            }
          } else { // Если в комплектации нет цветов, то берём их из старого источника
            return getters.GET_GALLERY
          }
        } else {
          return null
        }
      } else {
        return null
      }
    } else {
      return null
    }
  },
  GET_EXTERIOR_OLD: (state) => {
    if (state.car) {
      return state.car.exterior
    } else {
      return null
    }
  },
  // Берём цвета из нового места
  GET_EXTERIOR: (state, getters) => {
    if (state.car) {
      let mod = state.car.modificationList[+state.configuration.modification]
      if (mod) {
        let complect = mod.complectations[+state.configuration.complectation]
        if (complect) {
          if ('exterior' in complect) {
            if ('colors' in complect.exterior) {
              return complect.exterior
            } else { // Если в комплектации нет цветов, то берём их из старого источника
              return getters.GET_EXTERIOR_OLD
            }
          } else { // Если в комплектации нет цветов, то берём их из старого источника
            return getters.GET_EXTERIOR_OLD
          }
        } else {
          return null
        }
      } else {
        return null
      }
    } else {
      return null
    }
  },
  GET_INTERIOR_OLD: (state) => {
    if (state.car) {
      return state.car.interior
    } else {
      return null
    }
  },
  GET_INTERIOR: (state, getters) => {
    if (state.car) {
      let mod = state.car.modificationList[+state.configuration.modification]
      if (mod) {
        let complect = mod.complectations[+state.configuration.complectation]
        if (complect) {
          if ('interior' in complect) {
            if ('colors' in complect.interior) {
              return complect.interior
            } else { // Если в комплектации нет цветов, то берём их из старого источника
              return getters.GET_INTERIOR_OLD
            }
          } else { // Если в комплектации нет цветов, то берём их из старого источника
            return getters.GET_INTERIOR_OLD
          }
        } else {
          return null
        }
      } else {
        return null
      }
    } else {
      return null
    }
  },
  GET_EXTERIOR_COLOR: (state) => {
    return state.configuration.exteriorColor
  },
  GET_INTERIOR_COLOR: (state) => {
    return state.configuration.interiorColor
  },
  GET_EXTERIOR_COLORS: (state, getters) => {
    if (getters.GET_EXTERIOR !== null && getters.GET_EXTERIOR.colors !== null) {
      const groups = getters.GET_EXTERIOR.colors.groups
      let colors = {}
      Object.keys(groups).map((key) => {
        let group = groups[key]
        Object.keys(group).map((key) => {
          const ID = group[key].id
          colors[ID] = group[key]
        })
      })
      return colors
    } else {
      return null
    }
  },
  GET_EXTERIOR_COLORS_ARRAY: (state, getters) => {
    if (getters.GET_EXTERIOR !== null && getters.GET_EXTERIOR.colors !== null) {
      const groups = getters.GET_EXTERIOR.colors.groups
      let colorsArray = []
      Object.keys(groups).map((key) => {
        let group = groups[key]
        Object.keys(group).map((key) => {
          const ID = group[key].id
          colorsArray.push(ID)
        })
      })
      return colorsArray
    } else {
      return null
    }
  },
  GET_DESIGN_CACHE: (state, getters) => {
    if (getters.GET_EXTERIOR_COLORS !== null) {
      const colors = getters.GET_EXTERIOR_COLORS
      let cacheArray = Object.keys(colors).map(key => {
        return colors[key].bgImage
      }).concat(Object.keys(colors).map(key => {
        return colors[key].carImage
      })).filter((el, index, array) => {
        return el !== null && el !== undefined && el.length > 5
      })
      return cacheArray
    } else {
      return null
    }
  },
  GET_INTERIOR_COLORS: (state, getters) => {
    if (getters.GET_INTERIOR !== null && getters.GET_INTERIOR.colors !== null && getters.GET_INTERIOR.colors.colorObj !== null) {
      return getters.GET_INTERIOR.colors.colorObj
    } else {
      return null
    }
  },
  GET_EXTERIOR_PRICE: (state, getters) => {
    if (getters.GET_EXTERIOR_COLORS && getters.GET_EXTERIOR_COLORS[getters.GET_EXTERIOR_COLOR]) {
      return getters.GET_EXTERIOR_COLORS[getters.GET_EXTERIOR_COLOR].cost
    } else {
      return 0
    }
  },
  GET_COLOR_ID: (state, getters) => {
    if (getters.GET_EXTERIOR_COLORS && getters.GET_EXTERIOR_COLORS[getters.GET_EXTERIOR_COLOR]) {
      return getters.GET_EXTERIOR_COLORS[getters.GET_EXTERIOR_COLOR].id
    } else {
      return 0
    }
  },
  GET_COLOR_NAME: (state, getters) => {
    if (getters.GET_EXTERIOR_COLORS && getters.GET_EXTERIOR_COLORS[getters.GET_EXTERIOR_COLOR]) {
      return getters.GET_EXTERIOR_COLORS[getters.GET_EXTERIOR_COLOR].nameRus
    } else {
      return 0
    }
  },
  GET_360: (state, getters) => {
    if (getters.GET_EXTERIOR) {
      return getters.GET_EXTERIOR.spritespin
    } else {
      return null
    }
  },
  GET_PANORAMA (state, getters) {
    if (getters.GET_INTERIOR && getters.GET_INTERIOR.panorama) {
      return getters.GET_INTERIOR.panorama
    } else {
      return null
    }
  },
  GET_CURRENT_CONFIGURATION: (state) => {
    return state.configuration
  },
  GET_SUMMARY_PRICE: (state, getters) => {
    // summarize mod + compl + packets + exterior colour
    return getters.GET_COMPLECTATION_PRICE + getters.GET_CURRENT_PACKETS_PRICE + getters.GET_EXTERIOR_PRICE
  },
  GET_CREDIT_PAYMENT: (state, getters) => {
    if (getters.GET_COMPLECTATION_OBJECT) {
      return getters.GET_COMPLECTATION_OBJECT.payment
    }
  },
  GET_CREDIT_PAYMENT_BASE: (state, getters) => {
    // payment w/o marketing roundings
    // uses in sidebar at 3 and 4 steps
    if (getters.GET_COMPLECTATION_OBJECT) {
      return getters.GET_COMPLECTATION_OBJECT.paymentBase
    }
  },
  GET_CREDIT_PROGRAM_NAME: (state, getters) => {
    if (getters.GET_COMPLECTATION_OBJECT) {
      return getters.GET_COMPLECTATION_OBJECT.programName
    }
  },
  GET_CREDIT_PROGRAM_START_STATE: (state, getters) => {
    if (getters.GET_COMPLECTATION_OBJECT) {
      return getters.GET_COMPLECTATION_OBJECT.isStart
    } else {
      return false
    }
  },
  GET_CREDIT_DEFAULT_PREPAY: (state, getters) => {
    if (getters.GET_COMPLECTATION_OBJECT) {
      return getters.GET_COMPLECTATION_OBJECT.defaultPV
    } else {
      return 0
    }
  },
  GET_CREDIT_DEFAULT_PROGRAM: (state, getters) => {
    if (getters.GET_COMPLECTATION_OBJECT) {
      return getters.GET_COMPLECTATION_OBJECT.programId
    } else {
      return 0
    }
  },
  GET_SUMMARY: (state) => {
    return state.summary
  },
  GET_CALC_ACTIVE_STATE: (state) => {
    return state.applicationState.calculator
  },
  GET_CALCULATOR: (state) => {
    return state.calculator
  },
  GET_CURRENT_CALCULATOR: (state, getters) => {
    return state.calculator[getters.GET_CURRENT_ID] || null
  },
  GET_CALCULATIONS: (state) => {
    return state.calculations
  },
  GET_CALCULATION_HASH: (state, getters) => {
    return getters.GET_COMPLECTATION_ID.toString() + getters.GET_EXTERIOR_PRICE.toString() + getters.GET_CURRENT_PACKETS_PRICE.toString()
  },
  GET_CURRENT_CALCULATION: (state, getters) => {
    return getters.GET_CALCULATIONS[getters.GET_CALCULATION_HASH]
  },
  GET_COOKIE_NAME: (state) => {
    return state.cookieName
  },
  GET_CAR_PRICELIST: (state, getters) => {
    return getters.GET_CAR && getters.GET_CAR.priceList || ''
  },
  GET_DEALERS: (state) => {
    return state.dealerList || []
  },
  GET_DEALERS_CREDIT: (state) => {
    return state.dealerCreditList || []
  },
  GET_IS_DEALER: (state) => {
    return state.isDealer
  }
}
