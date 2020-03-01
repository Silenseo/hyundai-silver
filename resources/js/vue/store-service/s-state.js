const domian = 'https://api.cofigurator.hyundai.ru/'
const domian1 = 'https://www.hyundai.ru/'

export default {
  openFindDealerPopup: false,
  openSendDealerPopup: false,
  openOfferCreditPopup: false,
  openBackCallPopup: false,
  openEventPopup: false,
  openCheckoutEventPopup: false,
  openTestDrivePopup: false,
  openSendEmailPopup: false,
  openSendApprovalPopup: false,
  openRules: false,
  openSuccess: false,
  API: {
	CAR: domian + 'car/',
	CAR_LIST: domian + 'carList',
	CAR_LIST2: '/api/carList', //Для дропдаунов со списком авто
	CAR_LIST3: '/ajax/getServiceJSON', //Для дропдаунов со списком авто в Калькуляторе ТО
	CAR_MODIFICATIONS: domian + 'car/modifications/',
	CAR_COMPLECTATIONS: domian + 'car/complectations/',
	DEALERS_LIST: '/requestapi/getDealers?notest=1',
	GET_DEALERS_CREDIT: domian + 'dealersCredit', //Также это св-во есть в state конфигуратора
	ENGINES_LIST: '/ajax/getServiceJSON',
	TO_CALC_COST: '/ajax/calculator', //Расчёт стоимости в калькуляторе ТО
	START_CALC_COST: domian + 'credit/startNew/', //Расчёт стоимости в калькуляторе Start
	CHECK_VIN: '/api/service/checkVin', //Проверка VIN на странице гарантии

	//Формы
	CONTACT_FORM: '/api/send/servicerequest', //Отправка формы на странице калькулятора ТО
	OFFER_CREDIT_FORM: '/api/send/offercreditrequest', //Отправка формы на странице спецпредложений
	START_CONTACT_FORM: '/api/send/start', //Отправка на почту формы на странице Старт
	SERVICE_FORM: '/api/send/servicerequest', //Записть на сервис
	TD_FORM: '/api/send/testdrive', //Записть на ТД
	CONTACT_US_FORM: '/api/send/contactus', //Форма на странице Обратная связь
	MOTORSTUDIO_CHECKOUT_FORM: '/api/send/motorstudio_request', //Форма записи на мероприятие Моторстудия
	VACANCY_FORM: '/api/send/jobseeker', //Форма на странице вакансии
	NEW_EVENT_MOTORSTUDION_FORM: '/api/send/eventRequest', //Форма на странице вакансии
	CHECK_CREDIT: '/api/checkEcredit/' //Показывать ли кнопку Предодобрение кредита на дилерской сборке
  },
  car: {//Данные используются везде
	code: "",
	id: 0,
	image: "",
	link: "",
	name: ""
  },
  savedModel: "", //Устанавливается на странице подели при открытии попапа записи на ТД, т.к. данные с тачкоми подгружаются после открытия попапа
  engine: '',
  vEngine: '',
  mileage: 15,
  user: {
	  phone: ''
  },
  engines: {},
  vEngines: [],
  city: '',
  dealer: '',
  cost: {
    works: 0,
    parts: 0,
    partsPl2: 0,
    total: 0
  },
  serviceParts: 'parts',
  data: [],
  dataEngines: [],
  dealersData: [],
  dealers: [],
  dealersCities: [],
  selectedEvents: [],
  selectedEvent: 0,
  carsIdLinks: [
    {
      id: 22,
      link: 'Creta'
    },
    {
      id: 26,
      link: 'NewTucson'
    },
    {
      id: 25,
      link: 'NewSantaFe'
    },
    {
      id: 23,
      link: 'Solaris'
    },
    {
      id: 27,
      link: 'NewElantra'
    },
    {
      id: 24,
      link: 'Sonata'
    },
    {
      id: 16,
      link: 'H-1'
    },
    {
      id: 29,
      link: 'NewSonata'
    },
    {
      id: 28,
      link: 'i30N'
    }
  ],
  //Start
  start: {
		carcaseList: [],
		modelsList: [],
		currentCar: {
			name: '',
			id: 0
		},
		currentCarSpec: {
			name: ''
		},
		modificationList: {},
		modification: {
			name: ''
		},
		dataModifications: {},
		complectationList: {},
		complectation: {
			name: '',
			price: 0
		},
		dataComplectations: {},
		packets: {},
		selectedPackets: [],
		activeColorObj: {
			nameRus: '',
			cost: '',
			carImage: ''
		},
		activeColor: 0,
		colorsAPI: {},
		prevColor: 0,
		spritespin: {},
		selectedPrograms: [],
		currentTerm: 36,
		includeKASKO: false,
		compareSelected: '',
		creditPack: {
			pay: 0,
			prepay: 0,
			prepayRub: 0,
			sum: 0,
			addCost: 0,
			lastPay: 0
		},
		openMobileLine: false
  },
  //DealerCars
  dealerCars: {
	  carId: 0
  },
  //Trade In
  tradein: {
	  currentCar: null,
	  sendUrl: '',
	  state: {
		  step1: false,
		  step2: false,
		  step3: false
	  },
	  step2: {
		  brand: '',
		  model: '',
		  age: '',
		  year: '',
		  complectation: '',
		  body: '',
		  condition: '',
		  milleage: undefined,
		  vin: ''
	  },
	  step3: {
		name: '',
		surname: '',
		patronymic: '',
		tel: '',
		email: '',
		city: ''
	  }
  }
}
