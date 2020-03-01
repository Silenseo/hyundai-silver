<!-- Компонент поиск дилера на карте
Зависимости: Яндекс карты, axios.
Вход:
	-город,
	-дилер (могут отсутствовать, если есть, то карта соответственно центрируется),
	-isFindDealerPage - для страницы Найти дилера (Вместо кнопки Выбрать дилера, кнопка Тест-драйв)
	-disableScroll - отключить зум колесом мыши
	-fullscreenControl - добавить кнопку открыть на весь экран
Выход: текущий город - сообытие city-detected (на основе города ближайшей к текущей геолокации метке), выбраный дилер - событие dealer-selected
Если геолокация отключена пользователем или не поддерживается браузером, то отображается Москва
Также у элемента есть событие закрытия -->

<template>
	<transition name="popup" v-on:enter="onEnter" v-on:leave="onLeave">
		<div class="c-find-dealer" v-show="isOpened">
			<div class="c-find-dealer__wrap" @click.self="closeDealer">
				<div class="c-find-dealer__center">
					<a href="#" @click.prevent="closeDealer" class="c-find-dealer__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<div id="c-find-dealer-map" :ref="id" class="c-find-dealer__map"></div>
					<!-- <a href="#" @click.prevent="zoomIn" class="c-find-dealer__zoomIn">

					</a>
					<a href="#" @click.prevent="zoomOut" class="c-find-dealer__zoomOut">

					</a> -->
					<!-- <a href="#" @click.prevent="whereIAm" class="c-find-dealer__location">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="10" cy="10" r="7" stroke="#002C5F" stroke-width="2"/>
							<circle cx="10" cy="10" r="2" fill="#002C5F" stroke="#002C5F" stroke-width="2"/>
							<rect x="9.5" y="0.5" width="1" height="3" fill="#002C5F" stroke="#002C5F"/>
							<rect x="9.5" y="16.5" width="1" height="3" fill="#002C5F" stroke="#002C5F"/>
							<rect x="3.5" y="9.5" width="1" height="3" transform="rotate(90 3.5 9.5)" fill="#002C5F" stroke="#002C5F"/>
							<rect x="19.5" y="9.5" width="1" height="3" transform="rotate(90 19.5 9.5)" fill="#002C5F" stroke="#002C5F"/>
						</svg>
					</a> -->
					<transition
						enter-active-class="animated fadeInUp faster"
					>
						<div class="label" v-show="labelOpened"
							:class="{
								special: label.special === '1',
								wa: label.wa === '1',
								star: label.rating === '1',
								citystore: label.citystore === 'C40AF11027'
							}"
						>
							<a href="#" @click.prevent="labelOpened = false" class="label__close">
								<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
									<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
								</svg>
							</a>
							<div class="label__top">
								<div class="label__flags" v-if="label.rating === '1' || label.wa === '1' || label.citystore === 'C40AF11027'">
									<div class="label__star">
										<svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 0L15.174 7.63131L23.4127 8.2918L17.1357 13.6687L19.0534 21.7082L12 17.4L4.94658 21.7082L6.8643 13.6687L0.587322 8.2918L8.82596 7.63131L12 0Z" fill="#A36B4F"/>
										</svg>
									</div>
									<div class="label__wa">
										<img src="/images/icons/wa.png" alt="WA">
									</div>
									<div class="label__citystore"></div>
								</div>
								<div class="label__title">{{ label.title }}</div>
							</div>
							<div class="label__address">{{ label.address }}</div>
							<div class="label__line">
								<a :href="'tel:'+label.phone" class="label__phone">{{ label.phone }}</a>
								<a :href="label.site" class="df-iconed-link df-iconed-link--small label__link" target="_blank">
									Перейти на сайт
									<svg>
										<use xlink:href="#arrow-link"></use>
									</svg>
								</a>
							</div>
							<button class="df-button label__button" v-show="dealerCode !== 'C40AF11027' && !isFindDealerPage" @click.prevent="checkout">Выбрать дилера</button>
							<a :href="'/test-drive?id='+label.dealerId" class="df-button label__button" v-show="dealerCode !== 'C40AF11027' && isFindDealerPage">Тест-драйв</a>
						</div>
					</transition>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
import axios from "axios";
import { setInterval } from 'core-js';
import findDealerState from '../../store-service/s-state';

export default {
	name: "FindDealer",
	components: {},
	props: ['isOpened', 'city', 'dealer', 'isFindDealerPage', 'disableScroll', 'fullscreenControl', 'i30n', 'ctrlZoom'],
	data() {
		return {
			id: 0,
			ready: false,
			myMap: null,
			objectManager: null,
			dealers: [],
			points: [],
			label: {
				title: '',
				address: '',
				phone: '',
				encode_phone: '',
				site: '',
				dealerId: '',
				special: '',
				rating: '',
				wa: '',
				citystore: ''
			},
			dealerCode: '',
			labelOpened: false,
			currentZoom: 10,
			defaultCity: false,
			currentLocation: {
				lat: 0,
				lng: 0
			}
		};
	},
	computed: {

	},
	methods: {
		closeDealer: function () {
			this.labelOpened = false;
			this.$emit('close-this');
		},
		getData: function () {
			var that = this;

			axios.get(findDealerState.API.DEALERS_LIST)
			.then(function (response) {
				that.dealers = response.data;

				that.ready = true;

				that.dealers.forEach(function(item){
					if (item.latitude && item.longitude) {
						var icon;

						if (item.code === 'C40AF11027') {
							icon =  '/images/map/PointCityStore.png';
						} else if (item.special === '1') {
							icon =  '/images/map/PointSpecial.png';
						} else {
							icon = '/images/map/Point.png';
						}

						that.points.push(
							{
								type: 'Feature',
								id: item.id,
								geometry: {
											type: "Point",
											coordinates: [+item.latitude, +item.longitude]
										},
								options: {
									iconLayout: 'default#image',
									iconImageHref: icon,
									iconImageSize: [32, 40]
								},
								properties: {
									city: item.city_name,
									cityId: item.city_id,
									dealerCode: item.code,
									i30n: item.i30n,
									defaultIcon: icon
								}
							}
						)
					}
				})

				//Добавляем объекты на карту
				that.objectManager.add(that.points);

				//Обработчик клика по маркеру
				that.objectManager.objects.events.add('click', function (e) {
					let objectId = e.get('objectId');

					//Смена иконки
					//Вернём на остальных элементах стандартные иконки
					that.points.forEach((point)=>{
						that.objectManager.objects.setObjectOptions(point.id, {
							iconImageHref: point.properties.defaultIcon
						});
					})

					that.objectManager.objects.setObjectOptions(objectId, {
						iconImageHref: '/images/map/PointSelected.png'
					});

					that.dealers.forEach((item) => {
						if (item.id === objectId) {
							that.label.title = item.name;
							that.label.address = item.address;
							that.label.phone = item.phone;
							that.label.encode_phone = item.encode_phone;
							that.label.site = item.site;
							that.label.dealerId = item.id;
							that.dealerCode = item.code;
							that.label.special = item.special;
							that.label.rating = item.rating;
							that.label.wa = item.wa;
							that.label.citystore = item.code;
						}
					})

					that.labelOpened = true;
				});

				//Установим город
				that.setCity();
			})
			.catch((error) => {
				this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
			})
		},
		checkout: function () {
			this.$emit('dealer-selected', this.dealerCode);
			this.closeDealer();
		},
		geolocation: function () {
			return new Promise ((resolve) => {
				var that = this;
				var result = {};

				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition((position) => {
						// Текущие координаты.
						result['lat'] = position.coords.latitude;
						result['lng'] = position.coords.longitude;

						that.currentLocation = result;

						that.defaultCity = false;
						resolve(result);
					}, (error) => {
						//Пользователь запретил доступ к местоположению
						that.defaultCity = true;
						resolve(false);
					});
				} else {
					//Браузер не поддерживает определение координат
					that.defaultCity = true;
					resolve(false);
				}
			})
		},
		setCity: function (def) {
			//Настройка области отображения дилеров в этом городе, если выбран город и не выбран дилер
			var that = this;

			if (this.city && !this.dealer) {
				//Фильтруем список дилеров по городу
				if (this.i30n) {
					var obj = that.objectManager.setFilter(function (object) {
									return  that.city === object.properties.cityId && object.properties.i30n == '1';
								}).getBounds()
				} else {
					var obj = that.objectManager.setFilter(function (object) {
									return  that.city === object.properties.cityId;
								}).getBounds()
				}
			}
			//Если указан город по умолчанию
			else if (this.defaultCity && !this.dealer && !this.city) {
				//Фильтруем список дилеров по городу
				var obj = that.objectManager.setFilter(function (object) {
									return  '1' === object.properties.cityId;
								}).getBounds()

				//Передадим родительскому элементу город
				this.$emit('city-detected', '1');
			}
			//Определить город по ближайшей к геолокации метке
			else if (!this.defaultCity && !this.dealer && !this.city) {
				var city;
				var res = ymaps.geoQuery(this.objectManager.objects).getClosestTo([this.currentLocation.lat, this.currentLocation.lng]);

				city = res.properties.get('cityId');
				//Передадим родительскому элементу город
				this.$emit('city-detected', city);

				//Фильтруем список дилеров по городу
				if (city) {
					var obj = that.objectManager.setFilter(function (object) {
									return  city === object.properties.city;
								}).getBounds()
				}
			}
			this.drawMap(obj);
		},
		setDealer: function () {
			//Настройка области отображения дилера
			if (this.dealer) {
				var that = this;

				//Фильтруем нужного дилера
				var obj = that.objectManager.setFilter(function (object) {
									return  that.dealer === object.properties.dealerCode;
								}).getBounds()

				this.drawMap(obj);
			}
		},
		setI30n: function () {
			var that = this;

			var obj = that.objectManager.setFilter(function (object) {
									return  object.properties.i30n == '1';
								}).getBounds()

			this.drawMap(obj);
		},
		drawMap: function (obj) {
			var that = this;

			//Отображаем правильную область и зум
			if (obj) {
				this.myMap.setBounds(obj, {checkZoomRange: true, duration: 500 }).then(function(){
					if(that.myMap.getZoom() > 14) {
						that.myMap.setZoom(14);
					}
				});
			}

			//Чтобы с карты нe убирались точки вне целевого региона, у i30N убираем дилеров, в которых её нет
			if (!this.i30n) {
				this.objectManager.setFilter(function (object) { return true; })
			} else {
				this.objectManager.setFilter(function (object) { return object.properties.i30n == '1'; })
			}
		},
		zoomIn: function () {
			let zoom = this.myMap.getZoom();

			if (zoom <= 18) {
				this.myMap.setZoom(zoom + 1, {duration: 500});
			}
		},
		zoomOut: function () {
			let zoom = this.myMap.getZoom();

			if (zoom > 1) {
				this.myMap.setZoom(zoom - 1, {duration: 500});
			}
		},
		whereIAm: function () {
			if (this.currentLocation) {
				this.myMap.panTo([this.currentLocation.lat, this.currentLocation.lng]);
			}
		},
		onEnter: function() {
			this.$root.$emit('fixOverflow', true)
		},
		onLeave: function() {
			this.$root.$emit('fixOverflow', false)
		}
	},
	filters: {},
	mounted() {
		var that = this;

		this.id = Date.now();

		this.$nextTick(function () {
			var userLocation = [55.76, 37.64];

			that.geolocation()
				.then((location)=>{
					if (location) {
						userLocation[0] = location.lat;
						userLocation[1] = location.lng;
					}

					ymaps.ready(init);
				})

			function init() {
				// Создание карты.
				that.myMap = new ymaps.Map(that.$refs[that.id], {
					center: userLocation,
					controls: [],
					zoom: that.currentZoom
				}, {suppressMapOpenBlock: true});

				if (that.disableScroll) {
					that.myMap.behaviors.disable('scrollZoom');

					if (that.ctrlZoom) {
						var ctrlKey = false;

						// Обрабатываем нажатие на Ctrl
						$(document).keydown(function(e) {
							if (e.which === 17 && !ctrlKey) { // Ctrl нажат: включаем масштабирование мышью
								ctrlKey = true;
								that.myMap.behaviors.enable('scrollZoom');
							}
						});
						$(document).keyup(function(e) { // Ctrl не нажат: выключаем масштабирование мышью
							if (e.which === 17) {
								ctrlKey = false;
								that.myMap.behaviors.disable('scrollZoom');
							}
						});
					}
				}

				//Запретить перетаскивание пальцем на мобилках
				// if ($(window).width() < 768) {
				// 	that.myMap.behaviors.disable('drag');
				// }

				that.objectManager = new ymaps.ObjectManager();

				that.myMap.geoObjects.add(that.objectManager);

				//Добавить кнопку открыть на весь экран
				if (that.fullscreenControl) {
					// var fullscreenControl = new ymaps.control.FullscreenControl();
					// that.myMap.controls.add(fullscreenControl);

					var FullLayout = ymaps.templateLayoutFactory.createClass("<div class='c-find-dealer__cont'>" +
						"<div id='full' class='c-find-dealer__fullscreen'></div>"
						+ "</div>", {
					});

					var fullControl = new ymaps.control.FullscreenControl({options: {layout: FullLayout}});

					that.myMap.controls.add(fullControl, {
						float: 'none',
						position: {
							right: '0px',
							bottom: '0px'
						}
					});
				}

				// Создадим пользовательский макет ползунка масштаба.
				var ZoomLayout = ymaps.templateLayoutFactory.createClass("<div class='c-find-dealer__cont'>" +
					"<div id='zoom-in' class='c-find-dealer__zoomIn'></div>" +
					"<div id='zoom-out' class='c-find-dealer__zoomOut'></div>"
					+ "</div>", {

					// Переопределяем методы макета, чтобы выполнять дополнительные действия
					// при построении и очистке макета.
					build: function () {
						// Вызываем родительский метод build.
						ZoomLayout.superclass.build.call(this);

						// Привязываем функции-обработчики к контексту и сохраняем ссылки
						// на них, чтобы потом отписаться от событий.
						this.zoomInCallback = ymaps.util.bind(this.zoomIn, this);
						this.zoomOutCallback = ymaps.util.bind(this.zoomOut, this);

						// Начинаем слушать клики на кнопках макета.
						$('#zoom-in').bind('click', this.zoomInCallback);
						$('#zoom-out').bind('click', this.zoomOutCallback);
					},

					clear: function () {
						// Снимаем обработчики кликов.
						$('#zoom-in').unbind('click', this.zoomInCallback);
						$('#zoom-out').unbind('click', this.zoomOutCallback);

						// Вызываем родительский метод clear.
						ZoomLayout.superclass.clear.call(this);
					},

					zoomIn: function () {
						var map = this.getData().control.getMap();
						map.setZoom(map.getZoom() + 1, {checkZoomRange: true});
					},

					zoomOut: function () {
						var map = this.getData().control.getMap();
						map.setZoom(map.getZoom() - 1, {checkZoomRange: true});
					}
				});

				var LocationLayout = ymaps.templateLayoutFactory.createClass("<div class='c-find-dealer__cont'>" +
					"<div id='location' class='c-find-dealer__location'></div>"
					+ "</div>", {

					// Переопределяем методы макета, чтобы выполнять дополнительные действия
					// при построении и очистке макета.
					build: function () {
						// Вызываем родительский метод build.
						LocationLayout.superclass.build.call(this);

						// Привязываем функции-обработчики к контексту и сохраняем ссылки
						// на них, чтобы потом отписаться от событий.
						this.locationCallback = ymaps.util.bind(this.location, this);

						// Начинаем слушать клики на кнопках макета.
						$('#location').bind('click', this.locationCallback);
					},

					clear: function () {
						// Снимаем обработчики кликов.
						$('#location').unbind('click', this.locationCallback);

						// Вызываем родительский метод clear.
						LocationLayout.superclass.clear.call(this);
					},

					location: function () {
						if (that.currentLocation) {
							that.myMap.panTo([that.currentLocation.lat, that.currentLocation.lng]);
						}
					}
				});


				var zoomControl = new ymaps.control.ZoomControl({options: {layout: ZoomLayout}});
				var locationControl = new ymaps.control.ZoomControl({options: {layout: LocationLayout}});

				that.myMap.controls.add(zoomControl, {
					float: 'none',
					position: {
						right: '0px',
						top: '0px'
					}
				});

				that.myMap.controls.add(locationControl, {
					float: 'none',
					position: {
						right: '0px',
						bottom: '0px'
					}
				});

				that.getData();
			};
		})
	},
	watch: {
		city: function () {
			if (this.city) {
				this.setCity(); //обновим видимую область при смене города
			}
		},
		isOpened: function () {
			var that = this;

			function initMap() {
				if (!this.dealer && !this.city && this.i30n) {
					this.setI30n();
				} else {
					//Подстраиваем размер карты под размер окна
					this.myMap.container.fitToViewport();
					this.setCity();
					this.setDealer();
				}
			}

			//Если выбран город, показываем его после того как карта отрисуется, если карта к моменту открытия попапа ещё не готова, ждём готовности
			if (this.isOpened && this.ready) {
				setTimeout(initMap.bind(this), 500)
			} else if (this.isOpened) {
				new Promise((resolve, reject) => {
					var counter = 0;

					setInterval(() => {
						if (that.ready) {
							resolve();
						}
						if (counter > 20) {
							reject();
						}
						counter++;
					}, 500)
				})
				.then(()=>{
					setTimeout(initMap.bind(this), 500)
				}, ()=>{
					this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
				})
			}
		}
	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'
@import '../../../../sass/common/components/_find-dealer.sass'
</style>
