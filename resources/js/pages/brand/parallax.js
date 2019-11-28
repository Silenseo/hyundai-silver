//Parallax
var rellax = null,
oldWindowWidth2 = 0;

export default function() {
	var windowWidth = $(window).outerWidth();

	//Для iOs
	if (oldWindowWidth2 === windowWidth) {
		return null;
	}

	oldWindowWidth2 = windowWidth;

	if (rellax) {
		rellax.destroy();
	}

	setTimeout(()=>{
		if ($(window).outerWidth() < 768) {
			rellax = new Rellax('.parallax', {
				speed: -0.5,
				center: true
			});
		} else {
			rellax = new Rellax('.parallax', {
				speed: -1.5,
				center: true
			});
		}
	})
}