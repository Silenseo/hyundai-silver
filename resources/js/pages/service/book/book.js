$(function() {
	$('.js-show-more').on('click', function (e) {
		e.preventDefault();

		$(this).toggleClass('active');

		if ($(this).hasClass('active')) {
			$(this).find('span').text('Скрыть');
		} else {
			$(this).find('span').text('Узнать больше');
		}

		$(this).closest('.row').find('.collapsed').slideToggle();
	})
})