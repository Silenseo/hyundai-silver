import Vue from 'vue'
import store from '../../vue/store-service'

//Чтобы store был доступен из вне, для создания событий открытия окон
window.vueStore = store;

new Vue({
	el: '#hotbuttons',
	store,
	components: {
		'hot-buttons': () => import('../../vue/components/common/HotButtons.vue')
	}
});

new Vue({
	el: '#offerPage',
	store,
	components: {
		'offer-forms': () => import('../../vue/OfferForms.vue')
	}
});

$(document).ready(function () {
	//Видео
	var oldWindowWidth = 0,
	videosList = document.querySelectorAll('.detail-video');

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
})
