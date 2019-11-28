$(document).ready(function(){
	//Фиксирование меню
	var controller = new ScrollMagic.Controller();
	
	var fixMenu = new ScrollMagic.Scene({ triggerElement: ".nav", duration: '0', triggerHook: '0' })
		.setPin('.nav')
		.addTo(controller);

	$(window).on('resize', function () {
		checkMenuOffset();
	})
	
	checkMenuOffset();

	function checkMenuOffset () {
		if ($(window).outerWidth() < 1263) {
			fixMenu.offset(-56);
		} else {
			fixMenu.offset(0);
		}
	}

    $('#gallery').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '#gallery-nav',
        infinite: true,
        lazyLoad: 'ondemand',
    });
    $('#gallery-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '#gallery',
        dots: false,
        centerMode: true,
        focusOnSelect: true
    });

    $('.gallery__total').text(formatOutput($('.gallery__item').not('.slick-cloned').length));
    $('.gallery__download').attr('href', $('.gallery__item.slick-current').data('image'));

    $('#gallery').on('afterChange', function(event, slick, currentSlide, nextSlide){
        $('.gallery__current').text(formatOutput(currentSlide+1));
        $('.gallery__download').attr('href', $('.gallery__item.slick-current').data('image'));
    });

    function formatOutput(data) {
        if (typeof data === 'undefined') { return null; }
        data = ''+data;
        if (data.length === 1) {
            return '0'+data;
        } else {
            return data;
        }
    }
});
