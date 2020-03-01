import axios from 'axios'
import router from '../router'
import store from '../store'
import Vue from 'vue'
import analytics from '../analytics/index'
// import { Base64 } from 'js-base64'

export default {
  SET_APP_STATE ({ commit, state, getters }, data) {
    commit('SET_APP_STATE', data)
  },
  LOAD_CARLIST ({ commit, state, getters }) {
    if (state.cars === null) {
      return axios.get(getters.GET_API_CARLIST).then(response => {
        commit('PUSH_CARLIST', response.data)
        commit('SET_APP_STATE', { isDesignReady: false })
        return Promise.resolve(response)
      }, error => {
        // TODO: CREATE RECONNECT W/ T/O
        router.push('/')
        return Promise.reject(error)
      })
    }
  },
  UPDATE_FILTER_PURPOSE ({ commit, state }, value) {
    commit('UPDATE_FILTER_PURPOSE', value)
    analytics.sendGtmFilter('Изменение фильтра тип авто', (value > 0 ? state.filter.carcases[value] : 'Все модели'))
  },
  UPDATE_FILTER_PREPAY_RANGE ({ commit, state }, value) {
    commit('UPDATE_FILTER_PREPAY_RANGE', value)
    analytics.sendGtmFilter('Изменение фильтра цена', state.filter.prepayRange[0] + '...' + state.filter.prepayRange[1])
  },
  UPDATE_FILTER_MONTHLY_RANGE ({ commit, state }, value) {
    commit('UPDATE_FILTER_MONTHLY_RANGE', value)
    analytics.sendGtmFilter('Изменение фильтра цена', state.filter.monthlyRange[0] + '...' + state.filter.monthlyRange[1])
  },
  LOAD_CAR ({ commit, state, getters }, id) {
    return new Promise((resolve, reject) => {
      if (!id) {
        router.push('/')
        return reject('Invalid model ID passed.')
      }
      return axios.get(getters.GET_API_CAR + id).then(response => {
        commit('PUSH_CAR', response.data)
        commit('SET_APP_STATE', { isDesignReady: false })
        window.configuratorModel = response.data.codeName
        if (!state.isDealer) {
          let axel = Math.random() + ''
          let a = axel * 10000000000000
          switch (id) {
            case 23:
              document.getElementById('dbm').innerHTML = '<iframe src="https://8042512.fls.doubleclick.net/activityi;src=8042512;type=invmedia;cat=wz3ouw59;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>'
              break
            case 22:
              document.getElementById('dbm').innerHTML = '<iframe src="https://8042512.fls.doubleclick.net/activityi;src=8042512;type=invmedia;cat=ctsl88dp;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>'
              break
            case 7:
              document.getElementById('dbm').innerHTML = '<iframe src="https://8042512.fls.doubleclick.net/activityi;src=8042512;type=invmedia;cat=yehs3fjp;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>'
              break
            case 18:
              document.getElementById('dbm').innerHTML = '<iframe src="https://8042512.fls.doubleclick.net/activityi;src=8042512;type=invmedia;cat=usqllk9z;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>'
              break
            case 17:
              document.getElementById('dbm').innerHTML = '<iframe src="https://8042512.fls.doubleclick.net/activityi;src=8042512;type=invmedia;cat=yzguv438;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>'
              break
            case 16:
              document.getElementById('dbm').innerHTML = '<iframe src="https://8042512.fls.doubleclick.net/activityi;src=8042512;type=invmedia;cat=dto2ynew;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>'
              break
          }
        }
        return store.dispatch('SET_CAR').then(result => {
          return resolve(response)
        }, error => {
          console.error('Error setting car: ', error)
          return reject(error)
        })
      }, error => {
        router.push('/')
        return reject(error)
      })
    })
  },
  SET_CAR ({ commit, state, getters }) {
    // sorry =(
    return new Promise((resolve, reject) => {
      let options = {}
      let query = Object.assign({}, state.route.query)
      if (Object.keys(query).length > 0) {
        // add options manually
        // [1] set exterior color id
        if (query.exterior) {
          // check color in complectation
          let complectation = state.car.modificationList[+query.modification].complectations[+query.complectation].exterior.colors.groups
          for (var key in complectation) {
            if (complectation[key].hasOwnProperty(query.exterior)) {
              options.exteriorColor = query.exterior
            }
            if (complectation[key].hasOwnProperty(query.exterior_detail)) {
              options.exteriorColor = query.exterior_detail
            }
          }
        }
        // [2] set modification id
        const modificationsList = getters.GET_MODIFICATION_LIST
        if (query.modification && modificationsList.hasOwnProperty(query.modification)) {
          options.modification = query.modification
          const modificationSelected = modificationsList[options.modification]
          // [3] set complectation id
          // set default complectation as a fallback
          // be sure you've kept this fallback (see 'SET_CAR' mutation for details about this issue)
          options.complectation = query.complectation && modificationSelected.complectations[query.complectation]
            ? query.complectation
            : modificationSelected.defaultComplectation
          // [4] add packets array
          // check if selected complectation has packets at all
          // check for validity, compatibility and unique of packets from the query
          const complPackets = modificationSelected.complectations[options.complectation].packets
          const queryPackets = query.packets
          if (query.complectation && complPackets && queryPackets && Array.isArray(queryPackets) && queryPackets.length > 0) {
            let isPacketsValid = false
            // for the one packet only, just check if it exists in the complectation too
            if (queryPackets.length === 1) {
              isPacketsValid = complPackets.hasOwnProperty(queryPackets[0]) && complPackets[queryPackets[0]].dependency === null
            } else {
              // otherwise, check for:
              // – it exists in the complectation
              // – it's not unique packet
              // – has no dep, or query contains it too
              isPacketsValid = queryPackets.every(queryPacket => {
                return complPackets.hasOwnProperty(queryPacket) && complPackets[queryPacket].unique === false && (complPackets[queryPacket].dependency === null || queryPackets.indexOf(complPackets[queryPacket].dependency) !== -1)
              })
            }
            // add packets if it's ok
            if (isPacketsValid) {
              options.packets = queryPackets
            }
          }
        }
      }

      commit('SET_CAR', options)

      // hope everything is fine now and we're ready to go.
      // let's get something via api
      store.dispatch('LOAD_SUMMARY', getters.GET_COMPLECTATION_ID)
      if (getters.GET_CALC_ACTIVE_STATE === true && (getters.GET_CURRENT_CALCULATOR === null || !getters.GET_CURRENT_CALCULATION)) {
        store.dispatch('LOAD_CALC_DATA')
      }
      if (getters.GET_CURRENT_STEP_ID === 4) {
        store.dispatch('LOAD_CACHE')
      }

      analytics.sendGtmConfig('Выбор автомобиля', state.car.name + ',' + state.car.modificationList[state.configuration.modification].name)
      // we did it

      return resolve('Car has been successfully setted up.')
    })
  },
  LOAD_CACHE ({ commit, state, getters }) {
    if (getters.GET_DESIGN_CACHE !== null) {
      let promiseArray = getters.GET_DESIGN_CACHE.map(url => axios.get(url))
      axios.all(promiseArray).then(axios.spread((...args) => {
        setTimeout(() => {
          commit('SET_APP_STATE', { isDesignReady: true })
        }, 250)
      }), error => {
        console.error('Can\'t load design cache:', error)
        commit('SET_APP_STATE', { isDesignReady: true })
      })
    }
  },
  CLEAR_CURRENT_CONFIGURATION ({ commit }) {
    commit('CLEAR_CURRENT_CONFIGURATION')
  },
  UPDATE_MODIFICATION ({ commit, state, getters }, data) {
    commit('UPDATE_MODIFICATION', data)
    commit('UPDATE_COMPLECTATION', state.car.modificationList[data].defaultComplectation)
    commit('CLEAR_PACKETS', data)
    store.dispatch('LOAD_SUMMARY', getters.GET_COMPLECTATION_ID)
    analytics.sendGtmConfig('Выбор модификации', state.car.name + ', ' + state.car.modificationList[data].name)
  },
  LOAD_FULL_MODIFICATIONS ({ commit, state, getters }, id) {
    if (state.full.modifications === null) {
      return axios.get(getters.GET_API_MODIFICATIONS + id).then(response => {
        commit('UPDATE_FULL_MODIFICATIONS', response.data)
      }, error => {
        console.error('Unable to load full modifications data: ', error.message)
      })
    }
  },
  UPDATE_COMPLECTATION ({ commit, state, getters }, data) {
    commit('UPDATE_COMPLECTATION', data)
    store.dispatch('LOAD_SUMMARY', getters.GET_COMPLECTATION_ID)
    let mname = state.car.modificationList[state.configuration.modification].name
    let cname = state.car.modificationList[state.configuration.modification].complectations[state.configuration.complectation].name
    analytics.sendGtmConfig('Выбор комплектации', state.car.name + ', ' + mname + ', ' + cname)
  },
  LOAD_FULL_COMPLECTATIONS ({ commit, state, getters }, id) {
    if (state.full.complectations === null) {
      return axios.get(getters.GET_API_COMPLECTATIONS + id).then(response => {
        commit('UPDATE_FULL_COMPLECTATIONS', response.data)
      }, error => {
        console.error('Unable to load full complectations data: ', error)
      })
    }
  },
  UPDATE_PACKETS ({ commit, state, getters }, packetsArray) {
    commit('UPDATE_PACKETS', packetsArray)
    store.dispatch('LOAD_CALC_DATA')
    let mname = state.car.modificationList[state.configuration.modification].name
    let cname = state.car.modificationList[state.configuration.modification].complectations[state.configuration.complectation].name
    analytics.sendGtmConfig('Выбор опций', state.car.name + ', ' + mname + ', ' + cname)
  },
  CLEAR_PACKETS ({ commit }) {
    commit('CLEAR_PACKETS')
  },
  UPDATE_EXTERIOR_COLOR ({ commit, state, getters }, value) {
    commit('UPDATE_EXTERIOR_COLOR', value)
    let color = getters.GET_EXTERIOR_COLORS[getters.GET_EXTERIOR_COLOR].name
    analytics.sendGtmConfig('Выбор цвета экстерьера', color)
  },
  UPDATE_INTERIOR_COLOR ({ commit, state, getters }, value) {
    commit('UPDATE_INTERIOR_COLOR', value)
    let color = getters.GET_INTERIOR_COLORS[getters.GET_INTERIOR_COLOR].name
    analytics.sendGtmConfig('Выбор цвета интерьера', color)
  },
  UPDATE_MINCOST ({ commit, state }, value) {
    commit('UPDATE_MINCOST', value)
    analytics.sendGtmFilter('Изменение фильтра цена', value + '...' + state.filter.max_cost_limit)
  },
  UPDATE_MAXCOST ({ commit, state }, value) {
    commit('UPDATE_MAXCOST', value)
    analytics.sendGtmFilter('Изменение фильтра цена', state.filter.min_cost_limit + '...' + value)
  },
  LOAD_SUMMARY ({ commit, getters }, id) {
    commit('CLEAR_SUMMARY')
    return axios.get(getters.GET_API_SUMMARY + id).then(response => {
      commit('PUSH_SUMMARY', response.data)
    }, error => {
      console.error('Unable to load summary car data: ', error)
    })
  },
  OPEN_CALC ({ commit }) {
    commit('SET_APP_STATE', { calculator: true })
  },
  LOAD_CALC_DATA ({ commit, getters }) {
    // TODO:
    // – IMPROVE ERROR HANDLERS
    // – CREATE ABORTS !!!

    if (getters.GET_API_CALCULATIONS === null || getters.GET_API_CALCULATOR === null || getters.GET_CURRENT_ID === 'null') {
      return false
    }
    if (getters.GET_CURRENT_CALCULATOR !== null) {
      if (getters.GET_CURRENT_CALCULATION === undefined) {
        commit('SET_APP_STATE', { isCalculatorLoading: true })
        return axios.get(getters.GET_API_CALCULATIONS).then((response) => {
          commit('PUSH_CALCULATION_DATA', { data: response.data, hash: getters.GET_CALCULATION_HASH })
          return Promise.resolve(response.status)
        }, (error) => {
          console.error('Can\'t load credit data:', error)
          return Promise.reject(error)
        }).then(() => {
          commit('SET_APP_STATE', { isCalculatorLoading: false })
        })
      }
    } else {
      const calcRequests = [ axios.get(getters.GET_API_CALCULATOR), axios.get(getters.GET_API_CALCULATIONS) ]
      return axios.all(calcRequests).then((result) => {
        commit('PUSH_CALCULATOR_DATA', { data: result[0].data, ID: getters.GET_CURRENT_ID })
        commit('PUSH_CALCULATION_DATA', { data: result[1].data, hash: getters.GET_CALCULATION_HASH })
        return Promise.resolve()
      }, (error) => {
        console.error('Can\'t load credit and calculation data:', error)
        return Promise.reject(error)
      }).then(() => {
        commit('SET_APP_STATE', { isCalculatorLoading: false })
      })
    }
  },
  OPEN_COMPARING ({ commit }) {
    commit('SET_APP_STATE', { compare: true })
  },
  ADD_FAVOURITE: ({ commit, state, getters }) => {
    let cookie = Vue.cookie.get(getters.GET_COOKIE_NAME) ? JSON.parse(Vue.cookie.get(getters.GET_COOKIE_NAME)) : []
    if (!cookie.includes(getters.GET_COMPLECTATION_ID)) {
      cookie.push(getters.GET_COMPLECTATION_ID)
      Vue.cookie.set(getters.GET_COOKIE_NAME, JSON.stringify(cookie), { expires: '1M' })
    }
  },
  ADD_FAVOURITE_FROM_PROMO: ({ commit, state, getters }, data) => {
    let cookie = Vue.cookie.get(getters.GET_COOKIE_NAME) ? JSON.parse(Vue.cookie.get(getters.GET_COOKIE_NAME)) : []
    if (!cookie.includes(data)) {
      cookie.push(data)
      Vue.cookie.set(getters.GET_COOKIE_NAME, JSON.stringify(cookie), { expires: '1M' })
    }
  },
  REMOVE_FAVOURITE: ({ commit, state, getters }, complID) => {
    let cookie = Vue.cookie.get(getters.GET_COOKIE_NAME) ? JSON.parse(Vue.cookie.get(getters.GET_COOKIE_NAME)) : []
    const compl = Number(complID)
    return new Promise((resolve, reject) => {
      if (!cookie.includes(compl)) {
        return reject('Passed complectation id doesn\'t exist in the coockies.')
      }
      Vue.cookie.set(getters.GET_COOKIE_NAME, JSON.stringify(cookie.filter((key) => {
        return Number(key) !== compl
      })), { expires: '1M' })
      return resolve('Cookies updated successfully.')
    })
  },
  LOAD_DEALERS ({ commit, getters }) {
    return new Promise((resolve, reject) => {
      if (getters.GET_DEALERS.length !== 0) {
        return resolve('Already loaded.')
      }
      return axios.get(getters.GET_API_DEALERS).then((response) => {
        commit('PUSH_DEALERS', response.data)
        return resolve(response)
      }, (error) => {
        return reject(error)
      })
    })
  },
  LOAD_DEALERS_CREDIT ({ commit, getters }) {
    return new Promise((resolve, reject) => {
      if (getters.GET_DEALERS_CREDIT.length !== 0) {
        return resolve('Already loaded.')
      }
      return axios.get(getters.GET_API_DEALERS_CREDIT).then((response) => {
        commit('PUSH_DEALERS_CREDIT', response.data)
        return resolve(response)
      }, (error) => {
        return reject(error)
      })
    })
  },
  LOAD_SIMILAR_CAR ({ commit, getters }, id) {
    return new Promise((resolve, reject)=>{

      axios.get(getters.GET_API_CAR + id)
        .then(response=>{
          resolve(response.data)
        })
        .catch(error=>{
          reject(error)
        })
    })
  },
  LOAD_SIMILAR ({ commit, getters }, data) {
    return new Promise((resolve, reject) => {
      // const tok = '1:1';
      // const hash = Base64.encode(tok);
      // const Basic = 'Basic ' + hash;

      // axios.get(store.state.API.LOAD_SIMILAR, {
      //   params: {},
      //   withCredentials: true,
      //   auth: {
      //     username: 1,
      //     password: 1
      //   }
      // })
      //   .then((response)=>{
      //     console.log(response);
      //     console.log(response.headers['Authorization']);
      //   })
      //   .catch((error)=>{
      //     console.log(error);
      //   })

      // let response = fetch(store.state.API.LOAD_SIMILAR, {
      //   headers: {
      //     Authentication: 'secret'
      //   }
      // });

      // response()
      //   .then((response)=>{
      //     console.log(response);
      //   })

      axios.get(store.state.API.LOAD_SIMILAR, {
        params: data
      })
        .then(r=>{
          commit('SET_SIMILAR', r.data)

          resolve()
        })
        .catch(error=>{
          reject(error)
        })
      // fetch(store.state.API.LOAD_SIMILAR + '?car_id=' + data.car_id + '&modification_id=' + data.modification_id + '&complectation_id=' + data.complectation_id + '&package_id=' + data.package_id + '&color_exterior_id=' + data.color_exterior_id + '&color_interior_id=' + data.color_interior_id, {
      //   method: 'GET',

      //   credentials: 'include',
      //   // headers: {'Authorization': 'Basic ' + btoa('1:1'),}
      // })
      // .then(response => response.json())
      // .then(r=>{
      //   commit('SET_SIMILAR', r)
      // })


    })
  }
}
