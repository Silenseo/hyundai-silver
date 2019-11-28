export default function () {
	var oldWindowWidth = 0;

	videoInit()

	$(window).on('resize', videoInit);

	function videoInit() {
		var windowWidth = $(window).outerWidth();

		//Для iOs
		if (oldWindowWidth === windowWidth) {
			return null;
		}

		oldWindowWidth = windowWidth;
		
		if (windowWidth > 1599) {
			if ($('.large-video').length > 0) {
				return null;
			}
			$('.banner__inner').html('');
			$('.banner__inner').append(
				'<video class="large-video" loop muted autoplay playsinline data-object-fit="cover">' + 
				'<source src="/images/brand/common/video/Gradient2.mp4">' +
				'</video>'
			)
		} else if (windowWidth > 1023) {
			if ($('.medium-video').length > 0) {
				return null;
			}
			$('.banner__inner').html('');
			$('.banner__inner').append(
				'<video class="medium-video" loop muted autoplay playsinline data-object-fit="cover">' + 
				'<source src="/images/brand/common/video/Gradient2.mp4">' +
				'</video>'
			)
		} else if (windowWidth > 767) {
			if ($('.small-video').length > 0) {
				return null;
			}
			$('.banner__inner').html('');
			$('.banner__inner').append(
				'<video class="small-video" loop muted autoplay playsinline>' + 
				'<source src="/images/brand/common/video/Gradient_Tablet_1.mp4">' +
				'</video>'
			)
		} else {
			if ($('.mobile-video').length > 0) {
				return null;
			}
			$('.banner__inner').html('');
			$('.banner__inner').append(
				'<video id="myVideo" class="mobile-video" loop muted autoplay playsinline>' + 
				'<source src="/images/brand/common/video/Gradient_Tablet_1.mp4">' +
				'</video>'
			)
		}

		objectFitPolyfill();
	}
}

