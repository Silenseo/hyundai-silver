//Добавление превью в низком разрешениии (загружается с сервера) к элементам с ленивой загрузкой и фоновой картинкой (плагин lazyload XT или lazysizes)
//Файл нужно подключать сразу после контента, перед загрузкой основных скриптов
//Для отрисовки превью к элементу нужно добавить класс lazypreview

(function(){
	try {
		var list = document.querySelectorAll('.lazypreview:not(.lazyloaded):not(.lazy-loaded)');

		for (var i = 0; i < list.length; i++) {
			let obj = list[i];
			let url = '';
		
			if (obj.getAttribute('data-bg')) {
				url = obj.getAttribute('data-bg');
				setPreviewImg(obj, url);
			} else if (obj.getAttribute('data-bgset')) {
				if (obj.getAttribute('data-bgset').indexOf('|') >= 0) {
					let arr = obj.getAttribute('data-bgset').split('|');
					let resultArr = [];
		
					arr.forEach((item)=>{
						let maxWidth = 2777;
						let itemUrl = '';
		
						if (item.indexOf('max-width') >= 0) {
							let start = item.indexOf(' [(max-width: ');
							let end = item.indexOf('px)]');
		
							if (!isNaN(start) && !isNaN(end) && start >=0 && end >= 0) {
								maxWidth = item.slice(start + 14, end);
							} else {
								throw new Error('Ошибка парсинга атрибута bgset у элемента. ' + obj.getAttribute('data-bgset'));
							}
		
							itemUrl = item.slice(0, start);
						} else {
							itemUrl = item.trim();
						}
		
						resultArr.push({
							maxWidth: +maxWidth,
							url: itemUrl
						})
					})
		
					setPreviewImg(obj, undefined, resultArr);
				} else {
					url = obj.getAttribute('data-bgset');
		
					setPreviewImg(obj, url);
				}
			}
		}
		
		function setPreviewImg(obj, url, arr) {
			var api = '/getPicThumb';
		
			if (typeof url !== 'undefined') {
				var img = new Image();
		
				img.src = (api + url) + '?w=100&h=0';
				img.onload = function() {
					if (!obj.style.backgroundImage) {
						obj.style.backgroundImage = 'url(' + img.src + ')';
					}
				}	
			}
			if (typeof arr !== 'undefined') {
				var windowWidth = document.body.clientWidth;
				var src = '';
		
				arr.sort((a, b) => {
					return b.maxWidth - a.maxWidth;
				})
		
				arr.forEach((item)=>{
					if (windowWidth <= item.maxWidth) {
						src = item.url;
					}
				})
		
				var img = new Image();
		
				img.src = (api + src) + '?w=100&h=0';
				img.onload = function() {
					if (!obj.style.backgroundImage) {
						obj.style.backgroundImage = 'url(' + img.src + ')';
					}
				}	
			}
		}
	} catch (error) {
		console.error(error);
	}	
})()
