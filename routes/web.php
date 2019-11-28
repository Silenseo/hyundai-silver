<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* redirects */
Route::get('Become-a-dealer', function () { return redirect('become-a-dealer'); });
Route::get('brand-collection/category/{cat_name}', function ($cat_name) { return redirect('brand-collection/' . $cat_name); });
Route::get('CareersMoscow', function () { return redirect('vacancy'); });
Route::get('CareersMoscow/{id}', function ($id) { return redirect('vacancy/' . $id); });

/* Сначала объявим роуты для админки */
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth', 'as' => 'admin.'], function () {
    Route::get('/', 'AdminController@index')->name('adminindex');
    Route::get('johndoe', 'ZController@test');
    // Тут будут роуты админки
    Route::resource('users', 'UserController');
    Route::resource('user_roles', 'UserRoleController');

    Route::resource('cars', 'CarsController');
    Route::resource('banners', 'BannersController');
    Route::resource('cities', 'CitiesRegionsController');
    Route::get('dealers/download_xls', ['as' => 'dealers.download_xls', 'uses' => 'DealersController@downloadXLS']);
    Route::resource('dealers', 'DealersController');
    Route::resource('news', 'NewsController');
    Route::resource('offers', 'OffersController');
    Route::resource('placeholders', 'PlaceholderController');
    Route::resource('seo', 'SeoController');
    Route::resource('motorstudio_events', 'MotorstudioEventController');
    Route::get('motorstudio_requests/download', ['as' => 'motorstudio_requests.download', 'uses' => 'MotorstudioRequestController@downloadCSV']);
    Route::resource('motorstudio_requests', 'MotorstudioRequestController');
    Route::resource('motorstudio_deadlines', 'MotorstudioDeadlineController');
    Route::resource('brandcollection_categories', 'BrandcollectionCategoryController');
    Route::resource('brandcollection_tags', 'BrandcollectionTagController');
    Route::resource('brandcollection_products', 'BrandcollectionProductController');
    Route::resource('warranty_cars', 'WarrantyCarController');
    Route::resource('accessories_categories', 'AccessoriesCategoryController');
    Route::resource('accessories_products', 'AccessoriesProductController');
    Route::resource('special_offer_labels', 'SpecialOfferLabelController');
    Route::resource('special_offers', 'SpecialOfferController');
    Route::resource('csvfile', 'CsvFileController');
    Route::resource('manuals', 'ManualController');
    Route::resource('siebel_logs', 'SiebelLogController');
    Route::resource('storage_photos', 'StoragePhotosController');

    Route::get('cache_clear', ['as' => 'cache_clear', 'uses' => function() {
        Artisan::call('cache:clear');
        return response('Кэш сброшен<br/><a href="/admin">В админку</a>');
    }]);
});

Route::group(['prefix' => 'requestapi', 'as' => 'requestapi.'], function() {
    Route::get('getDealers', ['as' => 'get_dealers', 'uses' => 'RequestApiController@getDealers']);
    Route::get('getModels', ['as' => 'get_models', 'uses' => 'RequestApiController@getModels']);
    Route::get('getEvents', ['as' => 'get_events', 'uses' => 'RequestApiController@getEvents']); /***/
    Route::get('getOffers', ['as' => 'get_offers', 'uses' => 'RequestApiController@getOffers']); /***/
    // Route::get('sendto_old', ['as' => 'send_to_old', 'uses' => 'RequestApiController@sendTOOld']); /***/
    // Route::get('sendto', ['as' => 'send_to', 'uses' => 'RequestApiController@sendTO']); /***/
    // Route::get('sendtd', ['as' => 'send_td', 'uses' => 'RequestApiController@sendTD']); /***/
    Route::get('brochureCodes', ['as' => 'get_brochure_codes', 'uses' => 'RequestApiController@getBrochureCodes']);
    Route::get('sendto', ['as' => 'send_to', 'uses' => 'SoapSiebelController@sendcrm']);
    Route::get('sendtd', ['as' => 'send_td', 'uses' => 'SoapSiebelController@sendtd']);
    Route::get('request_brochure', ['as' => 'request_brochure', 'uses' => 'SoapSiebelController@requestBrochure']);
});

/***/
Route::group(['prefix' => 'api'], function() {
    Route::get('/send/testdrive', ['as' => 'api_send_testdrive', 'uses' => 'Ajax\FormsController@sendTestDrive']);
    Route::get('/send/servicerequest', ['as' => 'api_send_servicerequest', 'uses' => 'Ajax\FormsController@sendServiceRequest']);
    Route::get('/send/offercreditrequest', ['as' => 'offercreditrequest', 'uses' => 'Ajax\FormsController@offerCreditRequest']);

    Route::get('/send/start', ['as' => 'api_send_start', 'uses' => 'Ajax\FormsController@sendStart']);
    Route::post('/send/start', ['as' => 'api_send_start', 'uses' => 'Ajax\FormsController@sendStart']);

    Route::get('/send/contactus', ['as' => 'api_send_contactus', 'uses' => 'SoapSiebelController@sendcontactus']);
    Route::post('/send/contactus', ['as' => 'api_send_contactus_post', 'uses' => 'SoapSiebelController@sendcontactus']);

    Route::get('/send/motorstudio_request', ['as' => 'api_send_motorstudio_request', 'uses' => 'Ajax\FormsController@sendMotorstudioRequest']);
     Route::get('/send/eventRequest', ['as' => 'api_send_event_request', 'uses' => 'Ajax\FormsController@sendEventRequest']);
     Route::post('/send/eventRequest', ['as' => 'api_send_event_request', 'uses' => 'Ajax\FormsController@sendEventRequest']);

    Route::get('/send/jobseeker', ['as' => 'api_send_jobseeker', 'uses' => 'Ajax\FormsController@jobseeker']);
    Route::post('/send/jobseeker', ['as' => 'api_send_jobseeker_post', 'uses' => 'Ajax\FormsController@jobseeker']);

    Route::get('/service/checkVin', ['as' => 'api_service_checkvin', 'uses' => 'Ajax\FormsController@checkVin']);

    Route::get('/carList', ['as' => 'api_carlist', 'uses' => 'Ajax\ApiController@carList']);
    Route::get('/dealers', ['as' => 'api_dealers', 'uses' => 'Ajax\ApiController@dealers']);
});
/***/

/***/
Route::group(['prefix' => 'requestnew'], function() {
    Route::get('/checkvin', ['as' => 'api_old_checkvin', 'uses' => 'Ajax\OldController@checkVin']);

    Route::get('/getserviceengines', ['as' => 'api_old_checkvin', 'uses' => 'Ajax\ServiceCalculatorController@getServiceEngines']);

    Route::get('/getserviceenginetypes', ['as' => 'api_old_checkvin', 'uses' => 'Ajax\ServiceCalculatorController@getServiceEngineTypes']);

    Route::get('/getservicecost', ['as' => 'api_old_checkvin', 'uses' => 'Ajax\ServiceCalculatorController@getServiceCost']);
});

Route::get('/getPicThumb/{path}', 'ZController@getPicThumb')->where('path', '.*');;

Route::get('/car/{id_text}', ['as' => 'car', 'uses' => 'Frontend\CarController@showCar']);

Route::get('/all-offers', 'SpecialOfferController@index');
Route::get('/all-offers/{code}', 'Frontend\OffersController@offerPage');
Route::get('/offers/{code}', 'Frontend\OffersController@offerPageRedirect');
Route::get('/special-offer', 'Frontend\OffersController@specialOffer')->name('static_specialoffer');
Route::get('/pl2', 'Frontend\OffersController@pl2')->name('static_pl2');
Route::get('/promo/solaris_super_series', function () {
/*
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.cofigurator.hyundai.ru/dealers');
//    curl_setopt($ch, CURLOPT_USERAGENT, 'HH-User-Agent');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $dealers = json_decode(curl_exec($ch), true);
    curl_close($ch);
*/


/*
    $json = file_get_contents('https://api.cofigurator.hyundai.ru/dealers');
    $dealers = json_decode($json, true);
*/

    $dealers = json_decode('[{"name":"\u041c\u043e\u0441\u043a\u0432\u0430 \u0438 \u041f\u043e\u0434\u043c\u043e\u0441\u043a\u043e\u0432\u044c\u0435","dealers":[{"id":267,"name":"GN service","code":"C40AF01156","credit_id":0,"i30n":0},{"id":223,"name":"Hyundai City Store \u0410\u0412\u0418\u041b\u041e\u041d","code":"C40AF11027","credit_id":0,"i30n":0},{"id":260,"name":"INCHCAPE","code":"C40AF01155","credit_id":491,"i30n":1},{"id":189,"name":"Major","code":"C40AF11090","credit_id":777,"i30n":0},{"id":218,"name":"Major \u041c\u041a\u0410\u0414 18 \u043a\u043c","code":"C40AF21090","credit_id":778,"i30n":0},{"id":217,"name":"Major \u041c\u041a\u0410\u0414 47 \u043a\u043c","code":"C40AF31090","credit_id":779,"i30n":0},{"id":228,"name":"\u0410\u0412\u0410\u041d\u0422\u0410\u0419\u041c \u0421\u041f","code":"C40AF01112","credit_id":781,"i30n":0},{"id":14,"name":"\u0410\u0413-\u041c\u043e\u0442\u043e\u0440\u0441 \u0411\u0430\u043b\u0430\u0448\u0438\u0445\u0430","code":"C40AF01038","credit_id":788,"i30n":0},{"id":28,"name":"\u0410\u0432\u0430\u043d\u0442\u0430-\u0417\u0430\u043f\u0430\u0434","code":"C40AF01144","credit_id":798,"i30n":0},{"id":27,"name":"\u0410\u0432\u0438\u043b\u043e\u043d","code":"C40AF01027","credit_id":0,"i30n":0},{"id":241,"name":"\u0410\u0432\u0440\u043e\u0440\u0430","code":"C40AF01115","credit_id":0,"i30n":0},{"id":48,"name":"\u0410\u0432\u0442\u043e\u0413\u0415\u0420\u041c\u0415\u0421","code":"C40AF11038","credit_id":784,"i30n":0},{"id":64,"name":"\u0410\u0432\u0442\u043e\u0421\u043f\u0435\u0446\u0426\u0435\u043d\u0442\u0440 \u0412\u043d\u0443\u043a\u043e\u0432\u043e","code":"C40AF01002","credit_id":0,"i30n":0},{"id":39,"name":"\u0410\u0432\u0442\u043e\u043c\u0438\u0440 \u0414\u043c\u0438\u0442\u0440\u043e\u0432\u043a\u0430","code":"C40AF20328","credit_id":0,"i30n":0},{"id":38,"name":"\u0410\u0432\u0442\u043e\u043c\u0438\u0440 \u041c\u0430\u0440\u044c\u0438\u043d\u043e","code":"C40AF10328","credit_id":0,"i30n":0},{"id":161,"name":"\u0410\u0432\u0442\u043e\u043c\u0438\u0440 \u0421\u043e\u043a\u043e\u043b\u044c\u043d\u0438\u043a\u0438","code":"C40AF30328","credit_id":0,"i30n":0},{"id":225,"name":"\u0410\u0432\u0442\u043e\u0440\u0443\u0441\u044c \u0411\u0443\u0442\u043e\u0432\u043e","code":"C40AF01138","credit_id":773,"i30n":0},{"id":210,"name":"\u0410\u0432\u0442\u043e\u0440\u0443\u0441\u044c \u041b\u043e\u0441\u0438\u043d\u044b\u0439 \u041e\u0441\u0442\u0440\u043e\u0432","code":"C40AF01101","credit_id":0,"i30n":0},{"id":168,"name":"\u0410\u0432\u0442\u043e\u0440\u0443\u0441\u044c \u041f\u043e\u0434\u043e\u043b\u044c\u0441\u043a","code":"C40AF01060","credit_id":768,"i30n":0},{"id":192,"name":"\u0410\u0432\u0442\u043e\u0446\u0435\u043d\u0442\u0440 \u0421\u0438\u0442\u0438 \u042e\u0433","code":"C40AF01091","credit_id":0,"i30n":0},{"id":172,"name":"\u0410\u043a\u0440\u043e\u0441","code":"C40AF01070","credit_id":775,"i30n":0},{"id":74,"name":"\u0410\u043a\u0446\u0435\u043d\u0442-\u0410\u0432\u0442\u043e \u041c\u043e\u0441\u043a\u0432\u0430","code":"C40AF00354","credit_id":790,"i30n":0},{"id":94,"name":"\u041a\u0412\u0418\u0421\u0422","code":"C40AF00996","credit_id":821,"i30n":0},{"id":257,"name":"\u041a\u041b\u042e\u0427\u0410\u0412\u0422\u041e \u0412\u043e\u043b\u043e\u043a\u043e\u043b\u0430\u043c\u043a\u0430","code":"C40AF01150","credit_id":0,"i30n":0},{"id":256,"name":"\u041a\u041b\u042e\u0427\u0410\u0412\u0422\u041e \u041b\u044e\u0431\u0435\u0440\u0446\u044b","code":"C40AF01149","credit_id":792,"i30n":0},{"id":185,"name":"\u041a\u043e\u0440\u0441\u0413\u0440\u0443\u043f\u043f","code":"C40AF01153","credit_id":0,"i30n":0},{"id":145,"name":"\u041e\u0440\u0435\u0445\u043e\u0432\u043e-\u0410\u0432\u0442\u043e\u0426\u0435\u043d\u0442\u0440","code":"C40AF01116","credit_id":0,"i30n":0},{"id":136,"name":"\u0420\u0422\u0420-\u0410\u0432\u0442\u043e","code":"C40AF01157","credit_id":822,"i30n":0},{"id":141,"name":"\u0420\u043e\u043b\u044c\u0444 \u0410\u043b\u0442\u0443\u0444\u044c\u0435\u0432\u043e","code":"C40AF10120","credit_id":716,"i30n":0},{"id":140,"name":"\u0420\u043e\u043b\u044c\u0444 \u0421\u0438\u0442\u0438","code":"C40AF40120","credit_id":756,"i30n":0},{"id":142,"name":"\u0420\u043e\u043b\u044c\u0444 \u0425\u0438\u043c\u043a\u0438","code":"C40AF20120","credit_id":712,"i30n":0},{"id":139,"name":"\u0420\u043e\u043b\u044c\u0444 \u042e\u0433","code":"C40AF30120","credit_id":464,"i30n":0},{"id":131,"name":"\u0421\u0418\u041c","code":"C40AF00132","credit_id":570,"i30n":0},{"id":265,"name":"\u0424\u0430\u0432\u043e\u0440\u0438\u0442 \u041c\u043e\u0442\u043e\u0440\u0441","code":"C40AF01158","credit_id":0,"i30n":0},{"id":52,"name":"\u0425\u0435\u043d\u0434\u044d \u0426\u0435\u043d\u0442\u0440 \u041a\u0443\u043d\u0446\u0435\u0432\u043e","code":"C40AF01063","credit_id":795,"i30n":0},{"id":242,"name":"\u0426\u0435\u043d\u0442\u0440 \u0417\u0435\u043b\u0435\u043d\u043e\u0433\u0440\u0430\u0434","code":"C40AF01128","credit_id":796,"i30n":0}]},{"name":"\u0421\u0430\u043d\u043a\u0442-\u041f\u0435\u0442\u0435\u0440\u0431\u0443\u0440\u0433","dealers":[{"id":244,"name":"\u0410\u0432\u0430\u043d\u0433\u0430\u0440\u0434","code":"C40AF01129","credit_id":823,"i30n":0},{"id":187,"name":"\u0410\u0432\u0442\u043e\u043f\u043e\u043b\u0435","code":"C40AF01147","credit_id":825,"i30n":0},{"id":183,"name":"\u0412\u043e\u0441\u0442\u043e\u043a-\u0410\u0432\u0442\u043e","code":"C40AF00233","credit_id":826,"i30n":0},{"id":199,"name":"\u0412\u043e\u0441\u0442\u043e\u043a-\u0410\u0432\u0442\u043e \u0416\u0443\u043a\u043e\u0432\u0430","code":"C40AF10233","credit_id":0,"i30n":0},{"id":263,"name":"\u0414\u0430\u043a\u0430\u0440 \u0422\u0430\u043b\u043b\u0438\u043d\u0441\u043a\u043e\u0435","code":"C40AF01151","credit_id":0,"i30n":0},{"id":173,"name":"\u041c\u0430\u043a\u0441\u0438\u043c\u0443\u043c","code":"C40AF01062","credit_id":829,"i30n":0},{"id":23,"name":"\u0420\u041e\u041b\u042c\u0424 \u041b\u0430\u0445\u0442\u0430","code":"C40AF01028","credit_id":0,"i30n":1},{"id":191,"name":"\u0420\u043e\u043b\u044c\u0444 \u041e\u043a\u0442\u044f\u0431\u0440\u044c\u0441\u043a\u0430\u044f","code":"C40AF11028","credit_id":830,"i30n":0}]},{"name":"\u0410\u0431\u0430\u043a\u0430\u043d","dealers":[{"id":85,"name":"\u041c\u0435\u0434\u0432\u0435\u0434\u044c","code":"C40AF01001","credit_id":831,"i30n":0}]},{"name":"\u0410\u0440\u0445\u0430\u043d\u0433\u0435\u043b\u044c\u0441\u043a","dealers":[{"id":56,"name":"\u0414\u0438\u043d\u0430\u043c\u0438\u043a\u0430","code":"C40AF00342","credit_id":594,"i30n":0}]},{"name":"\u0410\u0441\u0442\u0440\u0430\u0445\u0430\u043d\u044c","dealers":[{"id":177,"name":"\u0410\u0413\u0410\u0422-\u041f\u043b\u044e\u0441","code":"C40AF00332","credit_id":832,"i30n":0}]},{"name":"\u0411\u0430\u0440\u043d\u0430\u0443\u043b","dealers":[{"id":70,"name":"\u0410\u0432\u0442\u043e\u0446\u0435\u043d\u0442\u0440 \u0410\u041d\u0422","code":"C40AF00278","credit_id":833,"i30n":0}]},{"name":"\u0411\u0435\u043b\u0433\u043e\u0440\u043e\u0434\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c","dealers":[{"id":249,"name":"\u0420\u0438\u043d\u0433 \u0410\u0432\u0442\u043e \u0411\u0435\u043b\u0433\u043e\u0440\u043e\u0434","code":"C40AF01136","credit_id":0,"i30n":0},{"id":164,"name":"\u0420\u0438\u043d\u0433 \u0410\u0432\u0442\u043e \u041e\u0441\u043a\u043e\u043b","code":"C40AF01029","credit_id":981,"i30n":0},{"id":58,"name":"\u0422\u0420\u0418\u041d\u0418\u0422\u0418 \u041c\u041e\u0422\u041e\u0420\u0421","code":"C40AF00355","credit_id":565,"i30n":0}]},{"name":"\u0411\u043b\u0430\u0433\u043e\u0432\u0435\u0449\u0435\u043d\u0441\u043a","dealers":[{"id":20,"name":"\u0410\u0442\u0438\u043a-\u041c\u043e\u0442\u043e\u0440\u0441","code":"C40AF01069","credit_id":835,"i30n":0}]},{"name":"\u0411\u0440\u044f\u043d\u0441\u043a","dealers":[{"id":35,"name":"\u0410\u0432\u0442\u043e\u043c\u0438\u0440","code":"C40AF50328","credit_id":0,"i30n":0}]},{"name":"\u0412\u0435\u043b\u0438\u043a\u0438\u0439 \u041d\u043e\u0432\u0433\u043e\u0440\u043e\u0434","dealers":[{"id":49,"name":"\u0410\u0412\u041d","code":"C40AF01007","credit_id":837,"i30n":0}]},{"name":"\u0412\u043b\u0430\u0434\u0438\u0432\u043e\u0441\u0442\u043e\u043a","dealers":[{"id":163,"name":"\u0412\u043e\u0441\u0442\u043e\u043a","code":"C40AF01050","credit_id":0,"i30n":0}]},{"name":"\u0412\u043b\u0430\u0434\u0438\u043a\u0430\u0432\u043a\u0430\u0437","dealers":[{"id":231,"name":"\u0418\u0440\u0430\u0432\u0442\u043e","code":"C40AF01111","credit_id":0,"i30n":0}]},{"name":"\u0412\u043b\u0430\u0434\u0438\u043c\u0438\u0440","dealers":[{"id":126,"name":"\u0422\u0435\u0445\u0446\u0435\u043d\u0442\u0440 \u0413\u0440\u0430\u043d\u0434","code":"C40AF01053","credit_id":840,"i30n":0}]},{"name":"\u0412\u043e\u043b\u0433\u043e\u0433\u0440\u0430\u0434\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c","dealers":[{"id":103,"name":"\u0410\u0413\u0410\u0422 \u043d\u0430 \u043f\u0440.\u041b\u0435\u043d\u0438\u043d\u0430 ","code":"C40AF01016","credit_id":0,"i30n":0},{"id":105,"name":"\u0410\u0413\u0410\u0422 \u043d\u0430 \u0448.\u0410\u0432\u0438\u0430\u0442\u043e\u0440\u043e\u0432","code":"C40AF00256","credit_id":0,"i30n":0},{"id":234,"name":"\u0410\u0440\u043a\u043e\u043d\u0442 \u041c","code":"C40AF01123","credit_id":843,"i30n":0}]},{"name":"\u0412\u043e\u043b\u043e\u0433\u043e\u0434\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c","dealers":[{"id":13,"name":"\u041f\u0440\u0430\u0439\u043c \u041c\u043e\u0442\u043e\u0440\u0441","code":"C40AF01125","credit_id":0,"i30n":0},{"id":193,"name":"\u0421\u0435\u0432\u0435\u0440\u043d\u044b\u0439","code":"C40AF01079","credit_id":0,"i30n":0}]},{"name":"\u0412\u043e\u0440\u043e\u043d\u0435\u0436","dealers":[{"id":219,"name":"\u0410\u0432\u0442\u043e\u043c\u0438\u0440","code":"C40AF60328","credit_id":0,"i30n":0},{"id":155,"name":"\u041c\u043e\u0434\u0443\u0441","code":"C40AF00971","credit_id":0,"i30n":0},{"id":143,"name":"\u0420\u0438\u043d\u0433 \u0410\u0432\u0442\u043e","code":"C40AF00945","credit_id":0,"i30n":0},{"id":243,"name":"\u0420\u0438\u043d\u0433 \u0410\u0432\u0442\u043e \u0421\u0435\u0432\u0435\u0440","code":"C40AF01135","credit_id":0,"i30n":0}]},{"name":"\u0413\u0440\u043e\u0437\u043d\u044b\u0439","dealers":[{"id":233,"name":"\u041b\u0438\u0434\u0435\u0440 \u0410\u0432\u0442\u043e","code":"C40AF01109","credit_id":0,"i30n":0}]},{"name":"\u0418\u0432\u0430\u043d\u043e\u0432\u043e","dealers":[{"id":68,"name":"\u0411\u043b\u043e\u043a \u0420\u043e\u0441\u043a\u043e","code":"C40AF00309","credit_id":0,"i30n":0}]},{"name":"\u0418\u0436\u0435\u0432\u0441\u043a","dealers":[{"id":79,"name":"\u041a\u041e\u041c\u041e\u0421-\u0410\u0432\u0442\u043e","code":"C40AF00243","credit_id":857,"i30n":0},{"id":194,"name":"\u041a\u041e\u041c\u041e\u0421-\u0410\u0432\u0442\u043e","code":"C40AF01086","credit_id":858,"i30n":0},{"id":253,"name":"\u0422\u0440\u0430\u043d\u0441\u0422\u0435\u0445\u0421\u0435\u0440\u0432\u0438\u0441","code":"C40AF11035","credit_id":561,"i30n":0}]},{"name":"\u0418\u0440\u043a\u0443\u0442\u0441\u043a","dealers":[{"id":176,"name":"\u0418\u043d\u0442\u0435\u0440\u043b\u0430\u0439\u043d","code":"C40AF00350","credit_id":0,"i30n":0}]},{"name":"\u0419\u043e\u0448\u043a\u0430\u0440-\u041e\u043b\u0430","dealers":[{"id":45,"name":"\u0410\u0432\u0442\u043e\u043a\u043e\u043c","code":"C40AF00950","credit_id":0,"i30n":0}]},{"name":"\u041a\u0430\u043b\u0438\u043d\u0438\u043d\u0433\u0440\u0430\u0434","dealers":[{"id":86,"name":"\u0414\u0438\u043d\u0430\u043c\u0438\u043a\u0430","code":"C40AF00299","credit_id":701,"i30n":0}]},{"name":"\u041a\u0430\u043b\u0443\u0433\u0430","dealers":[{"id":96,"name":"\u041a\u0430\u043b\u0443\u0433\u0430-\u0410\u0432\u0442\u043e","code":"C40AF00343","credit_id":914,"i30n":0}]},{"name":"\u041a\u0435\u043c\u0435\u0440\u043e\u0432\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c","dealers":[{"id":236,"name":"\u0410\u0432\u0442\u043e\u043c\u0438\u0440","code":"C40AF70328","credit_id":889,"i30n":0},{"id":214,"name":"\u0410\u0432\u0442\u043e\u0446\u0435\u043d\u0442\u0440 \u041a\u0435\u043c\u0435\u0440\u043e\u0432\u043e","code":"C40AF01106","credit_id":863,"i30n":0},{"id":266,"name":"\u041a\u0430\u0440\u0442\u0435\u043b\u044c \u0410\u0432\u0442\u043e","code":"C40AF01154","credit_id":0,"i30n":0}]},{"name":"\u041a\u0438\u0440\u043e\u0432","dealers":[{"id":154,"name":"\u0422\u0421\u041a \u041c\u043e\u0442\u043e\u0440","code":"C40AF00181","credit_id":865,"i30n":0}]},{"name":"\u041a\u043e\u0441\u0442\u0440\u043e\u043c\u0430","dealers":[{"id":171,"name":"\u041b\u0438\u0434\u0435\u0440 \u0410\u0432\u0442\u043e","code":"C40AF01061","credit_id":866,"i30n":0}]},{"name":"\u041a\u0440\u0430\u0441\u043d\u043e\u0434\u0430\u0440\u0441\u043a\u0438\u0439 \u043a\u0440\u0430\u0439","dealers":[{"id":271,"name":"\u0410\u0433\u0430\u0442 \u043d\u0430 \u0420\u043e\u0441\u0442\u043e\u0432\u0441\u043a\u043e\u043c \u0448\u043e\u0441\u0441\u0435","code":"C40AF01161","credit_id":957,"i30n":0},{"id":11,"name":"\u041a\u041b\u042e\u0427\u0410\u0412\u0422\u041e","code":"C40AF01047","credit_id":968,"i30n":0},{"id":91,"name":"\u041a\u041b\u042e\u0427\u0410\u0412\u0422\u041e","code":"C40AF00182","credit_id":870,"i30n":1},{"id":162,"name":"\u041c\u043e\u0434\u0443\u0441","code":"C40AF01055","credit_id":891,"i30n":0},{"id":190,"name":"\u0425\u0451\u043d\u0434\u044d \u0426\u0435\u043d\u0442\u0440 \u0410\u0432\u0442\u043e\u0445\u043e\u043b\u0434\u0438\u043d\u0433","code":"C40AF01087","credit_id":868,"i30n":0},{"id":17,"name":"\u042e\u0433-\u0410\u0432\u0442\u043e","code":"C40AF01032","credit_id":890,"i30n":0},{"id":16,"name":"\u042e\u0433-\u0410\u0432\u0442\u043e","code":"C40AF01031","credit_id":869,"i30n":0},{"id":108,"name":"\u042e\u0433-\u0410\u0432\u0442\u043e","code":"C40AF01009","credit_id":867,"i30n":0}]},{"name":"\u041a\u0440\u0430\u0441\u043d\u043e\u044f\u0440\u0441\u043a","dealers":[{"id":84,"name":"\u041c\u0435\u0434\u0432\u0435\u0434\u044c-\u0421\u0435\u0432\u0435\u0440\u0410\u0432\u0442\u043e","code":"C40AF00326","credit_id":871,"i30n":0},{"id":113,"name":"\u0425\u0435\u043d\u0434\u044d-\u0446\u0435\u043d\u0442\u0440 \u041a\u0440\u0430\u0441\u043d\u043e\u044f\u0440\u0441\u043a","code":"C40AF01019","credit_id":872,"i30n":0}]},{"name":"\u041a\u0443\u0440\u0433\u0430\u043d","dealers":[{"id":207,"name":"\u0421\u0430\u0442\u0443\u0440\u043d-\u0420","code":"C40AF01098","credit_id":873,"i30n":0}]},{"name":"\u041a\u0443\u0440\u0441\u043a","dealers":[{"id":144,"name":"\u041e\u0440\u0438\u043e\u043d \u0410\u0432\u0442\u043e","code":"C40AF00295","credit_id":874,"i30n":0}]},{"name":"\u041b\u0438\u043f\u0435\u0446\u043a","dealers":[{"id":81,"name":"\u041c\u043e\u0434\u0443\u0441","code":"C40AF00318","credit_id":876,"i30n":0},{"id":220,"name":"\u0420\u0438\u043d\u0433 \u0410\u0432\u0442\u043e","code":"C40AF01113","credit_id":875,"i30n":0}]},{"name":"\u041c\u0430\u0445\u0430\u0447\u043a\u0430\u043b\u0430","dealers":[{"id":262,"name":"\u0410\u0432\u0442\u043e\u043b\u044e\u043a\u0441 \u041a\u0430\u0440","code":"C40AF01141","credit_id":0,"i30n":0}]},{"name":"\u041c\u0443\u0440\u043c\u0430\u043d\u0441\u043a","dealers":[{"id":88,"name":"\u0410\u0432\u0442\u043e \u0411\u0440\u043e\u043a\u0435\u0440 \u041c\u0443\u0440\u043c\u0430\u043d\u0441\u043a","code":"C40AF01081","credit_id":881,"i30n":0}]},{"name":"\u041d\u0438\u0436\u043d\u0438\u0439 \u041d\u043e\u0432\u0433\u043e\u0440\u043e\u0434","dealers":[{"id":77,"name":"\u0410\u0413\u0410\u0422 \u043d\u0430 \u041b\u0430\u0440\u0438\u043d\u0430","code":"C40AF00985","credit_id":0,"i30n":1},{"id":76,"name":"\u0410\u0413\u0410\u0422 \u043d\u0430 \u041c\u043e\u0441\u043a\u043e\u0432\u0441\u043a\u043e\u043c \u0448\u043e\u0441\u0441\u0435","code":"C40AF00352","credit_id":0,"i30n":0},{"id":75,"name":"\u0410\u0413\u0410\u0422 \u043d\u0430 \u0420\u043e\u0434\u0438\u043e\u043d\u043e\u0432\u0430","code":"C40AF00272","credit_id":0,"i30n":0},{"id":152,"name":"\u041d\u0438\u0436\u0435\u0433\u043e\u0440\u043e\u0434\u0435\u0446","code":"C40AF01131","credit_id":887,"i30n":0}]},{"name":"\u041d\u043e\u0432\u043e\u0441\u0438\u0431\u0438\u0440\u0441\u043a","dealers":[{"id":36,"name":"\u0410\u0432\u0442\u043e\u043c\u0438\u0440","code":"C40AF00328","credit_id":0,"i30n":0},{"id":198,"name":"\u042d\u043a\u0441\u043f\u0435\u0440\u0442-\u0410\u0432\u0442\u043e","code":"C40AF01095","credit_id":0,"i30n":0}]},{"name":"\u041d\u043e\u044f\u0431\u0440\u044c\u0441\u043a","dealers":[{"id":252,"name":"\u0412\u043e\u0441\u0442\u043e\u043a \u041c\u043e\u0442\u043e\u0440\u0441","code":"C40AF01139","credit_id":0,"i30n":0}]},{"name":"\u041e\u043c\u0441\u043a","dealers":[{"id":255,"name":"\u0410\u043b\u044c\u044f\u043d\u0441","code":"C40AF01142","credit_id":896,"i30n":0},{"id":104,"name":"\u0415\u0432\u0440\u0430\u0437\u0438\u044f \u043f\u043b\u044e\u0441","code":"C40AF00997","credit_id":0,"i30n":0},{"id":117,"name":"\u0424\u0435\u043d\u0438\u043a\u0441-\u0410\u0432\u0442\u043e","code":"C40AF00998","credit_id":897,"i30n":0}]},{"name":"\u041e\u0440\u0435\u043b","dealers":[{"id":67,"name":"\u0412\u043e\u0437\u0440\u043e\u0436\u0434\u0435\u043d\u0438\u0435","code":"C40AF01017","credit_id":898,"i30n":0}]},{"name":"\u041e\u0440\u0435\u043d\u0431\u0443\u0440\u0433\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c","dealers":[{"id":209,"name":"\u0410\u0432\u0442\u043e\u0441\u0430\u043b\u043e\u043d-2000","code":"C40AF01097","credit_id":0,"i30n":0},{"id":166,"name":"\u041a\u0430\u0441\u043a\u0430\u0434-\u041c","code":"C40AF01049","credit_id":0,"i30n":0},{"id":146,"name":"\u041e\u0440\u0435\u043d\u0420\u041e\u041b\u042c\u0424","code":"C40AF00092","credit_id":900,"i30n":0},{"id":227,"name":"\u042d\u043a\u0441\u043f\u0435\u0440\u0442-\u0410\u0432\u0442\u043e","code":"C40AF01122","credit_id":899,"i30n":0}]},{"name":"\u041f\u0435\u043d\u0437\u0430","dealers":[{"id":212,"name":"\u0410\u0432\u0442\u043e\u043c\u0430\u0441\u0442\u0435\u0440","code":"C40AF01103","credit_id":904,"i30n":0},{"id":128,"name":"\u0421\u0443\u0440\u0430-\u041c\u043e\u0442\u043e\u0440\u0441","code":"C40AF00302","credit_id":0,"i30n":0}]},{"name":"\u041f\u0435\u0440\u043c\u044c","dealers":[{"id":226,"name":"\u0412\u043e\u0441\u0442\u043e\u043a \u041c\u043e\u0442\u043e\u0440\u0441","code":"C40AF01117","credit_id":0,"i30n":0},{"id":237,"name":"\u0414\u0410\u0412-\u0410\u0412\u0422\u041e","code":"C40AF01118","credit_id":909,"i30n":0},{"id":132,"name":"\u0421\u0438\u043b\u044c\u0432\u0435\u0440 \u041c\u043e\u0442\u043e\u0440\u0441","code":"C40AF01010","credit_id":905,"i30n":0}]},{"name":"\u041f\u0435\u0442\u0440\u043e\u0437\u0430\u0432\u043e\u0434\u0441\u043a","dealers":[{"id":213,"name":"\u041a-\u041c\u043e\u0442\u043e\u0440\u0441","code":"C40AF01107","credit_id":947,"i30n":0}]},{"name":"\u041f\u0441\u043a\u043e\u0432","dealers":[{"id":153,"name":"\u0410\u0432\u0442\u043e\u0441\u0430\u043b\u043e\u043d 1","code":"C40AF00987","credit_id":0,"i30n":0}]},{"name":"\u0420\u0435\u0441\u043f\u0443\u0431\u043b\u0438\u043a\u0430 \u0411\u0430\u0448\u043a\u043e\u0440\u0442\u043e\u0441\u0442\u0430\u043d","dealers":[{"id":247,"name":"\u0410\u043b\u044c\u0444\u0430-\u0421\u0435\u0440\u0432\u0438\u0441 \u0417\u0443\u0431\u043e\u0432\u043e","code":"C40AF01137","credit_id":915,"i30n":0},{"id":186,"name":"\u0413\u041a \u041c\u0438\u0440","code":"C40AF01076","credit_id":882,"i30n":0},{"id":22,"name":"\u0422\u0440\u0430\u043d\u0441\u0422\u0435\u0445\u0421\u0435\u0440\u0432\u0438\u0441","code":"C40AF21035","credit_id":543,"i30n":0},{"id":121,"name":"\u0422\u0440\u0430\u043d\u0441\u0422\u0435\u0445\u0421\u0435\u0440\u0432\u0438\u0441","code":"C40AF31035","credit_id":542,"i30n":0},{"id":116,"name":"\u0422\u0440\u0430\u043d\u0441\u0422\u0435\u0445\u0421\u0435\u0440\u0432\u0438\u0441","code":"C40AF00168","credit_id":541,"i30n":0}]},{"name":"\u0420\u0435\u0441\u043f\u0443\u0431\u043b\u0438\u043a\u0430 \u0422\u0430\u0442\u0430\u0440\u0441\u0442\u0430\u043d","dealers":[{"id":165,"name":"\u041a\u0410\u041d \u0410\u0412\u0422\u041e","code":"C40AF01052","credit_id":861,"i30n":0},{"id":195,"name":"\u041a\u0410\u041d \u0410\u0412\u0422\u041e","code":"C40AF01093","credit_id":862,"i30n":1},{"id":208,"name":"\u0422\u0440\u0430\u043d\u0441\u0422\u0435\u0445\u0421\u0435\u0440\u0432\u0438\u0441","code":"C40AF10234","credit_id":610,"i30n":0},{"id":123,"name":"\u0422\u0440\u0430\u043d\u0441\u0422\u0435\u0445\u0421\u0435\u0440\u0432\u0438\u0441","code":"C40AF00234","credit_id":0,"i30n":0},{"id":21,"name":"\u0422\u0440\u0430\u043d\u0441\u0422\u0435\u0445\u0421\u0435\u0440\u0432\u0438\u0441","code":"C40AF01035","credit_id":0,"i30n":0},{"id":120,"name":"\u0422\u0440\u0430\u043d\u0441\u0422\u0435\u0445\u0421\u0435\u0440\u0432\u0438\u0441","code":"C40AF01036","credit_id":622,"i30n":0}]},{"name":"\u0420\u043e\u0441\u0442\u043e\u0432\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c","dealers":[{"id":51,"name":"\u0410\u0410\u0410 \u043c\u043e\u0442\u043e\u0440\u0441","code":"C40AF01018","credit_id":0,"i30n":0},{"id":59,"name":"\u0414\u0435\u043b\u044c\u0442\u0430 \u041c\u043e\u0442\u043e\u0440\u0441","code":"C40AF00986","credit_id":962,"i30n":0},{"id":259,"name":"\u041a\u041b\u042e\u0427\u0410\u0412\u0422\u041e \u0420\u043e\u0441\u0442\u043e\u0432","code":"C40AF01145","credit_id":967,"i30n":0},{"id":157,"name":"\u041c\u043e\u0434\u0443\u0441 (\u043f\u0440\u043e\u0441\u043f. \u0428\u043e\u043b\u043e\u0445\u043e\u0432\u0430)","code":"C40AF00336","credit_id":0,"i30n":0},{"id":240,"name":"\u0421\u043e\u043a\u043e\u043b \u041c\u043e\u0442\u043e\u0440\u0441","code":"C40AF01160","credit_id":963,"i30n":0},{"id":127,"name":"\u0422\u0435\u043c\u043f \u0410\u0432\u0442\u043e","code":"C40AF01054","credit_id":0,"i30n":0}]},{"name":"\u0420\u044f\u0437\u0430\u043d\u044c","dealers":[{"id":47,"name":"\u0410\u0432\u0442\u043e\u0438\u043c\u043f\u043e\u0440\u0442","code":"C40AF00957","credit_id":931,"i30n":0},{"id":179,"name":"\u0420\u0435\u0433\u0438\u043e\u043d 62","code":"C40AF01073","credit_id":0,"i30n":0}]},{"name":"\u0421\u0430\u043c\u0430\u0440\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c","dealers":[{"id":33,"name":"\u0410\u0432\u0442\u043e\u0441\u0430\u043b\u043e\u043d \u0410\u0440\u0433\u043e","code":"C40AF00013","credit_id":0,"i30n":0},{"id":80,"name":"\u0410\u0432\u0442\u043e\u0444\u0430\u043d","code":"C40AF00241","credit_id":920,"i30n":0},{"id":254,"name":"\u0410\u0432\u0442\u043e\u0446\u0435\u043d\u0442\u0440 \u0410\u041b\u042c\u0424\u0410","code":"C40AF01143","credit_id":952,"i30n":0},{"id":224,"name":"\u0410\u0440\u0435\u043d\u0430 \u0410\u0432\u0442\u043e","code":"C40AF01114","credit_id":0,"i30n":0},{"id":135,"name":"\u0421\u0430\u043c\u0430\u0440\u0441\u043a\u0438\u0435 \u0410\u0432\u0442\u043e\u043c\u043e\u0431\u0438\u043b\u0438","code":"C40AF00993","credit_id":960,"i30n":0},{"id":110,"name":"\u042d\u043a\u0441\u043f\u0435\u0440\u0442-\u0410\u0432\u0442\u043e","code":"C40AF01084","credit_id":0,"i30n":0}]},{"name":"\u0421\u0430\u0440\u0430\u043d\u0441\u043a","dealers":[{"id":235,"name":"\u0410\u0413\u0410\u0422","code":"C40AF01126","credit_id":898,"i30n":0}]},{"name":"\u0421\u0430\u0440\u0430\u0442\u043e\u0432","dealers":[{"id":78,"name":"\u0410\u0413\u0410\u0422","code":"C40AF01057","credit_id":0,"i30n":0},{"id":109,"name":"\u042d\u043b\u0432\u0438\u0441","code":"C40AF11133","credit_id":0,"i30n":0},{"id":248,"name":"\u042d\u043b\u0432\u0438\u0441 \u041f\u0440\u0435\u043c\u0438\u0443\u043c","code":"C40AF01133","credit_id":0,"i30n":0}]},{"name":"\u0421\u0432\u0435\u0440\u0434\u043b\u043e\u0432\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c","dealers":[{"id":42,"name":"\u0410\u0432\u0442\u043e-\u041b\u0438\u0434\u0435\u0440 \u0426\u0435\u043d\u0442\u0440","code":"C40AF00323","credit_id":855,"i30n":0},{"id":41,"name":"\u0410\u0432\u0442\u043e-\u041b\u0438\u0434\u0435\u0440 \u043d\u0430 \u0428\u0435\u0444\u0441\u043a\u043e\u0439","code":"C40AF00999","credit_id":852,"i30n":0},{"id":215,"name":"\u041b\u0430\u043a\u0438 \u041c\u043e\u0442\u043e\u0440\u0441","code":"C40AF01110","credit_id":0,"i30n":0},{"id":151,"name":"\u041e\u043a\u0430\u043c\u0438 \u0412\u043e\u0441\u0442\u043e\u043a","code":"C40AF01048","credit_id":851,"i30n":0},{"id":24,"name":"\u041e\u043a\u0430\u043c\u0438 \u0417\u0430\u043f\u0430\u0434","code":"C40AF01034","credit_id":0,"i30n":0},{"id":149,"name":"\u041e\u043a\u0430\u043c\u0438 \u0422\u0430\u0433\u0438\u043b","code":"C40AF00989","credit_id":0,"i30n":0},{"id":264,"name":"\u0420\u0435\u0433\u0438\u043d\u0430\u0441","code":"C40AF10223","credit_id":854,"i30n":0}]},{"name":"\u0421\u0438\u043c\u0444\u0435\u0440\u043e\u043f\u043e\u043b\u044c","dealers":[{"id":196,"name":"\u0410\u0432\u0442\u043e\u0446\u0435\u043d\u0442\u0440-\u041c","code":"C40AF01092","credit_id":0,"i30n":0}]},{"name":"\u0421\u043c\u043e\u043b\u0435\u043d\u0441\u043a ","dealers":[{"id":148,"name":"\u041e\u043a\u0442\u0430\u043d-\u0412","code":"C40AF00967","credit_id":911,"i30n":0}]},{"name":"\u0421\u0442\u0430\u0432\u0440\u043e\u043f\u043e\u043b\u044c\u0441\u043a\u0438\u0439 \u043a\u0440\u0430\u0439","dealers":[{"id":261,"name":"\u0410\u0432\u0442\u043e\u0436\u0438\u0437\u043d\u044c","code":"C40AF01140","credit_id":987,"i30n":0},{"id":92,"name":"\u041a\u041b\u042e\u0427\u0410\u0412\u0422\u041e","code":"C40AF00288","credit_id":880,"i30n":0},{"id":258,"name":"\u041a\u041b\u042e\u0427\u0410\u0412\u0422\u041e \u0421\u0442\u0430\u0432\u0440\u043e\u043f\u043e\u043b\u044c","code":"C40AF01146","credit_id":0,"i30n":0},{"id":158,"name":"\u041c\u043e\u0434\u0443\u0441","code":"C40AF00319","credit_id":949,"i30n":0},{"id":156,"name":"\u041c\u043e\u0434\u0443\u0441 ","code":"C40AF00141","credit_id":0,"i30n":0}]},{"name":"\u0421\u044b\u043a\u0442\u044b\u0432\u043a\u0430\u0440","dealers":[{"id":188,"name":"\u0426\u0435\u043d\u0442\u0440 \u041a\u041e\u041c\u0418","code":"C40AF01083","credit_id":0,"i30n":0}]},{"name":"\u0422\u0430\u043c\u0431\u043e\u0432","dealers":[{"id":180,"name":"\u0422\u0430\u043c\u0431\u043e\u0432-\u0410\u0432\u0442\u043e","code":"C40AF01075","credit_id":0,"i30n":0}]},{"name":"\u0422\u0432\u0435\u0440\u044c","dealers":[{"id":197,"name":"\u0412\u0430\u0436\u043d\u0430\u044f \u043f\u0435\u0440\u0441\u043e\u043d\u0430 - \u0410\u0432\u0442\u043e","code":"C40AF01100","credit_id":990,"i30n":0}]},{"name":"\u0422\u043e\u043c\u0441\u043a","dealers":[{"id":246,"name":"\u042d\u043b\u043a\u0435 \u041c\u043e\u0442\u043e\u0440","code":"C40AF01134","credit_id":0,"i30n":0}]},{"name":"\u0422\u0443\u043b\u0430","dealers":[{"id":46,"name":"\u0410\u0432\u0442\u043e\u043a\u043b\u0430\u0441\u0441-\u041b\u0430\u0443\u0440\u0430","code":"C40AF00310","credit_id":912,"i30n":0}]},{"name":"\u0422\u044e\u043c\u0435\u043d\u044c","dealers":[{"id":40,"name":"\u0410\u0432\u0442\u043e\u041c\u0430\u043a\u0441","code":"C40AF00002","credit_id":0,"i30n":0},{"id":66,"name":"\u0412\u043e\u0441\u0442\u043e\u043a \u041c\u043e\u0442\u043e\u0440\u0441","code":"C40AF01082","credit_id":984,"i30n":0}]},{"name":"\u0423\u043b\u0430\u043d-\u0423\u0434\u044d","dealers":[{"id":232,"name":"\u0410\u0432\u0442\u043e\u0446\u0435\u043d\u0442\u0440 \u043d\u0430 \u0428\u0430\u043b\u044f\u043f\u0438\u043d\u0430","code":"C40AF01121","credit_id":0,"i30n":0}]},{"name":"\u0423\u043b\u044c\u044f\u043d\u043e\u0432\u0441\u043a","dealers":[{"id":238,"name":"\u0410\u0432\u0442\u043e\u0440\u0430\u0439-\u0417\u0430\u0432\u043e\u043b\u0436\u044c\u0435","code":"C40AF01127","credit_id":655,"i30n":0},{"id":32,"name":"\u041c\u043e\u0442\u043e\u043c","code":"C40AF00227","credit_id":783,"i30n":0}]},{"name":"\u0425\u0430\u0431\u0430\u0440\u043e\u0432\u0441\u043a","dealers":[{"id":250,"name":"\u0412\u043e\u0441\u0442\u043e\u043a","code":"C40AF11050","credit_id":0,"i30n":0}]},{"name":"\u0425\u0430\u043d\u0442\u044b-\u041c\u0430\u043d\u0441\u0438\u0439\u0441\u043a\u0438\u0439 \u0410\u041e","dealers":[{"id":134,"name":"\u0421\u0438\u0431\u043a\u0430\u0440","code":"C40AF00034","credit_id":917,"i30n":0},{"id":167,"name":"\u0421\u0438\u0431\u043a\u0430\u0440 \u0421\u0435\u0432\u0435\u0440","code":"C40AF10034","credit_id":918,"i30n":0},{"id":133,"name":"\u0421\u0438\u0431\u043a\u0430\u0440+","code":"C40AF00369","credit_id":883,"i30n":0}]},{"name":"\u0427\u0435\u0431\u043e\u043a\u0441\u0430\u0440\u044b","dealers":[{"id":124,"name":"\u0422\u0440\u0430\u043d\u0441\u0422\u0435\u0445\u0421\u0435\u0440\u0432\u0438\u0441","code":"C40AF00953","credit_id":0,"i30n":0}]},{"name":"\u0427\u0435\u043b\u044f\u0431\u0438\u043d\u0441\u043a\u0430\u044f \u043e\u0431\u043b\u0430\u0441\u0442\u044c","dealers":[{"id":97,"name":"\u0418\u0441\u0442\u0435\u043d \u041c\u043e\u0442\u043e\u0440\u0441","code":"C40AF00961","credit_id":982,"i30n":0},{"id":184,"name":"\u041f\u043b\u0430\u043d\u0435\u0442\u0430 \u0410\u0432\u0442\u043e","code":"C40AF01078","credit_id":0,"i30n":0},{"id":44,"name":"\u0420\u0435\u0433\u0438\u043d\u0430\u0441","code":"C40AF00223","credit_id":985,"i30n":0},{"id":43,"name":"\u0420\u0435\u0433\u0438\u043d\u0430\u0441","code":"C40AF00273","credit_id":983,"i30n":0},{"id":269,"name":"\u0421\u0438\u043b\u044c\u0432\u0435\u0440-\u0410\u0432\u0442\u043e","code":"C40AF01159","credit_id":877,"i30n":0}]},{"name":"\u042e\u0436\u043d\u043e-\u0421\u0430\u0445\u0430\u043b\u0438\u043d\u0441\u043a","dealers":[{"id":251,"name":"\u0412\u043e\u0441\u0442\u043e\u043a","code":"C40AF21050","credit_id":0,"i30n":0}]},{"name":"\u042f\u043a\u0443\u0442\u0441\u043a","dealers":[{"id":221,"name":"\u0412\u043e\u0441\u0442\u043e\u043a\u0435\u0432\u0440\u043e\u0422\u0435\u0445\u043d\u0438\u043a\u0430","code":"C40AF01105","credit_id":970,"i30n":0}]},{"name":"\u042f\u0440\u043e\u0441\u043b\u0430\u0432\u043b\u044c","dealers":[{"id":245,"name":"\u0410\u0432\u0442\u043e\u041b\u0438\u0433\u0430 \u042f\u0440\u043e\u0441\u043b\u0430\u0432\u043b\u044c","code":"C40AF01130","credit_id":0,"i30n":0},{"id":159,"name":"\u0421\u0418\u041c \u042f\u0440\u043e\u0441\u043b\u0430\u0432\u043b\u044c","code":"C40AF01051","credit_id":954,"i30n":0}]}]', true);



    return view('frontend.promo.solaris_super_series', ['header' => true, 'highlight' => false, 'footer' => true, 'dealers' => $dealers]);
})->name('static_ss');

Route::get('/promo/creta-rock', function () {
/*
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.cofigurator.hyundai.ru/dealers');
//    curl_setopt($ch, CURLOPT_USERAGENT, 'HH-User-Agent');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $dealers = json_decode(curl_exec($ch), true);
    curl_close($ch);
*/


/*
    $json = file_get_contents('https://api.cofigurator.hyundai.ru/dealers');
    $dealers = json_decode($json, true);
*/

    return view('frontend.promo.creta-rock', ['header' => true, 'highlight' => false, 'footer' => true]);
})->name('static_cretarock');

Route::get('/promo/{code}', 'SpecialOfferController@detail');

Route::get('/corporate-clients', 'Frontend\BuyController@corporateClients')->name('static_cc');
Route::get('/find-dealer', 'Frontend\BuyController@findDealer');

Route::get('/motorstudio_moscow', 'Frontend\MotorstudioController@getMotorstudioJSON')->name('static_motorstudio');
Route::get('/motorstudio_moscow_en', 'Frontend\MotorstudioController@getMotorstudioEnJSON');

Route::get('/hms', function () { return redirect('motorstudio_moscow'); });

// Route::get('test', function() {
//     return response(\App\Helpers\CityHelper::getCitiesList());
// });
// Route::get('test1/{id}', function($id) {
//     return response(\App\Helpers\CityHelper::getCitiesDealers($id));
// });
// Route::get('test2', function() {
//     return response(\App\Helpers\CityHelper::getCitiesDealersAll());
// });
// Route::get('test3', function() {
//     return \App\Helpers\PlaceholderHelper::getPlaceholderData(1, 30, 30);
// });

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('adminlogin');
Route::post('admin/login', 'Auth\LoginController@login')->name('adminloginpost');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('markup/static/{name}', ['as' => 'markup', 'uses' => 'MarkupController@getView']);

// Потом роуты для ajax-запросов
Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax'], function () {
    // Тут будут роуты для ajax-запросов

    Route::get('/getServiceJSON', 'ServiceCalculatorController@getServiceJSON');

    Route::get('/calculator', 'ServiceCalculatorController@getServiceCost');
});



// Роуты для api
Route::group(['prefix' => 'requestapi'], function () {
    // Тут будут роуты для api-запросов
});


// А дальше начинаем делить роуты по группам

// Тачки
/* Route::group(function () {
    // Тут будут роуты для тачек
});*/

// Сервис
Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
    // Тут будут роуты для сервиса

    //Сервис
    Route::get('/maintenance', function () {
        return view('frontend.service.index', ['header' => true, 'highlight' => false, 'footer' => true]);
    })->name('static_service_maintenance');

    //Гарантия
    // Route::get('/warranty', function () {
    //     return view('frontend.service.warranty', ['header' => true, 'highlight' => false, 'footer' => true]);
    // });
    Route::get('/warranty', ['as' => 'warranty', 'uses' => 'Frontend\ServiceController@warrantyCars']);

    //Документация
    Route::get('/manuals', ['as' => 'manuals', 'uses' => 'ServiceController@manuals']);

    //Кузовной ремонт
    Route::get('/bodyworks', function () {
        return view('frontend.service.bodyworks', ['header' => true, 'highlight' => false, 'footer' => true]);
    })->name('static_bodyworks');


    //Оригинальные запчасти
    Route::get('/parts', function () {
        return view('frontend.service.parts', ['header' => true, 'highlight' => false, 'footer' => true]);
    })->name('static_parts');

    //Помощь на дороге
    Route::get('/assistance', function () {
        return view('frontend.service.assistance', ['header' => true, 'highlight' => false, 'footer' => true]);
    })->name('static_assistance');

    //Лучшее для своих
    Route::get('/best', function () {
        return view('frontend.service.best', ['header' => true, 'highlight' => false, 'footer' => true]);
    })->name('static_best');
});

//Моторные масла
Route::get('/shell', 'ServiceController@shell')->name('static_shell');

// Бренд

// Формы / покупка

// Новости
Route::group(['prefix' => 'news', 'as' => 'news.'], function () {
    // Тут будут роуты для новостей
    Route::get('/', ['as' => 'index', 'uses' => 'NewsController@index']);
    Route::get('/{code}', ['as' => 'detail', 'uses' => 'NewsController@detail']);
});

// Спецпредложения
Route::group(['prefix' => 'offers', 'as' => 'offers.'], function () {
    // Тут будут роуты для спецпредложений
    Route::get('/', ['as' => 'index', 'uses' => 'SpecialOfferController@index']);
    Route::get('/{code}', ['as' => 'detail', 'uses' => 'SpecialOfferController@detail']);
});

// Статика


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Тестовый роут
Route::get('/layout-admin-test', function () {
    return view('admin-test');
})->name('admintest');

//Index
// Route::get('/', function () {
//     return view('index', ['header' => true, 'highlight' => true, 'footer' => true]);
// });
Route::get('/', 'HomeController@index');

//Index dealer
Route::get('/index-dealer', 'HomeController@indexDealer');


Route::get('/special', function () {
    return view('pages.special.special', ['header' => true, 'highlight' => false, 'footer' => true]);
});

Route::get('/promo1', function () {
    return view('pages.promo.promo1', ['header' => true, 'highlight' => false, 'footer' => true]);
});

Route::get('/promo2', function () {
    return view('pages.promo.promo2', ['header' => true, 'highlight' => false, 'footer' => true]);
});

//Роут для Конфигуратора
Route::get('/configurator/{any?}', 'SpaConfiguratorController@index')->where('any', '.*');



//Страница записи на сервис
/*
Route::get('/service-request', function () {
    return view('frontend.signUpService.index', ['header' => true, 'highlight' => false, 'footer' => true]);
});
*/

//Страница записи на сервис ДИЛЕР
Route::get('/service-request', function () {
    return view('frontend.signUpService.dealer', ['header' => true, 'highlight' => false, 'footer' => true]);
});

//Страница записи на тест-драйв
/*
Route::get('/test-drive', function () {
    return view('frontend.signUpTestDrive.index', ['header' => true, 'highlight' => false, 'footer' => true, 'code' => 'i30N']);
});
*/

//Страница записи на тест-драйв ДИЛЕР
Route::get('/test-drive', function () {
    return view('frontend.signUpTestDrive.dealer', ['header' => true, 'highlight' => false, 'footer' => true, 'code' => 'i30N']);
});

Route::get('/test-drive/{carCode}', function ($carCode) {
    return view('frontend.signUpTestDrive.dealer', ['header' => true, 'highlight' => false, 'footer' => true, 'code' => $carCode]);
});

// ЭСК
Route::get('/service-book', function () {
    return view('frontend.service.book', ['header' => true, 'highlight' => false, 'footer' => true]);
})->name('static_book');

//Страница поиска дилера
/*
Route::get('/find-dealer', function () {
    return view('frontend.findDealer.index', ['header' => true, 'highlight' => false, 'footer' => true]);
});
*/



//Contact Us
Route::get('/ContactUs', 'Frontend\BuyController@contactUs');


Route::group(['prefix' => 'vacancy'], function () {
    //Вакансии
    Route::get('/', 'VacancyController@index');
    Route::get('/{id}', 'VacancyController@detail');
});

/* ----------------- CARS ------------- */

//SantaFe
Route::get('/NewSantaFe', 'Frontend\CarController@NewSantaFe')->name('static_car25');

Route::get('/NewSantaFe/gallery', function () {
    return view('frontend.cars.santaFe.gallery', ['header' => true, 'highlight' => false, 'footer' => true]);
});

//Elantra
Route::get('/NewElantra', 'Frontend\CarController@Elantra')->name('static_car27');

Route::get('/NewElantra/gallery', function () {
    return view('frontend.cars.elantra.gallery', ['header' => true, 'highlight' => false, 'footer' => true]);
});

//Tucson
Route::get('/NewTucson', 'Frontend\CarController@Tucson')->name('static_car26');

Route::get('/NewTucson/gallery', function () {
    return view('frontend.cars.tucson.gallery', ['header' => true, 'highlight' => false, 'footer' => true]);
});

//i30n 2019
Route::get('/i30N', 'Frontend\CarController@i30n')->name('static_car28');

Route::get('/i30N/gallery', function () {
    return view('frontend.cars.i30n.gallery', ['header' => true, 'highlight' => false, 'footer' => true]);
});

Route::get('i30n', function () {
	return redirect('i30N');
});


Route::get('/offer/{code}', function ($code) {
	return redirect('/promo/' . $code);
});


//Solaris
Route::get('/Solaris', 'Frontend\CarController@Solaris')->name('static_car23');

Route::get('/Solaris/gallery', function () {
    return view('frontend.cars.solaris.gallery', ['header' => true, 'highlight' => false, 'footer' => true]);
});

//Sonata
Route::get('/Sonata', 'Frontend\CarController@Sonata')->name('static_car24');

Route::get('/Sonata/gallery', function () {
    return view('frontend.cars.sonata.gallery', ['header' => true, 'highlight' => false, 'footer' => true]);
});

//Creta
Route::get('/Creta', 'Frontend\CarController@Creta')->name('static_car22');

Route::get('/Creta/gallery', function () {
    return view('frontend.cars.creta.gallery', ['header' => true, 'highlight' => false, 'footer' => true]);
});

//H-1
Route::get('/H-1', 'Frontend\CarController@H1')->name('static_car16');

Route::get('/H-1/gallery', function () {
    return view('frontend.cars.h1.gallery', ['header' => true, 'highlight' => false, 'footer' => true]);
});


/* ----------------- CARS END ------------- */


//Product Line 2
Route::get('/pl2', function () {
    return view('frontend.service.pl2', ['header' => true, 'highlight' => false, 'footer' => true]);
});

//i30n
Route::get('/i30N_old', function () {
    return view('frontend.pages.cars.i30n', ['header' => true, 'highlight' => false, 'footer' => true]);
})->name('static_i30n');

//veloster-n
Route::get('/veloster-n', function () {
    return view('frontend.pages.cars.veloster_n', ['header' => true, 'highlight' => false, 'footer' => true]);
});

//IONIQ
Route::get('/ioniq', function () {
    return view('frontend.pages.cars.ioniq', ['header' => true, 'highlight' => false, 'footer' => true]);
})->name('static_ioniq');

//NEXO
Route::get('/nexo', function () {
    return view('frontend.pages.cars.nexo', ['header' => true, 'highlight' => false, 'footer' => true]);
})->name('static_nexo');

//KONA
Route::get('/kona', function () {
    return view('frontend.pages.cars.kona', ['header' => true, 'highlight' => false, 'footer' => true]);
})->name('static_kona');

//Brand-collection
// Route::get('/brand-collection', function () {
//     return view('frontend.brandCollection.index', ['header' => true, 'highlight' => false, 'footer' => true]);
// });

Route::group(['prefix' => 'brand-collection', 'as' => 'brandcollection.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Frontend\BrandcollectionController@index']);
    Route::get('/all', 'Frontend\BrandcollectionController@all');
    Route::get('/where-buy', 'Frontend\BrandcollectionController@map');
    Route::get('/{code}', ['as' => 'detail', 'uses' => 'Frontend\BrandcollectionController@category']);
});
//Trade-In
Route::get('/special-offer', function () {
    return view('frontend.pages.trade-in', ['header' => true, 'highlight' => false, 'footer' => true]);
});

// Route::get('/brand-collection', 'Frontend\BrandcollectionController@index');

// Route::get('/brand-collection/{code}', 'Frontend\BrandcollectionController@category');

// Route::get('/brand-collection/product', function () {
//     return view('frontend.brandCollection.product', ['header' => true, 'highlight' => false, 'footer' => true]);
// });
//NEXO
/*
Route::get('/nexo', function () {
    return view('frontend.pages.cars.nexo', ['header' => true, 'highlight' => false, 'footer' => true]);
});
*/

//Sitemap
Route::get('/sitemap', function () {
    return view('frontend.pages.sitemap', ['header' => true, 'highlight' => false, 'footer' => true]);
});

//Error page
Route::get('/warning', function () {
    return view('frontend.pages.warning', ['header' => true, 'highlight' => false, 'footer' => true]);
});

//Search page
Route::get('/search', 'SearchController@searchAsPage');
Route::get('/searchjson', 'SearchController@searchAsJson');

//History page
Route::get('/history', function () {
    return view('frontend.brand.history.index', ['header' => true, 'highlight' => false, 'footer' => true]);
})->name('static_history');

//History page
Route::get('/future', function () {
    return view('frontend.brand.future.index', ['header' => true, 'highlight' => false, 'footer' => true]);
})->name('static_future');

//Philosophy page
Route::get('/philosophy', function () {
    return view('frontend.brand.philosophy.index', ['header' => true, 'highlight' => false, 'footer' => true]);
})->name('static_philosophy');

//Manufacturing page
Route::get('/manufacturing', function () {
    return view('frontend.brand.manufacturing.index', ['header' => true, 'highlight' => false, 'footer' => true]);
})->name('static_manufacturing');

//Mobility page
Route::get('/perfection-mobility', function () {
    return view('frontend.brand.p-mobility.index', ['header' => true, 'highlight' => false, 'footer' => true]);
})->name('static_mobility');

//Motorsport page
Route::get('/motorsport', function () {
    return view('frontend.brand.motorsport.index', ['header' => true, 'highlight' => false, 'footer' => true]);
})->name('static_motorsport');

//Services page
Route::get('/customer-services', function () {
    return view('frontend.brand.services.index', ['header' => true, 'highlight' => false, 'footer' => true]);
})->name('static_service');

//Start page
Route::get('/start', 'Frontend\PagesController@start');

Route::get('/XMMP-careers', function() {
    return view('frontend.xmmp.careers', ['header' => true, 'highlight' => false, 'footer' => true]);
});

// Become a dealer
Route::get('/become-a-dealer', function() {
    return view('frontend.becomeDealer.index', ['header' => true, 'highlight' => false, 'footer' => true]);
});

// Corporate clients
Route::get('/corporate-clients', function() {
    return view('frontend.corporateClients.index', ['header' => true, 'highlight' => false, 'footer' => true]);
});

// Legal
Route::get('/Legal', function() {
    return view('frontend.pages.legal', ['header' => true, 'highlight' => false, 'footer' => true]);
});

// Privacy
Route::get('/Privacy', function() {
    return view('frontend.pages.privacy', ['header' => true, 'highlight' => false, 'footer' => true]);
});

// TermsConditions
Route::get('/TermsConditions', function() {
    return view('frontend.pages.terms-conditions', ['header' => true, 'highlight' => false, 'footer' => true]);
});

// Contractors
Route::get('/contractors', function() {
    return view('frontend.pages.contractors', ['header' => true, 'highlight' => false, 'footer' => true]);
});

// Старые тачки

Route::get('/Equus', function () { return redirect('/'); });
Route::get('/i40', function () { return redirect('/'); });
Route::get('/i40-Wagon', function () { return redirect('/'); });
Route::get('/Elantra', function () { return redirect('/'); });
Route::get('/i30', function () { return redirect('/'); });
Route::get('/i30-3dr', function () { return redirect('/'); });
Route::get('/i30-Wagon', function () { return redirect('/'); });

Route::get('/Solaris-5dr', function () { return redirect('/'); });
Route::get('/GrandSantaFe', function () { return redirect('/'); });
Route::get('/SantaFe', function () { return redirect('/'); });
Route::get('/Tucson', function () { return redirect('/'); });

// DealerCars
Route::get('/dealercars/{any?}', function() {
    return view('frontend.dealerCars.index', ['header' => true, 'highlight' => false, 'footer' => true]);
})->where('any', '.*');
