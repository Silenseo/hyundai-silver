import Vue from 'vue'
import store from '../../../vue/store-service'

//Чтобы store был доступен из вне, для создания событий открытия окон
window.vueStore = store;

new Vue({
	el: '#servicepopup',
	store,
	data () {
		return {
			isInit: false,
			popups: 0
		}
	},
	components: {
		'sign-up-service-form-popup': () => import('../../../vue/components/common/SignUpServiceFormPopup.vue')
	},
	computed: {
		isVisible: function () {
			if (this.$store.state.openTestDrivePopup) {
				this.isInit = true;
			}

			return this.isInit;
		},
	},
	methods: {
		fixOverflow (makeFixed) {
			if (makeFixed === true) {
				document.body.style.overflow = 'hidden'
				this.popups++
			} else {
				this.popups--

				if (this.popups === 0) {
					document.body.style.overflow = ''
				}
			}
		}
	},
	mounted: function () {
		this.$root.$on('fixOverflow', this.fixOverflow)
	}
});

$(function() {
	//Открываем попап записи на сервис
	var masterCar = '';

	$('.js-checkout-service').on('click', function (e) {
		e.preventDefault();

		switch (masterCar) {
			case 'SOLARIS New':
				masterCar = 'solaris';
				break;
			case 'Sonata New':
				masterCar = 'sonata';
				break;
		
			default:
				break;
		}
		//Установим активной модель. Св-во code!!!!!!
		vueStore.dispatch('SET_SAVED_MODEL', masterCar);
		vueStore.dispatch('SET_MODEL', masterCar);
		vueStore.dispatch('OPEN_TEST_DRIVE_POPUP', true);
	})

	var carSelect = $('#js-model-select').selectize({
    labelField: "label",
    valueField: "value",
    render: {
      item: function(data) {
        return "<div data-code='"+data.code+"' class='item-active'>"+data.label+" </div>";
      }
    },
	  onChange: function (e) {
      var _model = arguments[0];
      $('.volume').hide().filter('[data-car=' + _model + ']').show();  
      setTimeout(function() {
        $('.selection-car__title').text($('.item-active').text());
      }, 0);
      $('.selection-car__img').attr('src', '/images/service/shell/cars/' + _model + '.png');

      masterCar = $('.item-active').data('code');
	  },
	  openOnFocus: false,
	  onInitialize: function() {
      var that = this;
    
      this.$control.on('click', function() {
        that.ignoreFocusOpen = true;
        setTimeout(function () {
        that.ignoreFocusOpen = false;
        }, 50);
      });
	  },
	  onFocus: function() {
      if (!this.ignoreFocusOpen) {
        this.open();
      }
	  }
	});
  
	// Set the default car model before init $('#js-model-select').find('option').eq(1).value
	carSelect[0].selectize.setValue('solarisnew')
	
	new PerfectScrollbar('#js-model-select+.selectize-control .selectize-dropdown-content', {
	  wheelSpeed: 2,
	  minScrollbarLength: 20
	});
  
	// Set the default model year before init
	$('#js-year-select').find('option').last().attr('selected', 'selected');
  
	$('#js-year-select').selectize({
	  openOnFocus: false,
	  onInitialize: function() {
		var that = this;
  
		this.$control.on('click', function() {
		  that.ignoreFocusOpen = true;
		  setTimeout(function () {
			that.ignoreFocusOpen = false;
		  }, 50);
		});
	  },
	  onFocus: function() {
		if (!this.ignoreFocusOpen) {
		  this.open();
		}
	  }
	});
  
	new PerfectScrollbar('#js-year-select+.selectize-control .selectize-dropdown-content', {
	  wheelSpeed: 2,
	  minScrollbarLength: 20
	});
  
	var Accordion = function (el, multiple) {
	  this.el = el || {};
	  this.multiple = multiple || false;
  
	  var dropdownlink = this.el.find('.js-open-section');
	  dropdownlink.on('click',
		{ el: this.el, multiple: this.multiple },
		this.dropdown);
	};
  
	Accordion.prototype.dropdown = function(e) {
	  e.preventDefault();
  
	  var $el = e.data.el,
		$this = $(this),
		$next = $this.next();
  
	  $next.slideToggle();
	  $this.parent().toggleClass('active');
  
	  if (!e.data.multiple) {
		$el.find('.df-accordion__dropgown').not($next).slideUp().parent().removeClass('active');
	  }
	}
  
	var accordion       = new Accordion($('#accordion-questions'), false),
		accordionPopup1 = new Accordion($('.popup-accordion'), false);
  
	var tab = $('.df-tabs__button');
	tab.on('click', function(e) {
	  e.preventDefault();
	  tab.removeClass('df-tabs__button--active');
	  $(this).addClass('df-tabs__button--active');
	});
  
	var videos = {
	  init: function () {
		var self = this;
		self.el = $('[data-role="js-video"]')
		$('#videobg__tech').volume = 1;
		self.bind();
	  },
	  bind: function () {
		var self = this;
		self.el.on('click', self.exeVideo);
	  },
	  exeVideo: function() {
		var self = this;
		if ($('.tech__content').hasClass('is-playing')) {
		  $('.tech__content').removeClass('is-playing');
		  $('.video-container').fadeOut(500);
		  $('.video-play').fadeIn(500);
		  document.getElementById('video__tech').pause();
		  $('.video-preview').css('visibility', 'visible');
		}
		else {
		  var _this = $(this);
		  _this.addClass('is-playing');
		  _this.find('.video-container').fadeIn(500);
		  _this.find('.video-play').fadeOut(500);
		  _this.find('.video-preview').css('visibility', 'hidden');
		  document.getElementById('video__tech').play();
		}
		return false;
	  },
	  stopVideo: function() {
		$('.tech__content').removeClass('is-playing');
		$('.video-container').fadeOut(500);
		document.getElementById('video__tech').pause();
		$('.video-preview').fadeIn(500);
	  }
	};
  
	videos.init();
  
	$(document).on('click', '.choice__item', function (e) {
	  e.preventDefault();
	  var product = $(this).data('product');
	  var modal = $('.product-wrap[data-product="' + product + '"]');
	  modal.fadeIn();
	  if (modal.children('.product-popup').height() > modal.height()) {
		modal.children('.product-popup').css({'margin-top': '40px', 'top': '0'});
		new PerfectScrollbar('.product-wrap[data-product="' + product + '"]', {
		  wheelSpeed: 2,
		  minScrollbarLength: 20
		});
	  }
	  });
  
	  $(document).on('click', '.closeIt', function(e) {
		  e.preventDefault();
		  $('.overlayed').fadeOut();
	});
  
	$(document).mouseup(function(e) {
	  var container = $('.overlayed');
	  if (container.has(e.target).length === 0) {
		container.fadeOut();
	  }
	});
  
	$('.select-button').on('click', function(e) {
	  e.preventDefault();
	  $('.choice').slideDown(300);
	  var volume = $('.volume:visible').find('.df-tabs__button--active').data('volume'),
		  oil    = $('.volume:visible').find('.df-tabs__button--active').data('oil');
	  $('.volume-value').text(volume);
	  $('.choice').attr('data-oil', oil);
	  setTimeout(function() {
		$('body,html').animate({
		  scrollTop: $('.choice').offset().top
		}, 300);
	  }, 20);
	});
  
	
  });