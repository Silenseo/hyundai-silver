import axios from 'axios'
import store from '../store-service'

export default {
	SET_MODEL ({ commit, state }, data) {
		//Обновим данные
		state.data.forEach((car)=>{
			if (car.code.toLowerCase() === data.toLowerCase() || car.link === '/' + data) {
				store.dispatch('SET_CAR_DATA', car);
			}
		})

		//Если модель не найдена, установим первую в списке
		if (state.car.code === '' && state.data.length > 0) {
			store.dispatch('SET_MODEL', state.data[0].code);
		}

		//Обновим список двигателей
		if (state.dataEngines.length > 0) {
			store.dispatch('SET_ENGINES', data);
		}
	},
	SET_SAVED_MODEL ({ commit, state }, data) {
		commit('SET_SAVED_MODEL', data)
	},
	SET_CAR_DATA ({ commit, state }, data) {
		commit('SET_CAR_DATA', data)
	},
	SET_ENGINES ({ commit, state }, data) {
		//Обновим список двигателей
		state.dataEngines.forEach((car)=>{
			if (car.code === data || (data == 'santa fe' && car.code == 'santafe') || (data == 'h-1' && car.code == 'h1')) {
				commit('SET_ENGINES', car.engines);
			}
		})

		//Поставим первый двигатель в списке как активный
		store.dispatch('SET_ENGINE', Object.keys(state.engines)[0]);
	},
	SET_ENGINE ({ commit, state }, data) {
		commit('SET_ENGINE', data)

		//Обновим объёмы
		store.dispatch('SET_V_ENGINES', state.engines[state.engine]);
	},
	SET_V_ENGINES ({ commit, state }, data) {
		commit('SET_V_ENGINES', data)

		//Выберем первый объём в списке
		store.dispatch('SET_V_ENGINE', state.vEngines[0]);
	},
	SET_V_ENGINE ({ commit }, data) {
		commit('SET_V_ENGINE', data)
	},
	SET_MILEAGE ({ commit }, data) {
		commit('SET_MILEAGE', data)
	},
	SET_USER_PHONE ({ commit }, data) {
		commit('SET_USER_PHONE', data)
	},
	SET_DEALER ({ commit, state }, data) {
		//Устанавливаем город дилера (если город не выбран или дилер выбран на карте)
		var dealerCity;
		var currentCity = state.city;

		commit('SET_DEALER', data)

		state.dealers.forEach((dealer)=>{
			if (dealer.code === data) {
				dealerCity = dealer.city_id;
			}
		})

		if (currentCity !== dealerCity) {
			commit('SET_CITY', dealerCity)
		}
	},
	SET_DEALERS_CITIES ({ commit }, data) {
		var cities = [];

		data.forEach(function(item){
			if (!cities.some((i)=>{ return item.city_id == i.city_id })) {
				cities.push({
					'city_id': item.city_id,
					'city_name': item.city_name
				})
			}
		})

		//console.log(cities)

		commit('SET_DEALERS_CITIES', cities);
	},
	SET_CITY ({ commit }, data) {
		commit('SET_CITY', data)
		//При смене города очищаем дилера
		commit('SET_DEALER', '')
	},
	SET_SELECTED_EVENTS ({ commit }, data) {
		//Ищем событие в списке событий
		if (!Array.isArray(data)) {
			var data = [data];
		}

		let events = [];

		itemsJson.forEach((item)=>{
			if (data.some((event)=>{ return event.id === item.id })) {
				let event = {};

				Object.assign(event, item);
				events.push(event);
			}
		})

		commit('SET_SELECTED_EVENTS', events)
	},
	SET_SELECTED_EVENT ({ commit }, data) {
		commit('SET_SELECTED_EVENT', data)
	},
	GET_START_MODELS_LIST ({ commit, state }, data) {
		return axios.get(state.API.CAR_LIST)
				.then(function (response) {
					var list = [];

					for (var car in response.data.cars) {
						list.push(response.data.cars[car])
					}

					var carcaseList = [];

					response.data.carcaseList[0] = 'Все модели';

					for (var item in response.data.carcaseList) {
						carcaseList.push({
							id: item,
							name: response.data.carcaseList[item]
						})
					}

					commit('SET_START_CARCASE_LIST', carcaseList)
					commit('SET_START_MODELS_LIST', list)
				})
	},
	SET_START_CURRENT_CAR ({ commit, state }, data) {
		commit('SET_START_CURRENT_CAR', data)

		//Данные для попапов
		commit('SET_CAR_DATA', {
			code: data.codeName,
			id: data.id,
			image: data.image,
			link: data.link,
			name: data.name
		})

		return store.dispatch('SET_START_CURRENT_CAR_SPEC')
			.then((data)=>{
				//Обновим список модификаций
				commit('SET_START_MODIFICATION_LIST', data.modificationList)

				//Поставим дефолтную модификацию
				return store.dispatch('SET_START_MODIFICATION', data.modificationList[state.start.currentCarSpec.defaultModificationId])
			})
	},
	SET_START_CURRENT_CAR_SPEC ({ commit, state }) {
		return axios.get(state.API.CAR + state.start.currentCar.id)
				.then(function (response) {
					commit('SET_START_CURRENT_CAR_SPEC', response.data)

					return response.data
				})
	},
	SET_START_MODIFICATION ({ commit, state }, data) {
		commit('SET_START_MODIFICATION', data)

		commit('SET_START_COMPLECTATION_LIST', state.start.modification.complectations)

		//Подгрузим данные модификации
		axios.get(state.API.CAR_MODIFICATIONS + state.start.currentCar.id)
				.then(function (response) {
					commit('SET_START_DATA_MODIFICATION', response.data)

					//Обновим комплектацию и её данные
					return store.dispatch('SET_START_COMPLECTATION', state.start.modification.complectations[state.start.modification.defaultComplectation])
				})
	},
	SET_START_COMPLECTATION ({ commit, state }, data) {
		commit('SET_START_COMPLECTATION', data)

		//Очистим список выбранных пакетов
		commit('SET_START_SELECTED_PACKETS', [])

		//Обновим список пакетов
		store.dispatch('SET_START_PACKETS')

		//Дефолтные цвета
		store.dispatch('SET_360_COLORS')

		//Подгрузим данные комплектации
		return axios.get(state.API.CAR_COMPLECTATIONS + state.start.modification.id)
				.then(function (response) {
					commit('SET_START_DATA_COMPLECTATIONS', response.data)
				})
	},
	SET_START_PACKETS ({ commit, state }) {
		//Определение списка пакетов, если они есть, при установке комплектации
		if ('packets' in state.start.complectation) {
			commit('SET_START_PACKETS', state.start.complectation.packets)
		} else {
			commit('SET_START_PACKETS', {})
			//this.selectedPackets = [];
		}
	},
	SET_START_SELECTED_PACKETS ({ commit, state }, data) {
		commit('SET_START_SELECTED_PACKETS', data)
	},
	SET_START_ACTIVE_COLOR_OBJ ({ commit }, data) {
		commit('SET_START_ACTIVE_COLOR_OBJ', data)
	},
	SET_START_ACTIVE_COLOR ({ commit }, data) {
		commit('SET_START_ACTIVE_COLOR', data)
	},
	SET_START_PREV_COLOR ({ commit }, data) {
		commit('SET_START_PREV_COLOR', data)
	},
	SET_360_COLORS ({ commit, state }) {
		//Берём 360 из текущей комплектации
		commit('SET_START_ACTIVE_COLOR', state.start.complectation.exterior.colors.defaultColor)
		commit('SET_START_COLORS_API', state.start.complectation.exterior.colors.groups)
		commit('SET_START_SPRITESPIN', state.start.complectation.exterior.spritespin)

		for (var group in state.start.colorsAPI) {
			for (var color in state.start.colorsAPI[group]) {
				if (state.start.colorsAPI[group][color].id === state.start.activeColor) {
					commit('SET_START_ACTIVE_COLOR_OBJ', state.start.colorsAPI[group][color])
				}
			}
		}
	},
	SET_START_SELECTED_PROGRAMS ({ commit, state }, data) {
		commit('SET_START_SELECTED_PROGRAMS', data)
	},
	SET_START_CURRENT_TERM ({ commit, state }, data) {
		commit('SET_START_CURRENT_TERM', data)
	},
	SET_START_INCLUDE_KASKO ({ commit, state }, data) {
		commit('SET_START_INCLUDE_KASKO', data)
	},
	SET_START_COMPARE_SELECTED ({ commit, state }, data) {
		commit('SET_START_COMPARE_SELECTED', data)
	},
	SET_START_CREDIT_PACK ({ commit, state }, data) {
		if (data.prepay < 1 && data.prepay !== 0) {
			return console.error('data.prepay должно быть от 0 до 100')
		}
		commit('SET_START_CREDIT_PACK', data)
	},
	SET_DEALER_CARS_CAR_ID ({ commit, state }, data) {
		commit('SET_DEALER_CARS_CAR_ID', data)
	},
	SET_TRADEIN_CURRENT_CAR ({ commit, state }, data) {
		commit('SET_TRADEIN_CURRENT_CAR', data)
		commit('SET_TRADEIN_STATE', { step1: true })
	},
	SET_TRADEIN_STATE ({ commit, state }, data) {
		commit('SET_TRADEIN_STATE', data)
	},
	SET_TRADEIN_STEP2 ({ commit, state }, data) {
		commit('SET_TRADEIN_STEP2', data)
	},
	SET_TRADEIN_STEP3 ({ commit, state }, data) {
		commit('SET_TRADEIN_STEP3', data)
	},
	SET_TRADEIN_URL ({ commit, state }, data) {
		commit('SET_TRADEIN_URL', data)
	},
	OPEN_START_MOBILE_LINE ({ commit }, data) {
		commit('OPEN_START_MOBILE_LINE', data)
	},
	OPEN_FIND_DEALER ({ commit }, data) {
		commit('OPEN_FIND_DEALER', data)
	},
	OPEN_SEND_DEALER ({ commit }, data) {
		commit('OPEN_SEND_DEALER', data)
	},
	OPEN_OFFER_CREDIT ({ commit }, data) {
		commit('OPEN_OFFER_CREDIT', data)
	},
	OPEN_BACK_CALL ({ commit }, data) {
		commit('OPEN_BACK_CALL', data)
	},
	OPEN_RULES ({ commit }, data) {
		commit('OPEN_RULES', data)
	},
	OPEN_SUCCESS ({ commit }, data) {
		commit('OPEN_SUCCESS', data)
	},
	OPEN_EVENT_POPUP ({ commit }, data) {
		commit('OPEN_EVENT_POPUP', data)
	},
	OPEN_CHECKOUT_EVENT_POPUP ({ commit }, data) {
		commit('OPEN_CHECKOUT_EVENT_POPUP', data)
	},
	OPEN_TEST_DRIVE_POPUP ({ commit }, data) {
		commit('OPEN_TEST_DRIVE_POPUP', data)
	},
	OPEN_SEND_EMAIL_POPUP ({ commit }, data) {
		commit('OPEN_SEND_EMAIL_POPUP', data)
	},
	OPEN_SEND_APPROVAL_POPUP ({ commit }, data) {
		commit('OPEN_SEND_APPROVAL_POPUP', data)
	},
	GET_DEALERS ({ commit, state }, carName) {
		return new Promise((resolve, reject)=>{
			axios.get(state.API.DEALERS_LIST)
				.then(function (response) {
					commit('SET_DEALERS_DATA', response.data);
					commit('SET_DEALERS', response.data);

					store.dispatch('SET_DEALERS_CITIES', response.data);

					resolve();
				})
				.catch((error)=>{
					reject(error);
				})
		})
	},
	GET_DATA ({ commit, state }, data) {
		let params = {};

		if (typeof data !== 'undefined' && data.getOld) {
			params.oldCars = 1
		}

		return new Promise((resolve, reject)=>{
			axios.get(state.API.CAR_LIST2, { params: params })
				.then(function (response) {
					var arr = response.data.map((item)=>{
						item.code = item.code.toLowerCase();
						return item;
					})

					commit('SET_DATA', arr);

					//Установим модель по умолчаню, если модель была установлена до этого момента (на странице модели), ставим её
					if (typeof data === 'undefined' || (typeof data !== 'undefined' && data.flag !== 'noDefaultCar')) {
						if (state.savedModel) {
							store.dispatch('SET_MODEL', state.savedModel);
						} else {
							store.dispatch('SET_MODEL', response.data[0].code);
						}
					}

					resolve();
				})
				.catch((error)=>{
					reject(error);
				})
		})
	},
	GET_DATA_CALC_TO ({ commit, state }, data) {
		return new Promise((resolve, reject)=>{
			axios.get(state.API.CAR_LIST3)
				.then(function (response) {
					var arr = response.data.map((item)=>{
						item.code = item.code.toLowerCase();
						return item;
					})

					commit('SET_DATA', arr);

					//Установим модель по умолчаню
					store.dispatch('SET_MODEL', response.data[0].code);

					resolve();
				})
				.catch((error)=>{
					reject(error);
				})
		})
	},
	GET_ENGINES ({ commit, state }, data) {
		return new Promise((resolve, reject)=>{
			//Подгрузим информацию о двигателях
			axios.get(state.API.ENGINES_LIST)
				.then(function (response) {
					commit('SET_DATA_ENGINES', response.data);

					store.dispatch('SET_ENGINES', state.car.code);

					resolve();
				})
				.catch((error)=>{
					reject(error);
				})
		})
	},
	GET_COST ({ commit, state }, data) {
		let dealer = '';

		if (!!data.dealer) {
			dealer = '&dealer=' + data.dealer
		}
		
		axios.get(state.API.TO_CALC_COST + '?car=' + data.model + '' + dealer + '&engine=' + data.vEngine + '&enginetype=' + encodeURIComponent(data.engine) + '&mileage=' + data.mileage + '&spares=0')
			.then(function (response) {
				let data = response.data;

				let works = response.data.repairs_nf || 0;
				let parts = response.data.originspares_nf || 0;
				let partsPl2 = response.data.pl2spares_nf || 0;
				let total = response.data.total_nf || 0;

				commit('SET_COST', {
					works: works,
					parts: parts,
					partsPl2: partsPl2,
					total: total
				});
			})
	},
	SET_SERVICE_PARTS ({ commit, state }, data) {
		commit('SET_SERVICE_PARTS', data);
	}
}
