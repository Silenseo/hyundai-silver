$(function() {
  var swiperOffer = new Swiper('.swiper-offer', {
    slidesPerView: 1,
    spaceBetween: 0,
    speed: 600,
    loop: false,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }
  });

  // positioning nav buttons on mobile
  const navButton = $('.swiper-btn'),
        slideImg  = $('.slide__img'),
        isMobile  = window.matchMedia( '(max-width: 640px)' );

  if (isMobile.matches) {
    var buttonTop = slideImg.outerHeight() / 2;
    navButton.css('top', buttonTop + 'px');
  }

  let mobileFlag = false;

  $(window).on('resize', function() {
    if (isMobile.matches) {
      setTimeout(function() {
        var buttonTop = slideImg.outerHeight() / 2;
        navButton.css('top', buttonTop + 'px');
        mobileFlag = true;
      }, 100);      
    } else if (!isMobile.matches && mobileFlag) {
      navButton.css('top', '');
    }
  });
});