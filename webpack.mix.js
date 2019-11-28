const mix = require('laravel-mix');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
require('laravel-mix-merge-manifest');

const path = process.env.MIX_BUILD === 'dealer' ? 'dealer/' : '';
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 | Пример подключения стилей и скриптов смотри на примере страницы index.
 | В конце файла есть строка mix.version() для присвоения уникальных имён файлам, чтобы они не кэшировались.
 | Поэтому стили и скрипты в файлы нужно подключать так: <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
 | В главном лэйауте уже подключена jQuery.
 */

mix.webpackConfig({
   resolve: {
     extensions: ['.js', '.vue', '.json'],
     alias: {
       'vue$': 'vue/dist/vue.esm.js',
       '@': __dirname + '/resources/js/vue'
	 }
   }
})

//Динамическая подгрузка vue компонентов
if (path) {
	mix.config.webpackConfig.output = {
		chunkFilename: 'dealer/js/bundles/[name].bundle.js',
		publicPath: '/',
	};
} else {
	mix.config.webpackConfig.output = {
		chunkFilename: 'js/bundles/[name].bundle.js',
		publicPath: '/',
	};
}


//------------------------------------KIT-------------------------------------------
mix.js('resources/js/pages/kit/kit.js', 'public/js/kit')

mix.sass('resources/sass/pages/kit/kit.scss', 'public/css/kit')
mix.sass('resources/sass/pages/kit/kit_grid_styles.sass', 'public/css/kit')

mix.styles([
   'resources/libs/noUiSlider-12.1.0/nouislider.min.css',
   'resources/libs/selectize/selectize.css',
   'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
   'resources/libs/jquery-ui/jquery-ui.min.css',
   'resources/libs/datepicker/daterangepicker.min.css',
], 'public/css/kit/libs.css');

mix.scripts([
   'resources/libs/jquery/3.3.1.min.js',
   'resources/libs/selectize/selectize.min.js',
   'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js',
   'resources/libs/noUiSlider-12.1.0/nouislider.min.js',
   'resources/libs/jquery-ui/jquery-ui.min.js',
   'resources/libs/moment/moment.min.js',
   'resources/libs/datepicker/jquery.daterangepicker.min.js'
],
   'public/js/kit/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------LAYOUT-------------------------------------------
mix.js('resources/js/pages/layout/common.js', 'public/' + path + 'js/')
mix.js('resources/js/common/lazypreview.js', 'public/' + path + 'js/')
mix.sass('resources/sass/layout/master.sass', 'public/' + path + 'css')
mix.sass('resources/sass/layout/layoutFixed.sass', 'public/' + path + 'css')

mix.styles([
	 'resources/libs/hamburgers/hamburgers.css',
	 'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
], 'public/' + path + 'css/libs.css');

mix.scripts([
	'resources/libs/jquery/3.3.1.min.js',
	'resources/libs/selectize/selectize.min.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js',
	'resources/libs/jquery/jquery.cookie.min.js',
	'resources/libs/svg4everybody/svg4everybody.min.js',
	'resources/libs/polyfill/object-fit.min.js'
],
   'public/' + path + 'js/libs.js')

// mix.copy('resources/assets/sprite/svg/symbols.svg', 'public/images/svgSprite');

//------------------------------------------------------------------------------------

//------------------------------------INDEX-------------------------------------------
//так подключаются js, sass, scss... файлы. Эти файлы будут скомпилированы, т.е. например js будет преобразован в ES5 и т.д.
mix.js('resources/js/pages/index/index.js', 'public/' + path + 'js/index')
   .sass('resources/sass/pages/index/index.sass', 'public/' + path + 'css/index');

if (path) {
	mix.js('resources/js/pages/index/index-dealer.js', 'public/' + path + 'js/index');
	mix.sass('resources/sass/pages/index/index-dealer.sass', 'public/' + path + 'css/index');
}

//так подключаются css файлы, которые не нужно компилировать, например библиотеки.
if (path) {
	mix.styles([
		'resources/libs/OwlCarousel/dist/assets/owl.carousel.min.css',
		'resources/libs/selectize/selectize.css',
		'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
		'resources/libs/noUiSlider-12.1.0/nouislider.min.css',
	 ], 'public/' + path + 'css/index/libs.css');
} else {
	mix.styles([
		'resources/libs/OwlCarousel/dist/assets/owl.carousel.min.css',
	 ], 'public/css/index/libs.css');
}


//так подключаются js файлы библиотек.
if (path) {
	mix.scripts([
		'resources/libs/OwlCarousel/dist/owl.carousel.min.js',
		'resources/libs/polyfill/promise.js',
		'resources/libs/lazyLoad/ls.bgset.min.js',
		'resources/libs/lazyLoad/lazysizes.min.js',
		'resources/libs/polyfill/promise.js',
		'resources/libs/lodash/lodash.js',
		'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js',
		'resources/libs/noUiSlider-12.1.0/nouislider.min.js',
		'resources/libs/scrollmagic/ScrollMagic.min.js'
	],
	   'public/' + path + 'js/index/libs.js')
} else {
	mix.scripts([
		'resources/libs/OwlCarousel/dist/owl.carousel.min.js',
		'resources/libs/polyfill/promise.js',
		'resources/libs/axios/axios.js',
		'resources/libs/vue/vue.min.js',
		'resources/libs/greensock/TweenMax.min.js',
		'resources/libs/hammerjs/hammer.min.js',
		'resources/libs/lazyLoad/ls.bgset.min.js',
		'resources/libs/lazyLoad/lazysizes.min.js',
	],
	   'public/js/index/libs.js')
}

//------------------------------------------------------------------------------------

//------------------------------------CONFIGURATOR-------------------------------------------
mix.js('resources/js/pages/configurator/configurator.js', 'public/js/configurator')
	.js('resources/js/pages/configurator/forms.js', 'public/js/configurator')
   .sass('resources/sass/pages/configurator/configurator.sass', 'public/css/configurator');

mix.styles([
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/selectize/selectize.css'
], 'public/css/configurator/libs.css');

mix.scripts([
   'resources/libs/polyfill/promise.js',
   'resources/libs/polyfill/assign.js',
   'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js'
],
   'public/js/configurator/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------ADMIN-------------------------------------------
mix.js('resources/admin/js/common.js', 'public/js/admin/admin.js')
   .sass('resources/admin/sass/main.sass', 'public/css/admin');

mix.styles([
   'resources/admin/libs/jquery-ui/jquery-ui.min.css',
   'resources/admin/libs/selectize/selectize.css'
], 'public/css/admin/libs.css');

mix.scripts([
   'resources/libs/jquery/3.3.1.min.js',
   'resources/admin/libs/jquery-ui/jquery-ui.min.js',
   'resources/admin/libs/selectize/selectize.min.js'
],'public/js/admin/libs.js')

//------------------------------------------------------------------------------------

//------------------------------------PROMO1-------------------------------------------
mix.sass('resources/sass/pages/promo1/promo1.scss', 'public/css/promo1');
//------------------------------------------------------------------------------------

//------------------------------------PROMO2-------------------------------------------
mix.sass('resources/sass/pages/promo2/promo2.scss', 'public/css/promo2');
//------------------------------------------------------------------------------------

//------------------------------------SPECIAL-------------------------------------------
mix.js('resources/js/pages/special/custom.js', 'public/js/special')
    .js('resources/js/pages/special/detail.js', 'public/js/special')
   .sass('resources/sass/pages/special/special.scss', 'public/css/special')
   .sass('resources/sass/pages/special/detail.scss', 'public/css/special');

mix.scripts([
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
],
   'public/js/special/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------NEWS-------------------------------------------
mix.js('resources/js/pages/news/news.js', 'public/js/news')
   .sass('resources/sass/pages/news/news.sass', 'public/css/news');

mix.styles([
   'resources/libs/selectize/selectize.css',
   'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
   'resources/libs/datepicker/daterangepicker.min.css',
], 'public/css/news/libs.css');

mix.scripts([
   'resources/libs/selectize/selectize.min.js',
   'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js',
   'resources/libs/moment/moment.min.js',
   'resources/libs/datepicker/jquery.daterangepicker.min.js'
],
   'public/js/news/libs.js');
//------------------------------------------------------------------------------------

//------------------------------------SERVICE-------------------------------------------
mix.js('resources/js/pages/service/service.js', 'public/js/service')
   .js('resources/js/pages/service/service-calculator.js', 'public/js/service')
   .js('resources/js/pages/service/book/book.js', 'public/js/service/')
   .sass('resources/sass/pages/service/service.sass', 'public/css/service')
   .sass('resources/sass/pages/service/book.sass', 'public/css/service');

mix.styles([
   'resources/libs/OwlCarousel/dist/assets/owl.carousel.min.css',
   'resources/libs/OwlCarousel/dist/assets/owl.theme.default.min.css',
   'resources/libs/selectize/selectize.css',
   'resources/libs/noUiSlider-12.1.0/nouislider.min.css',
   'resources/libs/animate-css/animate.css',
   'resources/libs/perfect-scrollbar/perfect-scrollbar.css'
], 'public/css/service/libs.css');

mix.scripts([
   'resources/libs/polyfill/promise.js',
   'resources/libs/OwlCarousel/dist/owl.carousel.min.js',
   'resources/libs/noUiSlider-12.1.0/nouislider.min.js',
   'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js',
   'resources/js/common/slider-1.js',
   'resources/js/common/slider-2.js'
],
   'public/js/service/libs.js');
//------------------------------------------------------------------------------------

//------------------------------------SIGN-UP-FORM-------------------------------------------
mix.js('resources/js/pages/forms/sign-up-form.js', 'public/' + path + 'js/sign-up-form')
	.sass('resources/sass/pages/signUpFormPage/signUpForm.sass', 'public/' + path + 'css/sign-up-form');

mix.styles([
   'resources/libs/selectize/selectize.css',
   'resources/libs/animate-css/animate.css',
   'resources/libs/perfect-scrollbar/perfect-scrollbar.css'
], 'public/' + path + 'css/sign-up-form/libs.css');

mix.scripts([
   'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js',
   'resources/libs/polyfill/promise.js'
],
   'public/' + path + 'js/sign-up-form/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------FIND-DEALER-------------------------------------------
mix.js('resources/js/pages/findDealer/find-dealer.js', 'public/js/find-dealer')
   .sass('resources/sass/pages/findDealer/find-dealer.sass', 'public/css/find-dealer');

mix.styles([
	'resources/libs/selectize/selectize.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css'
 ], 'public/css/find-dealer/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js'
 ],
	'public/js/find-dealer/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------CONTACT-US-------------------------------------------
mix.js('resources/js/pages/contactUs/contact-us.js', 'public/js/contact-us')
   .sass('resources/sass/pages/contactUs/contact-us.sass', 'public/css/contact-us');

mix.styles([
	'resources/libs/selectize/selectize.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css'
 ], 'public/css/contact-us/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js'
 ],
	'public/js/contact-us/libs.js')
//------------------------------------------------------------------------------------
//------------------------------------WARRANTY-------------------------------------------
mix.js('resources/js/pages/service/warranty/warranty.js', 'public/js/service/warranty')
   .sass('resources/sass/pages/service/warranty/warranty.sass', 'public/css/service/warranty');

mix.styles('resources/libs/swiper/swiper.min.css', 'public/css/service/warranty/libs.css');

mix.scripts('resources/libs/swiper/swiper.min.js', 'public/js/service/warranty/libs.js');
//-----------------------------------------------------------------------------------

//------------------------------------DOCUMENTATION-------------------------------------------
mix.js('resources/js/pages/service/documentation/documentation.js', 'public/js/service/documentation')
   .sass('resources/sass/pages/service/documentation/documentation.sass', 'public/css/service/documentation');

mix.styles('resources/libs/swiper/swiper.min.css', 'public/css/service/documentation/libs.css');

mix.scripts('resources/libs/swiper/swiper.min.js', 'public/js/service/documentation/libs.js');
//-----------------------------------------------------------------------------------

//------------------------------------BODYWORKS-------------------------------------------
mix.js('resources/js/pages/service/bodyworks/bodyworks.js', 'public/js/service/bodyworks')
   .sass('resources/sass/pages/service/bodyworks/bodyworks.sass', 'public/css/service/bodyworks');

mix.styles('resources/libs/swiper/swiper.min.css', 'public/css/service/bodyworks/libs.css');

mix.scripts('resources/libs/swiper/swiper.min.js', 'public/js/service/bodyworks/libs.js');
//-----------------------------------------------------------------------------------

//------------------------------------SHELL-------------------------------------------
mix.js('resources/js/pages/service/shell/shell.js', 'public/js/service/shell')
   .sass('resources/sass/pages/service/shell/shell.sass', 'public/css/service/shell');

mix.styles([
   'resources/libs/selectize/selectize.css',
   'resources/libs/perfect-scrollbar/perfect-scrollbar.css'
], 'public/css/service/shell/libs.css');

mix.scripts([
   'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js',
   'resources/libs/selectize/selectize.min.js',
],
   'public/js/service/shell/libs.js');
//-----------------------------------------------------------------------------------
//------------------------------------VACANCY-------------------------------------------
mix.js('resources/js/pages/vacancy/vacancy.js', 'public/js/vacancy')
   .js('resources/js/pages/vacancy/vacancy-form.js', 'public/js/vacancy')
   .js('resources/js/pages/vacancy/vacancy-page.js', 'public/js/vacancy')
   .sass('resources/sass/pages/vacancy/vacancy.sass', 'public/css/vacancy');

mix.styles([
	'resources/libs/selectize/selectize.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/OwlCarousel/dist/assets/owl.carousel.min.css',
   	'resources/libs/OwlCarousel/dist/assets/owl.theme.default.min.css',
 ], 'public/css/vacancy/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js',
	'resources/libs/OwlCarousel/dist/owl.carousel.min.js',
	'resources/libs/lodash/lodash.js',
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js'
 ],
	'public/js/vacancy/libs.js')
//------------------------------------------------------------------------------------
//------------------------------------MOTORSTUDIO-------------------------------------------
mix.js('resources/js/pages/motorstudio/motorstudio.js', 'public/js/motorstudio')
   .sass('resources/sass/pages/motorstudio/motorstudio.sass', 'public/css/motorstudio');

mix.styles([
	'resources/libs/OwlCarousel/dist/assets/owl.carousel.min.css',
   	'resources/libs/OwlCarousel/dist/assets/owl.theme.default.min.css'
 ], 'public/css/motorstudio/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/hammerjs/hammer.min.js',
	'resources/libs/OwlCarousel/dist/owl.carousel.min.js',
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js',
 ],
	'public/js/motorstudio/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------PARTS-------------------------------------------
mix.js('resources/js/pages/service/parts/parts.js', 'public/js/service/parts')
   .sass('resources/sass/pages/service/parts/parts.sass', 'public/css/service/parts');

mix.styles([
   'resources/libs/swiper/swiper.min.css',
   'resources/libs/twentytwenty/twentytwenty.css',
],
 'public/css/service/parts/libs.css');

mix.scripts([
   'resources/libs/swiper/swiper.min.js',
   'resources/libs/twentytwenty/jquery.event.move.js',
   'resources/libs/twentytwenty/jquery.twentytwenty.js',
],
   'public/js/service/parts/libs.js');
//-----------------------------------------------------------------------------------

//------------------------------------ASSISTANCE-------------------------------------------
mix.js('resources/js/pages/service/assistance/assistance.js', 'public/js/service/assistance')
   .sass('resources/sass/pages/service/assistance/assistance.sass', 'public/css/service/assistance');
//-----------------------------------------------------------------------------------

//------------------------------------BEST-------------------------------------------
mix.js('resources/js/pages/service/best/best.js', 'public/js/service/best')
   .sass('resources/sass/pages/service/best/best.sass', 'public/css/service/best');

mix.styles('resources/libs/swiper/swiper.min.css', 'public/css/service/best/libs.css');

mix.scripts([
	'resources/libs/swiper/swiper.min.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
 ],
	'public/js/service/best/libs.js')
//-----------------------------------------------------------------------------------

//------------------------------------SANTAFE-------------------------------------------
mix.js('resources/js/pages/cars/santaFe/santa-fe.js', 'public/js/santaFe')
   .js('resources/js/pages/cars/santaFe/main.js', 'public/js/santaFe')
   .js('resources/js/pages/cars/santaFe/gallery.js', 'public/js/santaFe')
   .sass('resources/sass/pages/cars/santaFe/santa-fe.sass', 'public/css/santaFe');

mix.styles([
	'resources/libs/slickSlider/slick.css',
	'resources/libs/slickSlider/slick-theme.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/selectize/selectize.css'
 ], 'public/css/santaFe/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/greensock/TweenMax.min.js',
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.bg.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.video.min.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
	'resources/libs/rellax/rellax.min.js',
	'resources/libs/hammerjs/hammer.min.js',
	'resources/libs/slickSlider/slick.min.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js'
 ],
	'public/js/santaFe/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------ELANTRA-------------------------------------------
mix.js('resources/js/pages/cars/elantra/elantra.js', 'public/js/cars/elantra')
   .js('resources/js/pages/cars/elantra/main.js', 'public/js/cars/elantra')
   .js('resources/js/pages/cars/elantra/gallery.js', 'public/js/cars/elantra')
   .sass('resources/sass/pages/cars/elantra/elantra.sass', 'public/css/cars/elantra');

mix.styles([
	'resources/libs/slickSlider/slick.css',
	'resources/libs/slickSlider/slick-theme.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/selectize/selectize.css'
 ], 'public/css/cars/elantra/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/greensock/TweenMax.min.js',
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.bg.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.video.min.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
	'resources/libs/rellax/rellax.min.js',
	'resources/libs/hammerjs/hammer.min.js',
	'resources/libs/slickSlider/slick.min.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js'
 ],
	'public/js/cars/elantra/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------TUCSON-------------------------------------------
mix.js('resources/js/pages/cars/tucson/tucson.js', 'public/js/cars/tucson')
   .js('resources/js/pages/cars/tucson/main.js', 'public/js/cars/tucson')
   .js('resources/js/pages/cars/tucson/gallery.js', 'public/js/cars/tucson')
   .sass('resources/sass/pages/cars/tucson/tucson.sass', 'public/css/cars/tucson');

mix.styles([
	'resources/libs/slickSlider/slick.css',
	'resources/libs/slickSlider/slick-theme.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/selectize/selectize.css'
 ], 'public/css/cars/tucson/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/greensock/TweenMax.min.js',
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.bg.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.video.min.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
	'resources/libs/rellax/rellax.min.js',
	'resources/libs/hammerjs/hammer.min.js',
	'resources/libs/slickSlider/slick.min.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js'
 ],
	'public/js/cars/tucson/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------i30N-2019-------------------------------------------
mix
   .js('resources/js/pages/cars/i30n/main.js', 'public/js/cars/i30n_2019')
   .js('resources/js/pages/cars/i30n/gallery.js', 'public/js/cars/i30n_2019')
   .sass('resources/sass/pages/cars/i30n/i30n_2019.sass', 'public/css/cars/i30n_2019');

mix.js('resources/js/pages/cars/i30n/i30n_2019.js', 'public/js/cars/i30n_2019')

mix.styles([
	'resources/libs/slickSlider/slick.css',
	'resources/libs/slickSlider/slick-theme.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/selectize/selectize.css'
 ], 'public/css/cars/i30n_2019/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/greensock/TweenMax.min.js',
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.bg.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.video.min.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
	'resources/libs/rellax/rellax.min.js',
	'resources/libs/hammerjs/hammer.min.js',
	'resources/libs/slickSlider/slick.min.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js'
 ],
	'public/js/cars/i30n_2019/libs.js')
//------------------------------------------------------------------------------------


//------------------------------------SOLARIS-------------------------------------------
mix.js('resources/js/pages/cars/solaris/solaris.js', 'public/js/solaris')
   .js('resources/js/pages/cars/solaris/main.js', 'public/js/solaris')
   .js('resources/js/pages/cars/solaris/gallery.js', 'public/js/solaris')
   .sass('resources/sass/pages/cars/solaris/solaris.sass', 'public/css/solaris');

mix.styles([
	'resources/libs/slickSlider/slick.css',
	'resources/libs/slickSlider/slick-theme.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/selectize/selectize.css'
 ], 'public/css/solaris/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/greensock/TweenMax.min.js',
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.bg.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.video.min.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
	'resources/libs/rellax/rellax.min.js',
	'resources/libs/hammerjs/hammer.min.js',
	'resources/libs/slickSlider/slick.min.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js'
 ],
	'public/js/solaris/libs.js')
//------------------------------------------------------------------------------------


//------------------------------------SONATA-------------------------------------------
mix.js('resources/js/pages/cars/sonata/sonata.js', 'public/js/sonata')
   .js('resources/js/pages/cars/sonata/main.js', 'public/js/sonata')
   .js('resources/js/pages/cars/sonata/gallery.js', 'public/js/sonata')
   .sass('resources/sass/pages/cars/sonata/sonata.sass', 'public/css/sonata');

mix.styles([
	'resources/libs/slickSlider/slick.css',
	'resources/libs/slickSlider/slick-theme.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/selectize/selectize.css'
 ], 'public/css/sonata/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/greensock/TweenMax.min.js',
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.bg.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.video.min.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
	'resources/libs/rellax/rellax.min.js',
	'resources/libs/hammerjs/hammer.min.js',
	'resources/libs/slickSlider/slick.min.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js'
 ],
	'public/js/sonata/libs.js')
//------------------------------------------------------------------------------------


//------------------------------------CRETA-------------------------------------------
mix.js('resources/js/pages/cars/creta/creta.js', 'public/js/creta')
   .js('resources/js/pages/cars/creta/main.js', 'public/js/creta')
   .js('resources/js/pages/cars/creta/gallery.js', 'public/js/creta')
   .sass('resources/sass/pages/cars/creta/creta.sass', 'public/css/creta');

mix.styles([
	'resources/libs/slickSlider/slick.css',
	'resources/libs/slickSlider/slick-theme.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/selectize/selectize.css'
 ], 'public/css/creta/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/greensock/TweenMax.min.js',
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.bg.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.video.min.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
	'resources/libs/rellax/rellax.min.js',
	'resources/libs/hammerjs/hammer.min.js',
	'resources/libs/slickSlider/slick.min.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js'
 ],
	'public/js/creta/libs.js')
//------------------------------------------------------------------------------------


//------------------------------------H-1-------------------------------------------
mix.js('resources/js/pages/cars/h1/h1.js', 'public/js/h1')
   .js('resources/js/pages/cars/h1/main.js', 'public/js/h1')
   .js('resources/js/pages/cars/h1/gallery.js', 'public/js/h1')
   .sass('resources/sass/pages/cars/h1/h1.sass', 'public/css/h1');

mix.styles([
	'resources/libs/slickSlider/slick.css',
	'resources/libs/slickSlider/slick-theme.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/selectize/selectize.css'
 ], 'public/css/h1/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/greensock/TweenMax.min.js',
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.bg.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.video.min.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
	'resources/libs/rellax/rellax.min.js',
	'resources/libs/hammerjs/hammer.min.js',
	'resources/libs/slickSlider/slick.min.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js'
 ],
	'public/js/h1/libs.js')
//------------------------------------------------------------------------------------



//------------------------------------PRODUCT LINE 2-------------------------------------------
mix.js('resources/js/pages/service/pl2/pl2.js', 'public/js/service/pl2')
   .sass('resources/sass/pages/service/pl2/pl2.sass', 'public/css/service/pl2');

mix.scripts([
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
 ],
	'public/js/pages/service/pl2/libs.js')
//-----------------------------------------------------------------------------------

//------------------------------------i30N-------------------------------------------
mix.js('resources/js/pages/cars/i30n/i30n.js', 'public/js/cars/i30n')
   .sass('resources/sass/pages/cars/i30n/i30n.sass', 'public/css/cars/i30n');

mix.styles('resources/libs/swiper/swiper.min.css', 'public/css/cars/i30n/libs.css');

mix.scripts('resources/libs/swiper/swiper.min.js', 'public/js/cars/i30n/libs.js');
//-----------------------------------------------------------------------------------

//------------------------------------VelosterN-------------------------------------------
mix.js('resources/js/pages/cars/veloster-n/veloster-n.js', 'public/js/cars/veloster-n')
   .sass('resources/sass/pages/cars/veloster-n/veloster-n.sass', 'public/css/cars/veloster-n');
//-----------------------------------------------------------------------------------

//------------------------------------IONIQ-------------------------------------------
mix.js('resources/js/pages/cars/ioniq/ioniq.js', 'public/js/cars/ioniq')
   .sass('resources/sass/pages/cars/ioniq/ioniq.sass', 'public/css/cars/ioniq');

mix.styles('resources/libs/swiper/swiper.min.css', 'public/css/cars/ioniq/libs.css');

mix.scripts('resources/libs/swiper/swiper.jquery.min.js', 'public/js/cars/ioniq/libs.js');
//-----------------------------------------------------------------------------------

//------------------------------------BRANDCOLLECTION-------------------------------------------
mix.js('resources/js/pages/brandCollection/brand-collection.js', 'public/js/brandCollection')
   .js('resources/js/pages/brandCollection/buy.js', 'public/js/brandCollection')
   .sass('resources/sass/pages/brandCollection/brand-collection.sass', 'public/css/brandCollection');

mix.styles([
	'resources/libs/OwlCarousel/dist/assets/owl.carousel.min.css',
	'resources/libs/OwlCarousel/dist/assets/owl.theme.default.min.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/selectize/selectize.css',
 ], 'public/css/brandCollection/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/OwlCarousel/dist/owl.carousel.min.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js',
	'resources/libs/lodash/lodash.js',
 ],
	'public/js/brandCollection/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------IONIQ-------------------------------------------
mix.js('resources/js/pages/cars/nexo/nexo.js', 'public/js/cars/nexo')
   .sass('resources/sass/pages/cars/nexo/nexo.sass', 'public/css/cars/nexo');

mix.styles('resources/libs/swiper/swiper.min.css', 'public/css/cars/nexo/libs.css');

mix.scripts('resources/libs/swiper/swiper.jquery.min.js', 'public/js/cars/nexo/libs.js');
//-----------------------------------------------------------------------------------

//------------------------------------KONA-------------------------------------------
mix.js('resources/js/pages/cars/kona/kona.js', 'public/js/cars/kona')
   .sass('resources/sass/pages/cars/kona/kona.sass', 'public/css/cars/kona');

mix.styles([
   'resources/libs/swiper/swiper.min.css',
   'resources/libs/jquery-ui/jquery-ui-slider.min.css',
],
   'public/css/cars/kona/libs.css');

mix.scripts([
   'resources/libs/swiper/swiper.min.js',
   'resources/libs/jquery-ui/jquery-ui-slider.min.js',
],
   'public/js/cars/kona/libs.js');
//-----------------------------------------------------------------------------------

//------------------------------------Trade-In-------------------------------------------
mix.js('resources/js/pages/trade-in/trade-in.js', 'public/js/trade-in')
   .sass('resources/sass/pages/trade-in/trade-in.sass', 'public/css/trade-in');

mix.styles('resources/libs/swiper/swiper.min.css', 'public/css/trade-in/libs.css');

mix.scripts([
	'resources/libs/swiper/swiper.min.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
 ],
	'public/js/trade-in/libs.js')
//-----------------------------------------------------------------------------------

//------------------------------------Sitemap-------------------------------------------
mix.sass('resources/sass/pages/sitemap.sass', 'public/css/');
//-----------------------------------------------------------------------------------

//------------------------------------Warning-------------------------------------------
mix.sass('resources/sass/pages/warning.sass', 'public/css/');
//-----------------------------------------------------------------------------------

//------------------------------------Search-------------------------------------------
mix.js('resources/js/pages/search/search.js', 'public/js/search')
   .sass('resources/sass/pages/search.sass', 'public/css');
//----------------------------------------------------------------------------------------------

//------------------------------------Become a Dealer-------------------------------------------
mix.sass('resources/sass/pages/becomeDealer/become-dealer.sass', 'public/css/becomeDealer');
//-----------------------------------------------------------------------------------

//------------------------------------Corporate Clients-------------------------------------------
mix.sass('resources/sass/pages/corporate/corporate.sass', 'public/css/corporate/');
//-----------------------------------------------------------------------------------

//------------------------------------BRAND HISTORY-------------------------------------------
mix.js('resources/js/pages/brand/history/index.js', 'public/js/brand/history')
   .sass('resources/sass/pages/brand/history/index.sass', 'public/css/brand/history');


//------------------------------------BRAND MOBILITY -------------------------------------------
mix.js('resources/js/pages/brand/mobility/index.js', 'public/js/brand/mobility')
   .sass('resources/sass/pages/brand/mobility/index.sass', 'public/css/brand/mobility');

mix.styles([
 ], 'public/css/brand/history/libs.css');

mix.scripts([
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js',
	'resources/libs/greensock/TweenMax.min.js',
	'resources/libs/greensock/ScrollToPlugin.min.js',
	'resources/libs/greensock/CustomEase.min.js',
	'resources/libs/rellax/rellax.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.bg.min.js',
	'resources/libs/hammerjs/hammer.min.js',
	'resources/libs/fast-average-color/fac.min.js',
 ],
	'public/js/brand/history/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------BRAND PHILOSOPHY-------------------------------------------
mix.js('resources/js/pages/brand/philosophy/index.js', 'public/js/brand/philosophy')
   .sass('resources/sass/pages/brand/philosophy/index.sass', 'public/css/brand/philosophy');

mix.styles([
	'resources/libs/OwlCarousel/dist/assets/owl.carousel.min.css',
	'resources/libs/OwlCarousel/dist/assets/owl.theme.default.min.css',
 ], 'public/css/brand/philosophy/libs.css');

mix.scripts([
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js',
	'resources/libs/jquery-mousewheel/jquery.mousewheel.min.js',
	'resources/libs/OwlCarousel/dist/owl.carousel.min.js',
	'resources/libs/rellax/rellax.min.js',
	'resources/libs/greensock/TweenMax.min.js',
	'resources/libs/greensock/ScrollToPlugin.min.js',
	'resources/libs/greensock/CustomEase.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.bg.min.js',
	'resources/libs/fast-average-color/fac.min.js',
 ],
	'public/js/brand/philosophy/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------BRAND MANUFACTURING-------------------------------------------
mix.js('resources/js/pages/brand/manufacturing/index.js', 'public/js/brand/manufacturing')
   .sass('resources/sass/pages/brand/manufacturing/index.sass', 'public/css/brand/manufacturing');

mix.scripts([
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js',
	'resources/libs/rellax/rellax.min.js',
	'resources/libs/greensock/TweenMax.min.js',
	'resources/libs/greensock/ScrollToPlugin.min.js',
	'resources/libs/greensock/CustomEase.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.bg.min.js',
	'resources/libs/fast-average-color/fac.min.js',
 ],
	'public/js/brand/manufacturing/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------BRAND PERFECTION MOBILITY-------------------------------------------
mix.js('resources/js/pages/brand/p-mobility/index.js', 'public/js/brand/p-mobility')
   .sass('resources/sass/pages/brand/p-mobility/index.sass', 'public/css/brand/p-mobility');

mix.styles([
	'resources/libs/OwlCarousel/dist/assets/owl.carousel.min.css',
	'resources/libs/OwlCarousel/dist/assets/owl.theme.default.min.css',
 ], 'public/css/brand/p-mobility/libs.css');

mix.scripts([
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js',
	'resources/libs/OwlCarousel/dist/owl.carousel.min.js',
	'resources/libs/rellax/rellax.min.js',
	'resources/libs/greensock/TweenMax.min.js',
	'resources/libs/greensock/ScrollToPlugin.min.js',
	'resources/libs/greensock/CustomEase.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.bg.min.js',
	'resources/libs/fast-average-color/fac.min.js',
 ],
	'public/js/brand/p-mobility/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------BRAND MOTORSPORT-----------------------
mix.js('resources/js/pages/brand/motorsport/index.js', 'public/js/brand/motorsport')
   .sass('resources/sass/pages/brand/motorsport/index.sass', 'public/css/brand/motorsport');

mix.styles([
	'resources/libs/OwlCarousel/dist/assets/owl.carousel.min.css',
	'resources/libs/OwlCarousel/dist/assets/owl.theme.default.min.css',
	'resources/libs/twentytwenty/twentytwenty.css',
 ], 'public/css/brand/motorsport/libs.css');

mix.scripts([
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/scrollmagic/plugins/debug.addIndicators.min.js',
	'resources/libs/OwlCarousel/dist/owl.carousel.min.js',
	'resources/libs/rellax/rellax.min.js',
	'resources/libs/greensock/TweenMax.min.js',
	'resources/libs/greensock/ScrollToPlugin.min.js',
	'resources/libs/greensock/CustomEase.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.min.js',
	'resources/libs/lazyLoad/jquery.lazyloadxt.bg.min.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
	'resources/libs/fast-average-color/fac.min.js',
	'resources/libs/twentytwenty/jquery.twentytwenty.js',
	'resources/libs/twentytwenty/jquery.event.move.js',
	'resources/libs/hammerjs/hammer.min.js',
 ],
	'public/js/brand/motorsport/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------BRAND SERVICES-----------------------
mix.js('resources/js/pages/brand/services/index.js', 'public/js/brand/services')
   .sass('resources/sass/pages/brand/services/index.sass', 'public/css/brand/services');

mix.styles([
	'resources/libs/OwlCarousel/dist/assets/owl.carousel.min.css',
	'resources/libs/OwlCarousel/dist/assets/owl.theme.default.min.css'
 ], 'public/css/brand/services/libs.css');

mix.scripts([
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/OwlCarousel/dist/owl.carousel.min.js',
 ],
	'public/js/brand/services/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------START-------------------------------------------
mix.js('resources/js/pages/start/start.js', 'public/js/start')
	.js('resources/js/pages/start/calc.js', 'public/js/start')
	.sass('resources/sass/pages/start/start.sass', 'public/css/start');

mix.styles([
	'resources/libs/selectize/selectize.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/OwlCarousel/dist/assets/owl.carousel.min.css',
	'resources/libs/OwlCarousel/dist/assets/owl.theme.default.min.css',
	'resources/libs/noUiSlider-12.1.0/nouislider.min.css',
 ], 'public/css/start/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/lodash/lodash.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js',
	'resources/libs/noUiSlider-12.1.0/nouislider.min.js',
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/OwlCarousel/dist/owl.carousel.min.js',
 ],
	'public/js/start/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------DEALER CARS-------------------------------------------
mix.js('resources/js/pages/dealerCars/index.js', 'public/' + path + 'js/dealerCars')
mix.sass('resources/sass/common/components/_placeholder.sass', 'public/' + path + 'css/dealerCars/placeholder.css')

mix.styles([
	'resources/libs/selectize/selectize.css',
	'resources/libs/slickSlider/slick-theme.css',
	'resources/libs/slickSlider/slick.css',
 ], 'public/' + path + 'css/dealerCars/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/hammerjs/hammer.min.js',
	'resources/libs/slickSlider/slick.min.js',
 ],
	'public/' + path + 'js/dealerCars/libs.js')
//------------------------------------------------------------------------------------

//уникальные имена собраным файлам, чтобы они не кэшировались
mix.version()
mix.version(['public/dealer/css/libs.css', 'public/dealer/css/master.css', 'public/dealer/css/layoutFixed.css', 'public/dealer/js/libs.js', 'public/dealer/js/common.js'])
//Чтобы одна сборка не перезаписывала другую
mix.mergeManifest()

//------------------------------------ZEROHEIGHT------------------------------------
mix.sass('resources/sass/zeroheight/master.sass', 'public/css/zeroheight/')
//----------------------------------------------------------------------------------
