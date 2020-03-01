$(function(){
	//Карусель about
	$('.js-carousel').owlCarousel({
		items: 3,
		dots: false,
		nav: false,
		margin: 32,
		responsive: {
			0: {
				items: 1,
				stagePadding: 32,
				loop: true,
				margin: 17,
				dots: true
			},
			768: {
				items: 1,
				stagePadding: 192,
				loop: true,
				margin: 64,
				dots: true
			},
			1024: {
				items: 3,
				margin: 32
			}
		}
	});


	$('.disclamers__opener').on('click', function() {
		$('.disclamers__list').slideToggle(); $(this).toggleClass('open');
	});	
});
