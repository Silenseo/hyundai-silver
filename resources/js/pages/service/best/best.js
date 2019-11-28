$(function() {
  var swiperAdv = new Swiper('.swiper-advantages', {
    slidesPerView: 3,
    spaceBetween: 50,
    threshold: 2000,
    breakpoints: {
      900: {
        slidesPerView: 2,
        spaceBetween: 20,
        threshold: 0
      },
      480: {
        slidesPerView: 1,
        spaceBetween: 0,
        threshold: 0
      }
    },
    pagination: {
      el: '.swiper-advantages .swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: '.advantages__slider .swiper-button-next',
      prevEl: '.advantages__slider .swiper-button-prev'
    }
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

    var $el   = e.data.el,
      $this   = $(this),
      $next   = $this.next();
      $header = $('.header-main').height();

    $next.slideToggle();
    $this.parent().toggleClass('active');
    if (window.matchMedia('(max-width: 640px)').matches) {
      setTimeout(function() {
        var scroll_el = $this.parents('.df-accordion').find('.active');
        if (scroll_el.length > 0) {
          $('html, body').animate({ scrollTop: scroll_el.offset().top - $header }, 300);
        }
      }, 500);      
    }

    if (!e.data.multiple) {
      $el.find('.df-accordion__dropgown').not($next).slideUp().parent().removeClass('active');
    }
  }

  var accordion = new Accordion($('.df-accordion'), false);

});