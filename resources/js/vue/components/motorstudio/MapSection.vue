<template>
	<section id="contacts" class="map">
		<div class="map__left">
			<div class="map__body">
				<h3 class="map__title">{{ data.address }}</h3>
				<ul class="map__addresses">
					<li class="map__address map__iconed">
						<svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M18.6201 12.05L13.9399 0L10 7.04004L6.06006 0L1.37012 12.05H0V13.8601H7.06982V12.05H6.00977L7.04004 9.05005L10 14L12.96 9.05005L13.9902 12.05H12.9302V13.8601H20V12.05H18.6201Z" fill="#F53A27"/>
						</svg>
						{{ data.station1 }}
					</li>
					<li class="map__address map__iconed">
						<svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M18.6201 12.05L13.9399 0L10 7.04004L6.06006 0L1.37012 12.05H0V13.8601H7.06982V12.05H6.00977L7.04004 9.05005L10 14L12.96 9.05005L13.9902 12.05H12.9302V13.8601H20V12.05H18.6201Z" fill="#F53A27"/>
						</svg>
						{{ data.station2 }}
					</li>
				</ul>
				<div class="map__phone map__iconed">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M15.6963 12.2271L15.7259 12.2617L15.7584 12.2934L18.8083 15.2661C19.0221 15.4746 19.1042 15.9057 18.8079 16.3389L18.7311 16.4511L18.6871 16.5798L18.6871 16.5799C18.6866 16.5813 18.6783 16.6028 18.6514 16.6453C18.6239 16.6887 18.5852 16.7412 18.5338 16.8024C18.4278 16.9288 18.304 17.0504 18.1729 17.1782L18.1558 17.1948L18.1396 17.2123C17.0677 18.3615 15.5583 19 13.9149 19C12.2714 19 10.7621 18.3615 9.6902 17.2123L9.67708 17.1982L9.66344 17.1847L2.8013 10.3722L2.80133 10.3721L2.79476 10.3657C0.401747 8.03323 0.401747 4.22137 2.79476 1.88887C3.18307 1.51038 3.37135 1.33066 3.65825 1.14423C4.00066 0.92173 4.37468 0.954081 4.69648 1.26347L7.73813 4.35174L7.74529 4.35901L7.7526 4.36614C7.94786 4.55646 8.03449 5.04609 7.71474 5.44809L6.73598 6.4021L6.61886 6.51626L6.54421 6.66178C6.27015 7.19604 6.27015 7.78355 6.54421 8.31781L6.61886 8.46334L6.73598 8.57749L11.4851 13.2065C11.7642 13.5884 12.1992 13.754 12.5806 13.754C12.9619 13.754 13.397 13.5884 13.6761 13.2065L14.6129 12.2934L14.6454 12.2617L14.675 12.2271C14.9112 11.9508 15.4601 11.9508 15.6963 12.2271Z" stroke="#666666" stroke-width="2" stroke-miterlimit="10"/>
					</svg>
					+7 (495) 662-11-80
				</div>
				<div class="map__time map__iconed">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="10" cy="10" r="9" stroke="#666666" stroke-width="2"/>
						<path d="M10 5V10L13 13" stroke="#666666" stroke-width="2"/>
					</svg>
					{{ data.time }}
				</div>
				<div class="map__new-event" v-if="currentLang === 'ru'">
					<div>Хотите организовать свое мероприятие в&nbsp;пространстве Hyundai Motorstudio?</div>
					<button class="df-button" @click="openNewEventPopup">Оставить заявку</button>
				</div>
			</div>
			<ul class="map__social">
				<li class="map__fb">
					<a rel="nofollow" target="_blank" href="https://www.facebook.com/hyundaimotorstudiomoscow/">
						<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M32 26.6952C32 29.4332 29.4194 32 26.6667 32H20.9892V20.0214H26.3226V14.7166H20.9892V12.6631C20.9892 11.8075 21.5054 11.2941 22.0215 11.2941H26.3226V5.9893H22.0215C18.7527 5.9893 16 9.24064 16 12.8342V14.8877H12.043V20.0214H16V32H5.33333C2.58065 32 0 29.4332 0 26.6952V5.30481C0 2.56684 2.58065 0 5.33333 0H26.6667C29.4194 0 32 2.56684 32 5.30481V26.6952Z" fill="#B7B7B7"/>
						</svg>
					</a>
				</li>
				<li class="map__insta">
					<a rel="nofollow" target="_blank" href="https://www.instagram.com/hyundai_motorstudio_moscow/">
						<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M31.84 22.56C31.84 24.32 31.52 25.44 31.04 26.4C30.56 27.52 30.08 28.32 29.28 29.28C28.32 30.24 27.52 30.72 26.4 31.04C25.44 31.36 24.16 31.68 22.56 31.84C21.8743 31.84 21.3829 31.8643 20.783 31.8939H20.783C19.8431 31.9404 18.6369 32 16 32H15.9997C11.68 32 11.2 32 9.44001 31.84C7.68001 31.84 6.56 31.52 5.6 31.04C4.48 30.56 3.68 30.08 2.72 29.28C1.76 28.32 1.28001 27.52 0.96001 26.4C0.64001 25.44 0.32001 24.16 0.16001 22.56C0.16001 21.8743 0.135721 21.3829 0.106071 20.783C0.0596167 19.8431 0 18.6369 0 16C0 11.68 9.76324e-06 11.2 0.16001 9.44C0.16001 7.68 0.48001 6.56 0.96001 5.6C1.44001 4.48 1.92 3.68 2.72 2.72C3.68 1.76 4.48 1.28 5.6 0.960001C6.56 0.640001 7.84001 0.320001 9.44001 0.160001C10.1257 0.160001 10.6171 0.135714 11.217 0.106065C12.1569 0.0596133 13.3631 0 16 0C20.32 0 20.8 0 22.56 0.160001C24.32 0.160001 25.44 0.480001 26.4 0.960001C27.52 1.44 28.32 1.92 29.28 2.72C30.24 3.68 30.72 4.48 31.04 5.6C31.36 6.56 31.68 7.84 31.84 9.44C31.84 10.1257 31.8643 10.6171 31.8939 11.217V11.2171C31.9404 12.1569 32 13.3631 32 16V16.0012C32 20.3201 32 20.8002 31.84 22.56ZM28.4803 6.56063C28.1603 5.76062 27.8403 5.28062 27.3603 4.80062C26.8803 4.32062 26.2403 3.84062 25.6003 3.68062C25.1203 3.52062 24.1603 3.20062 22.7203 3.20062C22.1079 3.20062 21.6361 3.17718 21.0537 3.14824C20.1146 3.10158 18.8879 3.04063 16.3203 3.04063H16.3202C12.1603 3.04063 11.5203 3.04063 9.92031 3.20062C8.44623 3.20062 7.6512 3.47224 7.15984 3.64011L7.15981 3.64012C7.11785 3.65445 7.0781 3.66804 7.04033 3.68062C6.24033 4.00062 5.76032 4.32062 5.28032 4.80062C4.80032 5.28062 4.32033 5.92062 4.16033 6.56063L4.16032 6.56064L4.16032 6.56064C4.00032 7.04065 3.68032 8.00064 3.68032 9.44063C3.68032 10.0531 3.65688 10.5249 3.62794 11.1073C3.58127 12.0463 3.52031 13.273 3.52031 15.8406C3.52031 20.0006 3.52032 20.6406 3.68032 22.2406C3.68032 23.7147 3.95194 24.5098 4.11982 25.0011C4.13415 25.0431 4.14774 25.0829 4.16033 25.1206C4.48033 25.9206 4.80032 26.4006 5.28032 26.8806C5.76032 27.3606 6.40033 27.8406 7.04033 28.0006L7.04035 28.0006C7.52036 28.1606 8.48033 28.4806 9.92031 28.4806C10.5328 28.4806 11.0046 28.5041 11.5869 28.533C12.526 28.5797 13.7527 28.6406 16.3203 28.6406C20.4803 28.6406 21.1203 28.6406 22.7203 28.4806C24.1944 28.4806 24.9895 28.209 25.4808 28.0411C25.5228 28.0268 25.5625 28.0132 25.6003 28.0006C26.4003 27.6806 26.8803 27.3606 27.3603 26.8806C27.8403 26.4006 28.3203 25.7606 28.4803 25.1206C28.6403 24.6406 28.9603 23.6806 28.9603 22.2406C28.9603 21.6282 28.9838 21.1564 29.0127 20.574V20.574V20.574C29.0594 19.6349 29.1203 18.4082 29.1203 15.8406V15.8396C29.1203 11.6805 29.1203 11.0405 28.9603 9.44063C28.9603 8.26867 28.7484 7.52062 28.5832 6.93774C28.5454 6.80443 28.5101 6.67976 28.4803 6.56063ZM16.1603 24.1606C11.6803 24.1606 8.00032 20.4806 8.00032 16.0006C8.00032 11.5206 11.6803 7.84063 16.1603 7.84063C20.6403 7.84063 24.3203 11.5206 24.3203 16.0006C24.1603 20.4806 20.6403 24.1606 16.1603 24.1606ZM24.4803 9.44063C23.3603 9.44063 22.5603 8.64062 22.5603 7.52062C22.5603 6.40062 23.3603 5.60062 24.4803 5.60062C25.6003 5.60062 26.4003 6.40062 26.4003 7.52062C26.4003 8.48062 25.6003 9.44063 24.4803 9.44063ZM21.4397 16.0003C21.4397 18.9164 19.0758 21.2803 16.1597 21.2803C13.2436 21.2803 10.8797 18.9164 10.8797 16.0003C10.8797 13.0843 13.2436 10.7203 16.1597 10.7203C19.0758 10.7203 21.4397 13.0843 21.4397 16.0003Z" fill="#B7B7B7"/>
						</svg>
					</a>
				</li>
			</ul>
		</div>
		<div class="map__right">
			<div id="map"></div>
			<a href="#" @click.prevent="zoomIn" class="map__zoomIn">
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="7" y="16" width="16" height="2" transform="rotate(-90 7 16)" fill="#002C5F"/>
					<rect y="7" width="16" height="2" fill="#002C5F"/>
				</svg>
			</a>
			<a href="#" @click.prevent="zoomOut" class="map__zoomOut">
				<svg width="16" height="2" viewBox="0 0 16 2" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect width="16" height="2" fill="#002C5F"/>
				</svg>
			</a>
			<a href="#" @click.prevent="whereIAm" class="map__location">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="10" cy="10" r="7" stroke="#002C5F" stroke-width="2"/>
					<circle cx="10" cy="10" r="2" fill="#002C5F" stroke="#002C5F" stroke-width="2"/>
					<rect x="9.5" y="0.5" width="1" height="3" fill="#002C5F" stroke="#002C5F"/>
					<rect x="9.5" y="16.5" width="1" height="3" fill="#002C5F" stroke="#002C5F"/>
					<rect x="3.5" y="9.5" width="1" height="3" transform="rotate(90 3.5 9.5)" fill="#002C5F" stroke="#002C5F"/>
					<rect x="19.5" y="9.5" width="1" height="3" transform="rotate(90 19.5 9.5)" fill="#002C5F" stroke="#002C5F"/>
				</svg>
			</a>
		</div>
	</section>
</template>

<script>
export default {
	name: "MapSection",
	components: {},
	data() {
		return {
			myMap: null,
			dataRu: {
				address: 'Москва, улица Новый Арбат д.21, ст. 1',
				station1: 'Смоленская (400 м)',
				station2: 'Арбатская (900 м)',
				time: 'ежедневно, с 10:00 до 22:00'
			},
			dataEn: {
				address: 'Moscow, Novy Arbat st., 21/1',
				station1: 'Smolenskaya station (400 m.)',
				station2: 'Arbatskaya station (900 m.)',
				time: 'Daily, from 10:00 AM to 10:00 PM'
			}
		}
	},
	computed: {
		data: function () {
			if (lang.name === 'ru') {
				return this.dataRu;
			}
			if (lang.name === 'en') {
				return this.dataEn;
			}
		},
		currentLang: function() {
			return lang.name
		}
	},
	methods: {
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
			// Текущие координаты.
			let result = {};

			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition((position) => {
					// Текущие координаты.
					result['lat'] = position.coords.latitude;
					result['lng'] = position.coords.longitude;

					let currentLocation = result;

					if (currentLocation) {
						this.myMap.panTo([currentLocation.lat, currentLocation.lng]);
					}
				}, (error) => {
					console.log('Геолокация отключена')
				});
			}
		},
		openNewEventPopup: function() {
			this.$root.$emit('open-new-event')
		}
	},
	mounted() {
		var that = this;

		this.$nextTick(function () {
			ymaps.ready(init);

			function init() { 
				// Создание карты.  
				that.myMap = new ymaps.Map("map", {
					center: [55.751908, 37.584901],
					controls: [],
					zoom: 8
				}, {suppressMapOpenBlock: true});

				that.myMap.behaviors.disable('scrollZoom'); 

				//Запретить перетаскивание двумя пальцами на мобилках
				if ($(window).width() < 768) {
					that.myMap.behaviors.disable('drag'); 
				}

				 var myPlacemark = new ymaps.Placemark([55.751908, 37.584901], {}, {
					iconLayout: 'default#image',
					iconImageHref: '/images/map/Point.png'
				});

				that.myMap.geoObjects.add(myPlacemark);
			};
		})
	}
};
</script>