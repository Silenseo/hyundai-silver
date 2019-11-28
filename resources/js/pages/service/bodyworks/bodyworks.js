$(function() {
  var swiperAdv = new Swiper('.swiper-advantages', {
    slidesPerView: 4,
    spaceBetween: 48,
    loop: true,
    breakpoints: {
      1200: {
        slidesPerView: 3,
        spaceBetween: 40
      },
      900: {
        slidesPerView: 2,
        spaceBetween: 30
      },
      600: {
        slidesPerView: 1,
        spaceBetween: 0
      }
    },    
    pagination: {
      el: '.swiper-advantages .swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: '.advantages-slider .swiper-button-next',
      prevEl: '.advantages-slider .swiper-button-prev'
    }
  });

  var swiperRepair = new Swiper('.swiper-repair', {
    speed: 500,
    threshold: 20,
    navigation: {
      nextEl: '.repair-slider .swiper-button-next',
      prevEl: '.repair-slider .swiper-button-prev'
    }
  });

  var circle    = $('.repair__item'),
      circleMob = $('.repair__item-circle--mobile');

  circle.on('click', function() {
    $(this).parent().find(circle).removeClass('repair__item--active');
    $(this).addClass('repair__item--active');
  });

  circleMob.on('click', function() {
    var dataItem = $(this).data('item');
    console.log(dataItem);
    $(this).parent().find(circle).removeClass('repair__item--active');
    $(this).parent().find(circleMob).removeClass('repair__item-circle--active');
    $('.repair__item[data-item="' + dataItem + '"]').addClass('repair__item--active');
    $(this).addClass('repair__item-circle--active');
  });

  var headLink = $('.head .df-download-img-link');

  headLink.on('click', function () {
    var header; 
    $('.header-main').css('position') == ('fixed') ? header = $('header').outerHeight() : header = 0; 
    $('html, body').animate({
      scrollTop: $("#repair").offset().top - header
    }, 700);
  });

  // var tabButton  = $('.df-tabs__button'),
  //     tabSection = $('.insurance-section'); 
  
  // tabButton.on('click', function() {
  //   var tab = $(this).data('button');
  //   tabButton.removeClass('df-tabs__button--active');
  //   tabSection.removeClass('insurance-section--active');
  //   $(this).addClass('df-tabs__button--active');
  //   $('.insurance-inner').find('.insurance-section[data-row="'+ tab + '"]').addClass('insurance-section--active');
  // });

  //popup
  var osagoLink  = $('.osago__link'),
      popupRules = $('.rules'),
      rulesClose = $('.rules__close'),
      popupWrap  = $('.df-popup__wrap');

  osagoLink.on('click', function(e) {
    e.preventDefault();
    popupRules.fadeIn(400);
  });

  rulesClose.on('click', function(e) {
    e.preventDefault();
    popupRules.fadeOut(400);
  });

  $(document).mouseup(function (e) {
		if (!popupWrap.is(e.target) 
		  && popupWrap.has(e.target).length === 0) { 
      popupRules.fadeOut(400);
		}
  });
  
  $(document).keydown(function(e) {
    if (e.keyCode == 27) {
      popupRules.fadeOut(400);
    }
  });

});