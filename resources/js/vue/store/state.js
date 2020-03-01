import navigation from './navigation'

// const domian = 'http://conf_api.hyundai.familyagency.ru/'
const domian = 'https://api.cofigurator.hyundai.ru/'
const isDealer = true
const staticData = {
  PREPAY_MIN: 0,
  PREPAY_MAX: 1000000,
  MONTH_MIN: 2500,
  MONTH_MAX: 100000
}

export default {
  applicationState: {
    loading: false,
    fullModal: false,
    gallery: false,
    isDesignReady: false,
    calculator: false,
    isCalculatorLoading: false,
    compare: false
  },
  navigation,
  API: {
    CAR_LIST: domian + 'carList',
    CAR: domian + 'car/',
    MODIFICATIONS: domian + 'car/modifications/',
    COMPLECTATIONS: domian + 'car/complectations/',
    SUMMARY: domian + 'car/final/',
    CALCULATOR: domian + 'ecredit/car/',
    CALCULATIONS: domian + 'ecredit/calculations/',
    SEND_EMAIL: domian + 'sendPDFtoEmail',
    SEND_EMAIL_DEALER: '/api/send/configurator',
    GET_PDF: domian + 'getPdf',
    SEND_DEALER: domian + 'sendPDFtoDealer',
    GET_DEALERS: domian + 'dealers',
    GET_DEALERS_CREDIT: domian + 'dealersCredit',
    SEND_TESTDRIVE: domian + 'sendTestDrive',
	COMPARE: domian + 'compare',
	CHECK_CREDIT: '/api/checkEcredit/',
	CONF_BOOK: 'https://showroom.hyundai.ru/',
	LOAD_SIMILAR: 'https://showroom.hyundai.ru/rest/car',
	CALCULATOR_PDF: 'http://configurator.hyundai.ru/pdf/' //Не используется
  },
  filter: {
    min_cost_limit: 0,
    max_cost_limit: 0,
    prepay_min: staticData.PREPAY_MIN,
    prepay_max: staticData.PREPAY_MAX,
    month_min: staticData.MONTH_MIN,
    month_max: staticData.MONTH_MAX,
    purpose: '',
    cost: {
      min: 0,
      max: 0
    },
    carcases: {},
    monthlyRange: [staticData.MONTH_MIN, staticData.MONTH_MAX],
    prepayRange: [staticData.PREPAY_MIN, staticData.PREPAY_MAX]
  },
  cars: null, // showroom, filter; fetched
  car: null, // selected car; fetched
  full: {
    modifications: null,
    complectations: null
  },
  configuration: { // current and default user configuration
    modification: 0,
    complectation: 0,
    packets: [],
    exteriorColor: 0,
    interiorColor: 0
  },
  summary: null,
  calculator: {},
  calculations: {},
  cookieName: 'hyundaiFav',
  isPromoVisible: true,
  isPopoversVisible: false,
  isMobileOpened: false,
  dealerList: [],
//   isDealer: isDealer,
  dealerCreditList: [],
  similar: {
    models: [],
    similar_models: []
  }
}
