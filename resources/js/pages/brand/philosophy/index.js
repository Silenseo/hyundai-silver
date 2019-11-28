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

	//Появление блока Видение
	var scene3 = new ScrollMagic.Scene({triggerElement: '.vision', triggerHook: 0.5 })
		//.addIndicators({name: "vision (duration: 0)"})
		.addTo(controller);

	scene3.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	//Появление блока Мануфактура
	var scene4 = new ScrollMagic.Scene({triggerElement: '.manufacturing', triggerHook: 0.5 })
		//.addIndicators({name: "manufacturing (duration: 0)"})
		.addTo(controller);

	scene4.on("enter", function (event) {
		$(event.currentTarget.triggerElement()).addClass("active");
	});

	//Слайдер Ценности
	var owl = $('.values__carousel').owlCarousel({
		center: true,
		dots: false,
		nav: false,
		items: 5,
		loop: true,
		smartSpeed: 1000,
		pullDrag: false,
		mouseDrag: false,
		// touchDrag: false,
		// startPosition: 0,
		URLhashListener:true,
		startPosition: 'URLHash',
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 3
			},
			1263: {
				items: 5
			}
		},
		onInitialized: function() {
			$('.values .owl-item.active.center').prev('.owl-item.active').addClass('center-prev');
			$('.values .owl-item.active.center').next('.owl-item.active').addClass('center-next');
		}
	});

	owl.on('changed.owl.carousel', function (event) {
		location.hash = 'slide' + event.property.value;

		setTimeout(()=>{
			$('.values .owl-item').removeClass('center-prev');
			$('.values .owl-item').removeClass('center-next');
			$('.values .owl-item.active.center').prev('.owl-item.active').addClass('center-prev');
			$('.values .owl-item.active.center').next('.owl-item.active').addClass('center-next');
		}, 30)
	})

	
	$('body').on('click', '.values__item', function() {
		if($(window).outerWidth() >= 768) {
			window.location.hash = $(this).data('hash')
		}
	})

	parallax();
	$(window).on('resize', parallax);

	//Philosophy
	function ZoomCircle ($obj, maxRadius, delta, vertical) {
		this.obj = $obj;
		this.maxRadius = maxRadius;
		this.delta = delta;
		this.state = 'initial';
		this.vertical = vertical;

		this.init();
	}

	ZoomCircle.prototype.init = function () {
		this.destroy();
		this.obj.on('click', this.handler.bind(this))
	}

	ZoomCircle.prototype.handler = function () {
		var radius = this.obj.outerWidth() / 2;
		var scale = this.maxRadius / radius;

		$('.circle').removeClass('active');

		if (!this.vertical) {
			if (this.state === 'initial') {
				this.obj.addClass('active')
				this.obj.find('.circle__body').css('transform', 'scale(' + scale + ')');
				$('.circle--1').css('transform', 'translateX(' + (-(radius * scale - radius - this.delta)) + 'px)')
				$('.circle--3').css('transform', 'translateX(' + (radius * scale - radius - this.delta) + 'px)')
				this.state = 'zoom';
			} else {
				this.obj.removeClass('active')
				this.obj.find('.circle__body').css('transform', 'scale(1)');
				$('.circle--1').css('transform', 'translateX(' + this.delta + 'px)')
				$('.circle--3').css('transform', 'translateX(' + (-this.delta) + 'px)')
				this.state = 'initial';
			}
		} else {
			if (this.state === 'initial') {
				this.obj.addClass('active').parent('.philosophy__wrapper').css('z-index', 2);
				this.obj.find('.circle__body').css('transform', 'scale(' + scale + ')');
				this.state = 'zoom';
			} else {
				this.obj.removeClass('active').parent('.philosophy__wrapper').css('z-index', 0);
				this.obj.find('.circle__body').css('transform', 'scale(1)');
				this.state = 'initial';
			}
		}
	}

	ZoomCircle.prototype.destroy = function () {
		this.obj.off('click')
	}
	
	var circle2;

	circleInit();

	$(window).on('resize', circleInit);

	function circleInit() {
		if ($(window).outerWidth() > 1599) {
			circle2 = new ZoomCircle($('.circle--2'), 250, 30);
		} else if ($(window).outerWidth() > 1262) {
			circle2 = new ZoomCircle($('.circle--2'), 200, 30);
		} else if ($(window).outerWidth() > 767) {
			circle2 = new ZoomCircle($('.circle--2'), 176, 30);
		} else {
			circle2 = new ZoomCircle($('.circle--2'), 150, 0, true);
		}
	}
	
	
	//$('.circle--2').trigger('click');

	$('.circle--1, .circle--3').on('click', function () {
		$('.circle').removeClass('active');
		if (circle2.state === 'zoom') {
			$('.circle--2').trigger('click')
		}
		
		$(this).addClass('active');
	})
	$('.subcircle').on('click', function () {
		$('.circle').removeClass('active');
	})

	//закрыть всё
	$('.philosophy').on('click', function(e){
		var $target = $(e.target);

		if ($target.closest('.circle').length === 0) {
			$('.circle').removeClass('active');
			if (circle2.state === 'zoom') {
				$('.circle--2').trigger('click')
			}
		}
	})
	
})

class CircleWave {
	constructor (obj, filter) {
		var that = this;

		this.obg = document.querySelectorAll(obj)[0];
		this.turbVal = { val: 0.000001 };
		this.turb = document.querySelectorAll(filter + ' feTurbulence')[0];
		this.pause = false;
		this.anim = new TimelineLite({ 
			paused: true,
			onUpdate: function() {
				that.turb.setAttribute('baseFrequency', '0 ' + that.turbVal.val);
			},
			onComplete: function() {
				that.pause = false;
			}
		});

		this.init();
	}
	init () {
		var that = this;

		this.anim
			.to(this.turbVal, 1.5, { val: 0.020 })
			.to(this.turbVal, 1.5, { val: 0.000001 });

		this.obg.addEventListener('mousemove', function() {
			if (!that.pause) {
				that.anim.restart();
				that.pause = true;
			}
		});
	}
}

new CircleWave('.circle--1', '#noise1')
new CircleWave('.subcircle--11', '#noise11')
new CircleWave('.subcircle--12', '#noise12')
new CircleWave('.subcircle--13', '#noise13')
new CircleWave('.circle--2', '#noise2')
new CircleWave('.circle--3', '#noise3')
new CircleWave('.subcircle--21', '#noise21')
new CircleWave('.subcircle--22', '#noise22')
new CircleWave('.subcircle--23', '#noise23')