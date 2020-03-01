var elixir = require("laravel-elixir");
var svgSprite = require('gulp-svg-sprites'),
	svgmin = require('gulp-svgmin'),
	cheerio = require('gulp-cheerio'),
    replace = require('gulp-replace'),
    backstop = require('backstopjs'),
    args = require('yargs').argv;

elixir(function(mix) {
    mix.browserSync({
		proxy: 'hyundai',
		port: 8080
		// tunnel: true,
		// tunnel: "hyundai123", //Demonstration page: http://hyundai123.localtunnel.me
    });
});

// elixir(function(mix) {
//     mix.task('svg');
// });

// elixir(function(mix) {
//     mix.task('svgSpriteSass');
// });

// gulp.task('svg', function () {
//     return gulp.src('resources/assets/icons/*.svg')
//         .pipe(cheerio({
//             run: function ($) {
//                 $('[fill]').removeAttr('fill');
//                 $('[stroke]').removeAttr('stroke');
//                 $('[style]').removeAttr('style');
//             },
//             parserOptions: {xmlMode: true}
//         }))
//         .pipe(replace('&gt;', '>'))
//         .pipe(svgSprite({
//             mode: "symbols",
//             selector: "icon-%f"
//         }))
//         .pipe(gulp.dest("resources/assets/sprite/"));
// });

// gulp.task('svgSpriteSass', function () {
// 	return gulp.src('resources/assets/icons/*.svg')
// 		.pipe(svgSprite({
// 				preview: false,
// 				selector: "icon-%f",
// 				cssFile: 'sass/_svg_sprite.scss',
// 				templates: {
// 					css: require("fs").readFileSync('./resources/assets/sprite/_template.scss', "utf-8")
// 				}
// 			}
// 		))
// 		.pipe(gulp.dest('resources/assets/sprite/'));
// });

//Запуск тестов:
//gulp b-test --page название-страницы
//Принять изменения
//gulp b-approve --page название-страницы

//Tests
elixir(function(mix) {
    mix.task('b-test');
});

elixir(function(mix) {
    mix.task('b-approve');
});

gulp.task('b-test', () => {
	var page = args.page || '';

    switch (page) {
        case 'configurator':
            backstop('test', {config:'./backstop_data/configs/configurator.json'});
            break;

        case 'kit':
            backstop('test', {config:'./backstop_data/configs/kit.json'});
			break;
			
        case 'contact-us':
            backstop('test', {config:'./backstop_data/configs/contact-us.json'});
			break;

        case 'test-drive':
            backstop('test', {config:'./backstop_data/configs/test-drive.json'});
			break;

        case 'service-request':
            backstop('test', {config:'./backstop_data/configs/service-request.json'});
			break;
			
        case 'service-main':
			backstop('test', {config:'./backstop_data/configs/service-main.json'});
			break;
			
        case 'find-dealer':
			backstop('test', {config:'./backstop_data/configs/find-dealer.json'});
			break;
			
        case 'main':
			backstop('test', {config:'./backstop_data/configs/main.json'});
			break;
			
        case 'motorstudio':
			backstop('test', {config:'./backstop_data/configs/motorstudio.json'});
			break;
			
        case 'brand-collection':
			backstop('test', {config:'./backstop_data/configs/brand-collection.json'});
			break;

        case 'vacancy':
			backstop('test', {config:'./backstop_data/configs/vacancy.json'});
			break;

        case 'shell':
			backstop('test', {config:'./backstop_data/configs/shell.json'});
			break;

        case 'bodyworks':
			backstop('test', {config:'./backstop_data/configs/bodyworks.json'});
			break;

        case 'warranty':
			backstop('test', {config:'./backstop_data/configs/warranty.json'});
			break;

        case 'manuals':
			backstop('test', {config:'./backstop_data/configs/manuals.json'});
			break;

        case 'service-book':
			backstop('test', {config:'./backstop_data/configs/service-book.json'});
			break;

        case 'parts':
			backstop('test', {config:'./backstop_data/configs/parts.json'});
			break;

        case 'best':
			backstop('test', {config:'./backstop_data/configs/best.json'});
			break;

        case 'assistance':
			backstop('test', {config:'./backstop_data/configs/assistance.json'});
			break;

        case 'pl2':
			backstop('test', {config:'./backstop_data/configs/pl2.json'});
			break;

        case 'philosophy':
			backstop('test', {config:'./backstop_data/configs/philosophy.json'});
			break;

		case 'all':
			backstop('test', {config:'./backstop_data/configs/kit.json'});
			backstop('test', {config:'./backstop_data/configs/main.json'});
			backstop('test', {config:'./backstop_data/configs/vacancy.json'});
			backstop('test', {config:'./backstop_data/configs/motorstudio.json'});
			backstop('test', {config:'./backstop_data/configs/brand-collection.json'});
			backstop('test', {config:'./backstop_data/configs/find-dealer.json'});
			backstop('test', {config:'./backstop_data/configs/service-main.json'});
			backstop('test', {config:'./backstop_data/configs/contact-us.json'});
			backstop('test', {config:'./backstop_data/configs/test-drive.json'});
			backstop('test', {config:'./backstop_data/configs/service-request.json'});
			backstop('test', {config:'./backstop_data/configs/configurator.json'});
			backstop('test', {config:'./backstop_data/configs/shell.json'});
			backstop('test', {config:'./backstop_data/configs/bodyworks.json'});
			backstop('test', {config:'./backstop_data/configs/warranty.json'});
			backstop('test', {config:'./backstop_data/configs/manuals.json'});
			backstop('test', {config:'./backstop_data/configs/service-book.json'});
			backstop('test', {config:'./backstop_data/configs/parts.json'});
			backstop('test', {config:'./backstop_data/configs/best.json'});
			backstop('test', {config:'./backstop_data/configs/assistance.json'});
			backstop('test', {config:'./backstop_data/configs/pl2.json'});
			backstop('test', {config:'./backstop_data/configs/philosophy.json'});
			break;
			
        default:
            break;
    }
});

gulp.task('b-approve', () => {
    var page = args.page || '';

    switch (page) {
        case 'configurator':
            backstop('approve', {config:'./backstop_data/configs/configurator.json'});
            break;

        case 'kit':
            backstop('approve', {config:'./backstop_data/configs/kit.json'});
			break;
			
        case 'contact-us':
            backstop('approve', {config:'./backstop_data/configs/contact-us.json'});
			break;

        case 'test-drive':
            backstop('approve', {config:'./backstop_data/configs/test-drive.json'});
			break;

        case 'service-request':
            backstop('approve', {config:'./backstop_data/configs/service-request.json'});
			break;
			
        case 'service-main':
            backstop('approve', {config:'./backstop_data/configs/service-main.json'});
			break;
			
        case 'find-dealer':
            backstop('approve', {config:'./backstop_data/configs/find-dealer.json'});
			break;
			
        case 'main':
            backstop('approve', {config:'./backstop_data/configs/main.json'});
			break;
			
        case 'motorstudio':
            backstop('approve', {config:'./backstop_data/configs/motorstudio.json'});
			break;
			
        case 'brand-collection':
            backstop('approve', {config:'./backstop_data/configs/brand-collection.json'});
			break;
			
        case 'vacancy':
            backstop('approve', {config:'./backstop_data/configs/vacancy.json'});
			break;
			
        case 'shell':
            backstop('approve', {config:'./backstop_data/configs/shell.json'});
			break;
			
        case 'bodyworks':
            backstop('approve', {config:'./backstop_data/configs/bodyworks.json'});
			break;

        case 'warranty':
            backstop('approve', {config:'./backstop_data/configs/warranty.json'});
			break;
			
        case 'manuals':
            backstop('approve', {config:'./backstop_data/configs/manuals.json'});
			break;

        case 'service-book':
            backstop('approve', {config:'./backstop_data/configs/service-book.json'});
			break;
			
        case 'parts':
            backstop('approve', {config:'./backstop_data/configs/parts.json'});
			break;
			
        case 'best':
            backstop('approve', {config:'./backstop_data/configs/best.json'});
			break;
			
        case 'assistance':
            backstop('approve', {config:'./backstop_data/configs/assistance.json'});
			break;
			
        case 'pl2':
            backstop('approve', {config:'./backstop_data/configs/pl2.json'});
			break;
			
        case 'philosophy':
            backstop('approve', {config:'./backstop_data/configs/philosophy.json'});
            break;
    
        default:
            break;
    }
});

