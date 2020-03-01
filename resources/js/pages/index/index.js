$(document).ready(function () {
	var oldWindowWidth = 0,
		videosList = document.querySelectorAll('.slider__video');

	videoInit()

	$(window).on('resize', videoInit);

	function videoInit() {
		var windowWidth = $(window).outerWidth();

		//Для iOs
		if (oldWindowWidth === windowWidth) {
			return null;
		}

		oldWindowWidth = windowWidth;

		[].forEach.call(videosList, (video)=>{
			let $video = $(video);
			let desctopSRC = video.dataset.desctopVideo;
			let mobileSRC = video.dataset.mobileVideo;

			if (windowWidth > 640) {
				if ($video.find('.desctop-video').length > 0) {
					return null;
				}
				$video.html('');

				$video.append(
					'<video class="desctop-video" muted autoplay playsinline loop data-object-fit="cover">' +
					'<source src="' + desctopSRC + '">' +
					'</video>'
				)
			} else {
				if ($video.find('.mobile-video').length > 0) {
					return null;
				}
				$video.html('');

				$video.append(
					'<video class="mobile-video" muted autoplay loop playsinline>' +
					'<source src="' + mobileSRC + '">' +
					'</video>'
				)
			}
		})
	}

	objectFitPolyfill();

    $(".js-main-slider").owlCarousel({
        items: 1,
        autoplay: true,
        animateOut: 'fadeOut',
		animateIn: 'fadeIn',
		loop: true,
		nav: true,
		navText: ['<svg viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 1L1.57619 8.3415C1.24629 8.71852 1.24629 9.28148 1.57619 9.6585L8 17" stroke="white" stroke-width="2"/></svg>', '<svg viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 17L7.42381 9.6585C7.75371 9.28148 7.75371 8.71852 7.42381 8.3415L1 0.999999" stroke="white" stroke-width="2"/></svg>']
	});

	// Остановить автоматическую смену слайдов при клике
	$(".js-main-slider").on('click', function() {
		$(".js-main-slider").trigger('stop.owl.autoplay')
	})

	if (process.env.MIX_BUILD !== 'dealer') {
		$(".js-news-slider").owlCarousel({
			items: 4,
			dots: false,
			responsive: {
				0: {
					items: 1,
					dots: true,
					nav: true,
					autoHeight: true,
					navText: ['<div class="news__prev"><svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 125;" xml:space="preserve"><path d="M71.6,107.5c-0.7,0-1.3-0.2-1.8-0.7L27,64.7c-0.7-0.5-1.2-1.3-1.2-2.2c0-0.8,0.4-1.6,1-2.1l42.5-42.2c1-1,2.7-1,3.7,0s1,2.6,0,3.7L32.2,62.5l41.2,40.6c1,1,1,2.6,0,3.7C72.9,107.2,72.2,107.5,71.6,107.5z"/></svg></div>', '<div class="news__next"><svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 125;" xml:space="preserve"><path d="M71.6,107.5c-0.7,0-1.3-0.2-1.8-0.7L27,64.7c-0.7-0.5-1.2-1.3-1.2-2.2c0-0.8,0.4-1.6,1-2.1l42.5-42.2c1-1,2.7-1,3.7,0s1,2.6,0,3.7L32.2,62.5l41.2,40.6c1,1,1,2.6,0,3.7C72.9,107.2,72.2,107.5,71.6,107.5z"/></svg></div>']
				},
				768: {
					items: 2,
					dots: true,
					nav: true,
					autoHeight: false,
					navText: ['<div class="news__prev"><svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 125;" xml:space="preserve"><path d="M71.6,107.5c-0.7,0-1.3-0.2-1.8-0.7L27,64.7c-0.7-0.5-1.2-1.3-1.2-2.2c0-0.8,0.4-1.6,1-2.1l42.5-42.2c1-1,2.7-1,3.7,0s1,2.6,0,3.7L32.2,62.5l41.2,40.6c1,1,1,2.6,0,3.7C72.9,107.2,72.2,107.5,71.6,107.5z"/></svg></div>', '<div class="news__next"><svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 125;" xml:space="preserve"><path d="M71.6,107.5c-0.7,0-1.3-0.2-1.8-0.7L27,64.7c-0.7-0.5-1.2-1.3-1.2-2.2c0-0.8,0.4-1.6,1-2.1l42.5-42.2c1-1,2.7-1,3.7,0s1,2.6,0,3.7L32.2,62.5l41.2,40.6c1,1,1,2.6,0,3.7C72.9,107.2,72.2,107.5,71.6,107.5z"/></svg></div>']
				},
				1280: {
					items: 4
				}
			}
		});
	}
});

//	homepage model
// components
// homepage configurator
	var homeVM = new Vue({
		el: '#config',
		data: {
			hcData: [{bg:''}],
			hcCurrentIdx: 0,
			hcTL: new TimelineMax({ paused: true }),
			hcNavTL: new TimelineMax({ paused: true }),
			hcbgTL: new TimelineMax({ paused: true }),
			hcSpeed: .75,
			hcAnimating: false,
			direction: 'next',
			hcNextbg: '',
			flag: true,
			init: false
		},
		methods: {
			getData: function() {
				this.hcData = configJSON;
				this.cacheImgs(this.hcCacheArray)
				this.hcNextbg = this.hcData[0].bg

				// axios.get('/config_data.json')
				//     .then(function (response) {
				//         that.hcData = response.data;
				//         that.cacheImgs(that.hcCacheArray)
				//         that.hcNextbg = that.hcData[0].bg
				//     })
				//     .catch(function (error) {
				//         console.log(error);
				//     });
			},
			goToPage: function(index) {
				if (index > this.hcCurrentIdx) {
					this.direction = 'next'
					this.hcUpdate(index);
				} else if (index < this.hcCurrentIdx) {
					this.direction = 'prev'
					this.hcUpdate(index);
				}
			},
			cacheImgs: function (imgs) {
				if (!imgs) return;
				if (!this.cacheImgs.list) {
					this.cacheImgs.list = [];
				}
				var list = this.cacheImgs.list;
				for (var i = 0; i < imgs.length; i++) {
					var img = new Image();
					img.onload = function () {
						var _index = list.indexOf(this);
						if (_index !== -1) {
							list.splice(_index, 1);
						}
					}
					list.push(img);
					img.src = imgs[i];
				}
			},
			hcPrev: function () {
				this.direction = 'prev'
				this.hcUpdate(this.hcCurrentIdx > 0 ? this.hcCurrentIdx - 1 : this.hcTotal)
			},
			hcNext: function () {
				this.direction = 'next'
				this.hcUpdate(this.hcCurrentIdx < this.hcTotal ? this.hcCurrentIdx + 1 : 0)
			},
			hcUpdate: function (_index) {
				var _prev = document.querySelectorAll('.config__nav-item--prev'),
					_next = document.querySelectorAll('.config__nav-item--next'),
					_prevText = document.querySelectorAll('.config__nav-item--prev .config__item-title'),
					_nextText = document.querySelectorAll('.config__nav-item--next .config__item-title'),
					_car = document.querySelectorAll('.hc-car'),
					_carStep1 = this.direction === 'next' ? '-100%' : '100%',
					_carStep2 = this.direction === 'next' ? '100%' : '-100%',
					_carStep3 = '0%',
					_bg1 = document.querySelectorAll('.hc-bg.hc-bg--next'),
					_text = document.querySelectorAll('.hc-title-clip > *'),
					_btn = document.querySelectorAll('.hc-go-conf');
				// no more needed to animate badge sticker
				// 				_badge = document.querySelectorAll('.hc-badge');

				this.hcAnimating = true;
				this.hcNextbg = this.direction === 'next' ? this.hcData[_index].bg : this.hcData[_index].bg;

				this.hcbgTL
					.fromTo(_bg1, this.hcSpeed, {
						opacity: 0,
						ease: Power3.easeInOut
					}, {
							opacity: 1,
							ease: Power3.easeInOut
						})

				this.hcTL
					.fromTo([_car, _text, _btn], this.hcSpeed, {
						x: _carStep3,
						ease: Power3.easeInOut
					}, {
							x: _carStep1,
							ease: Power3.easeInOut,
							callbackScope: this,
							onComplete: function () {
								this.hcCurrentIdx = _index;
								this.hcAnimating = false;
							}
						})
					.set([_car, _text, _btn], { x: _carStep2 })
					.call(function () {
						this.hcCurrentIdx = _index;
					})
					.to([_car, _text, _btn], this.hcSpeed, {
						x: _carStep3,
						ease: Power3.easeInOut
					})

				this.hcNavTL.restart()
				this.hcNavTL
					.to(_prev, this.hcSpeed, {
						alpha: 0,
						ease: Power3.easeInOut
					}, 0)
					.to(_prevText, this.hcSpeed * .75, {
						alpha: 0,
						ease: Power3.easeInOut
					}, 0)
					.to(_nextText, this.hcSpeed * .75, {
						alpha: 0,
						ease: Power3.easeInOut
					}, 0)
					// no more needed to animate badge sticker
					/*
									.to(_badge, this.hcSpeed/2, {
										scale: 0,
										ease: Back.easeIn.config(3),
										delay: this.hcSpeed/2
									}, 0)
					*/
					.to(_next, this.hcSpeed, {
						alpha: 0,
						ease: Power3.easeInOut,
						callbackScope: this,
						onComplete: function () {
							this.hcNavTL.reverse(0)
						}
					}, 0)
				/*
							this.hcNavTL
								.to(_prev, this.hcSpeed, {
									x: '-120%',
									ease: Power3.easeInOut
								}, 0)
								.to(_prevText, this.hcSpeed*.75, {
									x: -200,
									ease: Power3.easeInOut
								}, 0)
								.to(_nextText, this.hcSpeed*.75, {
									x: 200,
									ease: Power3.easeInOut
								}, 0)
								.to(_badge, this.hcSpeed/2, {
									scale: 0,
									ease: Back.easeIn.config(3),
									delay: this.hcSpeed/2
								}, 0)
								.to(_next, this.hcSpeed, {
									x: '150%',
									ease: Power3.easeInOut,
									callbackScope: this,
									onComplete: function(){
										this.hcNavTL.reverse(0)
									}
								}, 0)
				*/

				this.hcbgTL.play()
				this.hcTL.play()
				this.hcNavTL.play()

				this.cacheImgs(this.hcCacheArray)
			}
		},
		computed: {
			hcTotal: function () {
				return this.hcData.length - 1
			},
			hcPrevIdx: function () {
				return this.hcCurrentIdx > 0 ? this.hcCurrentIdx - 1 : this.hcTotal;
			},
			hcNextIdx: function () {
				return this.hcCurrentIdx < this.hcTotal ? this.hcCurrentIdx + 1 : 0;
			},
			hcCacheArray: function () {
				var bgArray = [this.hcData[this.hcPrevIdx].bg, this.hcData[this.hcNextIdx].bg],
					carArray = [this.hcData[this.hcPrevIdx > 0 ? this.hcPrevIdx - 1 : this.hcTotal].picture, this.hcData[this.hcNextIdx < this.hcTotal ? this.hcNextIdx + 1 : 0].picture];

				return carArray.concat(bgArray)
			}
		},
		filters: {
			currencyFormat: function (value) {
				return parseInt(value).toLocaleString('ru-RU')
			}
		},
		mounted: function () {
			this.getData();

			//Добавляем смену слайдов по свайпу
			var that = this;

			that.init = true;

			this.$nextTick(function () {
				var square = document.querySelector('.config__holder');

				var manager = new Hammer.Manager(square, {touchAction: 'pan-y'});

				var Swipe = new Hammer.Swipe();

				manager.add(Swipe);

				var deltaX = 0;
				var deltaY = 0;

				manager.on('swipe', function(e) {
					deltaX = deltaX + e.deltaX;
					var direction = e.offsetDirection;

					if (direction === 4) {
						that.hcPrev()
					} else if (direction === 2) {
						that.hcNext()
					}
				});
			})
		}
	})
