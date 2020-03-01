const cars = require('./cars.mix');
const mix = require('laravel-mix');
const webpack = require('webpack');
const path1 = require('path');
const SRC_DIR = path1.resolve(__dirname,"resources");
require('laravel-mix-merge-manifest');

const path = process.env.MIX_BUILD === 'dealer' ? 'dealer/' : '';
const env = process.env.NODE_ENV;

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
	 },
   },

   plugins: [
		new webpack.optimize.LimitChunkCountPlugin({
			maxChunks: 1,
		}),
		// new webpack.optimize.CommonsChunkPlugin({
		// 	children: true,
		// 	minSize: 0
        // })
	],
	// module: {
	// 	rules: [{
	// 		test: /\.js$/,
	// 		include: SRC_DIR,
	// 		use: [{
	// 			loader: 'babel-loader',
	// 			options: {
	// 				plugins: [
	// 					'dynamic-import-webpack',
	// 					'remove-webpack'
	// 				]
	// 			}
	// 		}]
	// 	}]
	// },
})

//Динамическая подгрузка vue компонентов
mix.config.webpackConfig.output = {
	chunkFilename: path + 'js/bundles/[name].bundle.js',
	publicPath: env === 'development' ? '/' : '/',
};

//------------------------------------LAYOUT-------------------------------------------
mix.js('resources/js/pages/layout/common.js', 'public/' + path + 'js/')
mix.js('resources/js/common/lazypreview.js', 'public/' + path + 'js/')
mix.sass('resources/sass/layout/master.sass', 'public/' + path + 'css')
mix.sass('resources/sass/layout/layoutFixed.sass', 'public/' + path + 'css')
mix.sass('resources/sass/common/components/_placeholder.sass', 'public/' + path + 'css/placeholder.css')

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
	'resources/libs/polyfill/object-fit.min.js',
	'resources/libs/polyfill/assign.js'
],
   'public/' + path + 'js/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------INDEX-------------------------------------------
//так подключаются js, sass, scss... файлы. Эти файлы будут скомпилированы, т.е. например js будет преобразован в ES5 и т.д.
mix.js('resources/js/pages/index/index.js', 'public/' + path + 'js/index')
   .sass('resources/sass/pages/index/index.sass', 'public/' + path + 'css/index');


mix.js('resources/js/pages/index/index-dealer.js', 'public/' + path + 'js/index');
mix.sass('resources/sass/pages/index/index-dealer.sass', 'public/' + path + 'css/index');

//так подключаются css файлы, которые не нужно компилировать, например библиотеки.
mix.styles([
	'resources/libs/OwlCarousel/dist/assets/owl.carousel.min.css',
	'resources/libs/selectize/selectize.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/noUiSlider-12.1.0/nouislider.min.css',
	], 'public/' + path + 'css/index/libs.css');



//так подключаются js файлы библиотек.
mix.scripts([
	'resources/libs/OwlCarousel/dist/owl.carousel.min.js',
	'resources/libs/polyfill/promise.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
	'resources/libs/lodash/lodash.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js',
	'resources/libs/noUiSlider-12.1.0/nouislider.min.js',
	'resources/libs/scrollmagic/ScrollMagic.min.js'
],
	'public/' + path + 'js/index/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------CONFIGURATOR-------------------------------------------
mix.js('resources/js/pages/configurator/configurator.js', 'public/' + path + 'js/configurator')
	.js('resources/js/pages/configurator/forms.js', 'public/' + path + 'js/configurator')
   .sass('resources/sass/pages/configurator/configurator.sass', 'public/' + path + 'css/configurator');

mix.styles([
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/selectize/selectize.css'
], 'public/' + path + 'css/configurator/libs.css');

mix.scripts([
   'resources/libs/polyfill/promise.js',
   'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js'
],
   'public/' + path + 'js/configurator/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------SERVICE-------------------------------------------
mix.js('resources/js/pages/service/service.js', 'public/' + path + 'js/service')
   .js('resources/js/pages/service/service-calculator.js', 'public/' + path + 'js/service')
   .js('resources/js/pages/service/book/book.js', 'public/' + path + 'js/service/')
   .sass('resources/sass/pages/service/service.sass', 'public/' + path + 'css/service')
   .sass('resources/sass/pages/service/book.sass', 'public/' + path + 'css/service');

mix.styles([
   'resources/libs/OwlCarousel/dist/assets/owl.carousel.min.css',
   'resources/libs/OwlCarousel/dist/assets/owl.theme.default.min.css',
   'resources/libs/selectize/selectize.css',
   'resources/libs/noUiSlider-12.1.0/nouislider.min.css',
   'resources/libs/animate-css/animate.css',
   'resources/libs/perfect-scrollbar/perfect-scrollbar.css'
], 'public/' + path + 'css/service/libs.css');

mix.scripts([
   'resources/libs/polyfill/promise.js',
   'resources/libs/OwlCarousel/dist/owl.carousel.min.js',
   'resources/libs/noUiSlider-12.1.0/nouislider.min.js',
   'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js',
   'resources/js/common/slider-1.js',
   'resources/js/common/slider-2.js'
],
   'public/' + path + 'js/service/libs.js');
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

//------------------------------------CONTACT-US-------------------------------------------
mix.js('resources/js/pages/contactUs/contact-us.js', 'public/' + path + 'js/contact-us')
   .sass('resources/sass/pages/contactUs/contact-us.sass', 'public/' + path + 'css/contact-us');

mix.styles([
	'resources/libs/selectize/selectize.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css'
 ], 'public/' + path + 'css/contact-us/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js'
 ],
	'public/' + path + 'js/contact-us/libs.js')
//------------------------------------------------------------------------------------
//------------------------------------SHELL-------------------------------------------
mix.js('resources/js/pages/service/shell/shell.js', 'public/' + path + 'js/service/shell')
   .sass('resources/sass/pages/service/shell/shell.sass', 'public/' + path + 'css/service/shell');

mix.styles([
   'resources/libs/selectize/selectize.css',
   'resources/libs/perfect-scrollbar/perfect-scrollbar.css'
], 'public/' + path + 'css/service/shell/libs.css');

mix.scripts([
   'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js',
   'resources/libs/selectize/selectize.min.js',
   'resources/libs/polyfill/promise.js',
],
   'public/' + path + 'js/service/shell/libs.js');
//-----------------------------------------------------------------------------------

//------------------------------------START-------------------------------------------
mix.js('resources/js/pages/start/start.js', 'public/' + path + 'js/start')
	.js('resources/js/pages/start/calc.js', 'public/' + path + 'js/start')
	.sass('resources/sass/pages/start/start.sass', 'public/' + path + 'css/start');

mix.styles([
	'resources/libs/selectize/selectize.css',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.css',
	'resources/libs/OwlCarousel/dist/assets/owl.carousel.min.css',
	'resources/libs/OwlCarousel/dist/assets/owl.theme.default.min.css',
	'resources/libs/noUiSlider-12.1.0/nouislider.min.css',
 ], 'public/' + path + 'css/start/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/lodash/lodash.js',
	'resources/libs/perfect-scrollbar/perfect-scrollbar.min.js',
	'resources/libs/noUiSlider-12.1.0/nouislider.min.js',
	'resources/libs/scrollmagic/ScrollMagic.min.js',
	'resources/libs/OwlCarousel/dist/owl.carousel.min.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
 ],
	'public/' + path + 'js/start/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------DEALER CARS-------------------------------------------
	mix.js('resources/js/pages/dealer/cars/index.js', 'public/' + path + 'js/cars')
	mix.sass('resources/sass/pages/dealer/cars/showroom-static.sass', 'public/' + path + 'css/cars')

	mix.styles([
		'resources/libs/selectize/selectize.css',
		'resources/libs/slickSlider/slick-theme.css',
		'resources/libs/slickSlider/slick.css',
	], 'public/' + path + 'css/cars/libs.css');

	mix.scripts([
		'resources/libs/polyfill/promise.js',
		'resources/libs/hammerjs/hammer.min.js',
		'resources/libs/slickSlider/slick.min.js',
	],
		'public/' + path + 'js/cars/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------DEALER ABOUT-------------------------------------------
mix.js('resources/js/pages/dealer/about/index.js', 'public/' + path + 'js/about')
mix.sass('resources/sass/pages/dealer/about/about.sass', 'public/' + path + 'css/about')

mix.styles([
	'resources/libs/selectize/selectize.css',
], 'public/' + path + 'css/about/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
],
	'public/' + path + 'js/about/libs.js')
//------------------------------------------------------------------------------------

//------------------------------------DEALER TRADE IN-------------------------------------------
mix.js('resources/js/pages/dealer/tradein/index.js', 'public/' + path + 'js/tradein')
mix.sass('resources/sass/pages/dealer/tradein/tradein.sass', 'public/' + path + 'css/tradein')

mix.styles([
	'resources/libs/selectize/selectize.css',
], 'public/' + path + 'css/tradein/libs.css');

mix.scripts([
	'resources/libs/polyfill/promise.js',
	'resources/libs/lazyLoad/ls.bgset.min.js',
	'resources/libs/lazyLoad/lazysizes.min.js',
],
	'public/' + path + 'js/tradein/libs.js')
//------------------------------------------------------------------------------------

// Некоторые стили для дилеров на страницах тачек
mix.sass('resources/sass/pages/cars/dealers.sass', 'public/' + path + 'css')
cars.modules(mix, path);

//уникальные имена собраным файлам, чтобы они не кэшировались
mix.version()
//Чтобы одна сборка не перезаписывала другую
mix.mergeManifest()
