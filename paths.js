var kit = require('./backstop_configs/kit')
var main = require('./backstop_configs/main')
var news = require('./backstop_configs/news')
var contactUs = require('./backstop_configs/contactUs')
var findDealer = require('./backstop_configs/find-dealer')
var configurator = require('./backstop_configs/configurator')
var configuratorMod = require('./backstop_configs/configurator_mod')
var configuratorComp = require('./backstop_configs/configurator_compl')
var configuratorDesign = require('./backstop_configs/configurator_design')
var configuratorSumm = require('./backstop_configs/configurator_summ')
var serviceRequest = require('./backstop_configs/service_request')
var testDriveRequest = require('./backstop_configs/test-drive_request')
var motorstudio = require('./backstop_configs/motorstudio')
var motorstudioEvent = require('./backstop_configs/motorstudio_event')
var serviceMain = require('./backstop_configs/service_main')
var brandCollection = require('./backstop_configs/brand_collection')
var vacancy = require('./backstop_configs/vacancy')
var vacancyJunior = require('./backstop_configs/vacancy_junior')
var shell = require('./backstop_configs/shell')
var superSeries = require('./backstop_configs/super_series')
var bodyworks = require('./backstop_configs/bodyworks')
var best = require('./backstop_configs/best')
var warranty = require('./backstop_configs/warranty')
var serviceBook = require('./backstop_configs/service_book')
var offers = require('./backstop_configs/offers')
var customerServices = require('./backstop_configs/customer_services')
var philosophy = require('./backstop_configs/philosophy')

var pathConfig = {};
 
pathConfig.array = [
	{
		name: 'kit',
		path: '/markup/static/kit',
		scenarios: kit.scenarios
	},
	{
		name: 'index',
		path: '/',
		scenarios: main.scenarios
	},
	{
		name: 'news',
		path: '/news',
		scenarios: news.scenarios
	},
	//Отправка формы
	{
		name: 'ContactUs',
		path: '/ContactUs',
		scenarios: contactUs.scenarios
	},
	{
		name: 'find-dealer',
		path: '/find-dealer',
		scenarios: findDealer.scenarios
	},
	{
		name: 'configurator',
		path: '/configurator',
		scenarios: configurator.scenarios
	},
	{
		name: 'configurator',
		path: '/configurator/car/23/modification',
		scenarios: configuratorMod.scenarios
	},
	{
		name: 'configurator',
		path: '/configurator/car/23/complectation',
		scenarios: configuratorComp.scenarios
	},
	{
		name: 'configurator',
		path: '/configurator/car/23/design',
		scenarios: configuratorDesign.scenarios
	},
	{
		name: 'configurator',
		path: '/configurator/car/23/summary',
		scenarios: configuratorSumm.scenarios
	},
	{
		name: 'service-request',
		path: '/service-request',
		scenarios: serviceRequest.scenarios
	},
	{
		name: 'test-drive',
		path: '/test-drive',
		scenarios: testDriveRequest.scenarios
	},
	{
		name: 'motorstudio_moscow',
		path: '/motorstudio_moscow',
		scenarios: motorstudio.scenarios
	},
	{
		name: 'motorstudio_moscow',
		path: '/motorstudio_moscow#test_event',
		scenarios: motorstudioEvent.scenarios
	},
	{
		name: 'service',
		path: '/service/maintenance',
		scenarios: serviceMain.scenarios
	},
	{
		name: 'brand-collection',
		path: '/brand-collection',
		scenarios: brandCollection.scenarios
	},
	{
		name: 'brand-collection',
		path: '/brand-collection/where-buy',
		scenarios: []
	},
	{
		name: 'vacancy',
		path: '/vacancy',
		scenarios: vacancy.scenarios
	},
	{
		name: 'vacancy',
		path: '/vacancy#junior',
		scenarios: vacancyJunior.scenarios
	},
	{
		name: 'shell',
		path: '/shell',
		scenarios: shell.scenarios
	},
	{
		name: 'solaris_super_series',
		path: '/promo/solaris_super_series',
		scenarios: superSeries.scenarios
	},
	{
		name: 'bodyworks',
		path: '/service/bodyworks',
		scenarios: bodyworks.scenarios
	},
	{
		name: 'manuals',
		path: '/service/manuals',
		scenarios: []
	},
	{
		name: 'parts',
		path: '/service/parts',
		scenarios: []
	},
	{
		name: 'best',
		path: '/service/best',
		scenarios: best.scenarios
	},
	{
		name: 'assistance',
		path: '/service/assistance',
		scenarios: []
	},
	{
		name: 'pl2',
		path: '/pl2',
		scenarios: []
	},
	{
		name: 'warranty',
		path: '/service/warranty',
		scenarios: warranty.scenarios
	},
	{
		name: 'service-book',
		path: '/service-book',
		scenarios: serviceBook.scenarios
	},
	{
		name: 'all-offers',
		path: '/all-offers',
		scenarios: []
	},
	{
		name: 'customer-services',
		path: '/customer-services',
		scenarios: customerServices.scenarios
	},
	{
		name: 'ioniq',
		path: '/ioniq',
		scenarios: []
	},
	{
		name: 'nexo',
		path: '/nexo',
		scenarios: []
	},
	{
		name: 'kona',
		path: '/kona',
		scenarios: []
	},
	{
		name: 'special-offer',
		path: '/special-offer',
		scenarios: []
	}
]
 
module.exports = pathConfig;