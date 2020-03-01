import { Slider } from '../slider'
import parallax from '../parallax'
import smoothScroll from '../smoothScroll'

$(function() {
	var controller = new ScrollMagic.Controller();

	$(window).on('load', function() {
		$('body').addClass('loaded');
	})

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

	//Появление блока Чемпионат
	var sceneChamp1 = new ScrollMagic.Scene({triggerElement: '.champ1', triggerHook: 1, offset: 150 })
		//.addIndicators({name: id + " (duration: 0)"})
		.addTo(controller);

	sceneChamp1.on('enter', function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	var sceneChamp2 = new ScrollMagic.Scene({triggerElement: '.champ2', triggerHook: 1, offset: 150 })
	//.addIndicators({name: id + " (duration: 0)"})
	.addTo(controller);

	sceneChamp2.on('enter', function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	//Появление блока с командой
	var scene = new ScrollMagic.Scene({triggerElement: '.team', triggerHook: 1, offset: 150 })
			//.addIndicators({name: id + " (duration: 0)"})
			.addTo(controller);

	scene.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	//Слайдер
	var slider = new Slider();

	slider.init('.team__slider');
	
	$('#next').on('click', function(e) {
		e.preventDefault();

		slider.nextSlide();
	})
	$('#prev').on('click', function(e) {
		e.preventDefault();

		slider.prevSlide();
	})

	//Сравнение
	$("#compare").twentytwenty({
		no_overlay: true
	});

	$("#compare").on('move', function(e) {
		var slider = $('.compare__m-description');

		if (e.deltaX > 0) {
			slider.css('transform', 'translateX(-100%)')
		} else {
			slider.css('transform', 'translateX(0)')
		}
	})

	$('.twentytwenty-handle').on('mousedown', function() {
		$(this).addClass('move');
	})
	$('.compare').on('mouseup', function() {
		$('.twentytwenty-handle').removeClass('move');
	})

	parallax();
	$(window).on('resize', parallax);
})