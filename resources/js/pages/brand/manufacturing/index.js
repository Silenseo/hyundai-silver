import parallax from '../parallax'
import smoothScroll from '../smoothScroll'
import videoInit from '../videoInit'

$(function() {
	var controller = new ScrollMagic.Controller(),
		oldWindowWidth = 0;

	videoInit()

	//Усреднённые цвета подложек
	const fac = new FastAverageColor();

	$.extend($.lazyLoadXT, {
		edgeY:  500,
		checkDuplicates: false
	  });

	$('.js-set-color').on('lazyload', function () {
        const image = new Image();
		var color;

		image.src = this.style.backgroundImage.replace('url("','').replace('")','');

		image.onload = ()=>{
			color = fac.getColor(image);

			$(this).parent().css('background-color', color.hex);
		}
	})

	$(window).on('load', function() {
		$('body').addClass('loaded');
	})

	//Расстановка триггеров для блоков
	$('.scrollmagic').each(function(){
		var scene = new ScrollMagic.Scene({triggerElement: this, triggerHook: 1, offset: 150 })
			//.addIndicators({name: id + " (duration: 0)"})
			.addTo(controller);

		scene.on("enter", function (event) {
			$(event.currentTarget.triggerElement()).addClass("active");
		});

		if ($(this).find('.df-description').length > 0) {
			var description = this.querySelector('.df-description');

			var scene1 = new ScrollMagic.Scene({triggerElement: description, triggerHook: 1, offset: 150 })
				//.addIndicators({name: id + " description (duration: 0)"})
				.addTo(controller);

			scene1.on("enter", function (event) {
				$(event.currentTarget.triggerElement()).addClass("active");
			});
		}
		
	})

	$('.df-slideUp').each(function() {
		var scene = new ScrollMagic.Scene({triggerElement: this, triggerHook: 1, offset: 150 })
			.addTo(controller);

		scene.on("enter", function (event) {
			$(event.currentTarget.triggerElement()).addClass("active");
		});
	})

	//Появление блока История
	var scene = new ScrollMagic.Scene({triggerElement: '.history', triggerHook: 0.5 })
	//.addIndicators({name: "item (duration: 0)"})
	.addTo(controller);

	scene.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	parallax();
	$(window).on('resize', parallax);

	//Выбор цехов

	//Установка высоты слайдов
	var slides = [],
		currentSlide = 0;

	function setHeight () {
		slides = [];

		$('.description__item').each(function() {
			slides.push({
				name: $(this).data('slide'),
				height: $(this).outerHeight()
			});
		})

		setSlide(currentSlide);
	}

	setHeight();

	$(window).on('resize', setHeight);

	$('.factory__workshop').on('click', function() {
		var number = $(this).data('number');

		$('.process').removeClass('first second third fourth');

		setSlide(+number);
	})

	$('.js-prev-slide').on('click', function(e) {
		e.preventDefault();
		$('.process').removeClass('first second third fourth');

		if (currentSlide > 0) {
			setSlide(currentSlide - 1);
		} else {
			setSlide(slides.length - 1);
		}
	})
	$('.js-next-slide').on('click', function(e) {
		e.preventDefault();
		$('.process').removeClass('first second third fourth');

		if (currentSlide < slides.length - 1) {
			setSlide(currentSlide + 1);
		} else {
			setSlide(0);
		}
	})

	function setSlide(number) {
		$('.process').addClass(slides[number].name);
		$('.description__list').height(slides[number].height);

		currentSlide = number;
	}

	$('.factory__workshop--1').trigger('click');

	//Карта
	ymaps.ready(init);

	function init() { 
		// Создание карты.  
		var myMap = new ymaps.Map("map", {
			center: [60.060051, 30.126692],
			controls: [],
			zoom: 9
		}, {suppressMapOpenBlock: true});
		var currentLocation = null;

		myMap.behaviors.disable('scrollZoom'); 

		//Запретить перетаскивание двумя пальцами на мобилках
		if ($(window).width() < 768) {
			myMap.behaviors.disable('drag'); 
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
				if (currentLocation) {
					myMap.panTo([currentLocation.lat, currentLocation.lng]);
				}
			}
		});

		
		var zoomControl = new ymaps.control.ZoomControl({options: {layout: ZoomLayout}});
		var locationControl = new ymaps.control.ZoomControl({options: {layout: LocationLayout}});

		myMap.controls.add(zoomControl, {
			float: 'none',
			position: {
				right: '0px',
				top: '0px'
			}
		});

		myMap.controls.add(locationControl, {
			float: 'none',
			position: {
				right: '0px',
				bottom: '0px'
			}
		});

		var myPlacemark = new ymaps.Placemark([60.060051, 30.126692], {}, {
			iconLayout: 'default#image',
			iconImageHref: '/images/map/Point.png'
		});

		myMap.geoObjects.add(myPlacemark);

		//текущая геолокация
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition((position) => {
				var result = {};

				// Текущие координаты.
				result['lat'] = position.coords.latitude;
				result['lng'] = position.coords.longitude;

				currentLocation = result;
			}, (error) => {
				$('#location').hide();
			});
		}
	};
})