document.addEventListener("DOMContentLoaded", function() {
	$(".js-carousel").owlCarousel({
		margin: 16,
		autoWidth: true,
		responsive: {
			641: {
				margin: 32
			}
		}
	});

	var parallax1, parallax2;

	function setParallax () {
		if (!parallax1 && !parallax2 && window.innerWidth >= 1024) {
			parallax1 = new Rellax('.js-parallax-1', {
				speed: -1,
				center: true
			});
		
			parallax2 = new Rellax('.js-parallax-2', {
				speed: -3,
				center: true
			});
		} else if (parallax1 && parallax2 && window.innerWidth < 1024) {
			parallax1.destroy()
			parallax2.destroy()
			parallax1 = null
			parallax2 = null
		}
		
	}

	window.addEventListener('resize', setParallax)

	setParallax()
})