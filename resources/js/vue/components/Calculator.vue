<template>
  <transition name="calc-in" v-on:enter="onEnter" v-on:after-enter="onAfterEnter" v-on:leave="onLeave" v-on:after-leave="onAfterLeave">
  <div class="calculator" v-if="isCalcActive" id="calculator" :class="{ 'is-loading': isLoading, 'is-modal-opened' : isProgramInfoActive }">
    <div class="container calculator-holder">
      <div class="row">
        <div class="col-md-12">
          <div class="calculator-node" id="calculator-node">
            <div class="calculator-main">
              <div class="calculator-main__top">
                <a href="#" @click.prevent="close" class="calculator-main__back df-back-link">
                  Назад
                  <svg aria-hidden="true">
                      <use xlink:href="#back-link"></use>
                  </svg>
                </a>
                <div class="calculator-main__title">
                  Ваш расчет
                </div>
                <a href="#" @click.prevent="close" class="calculator-main__close">
                  <svg aria-hidden="true">
                      <use xlink:href="#ic-close-popup"></use>
                  </svg>
                </a>
              </div>
              <div class="calculator-main__body">
                <div class="calculator-main__section">
                  <div class="calculator-main__subtitle">
                    Модификация
                  </div>
                  <div class="calculator-main__block">
                    <list :items="modificationList" textKey="name" valueKey="id" :initialValue="modification" @change="changeModification"></list>
                  </div>
                </div>
                <div class="calculator-main__section">
                  <div class="calculator-main__subtitle">
                    Комплектация
                  </div>
                  <div class="calculator-main__block">
                    <list :items="complectationList" textKey="name" textKeyRight="price" valueKey="id" :initialValue="complectation" @change="changeComplectation"></list>
                  </div>
                </div>
                <div class="calculator-main__section calculator-main__section--sm100">
                  <div class="calculator-main__subtitle">
                    Срок кредита, мес
                  </div>
                  <div class="calculator-main__block">
                    <radio-line :items="currentTerms" valueKey="value" textKey="name" disabledKey="disabled" :activeValue="terms.active" @change="changeTerms"></radio-line>
                  </div>
                </div>
                <div class="calculator-main__section calculator-main__section--sm100">
                  <div class="calculator-main__line">
                    <div class="calculator-main__subtitle">
                      Первый взнос
                    </div>
                    <div class="calculator-main__prepay">{{ prepayExact | priceFormat }}
                      <!-- <sub>-10%</sub> -->
                    </div>
                  </div>
                  <div class="calculator-main__block">
                    <vue-slider ref="sliderPrepay" v-bind="sliderStyles" :real-time="true" :value="sliderPrepayValue" :min="sliderPrepayMin" :max="sliderPrepayMax" @callback="sliderPrepayChanged"></vue-slider>
                  </div>
                  <div class="calculator-main__line">
                    <div class="calculator-main__min">
                      {{ sliderPrepayMin }}
                    </div>
                    <div class="calculator-main__max">
                      90
                    </div>
                  </div>
                </div>
              </div>
              <div class="calculator-main__bottom">
                <div class="offer" v-if="upsale">
                  <div class="offer__title">
                    Мы предлагаем
                  </div>
                  <div class="offer__body">
                    <div class="offer__left">
					    <div class="offer__name" v-if="carID !== upsale.car_id">{{ upsale.carName }}</div>
						<div class="offer__name">{{ upsale.name }}</div>
                        <div class="offer__up-price" :class="{ 'vhidden' : upsalePriceRange === 0}">+ {{ upsalePriceRange | priceBaseFormat }} ₽/мес</div>
                    </div>
                    <div class="offer__right">
                      <a href="#" @click.prevent="getUpsale" class="calculator-aside__select">Улучшить</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="calculator-aside">
              <div class="calculator-aside__name">
                {{ carName }}
              </div>
              <div class="calculator-aside__img">
                <img v-fade-in :src="carPicture" :alt="carName"/>
              </div>
              <div class="calculator-aside__body">
                <div class="calculator-aside__line">
                  <div class="calculator-aside__text">
                    Общая стоимость
                  </div>
                  <div class="calculator-aside__summary">
                    {{ summaryPrice | priceFormat }}
                  </div>
                </div>
                <div class="calculator-aside__line">
                  <div class="calculator-aside__text">
                    Первый взнос
                  </div>
                  <div class="calculator-aside__prepay">
                    {{ prepayExact | priceFormat }}
                  </div>
                </div>
                <hr class="calculator-aside__hr">
                <div class="calculator-aside__line calculator-aside__line--at calculator-aside__line--mb" :class="{ 'vhidden' : activeProgramMonthly === 0}">
                  <div class="calculator-aside__text">
                    Итого
                  </div>
                  <div class="calculator-aside__total">
                    <span>{{ activeProgramMonthly | priceBaseFormat }}</span> ₽/мес<sup>*</sup>
                  </div>
                </div>
<!--
                <a href="#" @click.prevent="selectProgramScroll" class="calculator-aside__select">
                  Выбрать программу
                  <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-arrow-down"></use></svg>
                </a><br/>
-->
                <a href="#" class="df-button offer__button" @click.prevent="toggleSendCredit" v-if="creditApprove || !isDealer">Предодобрение кредита</a>
              </div>
            </div>
          </div>
          <div class="calculator-programs" v-if="calculator">
            <div class="calculator-programs-holder" v-if="programs && availablePrograms !== null && Object.keys(availablePrograms).length && calculator && currentCalculation">
              <h3 class="calculator-programs__title">
                Выберите программу
              </h3>
              <ul class="program-list">
                <li class="program-item" v-for="(programID, monthly, index) in availablePrograms" @click.prevent="selectProgram(index, monthly)" :class="{ 'is-active': viewingProgram === index, 'is-start': programs[programID].isStart }">
                  <div class="program-item__row program-item__body">
                    <div class="program-item__col">
                      <span class="program-item__name">{{ programs[programID].front_name }}</span>
                      <span class="program-detail-spot hidden-mobile">{{ programs[programID].text }}</span>
                    </div>
                    <div class="program-item__plus hidden-desctop"></div>
                    <div class="program-item__col">
                      <span class="program-item__payment">
                        <span class="program-item__el program-item__payment-value">{{ monthly | priceBaseFormat }} ₽</span>
                        <span class="program-item__el-subtitle">платеж</span>
                      </span>
                      <span class="program-item__rate">
                        <span class="program-item__el program-item__rate-value">{{ programs[programID].rate }} %</span>
                        <span class="program-item__el-subtitle">Ставка</span>
                      </span>
                    </div>
                    <div class="program-item__plus hidden-mobile"></div>
                    <div class="program-item__col hidden-desctop">
                      <span class="program-detail-spot">{{ programs[programID].text }}</span>
                    </div>
                  </div>
                    <div class="program-item__row program-item__controls">
                      <div class="program-item__col program-item__controls-left">
                        <a href="#" @click.prevent="toggleProgramDetail($event, programID)" class="df-iconed-link df-iconed-link--small program-item__more">
                            Узнать больше
                            <svg aria-hidden="true">
                                <use xlink:href="#arrow-link"></use>
                            </svg>
                        </a>
                      </div>
                      <div class="program-item__col program-item__controls-right">
                        <a href="#" class="df-button program-item__send-dealer" @click.prevent="toggleSendDealer" v-if="!isDealer">Отправить дилеру</a>
                        <a href="#" class="program-item__send" @click.prevent="toggleSendEmail">
                          <svg aria-hidden="true">
                            <use xlink:href="#mail-icon"></use>
                          </svg>
                          Отправить на email
                        </a>
                        <!-- <a href="#" @click.prevent="toggleSendEmail" class="program-control-button" title="Отправить на e-mail" v-if="!isDealer"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-email"></use></svg></a> -->
                        <!-- <a href="#" @click.prevent="print" class="program-control-button" title="Распечатать"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-print"></use></svg></a> -->
                        <!-- <a href="#" @click.prevent="toggleSendDealer" class="button button--ripple button--send-dealer" v-if="!isDealer">Отправить дилеру</a> -->
                        <!-- <a href="#" @click.prevent="toggleSendEmail" class="button button--ripple button--send-dealer" v-if="isDealer">Отправить на e-mail</a> -->
                      </div>
                      <div class="program-item__plus" style="visibility: hidden"></div>
                    </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="calculator-disclaimers" v-if="calculator">
            <div class="calculator-disclaimer" v-for="(disclaimer, index) of disclaimers">
              <div class="calculator-disclaimer__star">
                	&#10033;
              </div>
              <div class="calculator-disclaimer__text">
                {{ disclaimer }}
              </div>
            </div>
          </div>
          <div class="calculator-line" :class="{ isOpened: isLineOpened, isShow: isLineShow }">
            <div class="calculator-line__header">
              <div class="calculator-line__img">
                <img v-fade-in :src="carPicture" :alt="carName"/>
              </div>
              <div>
                <div class="calculator-line__name">
                  {{ carName }}
                </div>
                <div class="calculator-line__payment">
                  <span>{{ activeProgramMonthly | priceBaseFormat }}</span> ₽/мес<sup>*</sup>
                </div>
              </div>
              <a href="#" @click.prevent="isLineOpened = !isLineOpened" class="calculator-line__plus"></a>
            </div>
            <div class="calculator-line__dd">
              <div class="calculator-line__body">
                <div class="calculator-line__line calculator-line__line--mb">
                  <div class="calculator-line__text">
                    Общая стоимость
                  </div>
                  <div class="calculator-line__summary">
                    {{ summaryPrice | priceFormat }}
                  </div>
                </div>
                <div class="calculator-line__line">
                  <div class="calculator-line__text">
                    Первый взнос
                  </div>
                  <div class="calculator-line__prepay">
                    {{ prepayExact | priceFormat }}
                  </div>
                </div>
                <hr class="calculator-line__hr">
                <div class="calculator-line__line">
                  <div class="calculator-line__total">
                    <span>{{ activeProgramMonthly | priceBaseFormat }}</span> ₽/мес<sup>*</sup>
                  </div>
                  <a href="#" @click.prevent="selectProgramScroll" class="calculator-line__select">
                    Выбрать программу
                    <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-arrow-down"></use></svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <transition name="popup">
		<div class="details df-popup" v-if="isProgramInfoActive && programs">
			<div class="df-popup__wrap" @click.self="toggleProgramDetail">
				<div class="details__center df-popup__center">
					<a href="#" @click.prevent="toggleProgramDetail" class="details__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<div class="details__body">
						<h3 class="details__title">{{programs[programInfoID].front_name}}</h3>
						<p class="details__text df-text-main-16px">
						{{ programs[programInfoID].description }}
						</p>
					</div>
					<div class="details__footer" v-if="programs[programInfoID].isStart">
						<a href="/start" target="_blank" class="df-iconed-link df-iconed-link--small">
                            Преимущества
                            <svg>
                                <use xlink:href="#arrow-link"></use>
                            </svg>
                        </a>
					</div>
				</div>
			</div>
		</div>
      <!-- <div class="program-details-wrapper"  @click.prevent="toggleProgramDetail">
        <div class="program-details" @click.stop="">
          <div class="program-details__header">
            <a href="#" @click.prevent="toggleProgramDetail" class="close"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-close"></use></svg></a>
          </div>
          <div class="program-details__body">
            <span class="program-details__title">{{programs[programInfoID].front_name}}</span>
            <p class="program-details__text">
              {{ programs[programInfoID].description }}
            </p>
          </div>
          <div class="program-details__footer" v-if="programs[programInfoID].isStart">
            <a href="/start" target="_blank" class="button button--ripple button--continue program-details--go-start">
              Преимущества <svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-continue-arrow"></use></svg>
            </a>
          </div>
        </div>
      </div> -->
    </transition>
    <!-- <send-email :pdfData="pdfData" :isActive="isSendEmailActive" :isRulesActive="isRulesActive" @close="toggleSendEmail" @showRules="toggleRules"></send-email> -->
    <send-email-new from="calculator" :pdfData="pdfData" :isOpened="isSendEmailActive" @close="toggleSendEmail" @show-rules="toggleRules" @success="sentSuccess = true"></send-email-new>
    <!-- <send-dealer-new :pdfData="pdfData" :isActive="isSendDealerActive" :isRulesActive="isRulesActive" @close="toggleSendDealer" @showRules="toggleRules"></send-dealer-new> -->
    <send-dealer-new :pdfData="pdfData" :isOpened="isSendDealerActive" @close="toggleSendDealer" @show-rules="toggleRules" @success="sentSuccess = true"></send-dealer-new>
    <!-- <send-credit :isActive="isSendCreditActive" :carData="carData" @close="toggleSendCredit"></send-credit> -->
    <credit-approval-form :isOpened="isSendCreditActive" :currentCar="{ name: carName }" :creditPack="{ prepay: sliderPrepayValue, sum: summaryPrice }" :term="terms.active" @close="toggleSendCredit"></credit-approval-form>
    <!-- <rules-agreement :isActive="isRulesActive" @close="toggleRules"></rules-agreement> -->
    <rules-agreement :isOpened="isRulesActive" @close="toggleRules"></rules-agreement>
	<simple-sent-successfully :isOpened="sentSuccess" innerText="Форма успешно отправлена" @close-this="sentSuccess = false"></simple-sent-successfully>
  </div>
  </transition>
</template>

<script>
import { mapGetters } from 'vuex'
import List from './common/List'
import RadioLine from './common/RadioLine'
import Loader from './Loader'
import nprogress from 'nprogress'
import '../../../../node_modules/nprogress/nprogress.css'
import vueSlider from 'vue-slider-component'
// import SendEmail from '@/components/SendEmail'
import SendEmailNew from '@/components/SendEmailNew'
// import SendDealer from '@/components/SendDealer'
import SendDealerNew from '@/components/SendDealerNew'
// import SendCredit from '@/components/SendCredit'
import CreditApprovalForm from '@/components/common/CreditApprovalForm'
// import RulesAgreement from '@/components/RulesAgreement'
import RulesAgreement from '@/components/common/Rules'
import SimpleSentSuccessfully from '@/components/common/SimpleSentSuccessfully'
import axios from 'axios'
import cloneDeep from 'lodash/cloneDeep'
import { setTimeout } from 'timers';

export default {
  name: 'Calculator',
  components: { List, Loader, RadioLine, vueSlider, SendEmailNew, SendDealerNew, CreditApprovalForm, RulesAgreement, SimpleSentSuccessfully },
  data () {
    return {
      disclaimers: [
        'Расчет кредита является предварительным. Обязательное условие — оформление страхования КАСКО в страховой компании, соответствующей требованиям банков партнеров. Более подробную информацию обо всех условиях кредитования Вы можете получить, обратившись к банкам-партнерам программы и официальным дилерам Hyundai. Банки оставляют за собой право вносить изменения в программы кредитования без предварительного уведомления. Данное предложение носит информационный характер и не является публичной офертой (ст.437 ГК РФ).'
      ],
      currentCalculation: this.calculation,
      lastChange: false,
      terms: {
        scale: {
          12: {
            value: 12,
            name: 12
          },
          24: {
            value: 24,
            name: 24
          },
          36: {
            value: 36,
            name: 36
          },
        //   48: {
        //     value: 48,
        //     name: 48
        //   },
        //   60: {
        //     value: 60,
        //     name: 60
        //   }
        },
        active: 36
      },
      sliderPrepayMin: (this.calculator ? this.calculator.minPrepay : 0) || 0,
      sliderPrepayMax: 90,
      sliderPrepayValue: (this.calculator ? this.calculator.car[this.modification].compl[this.complectation].defaultPV : 35) || 35,
      sliderStyles: {
        height: 4,
        tooltip: 'always',
        dotSize: 20,
        speed: 0.15,
        bgStyle: {
          'backgroundColor': '#B7B7B7',
          'borderRadius': '0'
        },
        processStyle: {
          'backgroundColor': '#00aed5'
        },
        class: 'calculator-prepay-slider'
      },
      viewingProgram: 0,
      isProgramInfoActive: false,
      isSendEmailActive: false,
      isSendDealerActive: false,
      isSendCreditActive: false,
      isRulesActive: false,
      specialSaleHasFamily: false,
      specialSaleFirstCar: false,
      isSpecialSaleActive: false,
      specialSaleInfoTarget: '',
      isLineOpened: false,
      isLineShow: false,
      sentSuccess: false,
      creditApprove: false,
      dealerCreditApprove: ''
    }
  },
  computed: {
    ...mapGetters({
      carName: 'GET_CAR_NAME',
      carPicture: 'GET_CAR_PICTURE',
      summaryPrice: 'GET_SUMMARY_PRICE',
      calculation: 'GET_CURRENT_CALCULATION',
      calculations: 'GET_CALCULATIONS',
      calculator: 'GET_CURRENT_CALCULATOR',
      carID: 'GET_CURRENT_ID',
      complectations: 'GET_COMPLECTATION_LIST',
      complectationID: 'GET_COMPLECTATION_ID',
      isCalcActive: 'GET_CALC_ACTIVE_STATE',
      modificationList: 'GET_MODIFICATION_LIST',
      summaryPrice: 'GET_SUMMARY_PRICE',
      pdfApi: 'GET_API_GET_PDF',
      colorId: 'GET_COLOR_ID',
      packetsSelected: 'GET_CURRENT_PACKETS',
      isDealer: 'GET_IS_DEALER',
      apiCheckCredit: 'GET_API_CHECK_CREDIT'
    }),
    isLoading () {
      return this.$store.getters.GET_APP_STATE.isCalculatorLoading
    },
    modification: {
      get () {
        return this.$store.state.configuration.modification
      },
      set (value) {
        this.$store.dispatch('UPDATE_MODIFICATION', value)
      }
    },
    complectationList () {
      let result = cloneDeep(this.complectations)
      for (let prop in result) {
        result[prop].price = result[prop].price.toString().replace(/\D/g, '').replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' ') + ' ₽'
      }
      return result
    },
    complectation: {
      get () {
        return this.$store.state.configuration.complectation
      },
      set (value) {
        this.$store.dispatch('UPDATE_COMPLECTATION', value)
      }
    },
    programs () {
      return this.calculator && this.calculator.programs
    },
    defaultProgramID () {
      if (this.programs !== null && this.availablePrograms !== null) {
        let ID
        for (let key in this.availablePrograms) {
          ID = this.availablePrograms[key]
          break
        }
        return ID
      } else {
        return 0
      }
    },
    activeProgramID () {
      if (this.availablePrograms !== null && typeof this.viewingProgram === 'number') {
        return this.availablePrograms[Object.keys(this.availablePrograms)[this.viewingProgram]]
      } else {
        return this.defaultProgramID
      }
    },
    activeProgramMonthly () {
      if (this.availablePrograms !== null && typeof this.viewingProgram === 'number') {
        return Object.keys(this.availablePrograms)[this.viewingProgram]
      } else {
        return this.minPay || 0
      }
    },
    calculationSelected () {
      return this.currentCalculation && this.currentCalculation.calc[this.terms.active][this.sliderPrepayValue] || null
    },
    availablePrograms () {
      if (this.calculationSelected && this.calculationSelected !== null && this.calculationSelected.programs !== null) {
        let result = {}
        Object.keys(this.calculationSelected.programs).map((key, index) => {
          let newKey
          if (this.specialSaleFirstCar || this.specialSaleHasFamily) {
            // recalculate here
            newKey = Math.round(parseInt(key.replace(/s/g), '') * 0.9)
          } else {
            newKey = key
          }
          result[newKey] = this.calculationSelected.programs[key]
        })
        return result
      }
      return null
    },
    minPay () {
      return this.calculationSelected && this.calculationSelected.min
    },
    upsalePriceRange () {
      return this.calculationSelected && this.calculationSelected.up
    },
    currentTerms () {
      let obj = {}
      Object.keys(this.terms.scale).map((key) => {
        this.$set(obj, key, this.terms.scale[key])
        this.$set(obj[key], 'disabled', !this.currentCalculation.calc[key])
      })
      return obj
    },
    prepayExact () {
      return Math.round(this.summaryPrice * this.sliderPrepayValue / 100)
    },
    upsale () {
      return this.currentCalculation && this.currentCalculation.upsale
    },
    pdfData () {
      return {
        compl_id: this.complectation,
        pv_perc: this.sliderPrepayValue,
        tm: this.terms.active,
        sum: this.summaryPrice,
        delta: 0,
        payment: this.activeProgramMonthly,
        programId: this.activeProgramID,
        color_id: this.colorId,
        packets: this.packetsSelected && this.packetsSelected.length > 0 ? this.packetsSelected.join(',') : ''
      }
    },
    carData () {
      return {
        carName: this.carName,
        pv_perc: this.sliderPrepayValue,
        tm: this.terms.active,
        sum: this.summaryPrice
      }
    }
  },
  methods: {
    close (event) {
      if ((!event || event.type === 'click' || (event.type === 'keyup' && event.keyCode === 27)) && this.isCalcActive) {
        // close sub-windows
        if (this.isRulesActive) {
          this.isRulesActive = false
          return false
        }
        if (this.isProgramInfoActive) {
          this.toggleProgramDetail()
          return false
        }
        if (this.isSendEmailActive) {
          this.isSendEmailActive = false
          return false
        }
        if (this.isSendDealerActive) {
          this.isSendDealerActive = false
          return false
        }
        if (this.isSpecialSaleActive) {
          this.isSpecialSaleActive = false
          return false
        }
        // just close calc instance
        this.isSendEmailActive = false
        window.removeEventListener('keyup', this.close, false)
        this.$store.dispatch('SET_APP_STATE', { calculator: false })
        if (this.lastChange) {
          this.$router.push({name: 'Complectation', params: { id: this.carID }})
        }
      }
    },
    configureLoader () {
      if (this.isCalcActive === true && this.isLoading === false && (!nprogress || nprogress.settings.parent !== '#calculator-node')) {
        nprogress.configure({ minimum: 0.50, trickleSpeed: 20, easing: 'ease-out', speed: 105, showSpinner: false, parent: '#calculator-node' })
      }
    },
    getData () {
      if (this.carID !== 'null' && (this.calculator === null || (this.calculator !== null && this.calculation === undefined))) {
        if (this.calculator && this.isCalcActive === true && this.isLoading === false) {
          this.configureLoader()
          nprogress.start()
        }
        this.$store.dispatch('LOAD_CALC_DATA').then(() => {
          this.setPrepayMin()
          if (this.availablePrograms === null || !Object.keys(this.availablePrograms) || Object.keys(this.availablePrograms).length < 2 || typeof Object.keys(this.availablePrograms)[this.viewingProgram] === 'undefined') {
            this.selectProgram(0)
          }
        }, () => {
          this.$root.$emit('notify', { type: 'error', text: 'Ошибка получения данных.\nПожалуйста, попробуйте позже.' })
          console.warn('Unable to load data!\nPlease try to reload this page and check the connection.')
          setTimeout(() => {
            this.$store.dispatch('LOAD_CALC_DATA')
          }, 10000)
        }).then((response) => {
          nprogress.done()
        })
      }
    },
    changeModification (newValue) {
      this.lastChange = true
      this.modification = newValue
    },
    changeComplectation (newValue) {
      this.lastChange = true
      this.complectation = newValue
    },
    changeTerms (newValue) {
      const obj = this.currentTerms
      // check if newValue is disabled in currentTerms object
      // if true, change to the nearest element in currentTerms (by value)

      let finalValue = newValue
      let value = newValue
      if (obj[value].disabled !== true) {
        this.terms.active = finalValue
      }
    },
    sliderPrepayChanged (value) {
      if (this.calculator && value < this.calculator.minPrepay) {
        value = this.calculator.minPrepay
        this.setPrepayMin()
      }
      this.sliderPrepayValue = value
    },
    setPrepayMin () {
      if (this.calculator && this.calculator.minPrepay) {
        this.sliderPrepayMin = this.calculator.minPrepay
        this.$refs.sliderPrepay && this.$refs.sliderPrepay.refresh()
      }
    },
    onEnter () {
      this.$root.$emit('fixOverflow', true)
      window.addEventListener('keyup', this.close, false)
      this.lastChange = false
      this.configureLoader()
      this.getData()
	},
	onLeave () {
		this.$root.$emit('fixOverflow', false)
	},
    onAfterEnter () {
      this.lineController()
    },
    onAfterLeave () {
      this.isLineShow = false
    },
    getUpsale () {
	  if (this.upsale) {
	    if (this.upsale.car_id.toString() === this.carID.toString()) {
			if (this.upsale.mod_id !== this.modification) {
			this.modification = this.upsale.mod_id
			}
			this.complectation = this.upsale.id
		} else {
			this.close()
			this.$store.dispatch('LOAD_CAR', this.upsale.car_id)
			this.$router.push({name: 'Modification', params: { id: this.upsale.car_id }})
		}
	  }
    },
    toggleProgramDetail (event, id) {
      if (id && typeof id === 'number') {
        this.isProgramInfoActive = true
        this.programInfoID = id
      } else if (!event || (event.type === 'keyup' && event.keyCode === 27) || event.type === 'click') {
        this.isProgramInfoActive = false
        this.programInfoID = 0
      }
      this.$store.dispatch('SET_APP_STATE', {fullModal: this.isProgramInfoActive})
    },
    selectProgram (index) {
      this.viewingProgram = index
    },
    toggleSendEmail () {
      if (!this.isRulesActive) {
        this.isSendEmailActive = !this.isSendEmailActive
      }
    },
    toggleSendDealer () {
      if (!this.isRulesActive) {
        this.isSendDealerActive = !this.isSendDealerActive
      }
    },
    toggleSendCredit () {
      if (!this.isDealer) {
        this.isSendCreditActive = !this.isSendCreditActive
      } else {
        window.open('https://credit-approval.ecredit.one/?car=' + this.carName + '&fee=' + this.sliderPrepayValue + '&sum=' + this.summaryPrice + '&term=' + this.terms.active + '&dealer=' + this.dealerCreditApprove, '_blank');
      }
    },
    toggleRules () {
      this.isRulesActive = !this.isRulesActive
    },
    print () {
      return axios.get(this.pdfApi, { params: this.pdfData })
        .then((response) => {
          if (!response || !response.data || !response.data.success) {
            this.$root.$emit('notify', { type: 'error', text: 'Ошибка получения PDF.\nПожалуйста, попробуйте позже.' })
            throw new Error('Error getting PDF.')
          }
          // хардкод. технически это единственное место, где в JS надо указывать УРЛ домена
          window.open(this.$store.state.API.CALCULATOR_PDF + response.data.file, '_blank')
        })
    },
    specialChanged (value, dataName) {
      if (value === true) {
        if (dataName === 'specialSaleHasFamily') {
          this.specialSaleFirstCar = false
        } else {
          this.specialSaleHasFamily = false
        }
      }
    },
    showSpecialSaleInfo (event) {
      if (event && event.target && event.target.hash) {
        this.specialSaleInfoTarget = event.target.hash.replace(/#/g, '')
        this.isSpecialSaleActive = true
      }
    },
    lineController () {
      var line = document.querySelector('.calculator-line');
      var aside = document.querySelector('.calculator-aside');
      var windowHeight = window.innerHeight

      if (line && aside) {
        var lineHeight = line.clientHeight;
        var asideCenter = aside.clientHeight/2;
        var asideTop = aside.offsetTop;

        if (windowHeight < asideTop + asideCenter) {
          this.isLineShow = true;
          document.querySelector('.calculator-disclaimers').style.paddingBottom = '132px';
        } else {
          this.isLineShow = false;
          document.querySelector('.calculator-disclaimers').style.paddingBottom = '42px';
        }
      }
    },
    selectProgramScroll () {
      $('.calculator').animate({ scrollTop: $('.calculator-node').outerHeight() + parseInt($(".calculator-holder").css("padding-top")) }, 500)
	}
  },
  watch: {
    availablePrograms: function (newData) {
      if (newData === null || !Object.keys(newData)[this.viewingProgram]) {
        this.selectProgram(0)
      }
    },
    calculator: function (newData, oldData) {
      if (newData) {
        let mod = newData.car[Object.keys(newData.car)[0]]
        let compl = mod.compl[Object.keys(mod.compl)[0]]
        this.sliderPrepayValue = this.calculator && this.calculator.car && this.calculator.car[this.modification] ? this.calculator.car[this.modification].compl[this.complectation].defaultPV : 35 || 35
        // небольшой костыль - берем дефолтный строго из newData, если не взяли из данных
        if (this.sliderPrepayValue === 35) {
          this.sliderPrepayValue = compl.defaultPV ? compl.defaultPV : 35 || 35
        }
        this.$refs.sliderPrepay && this.$refs.sliderPrepay.refresh()
      }
    },
    calculation: function (newData, oldData) {
      if (newData) {
        this.sliderPrepayMin = this.calculator ? this.calculator.minPrepay : 20 || 20
        if (this.sliderPrepayValue < this.sliderPrepayMin) {
          this.sliderPrepayValue = (this.calculator && this.calculator.car && this.calculator.car[this.modification] ? this.calculator.car[this.modification].compl[this.complectation].defaultPV : this.sliderPrepayMin) || 35
        }
        this.$refs.sliderPrepay && this.$refs.sliderPrepay.refresh()
        this.currentCalculation = newData
      }
    },
    complectation: function (value) {
      this.getData()
    }
  },
  created () {
    this.currentCalculation = this.calculation
    this.setPrepayMin()
  },
  mounted () {
    var that = this;

    this.currentCalculation = this.calculation
    if (this.isCalcActive) {
      this.getData()
    }
    window.addEventListener('resize', function () {
      that.lineController();
    })
    
    //Проверяем показывать ли кнопку предодобрение кредита
    if (this.isDealer) {
      axios.get(this.apiCheckCredit)
        .then(response=>{
          if (!response.data) {
            this.creditApprove = false
          } else if (response.data) {
            this.creditApprove = true
            this.dealerCreditApprove = response.data
          } else {
            throw new Error()
          }
        })
        .catch(error=>{
          this.creditApprove = false
          console.error(error)
        })
    }
  }
}
</script>
<style lang="scss">
@import '../assets/_mixins.scss';
@import '../../../sass/common/variables';

$programTransition: .35s cubic-bezier(.55,0,.1,1) 0s;

// custom transition for the calc
.calc-in-enter-active, .calc-in-leave-active {
  transition: opacity .5s cubic-bezier(.55,0,.1,1) 0s;
}
.calc-in-enter, .calc-in-leave-active {
  opacity: 0;
  .calculator-holder {
    opacity: 0;
    transform: translate(0, 50px);
  }
}
.calculator {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 800;
  overflow-x: auto;
  overflow-y: auto;
  background: #fbfbfb url('../assets/image/bgr_2.jpg') no-repeat center top / 100% auto;
  width: 100%;
  &.is-loading {
    cursor: wait;
  }
  #nprogress {
    .bar {
      height: 5px;
      background: #00aed5;
    }
    .peg {
      box-shadow: 0 0 10px #00aed5, 0 0 5px #007ea5;
    }
  }
  .loader-overlay {
    background: transparent;
    height: 85%;
  }

  &.is-modal-opened {
    overflow: hidden;
  }
}
.calculator-holder {
  transition: opacity .75s cubic-bezier(.55,0,.1,1) 0s, transform .75s cubic-bezier(.55,0,.1,1) 0s;
  position: relative;
  padding-top: 60px;
}
.calculator-node {
  display: flex;
  background: #002C5F;
  position: relative;
  min-height: 550px;
  color: #fff;
}

.calculator-main {
  width: 68%;
  padding: 33px 32px 64px 32px;
  overflow: hidden;
  &__top {
    margin-bottom: 65px;
  }
  &__title {
    display: none;
  }
  &__back {
    color: #00AAD2;
    &:hover, &:focus {
      color: #00AAD2;
    }
  }
  &__close {
    display: none;
  }
  &__body {
    display: flex;
    flex-wrap: wrap;
    min-width: 100%;
    margin-left: -16px;
    margin-right: -16px;
    margin-bottom: 42px;
  }
  &__section {
    width: calc(50% - 32px);
    margin: 0 16px;
    margin-bottom: 30px;
  }
  &__subtitle {
    font-size: 1.6rem;
    font-weight: 500;
    color: #fff;
    margin-bottom: 8px;
  }
  &__line {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  &__min, &__max {
    font-size: 14px;
    margin-top: 8px;
  }
  &__block {
    .selected-item {
      border-radius: 0;
      font-size: 16px;
      color: #fff;
      border: 2px solid #fff;
      padding: 14px 80px 14px 20px!important;
    }
    .list-item.selected-item .ic-svg {
      width: 9px;
      height: 6px;
      right: 20px;
    }
    .list-component-holder {
      border: none;
      border-radius: 0;
      padding: 0;
      background-color: #fff;
      left: 0;
      right: 0;
      width: 100%;
    }
    .list-component {
      background-color: #002C5F;
      border-radius: 0;
      border: 0;
      &.is-active {
        .selected-item  {
          background-color: #fff;
          color: #666666;
        }
        .list-component-holder {
          border-top: 1px solid #F1F1F1;
        }
      }
    }
    .list-item {
      border-radius: 0;
      padding-left: 22px;
      padding-right: 20px;
      color: #000;
      &.selected-item {
        color: #fff;
      }
      &.is-active {
        display: none;
      }
      &:hover {
        background-color: #F8F8F8;
      }
    }
    .list-item:not(.selected-item):last-of-type {
      margin-bottom: 0;
    }
    .radio-line-component {
      border-radius: 0;
      border: 2px solid #fff;
	  border-right: none;
	  .radio-line, .radio-line.is-active  {
		  font-size: 1.6rem;
	  }
      .radio-line::before {
        border-radius: 0;
        background-color: #fff;
      }
      .radio-line-item {
        border-radius: 0;
        max-height: 100%;
        line-height: 44px;
        padding: 0;
        text-align: center;
        border-right: 2px solid #fff;
        &.is-active {
          font-size: 16px;
          font-weight: 400;
          color: #002C5F;
        }
      }
    }
    .calculator-prepay-slider {
      &::before {
        top: 14px;
        left: 0;
      }
      &::after {
        top: 14px;
        right: 0;
      }
      &.is-dragging {
        .vue-slider .vue-slider-dot::before {
          transform: scale(1);
        }
      }
      .vue-slider-dot-handle {
        display: none;
      }
      .vue-slider .vue-slider-dot {
        background-color: #00AAD2;
        box-shadow: none;
        border-radius: 50%;
        &:hover {
          &::after {
            transform: scale(1.12);
          }
        }
        &::before {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          margin: auto;
          width: 6px;
          height: 6px;
          background: #ffffff;
          border-radius: 50%;
          z-index: 1;
        }
      }
      .vue-slider-tooltip-wrap.vue-slider-tooltip-top {
        top: 49px;
        .vue-slider-tooltip {
          position: relative;
          font-size: 16px;
          color: #00AAD2;
          font-weight: 500;
          border: none;
          background-color: transparent;
          &::after {
            content: '%';
            display: inline-block;
          }
          &::before {
            width: 200%;
            height: 100%;
            bottom: 0;
            border: none;
            background: -moz-linear-gradient(left, rgba(0,44,95,0) 0%, rgba(0,44,95,1) 30%, rgba(0,44,95,1) 70%, rgba(0,44,95,0) 100%);
            background: -webkit-linear-gradient(left, rgba(0,44,95,0) 0%,rgba(0,44,95,1) 30%,rgba(0,44,95,1) 70%,rgba(0,44,95,0) 100%);
            background: linear-gradient(to right, rgba(0,44,95,0) 0%,rgba(0,44,95,1) 30%,rgba(0,44,95,1) 70%,rgba(0,44,95,0) 100%);
            z-index: -1;
          }
        }
      }
    }
  }
}
.offer {
  border: 2px solid #527092;
  padding: 21px 48px 26px 47px;
  color: #fff;
  &__title {
    font-size: 1.6rem;
    font-weight: 500;
    margin-bottom: 14px;
  }
  &__body {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
  }
  &__name {
    font-size: 1.8rem;
  }
  &__up-price {
    font-size: 2.4rem;
    font-weight: 500;
  }
  &__button {
    display: block;
    background-color: #00AAD2;
    padding: 18px 0px;
    &:hover, &:focus {
      background-color: #00AAD2;
      color: #fff;
    }
  }
}
.calculator-aside {
  flex: none;
  width: 32%;
  min-width: 416px;
  color: #fff;
  padding: 40px;
  background-color: #103A71;
  &__name {
    font-size: 2.6rem;
    font-weight: 500;
    margin-bottom: 40px;
  }
  &__img {
    max-width: 300px;
    margin: 0 auto;
    margin-bottom: 38px;
    img {
      display: block;
      max-width: 100%;
      height: auto;
    }
  }
  &__line {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
    &--at {
      align-items: flex-start;
    }
    &--mb {
      margin-bottom: 26px;
    }
  }
  &__text {
    font-size: 1.6rem;
  }
  &__summary, &__prepay {
    font-size: 1.6rem;
    font-weight: 500;
  }
  &__total {
    font-size: 4.2rem;
    font-weight: 500;
    line-height: 1;
    white-space: nowrap;
    sup {
      font-size: 2.4rem;
    }
  }
  &__select {
    position: relative;
    font-size: 1.8rem;
    font-weight: 500;
    color: #00AAD2;
    padding-right: 15px;
    &:hover, &:focus {
      color: #00AAD2;
    }
    svg {
      display: block;
      position: absolute;
      top: 50%;
      right: 0;
      transform: translateY(-50%);
      height: 16px;
      width: 8px;
    }
  }
  &__hr {
    display: block;
    border-color: #527092;
    margin: 32px 0;
  }
}

.calculator-header {
  font-size: 3.0rem;
  letter-spacing: 0.001em;
  line-height: 1;
  font-weight: 500;
  display: flex;
  align-items: center;
  padding: 18px 0 15px;
  cursor: default;
  .close {
    margin-left: auto;
    height: 60px;
    width: 60px;
    margin-right: -18px;
    padding: 18px;
    opacity: .35;
    &:hover {
      opacity: 1;
    }
    .ic-svg {
      fill: currentColor;
      display: block;
      height: 24px;
      width: 24px;
    }
  }
}
.calculator-body {
  min-height: 400px;
  position: relative;
  transition: opacity $programTransition;
  &.is-busy {
    opacity: .5;
    pointer-events: none;
  }
}
.calculator-body__inner {}
.calculator-body__col {
  width: calc(50% - 50px);
  max-width: calc(50% - 50px);
  flex-basis: calc(50% - 50px);
  flex-grow: 0;
  flex-shrink: 1;
}
.calculator-body__row {
  display: flex;
  flex-flow: row nowrap;
  align-items: start;
  justify-content: space-between;
  position: relative;
  transition: margin-top .25s linear 0s;
  &:not(:first-of-type) {
    margin-top: 40px;
  }
  &:nth-of-type(even) {
    margin-top: 18px;
  }
  &.is-shifted {
    margin-top: 55px;
  }
  @for $i from 0 to 10 {
    &:nth-of-type(#{$i}) {
      z-index: 11 - $i;
    }
  }
}
.calculator-body__subtitle {
  font-weight: 400;
  color: #416b97;
  font-size: 13px;
  line-height: 1;
  white-space: nowrap;
  letter-spacing: .05em;
  text-transform: uppercase;
  display: block;
  position: relative;
  cursor: default;
}
.calculator-body__subtitle-current {
  margin-left: auto;
  color: #fff;
  font-weight: 500;
  font-size: 22px;
  text-transform: none;
  position: absolute;
  bottom: -.05em;
  right: 0;
  line-height: 1;
  @at-root .is-shifted & sub {
    height: 1.1em;;
    opacity: 1;
  }
  sub {
    transition: height .25s linear 0s, opacity .25s linear 0s;
    display: block;
    text-align: right;
    height: 0;
    overflow: hidden;
    opacity: 0;
    line-height: 1;
    color: #00aed5;
    font-size: 14px;
    font-weight: 500;
    margin-top: 6px;
  }
}
.calculator__specials {
  margin-bottom: 44px;
}
.calculator__specials-item {
  position: relative;
  display: inline-block;
  vertical-align: middle;
  & + & {
    margin-left: 27px;
  }
}
.checkbox-component.calculator__specials-check {
  font-size: 12px;
  label {
    color: #fff;
    padding-left: 67px;
    height: 47px;
    line-height: 1;
    transition: color $tr-fast;
    .svg-check {
      height: 47px;
      width: 47px;
      margin-top: -26px;
      background: #00254c;
    }
    &:hover {
      color: #5781ac;
    }
  }
  input:checked + label .svg-check {
    background: #13b4d8;
  }
}
.calculator__specials-text {
  display: block;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}
.calculator__specials-detail-link {
  span {
    display: block;
    color: #fff;
  }
  line-height: 1.15;
  font-size: 14px;
  color: #00aed5;
  text-transform: none;
  letter-spacing: normal;
  padding: 0;
  transition: color $tr-fast;
  position: absolute;
  left: 67px;
  bottom: 0;
  right: 0;
  &:hover {
    color: #1ac6ec;
  }
  span {

  }
}

.calculator-programs {
  &__title {
    color: #B7B7B7;
    margin-bottom: 32px;
  }
}
.calculator-programs-holder {
  background: #fff;
  padding: 52px 32px 48px 32px;
}
.program-list {}

.program-item {
  padding: 43px 71px 40px 73px;
  transition: background $programTransition, padding $programTransition, border $programTransition;
  cursor: pointer;
  position: relative;
  color: #000;
  background-color: #E4DCD3;
  &:not(:last-of-type) {
    margin-bottom: 8px;
  }
  &.is-start {
    .program-item__body {
      //margin-bottom: 30px;
    }
    .program-item__payment {
      margin-top: 9px;
      &::before {
        display: none;
        opacity: 1;
      }
    }
  }
  .button--send-dealer {
    padding: 3px 26px;
    margin-left: 23px;
  }
  &.is-active {
    cursor: default;
    background: #F1F1F1;
    .program-item__controls {
      max-height: 150px;
      opacity: 1;
    }
    .program-item__plus {
	  opacity: 0;
    //   &::before {
    //     transform: rotate(0);
    //   }
    }
    .program-detail-spot {
      opacity: 1;
      max-height: 200px;
    }
  }
  &:not(.is-active) {

    &:hover {

    }
  }
  & + &:not(.is-active) {
    padding-top: 51px;
    padding-bottom: 36px;
  }
  &__plus {
    flex: none;
    position: relative;
    width: 32px;
    height: 32px;
    border: 1px solid #777673;
    border-radius: 50%;
	transition: 0.3s;
    &::after, &::before {
      content: '';
      display: block;
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      margin: auto;
      width: 10px;
      height: 2px;
      background-color: #777673;
      transition: transform 0.3s;
    }
    &::before {
      transform: rotate(90deg);
    }
  }
  &__more {
    font-size: 1.8rem;
  }
  &__send-dealer {
    display: block;
    padding-left: 31px;
    padding-right: 31px;
    margin-right: 37px;
    &:hover, &:focus {
      color:#fff;
    }
  }
  &__send {
    display: flex;
    align-items: center;
    color: #002C5F;
    font-weight: 500;
	transition: 0.3s;
    svg {
      display: block;
      width: 16px;
      height: 12px;
      stroke: #002C5F;
      fill: transparent;
      margin-right: 8px;
	  transition: 0.3s
    }
	&:hover {
		opacity: 0.8;
		svg {
			stroke: #00AAD2;
		}
	}
  }
}

.program-item__row {
  display: flex;
  flex-flow: row nowrap;
  align-items: start;
}
.program-item__body {
  transition: padding $programTransition;
  margin-bottom: 6px;
}
.program-item__controls {
  overflow: hidden;
  align-items: center;
  transition: max-height $programTransition, opacity $programTransition;
  max-height: 0;
  opacity: 0;
}
.program-item__controls-left {
  height: 100%;
  transition: padding $programTransition;
}
.program-item__controls-right {
  display: flex;
  align-items: center;
}
.program-item__col {
  flex: 0 1 45%;
  &:nth-of-type(1) {
    padding-right: 50px;
    flex: 0 1 55%;
  }
}
.program-item__name {
  font-size: 3.2rem;
  line-height: 1;
  letter-spacing: 0.01em;
  margin-top: -0.1em;
  display: block;
  margin-bottom: 5px;
}
.program-item__payment,
.program-item__rate {
  display: inline-block;
  width: 100%;
  min-width: 150px;
  max-width: 206px;
  sup {
    line-height: 1.2;
    display: inline-block;
    vertical-align: top;
    margin-left: 2px;
    font-size: 0.55em;
  }
}
.program-item__payment {
  position: relative;
  &::before {
    content: '';
    position: absolute;
    z-index: 0;
    background: #f53a27;
    opacity: 0;
    height: 120px;
    width: 120px;
    top: -41px;
    left: -14px;
    border-radius: 50% 50% 50% 0;
  }
}
.program-item__rate {}
.program-item__el,
.program-item__el-subtitle {
  line-height: 1;
  z-index: 1;
  display: block;
  position: relative;
}
.program-item__el {
  font-size: 3.0rem;
  font-weight: 500;
  letter-spacing: -0.02em;
}
.program-item__el-subtitle {
  font-size: 1.6rem;
  letter-spacing: .05;
  margin-top: 4px;
}
.program-detail-link {
  @include button-reset;
  color: #013368;
  font-size: 1.6rem;
  font-weight: 500;
  display: inline-block;
  padding: 0;
  margin-right: 15px;
  transition: color $tr-fast;
  &:hover {
    color: #15488b;
  }
  .ic-svg {
    width: 24px;
    height: 24px;
    margin-right: 10px;
    margin-top: -2px;
  }
  &::after {
    content: '';
    margin-left: 23px;
    height: 34px;
    vertical-align: middle;
    display: inline-block;
    width: 1px;
    background: #887e74;
  }
}
.program-detail-spot {
  color: #666666;
  font-size: 1.6rem;
  line-height: 1.37;
  display: block;
  max-width: 400px;
  opacity: 0;
  max-height: 0;
  transition: 0.5s;
}
.program-control-button {
  width: 52px;
  height: 52px;
  border-radius: 50%;
  color: #948c82;
  position: relative;
  display: inline-block;
  vertical-align: middle;
  &, &:active, &:hover, &:focus {
    border: 1px solid rgba(#fff, .4);
  }
  .ic-svg {
    @include abs-center;
    width: 26px;
    height: 26px;
    z-index: 1;
  }
  &::before {
    content: '';
    background: #dbd5cf;
    border-radius: inherit;
    position: absolute;
    margin: -31px 0 0 -31px;
    left: 50%;
    top: 50%;
    height: 62px;
    width: 62px;
    opacity: 0;
    z-index: 0;
    transform: scale(.75);
    transition: transform 0.15s cubic-bezier(0.55, 0, 0.1, 1) 0s, opacity 0.15s cubic-bezier(0.55, 0, 0.1, 1) 0s
  }
  &:hover {
    &::before {
      transform: scale(1);
      opacity: 1;
    }
  }
  & + & {
    margin-left: 7px;
  }
}

.calculator-upsale {
  border: 2px solid #00aed5;
  padding: 24px 35px 23px 31px;
}
.calculator-body__subtitle.calculator-upsale__subtitle {
  margin-bottom: 6px;
}
.calculator-upsale__name-wrapper {
  margin-top: 2px;
  height: 53px;
}
.calculator-upsale__name {
  font-size: 16px;
  color: #fff;
  line-height: 1.3;
}
.calculator-upsale__name--header {
  font-weight: 600;
}
.calculator-upsale__name--subheader {
  font-weight: 400;
}
.calculator-upsale__footer {
  display: flex;
  flex-flow: row nowrap;
  align-items: center;
  justify-content: space-between;
}
.calculator-upsale__up-price {
  line-height: 1;
  color: #00aed5;
  font-size: 20px;
  vertical-align: baseline;
  font-weight: 500;
}
.calculator-upsale__button {
  background: #00aed5;
  font-weight: 500;
  font-size: 15px;
  color: #fff;
  display: inline-block;
  line-height: 1;
  padding: 17px 43px 18px;
  text-align: center;
  transition: background $tr-fast;
  &, &:hover {
    text-decoration: none;
    outline: none;
  }
  &:hover {
    background: #1bc6ec;
  }
}

.calculator-minpay {
  font-size: 26px;
  line-height: 1;
  font-weight: 600;
  margin-bottom: 5px;
  cursor: default;
}
.calculator-minpay__value {
  line-height: 1;
  vertical-align: baseline;
  font-weight: 500;
  font-size: 60px;
  margin-right: 5px;
}
.calculator-summary-price {
  color: #5781ac;
  font-size: 16px;
  line-height: 1;
  cursor: default;
}

.calculator-disclaimers {
  padding: 0px 32px 48px 32px;
  background-color: #fff;
}
.calculator-disclaimer {
  position: relative;
  padding-left: 32px;
  &__star {
    position: absolute;
    width: 16px;
    top: 0;
    left: 0;
    font-size: 10px;
    font-weight: 500;
    color: #fff;
    line-height: 16px;
    text-align: center;
    background-color: #C4C4C4;
    border-radius: 50%;
  }
  &__text {
    font-size: 1.4rem;
    line-height: 1.21;
    color: #000;
  }
}

.program-details-wrapper, .special-sale-wrapper {
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(#000,.35);
  position: fixed;
  min-height: 100%;
  max-width: 100%;
  width: 100%;
  overflow-x: hidden;
  overflow-y: auto;
  z-index: 180;
}
.program-details, .special-sale {
  background: #fff url('../assets/image/popup_bgr.jpg') no-repeat center top / cover;
  padding: 42px 80px 60px;
  margin: 0 auto;
  overflow: hidden;
  max-width: 750px;
  width: auto;
  left: 0;
  right: 0;
  position: absolute;
  top: 50%;
  transform: translate(0, -50%);
  @media (max-height: 650px) {
    transform: none;
    position: relative;
    top: 0;
    margin: 50px auto;
  }
}
.program-details__header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  .close {
    height: 36px;
    width: 36px;
    padding: 5.5px;
    margin-left: auto;
    .ic-svg {
      fill: #dcdcdc;
      width: 25px;
      height: 25px;
      transition: fill $tr-fast;
    }
    &:hover {
      opacity: 1;
      .ic-svg {
        fill: $hollow;
      }
    }
  }
}
.details__center {
	padding: 40px 72px 48px;
    background-color: #fff;
    max-width: 1144px;
    margin: 0 auto;
}
.details__title {
	margin-bottom: 10px;
}
.program-details__body {
  margin-top: 15px;
}
.details__footer {
	margin-top: 50px;
}
.program-details__title {
  font-size: 40px;
  font-weight: 400;
  letter-spacing: 0.01em;
  line-height: 1.2;
  display: block;
}
.program-details__text {
  font-size: 18px;
  line-height: 1.675;
  margin-top: 20px;
}
.program-details__list {
  list-style: none;
  margin-bottom: 55px;
}
.program-details__list-item {
  position: relative;
  display: block;
  font-size: 16px;
  padding-left: 30px;
  margin-bottom: 0.72em;
  line-height: 1.2;
  &::before {
    content: '';
    width: 4px;
    height: 4px;
    border-radius: 50%;
    position: absolute;
    left: 3px;
    top: .65em;
    display: inline-block;
    background: rgba(#353535, .2);
  }
}
.program-details__footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 80px;
}
.program-details--go-start {
  padding: 4px 47px;
  margin: 0;
}
.special-sale {
  padding: 50px 60px;
}
.special-sale__header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  .close {
    height: 36px;
    width: 36px;
    padding: 5.5px;
    margin-right: -6px;
    .ic-svg {
      fill: #002c5f;
      width: 25px;
      height: 25px;
      transition: fill $tr-fast;
    }
  }
}
.special-sale__footer {
  margin-bottom: 10px;
}
.special-sale__body {
  margin: 42px 0 38px;
  padding-right: 2.2em;
}
.button.special-sale--go-detail {
  line-height: 52px;
  width: 190px;
  font-size: 13px;
  font-weight: 600;
  .ic-svg {
    width: 18px;
  }
}
.special-sale__title {
  font-size: 36px;
  font-weight: 500;
  line-height: 1.111;
  display: block;
}
.special-sale__text {
  font-size: 16px;
  line-height: 1.625;
  & + & {
    margin-top: 2em;
  }
}
.calculator-line {
  display: none;
}

.vhidden {
  visibility: hidden;
}
.hidden-desctop {
  display: none;
}

@media only screen and (max-width : $lg-max) {
  .calculator-holder {
    padding-top: 0;
  }
  .calculator-node {
    display: block;
    min-width: 100%;
    margin-left: -40px;
    margin-right: -40px;
  }
  .calculator-main {
    width: 100%;
    &__top {
      margin-bottom: 24px;
    }
    &__body {
      margin-bottom: 8px;
    }
    &__section {
      &--sm100 {
        width: calc(100% - 32px);
      }
    }
  }
  .calculator-aside {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    padding-bottom: 69px;
    &__name {
      width: 100%;
      margin-bottom: 0;
    }
    &__img {
      width: calc(50% - 35px);
      max-width: 50%;
      margin: 0;
    }
    &__body {
      margin-left: 35px;
      padding-left: 10px;
      width: 50%;
    }
    &__hr {
      margin: 26px 0;
    }
    &__line {
      &--mb {
        margin-bottom: 23px;
      }
    }
  }

  .calculator-programs {
    display: block;
    min-width: 100%;
    margin-left: -40px;
    margin-right: -40px;
  }
  .calculator-programs-holder {
    padding: 40px;
    padding-top: 36px;
    padding-bottom: 27px;
  }

  .program-item {
    padding: 27px 48px 40px 48px;
    &__name {
      margin-bottom: 20px;
    }
    &__row {
      flex-wrap: wrap;
    }
    &__col {
      flex: 0 1 100%;
      &:nth-of-type(1) {
        flex-basis: calc(100% - 32px);
      }
    }
    &__controls-left {
      margin-bottom: 37px;
    }
    &.is-active {
      .program-item__payment {
        margin-bottom: 33px;
      }
    }
  }

  .program-detail-spot {
    max-width: 100%;
  }
  .program-item + .program-item:not(.is-active) {
    padding: 27px 48px 40px 48px;
  }
  .calculator-disclaimers {
    padding-left: 8px;
    padding-right: 8px;
    padding-bottom: 42px;
  }

  .calculator-line {
    display: block;
    position: fixed;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 0 40px;
    background-color: #103A71;
    color: #fff;
    z-index: 100;
    transform: translateY(100%);
    transition: transform 0.5s;
    &.isShow {
      transform: translateY(0);
    }
    &.isOpened {
      .calculator-line__dd {
        max-height: 400px;
      }
      .calculator-line__plus {
        &::before {
          transform: rotate(0);
        }
      }
    }
    &__dd {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.5s;
    }
    &__header {
      position: relative;
      display: flex;
      align-items: center;
      height: 96px;
      padding-right: 50px;
    }
    &__img {
      flex: none;
      max-width: 136px;
      margin-right: 70px;
      img {
        display: block;
        max-width: 100%;
        height: auto;
      }
    }
    &__name {
      font-size: 14px;
      font-weight: 500;
    }
    &__payment {
      font-size: 24px;
      font-weight: 500;
    }
    &__plus {
      position: absolute;
      top: 50%;
      margin-top: -18px;
      right: 0px;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      border: 1px solid #00AAD2;
      &::after, &::before {
        content: '';
        display: block;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        margin: auto;
        width: 12px;
        height: 2px;
        background-color: #00AAD2;
        transition: transform 0.3s;
      }
      &::before {
        transform: rotate(90deg)
      }
    }
    &__body {
      border-top: 1px solid #527092;
      font-size: 16px;
      padding-top: 25px;
      padding-bottom: 45px;
    }
    &__line {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      &--mb {
        margin-bottom: 8px;
      }
    }
    &__summary, &__prepay {
      font-weight: 500;
    }
    &__hr {
      border-color: #527092;
      margin-top: 24px;
      margin-bottom: 23px;
    }
    &__total {
      width: 100%;
      font-size: 42px;
      font-weight: 500;
      margin-bottom: 11px;
      sup {
        font-size: 24px;
      }
    }
    &__select {
      display: flex;
      align-items: center;
      font-size: 18px;
      font-weight: 500;
      color: #00AAD2;
      &:hover {
        color: #00AAD2;
      }
      svg {
        display: block;
        width: 8px;
        height: 16px;
        margin-left: 7px;
      }
    }
  }

  .hidden-desctop {
    display: block;
  }
  .hidden-mobile {
    display: none;
  }
}

@media only screen and (max-width : $md-max) {
  .details__center {
	margin: 16px;
    padding: 48px 16px 32px 16px;
  }
  .calculator-node {
    margin-left: -16px;
    margin-right: -16px;
  }
  .calculator-main {
    width: 100%;
    padding: 22px 16px 32px 16px;
    &__top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
    }
    &__back {
      display: none;
    }
    &__title {
      display: block;
      font-size: 20px;
      font-weight: 500;
    }
    &__close {
      display: block;
      width: 16px;
      height: 16px;
      svg {
        display: block;
        max-width: 100%;
        max-height: 100%;
        fill: #fff;
      }
    }
    &__body {
      margin-bottom: 8px;
    }
    &__section {
      width: calc(100% - 32px);
      margin-bottom: 22px;
    }
  }

  .offer {
    padding: 22px;
    padding-top: 14px;
    &__body {
      flex-wrap: wrap;
    }
    &__left, &__right {
      width: 100%;
    }
    &__title {
      font-size: 14px;
      margin-bottom: 2px;
    }
    &__name {
      font-size: 16px;
    }
    &__up-price {
      font-size: 20px;
      margin-top: 11px;
    }
    &__button {
      margin-top: 24px;
      padding-top: 12px;
      padding-bottom: 12px;
      max-width: 400px;
    }
  }

  .calculator-aside {
    padding: 38px 16px 45px 16px;
    min-width: 0;
    &__line {
      &--at {
        align-items: flex-end;
      }
      &--mb {
        margin-bottom: 40px;
      }
    }
    &__img {
      width: 100%;
      max-width: 400px;
    }
    &__total {
      font-size: 30px;
    }
    &__select {
      font-size: 16px;
    }
    &__body {
      width: 100%;
      margin-left: 0;
      padding-left: 0;
      margin-top: 50px;
    }
    &__hr {
      margin: 32px 0;
      margin-bottom: 24px;
    }
  }

  .calculator-line {
    padding-left: 16px;
    padding-right: 20px;
    &__header {
      height: 72px;
    }
    &__payment {
      font-size: 20px;
    }
    &__img {
      max-width: 83px;
      margin-right: 10px;
    }
    &__plus {
      width: 24px;
      height: 24px;
      margin-top: -12px;
      &::after, &::before {
        width: 8px;
        height: 2px;
      }
    }
    &__body {
      font-size: 14px;
      padding-bottom: 37px;
    }
    &__total {
      font-size: 30px;
      margin-bottom: 25px;
    }
  }

  .calculator-programs-holder {
    padding: 16px;
    padding-top: 32px;
    padding-bottom: 24px;
  }
  .calculator-programs {
    margin-left: -16px;
    margin-right: -16px;
    &__title {
      display: none;
    }
  }
  .program-item {
    padding: 19px 18px 21px 24px;
    &__name {
      font-size: 18px;
    }
    &__col {
      display: flex;
      align-items: center;
    }
    &__plus {
      width: 24px;
      height: 24px;
      &::after, &::before {
        width: 8px;
        height: 2px;
      }
    }
    &__body {
      margin-bottom: 14px;
    }
    &__controls-left {
      margin-bottom: 28px;
    }
    &__controls-right {
      flex-wrap: wrap;
    }
    &__send-dealer {
      padding: 12px 47px;
      margin-right: 0;
      margin-bottom: 23px;
    }
    &__send {
      width: 100%;
      font-size: 14px;
    }
    &__payment, &__rate {
      min-width: 0;
      max-width: 100%;
      margin-top: 0!important;
    }
  }
  .program-item + .program-item:not(.is-active) {
    padding: 19px 17px 19px 24px;
    .program-item__body {
      margin-bottom: 0;
    }
  }
  .program-item.is-active .program-item__payment {
    margin-bottom: 0;
  }
  .program-item__col:nth-of-type(1) {
    flex-basis: calc(100% - 24px);
  }
  .program-detail-spot {
    font-size: 14px;
    line-height: 16px;
    margin-top: 27px;
  }

  .calculator-disclaimers {
    padding-bottom: 120px;
  }
  .calculator-disclaimer__text {
    font-size: 12px;
    line-height: 15px;
  }
}
</style>
