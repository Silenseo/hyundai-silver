import Vue from 'vue'
import smoothScroll from '../smoothScroll'
import videoInit from '../videoInit'

Vue.component('extra-gallery', require('../../../vue/components/common/ExtraGallery.vue'));

const app = new Vue({
    el: '#app'
});

$(function(){
	var controller = new ScrollMagic.Controller();

	videoInit();

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

	$('.df-slideUp').each(function() {
		var scene = new ScrollMagic.Scene({triggerElement: this, triggerHook: 1, offset: 150 })
			.addTo(controller);

		scene.on("enter", function (event) {
			$(event.currentTarget.triggerElement()).addClass("active");
		});
	})

	$(window).on('load', function() {
		$('body').addClass('loaded');
	})

	//Появление блока с годом
	var scene = new ScrollMagic.Scene({triggerElement: '.year', triggerHook: 1, offset: 150 })
	//.addIndicators({name: id + " (duration: 0)"})
	.addTo(controller);

	scene.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	//Фиксация года
	var yearFixDuration = $('.history').outerHeight() - $('.year__centuries').outerHeight() - $('.year__decades').outerHeight() - $(window).outerHeight() / 5;

	var yearFix = new ScrollMagic.Scene({triggerElement: ".year", duration:  yearFixDuration, triggerHook: 0, offset: -50 })
		.setPin(".year")
		//.addIndicators({name: "year (duration: 0)"}) // add indicators (requires plugin)
		.addTo(controller);

	var yearFixDurationRu = $('.history--ru').outerHeight() - $('.year__centuries').outerHeight() - $('.year__decades').outerHeight() - $(window).outerHeight() / 3;

	var yearFixRu = new ScrollMagic.Scene({triggerElement: ".year--ru", duration:  yearFixDurationRu, triggerHook: 0, offset: -50 })
		.setPin(".year--ru")
		//.addIndicators({name: "year (duration: 0)"}) // add indicators (requires plugin)
		.addTo(controller);

	//Фиксация временной шкалы
	var timeFixDuration = $('.history').outerHeight() + $('.history--ru').outerHeight() - $('.time-line').outerHeight();

	var timeFix = new ScrollMagic.Scene({triggerElement: ".time-line", duration: timeFixDuration, triggerHook: 0.5 })
		.setPin(".time-line")
		//.addIndicators({name: "time-line (duration: 0)"}) // add indicators (requires plugin)
		.addTo(controller);

	//Мобильная шкала
	var timeFixDurationMobile = $('.history').outerHeight() + $('.history--ru').outerHeight() - $('.time-line').outerHeight() - $(window).outerHeight() / 2;

	var timeFix = new ScrollMagic.Scene({triggerElement: ".m-time-line", duration: timeFixDurationMobile, triggerHook: 0.5 })
		.setPin(".m-time-line")
		//.addIndicators({name: "m-time-line (duration: 0)"}) // add indicators (requires plugin)
		.addTo(controller);

	//Анимация графиков
	var graphAnimation =new ScrollMagic.Scene({triggerElement: ".after", triggerHook: 0.5 })
		//.addIndicators({name: "graph (duration: 0)"}) // add indicators (requires plugin)
		.addTo(controller);

	graphAnimation.on("enter", function () {
		$(".after").addClass("active");
	});

	//Обновить страницу при переходе из планшета на десктоп
	var oldWindowWidth = $(window).outerWidth();

	$(window).on('resize', function(){
		if ((oldWindowWidth < 1263 && $(window).outerWidth() >= 1263) || (oldWindowWidth >= 1263 && $(window).outerWidth() < 1263)) {
			location.href = location.href;
		}
		
		rellax.refresh();

		//обновим позицию зафиксированных больших цифр
		yearFix.destroy(true);
		yearFix = new ScrollMagic.Scene({triggerElement: ".year", duration:  yearFixDuration, triggerHook: 0, offset: -50 })
			.setPin(".year")
			.addTo(controller);

		yearFixRu.destroy(true);
		yearFixRu = new ScrollMagic.Scene({triggerElement: ".year--ru", duration:  yearFixDurationRu, triggerHook: 0, offset: -50 })
			.setPin(".year--ru")
			.addTo(controller);
	})

	//Анимация года
	yearAnimation(2007);
	yearAnimation(1968);

	function yearAnimation (year) {
		var allowDates = [];

		$('.time-line__link').each(function(){
			allowDates.push(parseInt($(this).text()));
		})

		if ($(window).outerWidth() >= 1263) {
			if (allowDates.indexOf(+year) < 0) {
				return null;
			}
	
			var obj = '',
				a = 1,
				i = ("" + year).split("");
	
			if (year >= 2007) {
				obj = '.history--ru'
			} else {
				obj = '.history--ww'
			}
	
			TweenMax.to(obj + ' .year__digit--first', 0.3, {
				y: "-" + (((+i[0] + a) % 10) * 100) + "%" 
			})
			TweenMax.to(obj + ' .year__digit--second', 0.6, {
				y: "-" + (((+i[1] + a) % 10) * 100) + "%" 
			})
			TweenMax.to(obj + ' .year__digit--third', 0.8, {
				y: "-" + (((+i[2] + a) % 10) * 100) + "%" 
			})
			TweenMax.to(obj + ' .year__digit--fourth', 1.1, {
				y: "-" + (((+i[3] + a) % 10) * 100) + "%" 
			})
	
			$('.time-line__link').closest('.time-line__item').removeClass('active');
			$('.time-line__link').closest('.time-line__list').removeClass('active');
	
			$('.time-line__link[href="#' + year + '"]').closest('.time-line__list').addClass('active');
			$('.time-line__link[href="#' + year + '"]').closest('.time-line__item').addClass('active');
		} else {
			var index = 0,
				indexes = [];

			$('.m-time-line__item').each(function(i){
				if (+$(this).text() === +year) {
					index = i;
				}
			})

			for (var i = index; i >= 0; i--) {
				indexes.unshift(index - i);
			}

			for (var i = index; i < index + 7; i++) {
				indexes.push(i - index);
			}

			$('.m-time-line__item').attr('class', 'm-time-line__item');

			$('.m-time-line__item').each(function(i){
				indexes.forEach((j)=>{
					if (i === (index - j) || i === (index + j)) {
						$(this).addClass('opa-' + j)
					}
				})
			})

			TweenMax.to('.m-time-line__list', 0.5, {
				y: "-" + (index * 100) + "%" 
			})
		}
	}

	var dates = [];

	//Расстановка триггеров для блоков
	$('.scrollmagic').each(function(){
		var scene = new ScrollMagic.Scene({triggerElement: this, triggerHook: 1, offset: 150 })
			//.addIndicators({name: "before (duration: 0)"})
			.addTo(controller);

		scene.on("enter", function (event) {
			$(event.currentTarget.triggerElement()).addClass("active");
		});

		if ($(this).find('.df-description').length > 0) {
			var description = this.querySelector('.df-description');

			var scene1 = new ScrollMagic.Scene({triggerElement: description, triggerHook: 1, offset: 150 })
				//.addIndicators({name: "before description (duration: 0)"})
				.addTo(controller);

			scene1.on("enter", function (event) {
				$(event.currentTarget.triggerElement()).addClass("active");
			});
		}
		
	})

	//Появление блока Философия
	var scene3 = new ScrollMagic.Scene({triggerElement: '.philosophy', triggerHook: 0.5 })
	//.addIndicators({name: "item (duration: 0)"})
	.addTo(controller);

	scene3.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	$('.history__item').each(function() {
		var scene = new ScrollMagic.Scene({triggerElement: this, triggerHook: 0.5, duration: $(this).outerHeight(true) })
			//.addIndicators({name: "item (duration: 0)"})
			.addTo(controller);

		scene.on("enter", function (event) {
			yearAnimation(event.currentTarget.triggerElement().getAttribute("data-year"));
		});

		//Заполнение датами мобильной линии дат
		var date = $(this).data('year')

		if (date && dates.indexOf(date) < 0) {
			$('.m-time-line__list').append('<li class="m-time-line__item">' + date + '</li>');
			dates.push(date);
		}
	})

	$('.history__item').each(function() {
		var scene = new ScrollMagic.Scene({triggerElement: this, triggerHook: 0.9, duration: $(this).outerHeight(true) })
			//.addIndicators({name: "item (duration: 0)"})
			.addTo(controller);

		scene.on("enter", function (event) {
			$(".history__item[data-year=\"" + event.currentTarget.triggerElement().getAttribute("data-year") + "\"]").addClass("active")
		});
	})
})

//Parallax
var rellax = new Rellax('.history__wrapper', {
	speed: 0.5,
	center: true
});


//Скролл до якоря
$('.time-line__link').on('click', function(e){
	e.preventDefault();

	$('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top }, 500);
})
