<template>
  <div class="summary">
    <div class="summary-inner-holder container">
      <transition name="fade">
        <div class="row">
          <div class="col-md-12">
            <div class="summary-layer" v-if="car">
              <div class="summary-view">
                <div class="summary-header">
                  <div class="summary-header__up">Ваша конфигурация</div>
                  <div class="summary-header__car-name">{{ carName }}</div>
                  <div class="summary-header__modification-name">{{ modificationName }} / {{ complectationName }}{{ packetsText }} {{ packetsString }}</div>
                </div>
                <div class="summary-car-view">
                  <div v-if="id == 29" class="summary-car-view-left">
                    <div class="summary-car-view-price">{{ summaryPrice | priceFormat }}</div>
                    <div class="summary-car-view-credit">Действует рассрочка</div>
                    <div class="summary-car-view-exist">
                      <svg v-if="carExist" width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 6.71429L4.21071 10.1543C4.62682 10.6002 5.34166 10.5729 5.72263 10.0967L13 1" stroke="#002C5F" stroke-width="2"/>
                      </svg>
                      <svg v-else width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9" cy="9" r="9" fill="#00AAD2"/>
                        <path d="M7.875 14.625H10.125V7.875H7.875V14.625ZM7.875 5.625H10.125V3.375H7.875V5.625Z" fill="white"/>
                      </svg>

                      <span>{{ carExist ? 'Есть в наличии' : 'Нет в наличии'}}</span>
                    </div>
                    <button class="df-button summary-car-view-check" @click="book" :disabled="!carExist">Забронировать</button>
                  </div>
                  <div class="summary-car-view-right">
                     <!-- <div class="summary-car-view__backstage">{{ bgName }}</div> -->
                    <summary-spritespin-view v-if="view360sources" :sources="view360sources" :ID="exteriorID" class="summary-car-view__visual"></summary-spritespin-view>
                    <summary-static-view v-else class="summary-car-view__visual"></summary-static-view>
                    <a href="#" class="summary-sticker" @click.prevent="creditCalc" v-if="isCreditAvaible && isStart && id != 29">
                      <span class="summary-sticker__subwrap">
                        <span class="summary-sticker__program">{{ creditProgramName }}</span>
                        <span class="summary-sticker__payment">
                          <span class="summary-sticker__payment-value">от {{ creditPayment | priceBaseFormat }}</span>
                          <span class="summary-sticker__payment-currency">₽ / месяц</span>
                        </span>
                      </span>
                      <svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-rounded_cross"></use></svg>
                    </a>
                  </div>
                </div>
                <div v-if="id == 29" class="summary-car-view-mobile">
                  <div class="summary-car-view-mobile-left">
                    <div class="summary-car-view-price">{{ summaryPrice | priceFormat }}</div>
                    <div class="summary-car-view-credit">Действует рассрочка</div>
                    <div class="summary-car-view-exist">
                      <svg v-if="carExist" width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 6.71429L4.21071 10.1543C4.62682 10.6002 5.34166 10.5729 5.72263 10.0967L13 1" stroke="#002C5F" stroke-width="2"/>
                      </svg>
                      <svg v-else width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9" cy="9" r="9" fill="#00AAD2"/>
                        <path d="M7.875 14.625H10.125V7.875H7.875V14.625ZM7.875 5.625H10.125V3.375H7.875V5.625Z" fill="white"/>
                      </svg>

                      <span>{{ carExist ? 'Есть в наличии' : 'Нет в наличии'}}</span>
                    </div>
                  </div>
                  <div class="summary-car-view-mobile-right">
                    <button class="df-button summary-car-view-check" @click="book" :disabled="!carExist">Забронировать</button>
                  </div>
                </div>
              </div>
              <div class="summary-details">
                <summary-conf-controls v-if="summaryData" @showSendEmail="toggleSendEmail" @showSendDealer="toggleSendDealer" @showSendTestDrive="toggleSendTestDrive"></summary-conf-controls>
                <summary-similar-block v-if="similarModels.length > 0 && id == 29" :models="similarModels"></summary-similar-block>
                <summary-tables v-if="summaryData" :summaryData="summaryData"></summary-tables>
              </div>
              <div class="summary-disclaimers">
                <!-- <p class="summary-disclaimer" v-for="(disclaimer, index) of disclaimers">
                  {{ disclaimer }}
                </p> -->
                <div class="df-info" v-for="(disclaimer, index) of disclaimers">
                    <div class="df-info__icon">
                        <svg width="2" height="9" viewBox="0 0 2 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 6.75H0V9H2V6.75Z" fill="white"/>
                        <path d="M0.133301 0H1.86663L1.5333 5.55H0.466634L0.133301 0Z" fill="white"/>
                        </svg>
                    </div>
                    <div class="df-info__text">
                      {{ disclaimer }}
                    </div>
                </div>
              </div>
            </div>
            <loader v-else></loader>
          </div>
        </div>
      </transition>
    </div>
    <send-email-new from="summary" :pdfData="pdfData" :isOpened="isSendEmailActive" @close="toggleSendEmail" @show-rules="toggleRules" @success="sentSuccess = true"></send-email-new>
    <rules-agreement :isOpened="isRulesActive" @close="toggleRules"></rules-agreement>
	<simple-sent-successfully :isOpened="sentSuccess" innerText="Форма успешно отправлена" @close-this="sentSuccess = false"></simple-sent-successfully>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import SummarySpritespinView from './SummarySpritespinView'
import SummaryStaticView from './SummaryStaticView'
import SummaryConfControls from './SummaryConfControls'
import SummaryTables from './SummaryTables'
import SendEmailNew from '@/components/SendEmailNew'
import RulesAgreement from '@/components/common/Rules'
import SimpleSentSuccessfully from '@/components/common/SimpleSentSuccessfully'
import SummarySimilarBlock from './SummarySimilarBlock'
import Loader from '@/components/Loader'
import { error } from 'util'

export default {
  name: 'Summary',
  components: { SummarySpritespinView, SummaryStaticView, SummaryConfControls, SummaryTables, Loader, SendEmailNew, RulesAgreement, SimpleSentSuccessfully, SummarySimilarBlock },
  data () {
    return {
      disclaimers: [
        'Расчет кредита является предварительным. Обязательное условие — оформление страхования КАСКО в страховой компании, соответствующей требованиям банков партнеров. Более подробную информацию обо всех условиях кредитования Вы можете получить, обратившись к банкам-партнерам программы и официальным дилерам Hyundai. Банки оставляют за собой право вносить изменения в программы кредитования без предварительного уведомления. Данное предложение носит информационный характер и не является публичной офертой (ст.437 ГК РФ).'
      ],
      isSendEmailActive: false,
      isSendDealerActive: false,
      isSendTestDriveActive: false,
	  isRulesActive: false,
	  sentSuccess: false
    }
  },
  computed: {
    ...mapGetters({
      car: 'GET_CAR',
      carName: 'GET_CAR_NAME',
      bgName: 'GET_CAR_BGNAME',
      colorPrice: 'GET_EXTERIOR_PRICE',
      complectationID: 'GET_COMPLECTATION_ID',
      complectationName: 'GET_COMPLECTATION_NAME',
      modificationID: 'GET_MODIFICATION_ID',
      complectationPrice: 'GET_COMPLECTATION_PRICE',
      creditDefaultProgram: 'GET_CREDIT_DEFAULT_PROGRAM',
      creditPaymentBase: 'GET_CREDIT_PAYMENT_BASE',
      creditPrepay: 'GET_CREDIT_DEFAULT_PREPAY',
      creditProgramName: 'GET_CREDIT_PROGRAM_NAME',
      exteriorID: 'GET_EXTERIOR_COLOR',
      interiorID: 'GET_INTERIOR_COLOR',
      id: 'GET_CURRENT_ID',
      isCreditAvaible: 'GET_CREDIT_AVAIBILITY',
      isStart: 'GET_CREDIT_PROGRAM_START_STATE',
      modificationName: 'GET_MODIFICATION_NAME',
      packetsPrice: 'GET_CURRENT_PACKETS_PRICE',
      summaryData: 'GET_SUMMARY',
      summaryPrice: 'GET_SUMMARY_PRICE',
      view360sources: 'GET_360',
      colorId: 'GET_COLOR_ID',
      packetsSelected: 'GET_CURRENT_PACKETS',
      packetsList: 'GET_PACKETS_LIST',
      models: 'GET_SIMILAR_MODELS',
      similarModels: 'GET_SIMILAR_SIMILARMODELS'
	}),
	carExist () {
    //Проверяем существует ли собранная конфигурация
		let result = false;
		let packets = [];

		if (Array.isArray(this.packetsSelected)) {
			packets = this.packetsSelected;
		}

		if (Array.isArray(this.models) && this.models.length > 0) {
			this.models.forEach(model => {
				let currentPackets = [];

				if (typeof model.package_id === 'number') {
					currentPackets.push(model.package_id)
				} else if (typeof model.package_id === 'string') {
					currentPackets = model.package_id.split(',')
				}

				let samePackets = packets.every(p=>currentPackets.some(cp=>cp == p))

				if (model.modification_id == this.modificationID && model.complectation_id == this.complectationID && samePackets && model.color_exterior_id == this.exteriorID && model.color_interior_id == this.interiorID && model.count_available > 0) {
					result = model.id
				}
			});
		}

		return result
	},
    packetsText () {
      if (Array.isArray(this.packetsSelected)) {
        return this.packetsSelected.length > 1 ? ' + пакеты' : ' + пакет'
      }
    },
    packetsString () {
      if (Array.isArray(this.packetsSelected)) {
        let arr = [];

        for (let packet in this.packetsList) {
          if (this.packetsSelected.indexOf(+packet) >= 0) arr.push(this.packetsList[packet].name)
        }

        return arr.join(', ')
      }
    },
    creditPayment () {
      const increase = this.colorPrice + this.packetsPrice
      return increase > 0 ? (Math.round((1 + increase / this.complectationPrice) * this.creditPaymentBase)) : this.$store.getters.GET_CREDIT_PAYMENT
    },
    pdfData () {
      return {
        compl_id: this.complectationID, // - ID комплектации
        pv_perc: this.creditPrepay, // - процент первоначального взноса [default value this time]
        tm: 36, // - срок, в месяцах [default value this time]
        sum: this.summaryPrice, // - стоимость тачки
        delta: 0, // - надбавки или скидки из-за акций. Сейчас у нас такой инфы нет, так что передавать ноль принудительно.
        payment: this.creditPayment, // - размер ежемесячного платежа [default value this time]
        programId: this.creditDefaultProgram, // - ID кредитной программы
        color_id: this.colorId,
        packets: this.packetsSelected > 0 ? this.packetsSelected.join(',') : ''
      }
    },
    bookLink () {
      let packets;

      if (Array.isArray(this.packetsSelected)) {
        packets = this.packetsSelected.join(',');
      } else {
        packets = '';
      }

      return this.$store.state.API.CONF_BOOK + '?modification_id=' + this.modificationID + '&complectation_id=' + this.complectationID + '&package_id=' + packets + '&color_exterior_id=' + this.exteriorID + '&color_interior_id=' + this.interiorID 
    },
    bookLinkNew () {
			return this.carExist ? this.$store.state.API.CONF_BOOK + 'model/'+ this.carExist : ''
		},
    similarData () {
      return {
        car_id: this.id,
        modification_id: this.modificationID,
        complectation_id: this.complectationID,
        package_id: this.packetsSelected ? this.packetsSelected.join(',') : '',
        color_exterior_id: this.exteriorID,
        color_interior_id: this.interiorID
      }
    }
  },
  methods: {
    toggleSendEmail () {
      if (!this.isRulesActive) {
        this.isSendEmailActive = !this.isSendEmailActive
        this.$root.$emit('fixOverflow', this.isSendEmailActive)
      }
    },
    toggleSendDealer () {
      if (!this.isRulesActive) {
        this.isSendDealerActive = !this.isSendDealerActive
        this.$root.$emit('fixOverflow', this.isSendDealerActive)
      }
    },
    toggleSendTestDrive () {
      this.isSendTestDriveActive = !this.isSendTestDriveActive
      // if (!this.isRulesActive) {
        
      //   this.$root.$emit('fixOverflow', this.isSendTestDriveActive)
      // }
    },
    toggleRules () {
      this.isRulesActive = !this.isRulesActive
      this.$root.$emit('fixOverflow', this.isRulesActive)
    },
    creditCalc () {
      this.$store.dispatch('OPEN_CALC')
    },
    closeHandler (event) {
      if (event.type === 'keyup' && event.keyCode === 27) {
        if (this.isRulesActive) {
          this.isRulesActive = false
        } else {
          this.isSendEmailActive = false
          this.isSendTestDriveActive = false
          this.isSendDealerActive = false
          this.$root.$emit('fixOverflow', false)
        }
      }
    },
    book () {
      window.open(this.bookLinkNew, '_blank');
    },
    loadSimilar () {
      this.$store.dispatch('LOAD_SIMILAR', this.similarData)
        .then(
          ()=>{},
          error=>{
            this.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки запроса.\nПожалуйста, попробуйте позже.' })
            console.error(error)
          }
        )
    }
  },
  activated () {
    window.addEventListener('keyup', this.closeHandler)
    this.loadSimilar()
  },
  deactivated () {
    window.removeEventListener('keyup', this.closeHandler)
  },
  watch: {
    similarData () {
       //load similar
      this.loadSimilar()
    }
  }
}
</script>

<style lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.summary-header__up {
  font-size: 4.2rem;
  line-height: 1.14;
  font-weight: 500;
  color: #000;
  margin-bottom: 32px;
}
.car-view-item.summary {
  padding-top: 90px;
  padding-bottom: 60px;
  position: relative;
  height: auto;
  min-height: calc(100vh - 60px);
}
.summary-inner-holder {
  min-height: 800px;
  padding-bottom: 15px;
}
.summary-layer {
  background-color: #fff;
}
.summary-view {
  position: relative;
  padding-top: 40px;
  padding-left: 72px;
  padding-right: 72px;
  background-color: #fff;
}
.summary-header {
  position: relative;
  z-index: 1;
}
.summary-header__car-name {
  line-height: 1.2;
  font-size: 3.0rem;
  font-weight: 500;
  letter-spacing: .01em;
  margin-bottom: 3px;
}
.summary-header__modification-name {
  font-size: 1.8rem;
  line-height: 1.22;

}
.summary-car-view {
  position: relative;
  display: flex;
  border-bottom: 1px solid #E4DCD3;
}
.summary-car-view-mobile {
  display: none;
}
.summary-car-view-right {
  width: 100%;
}
.summary-car-view-left {
  flex: none;
  display: flex;
  flex-direction: column;
  padding-top: 54px;
  padding-bottom: 41px;
}
.summary-car-view-price {
  font-size: 3rem;
  line-height: 1.2;
  font-weight: 500;
  margin-bottom: 8px;
}
.summary-car-view-credit {
  font-size: 1.8rem;
  line-height: 1.22;
  margin-bottom: 33px;
}
.summary-car-view-exist {
  font-size: 1.6rem;
  line-height: 1.5;
  font-weight: 500;
  color: #002C5F;
  margin-top: auto;
  margin-bottom: 24px;
}
.summary-car-view-exist svg {
  margin-right: 8px;
}
.summary-car-view__backstage {
  position: absolute;
  top: -10px;
  left: 0;
  right: 0;
  text-align: center;
  font-size: 120px;
  font-weight: 500;
  line-height: 1;
  color: #f5f5f5;
  user-select: none;
  pointer-events: none;
  z-index: 0;
}
.summary-car-view__visual {
  position: relative;
  z-index: 1;
}
.summary-sticker {
  position: absolute;
  right: 0;
  top: -30px;
  z-index: 2;
  width: 160px;
  height: 160px;
  transition: background $tr-fast;
  background: #f53a27;
  border-radius: 50% 50% 50% 0;
  &:hover {
    background: #f86b5d;
  }
  .ic-svg {
    position: absolute;
    width: 19px;
    height: 19px;
    z-index: 1;
    fill: #fff;
    left: 15px;
    bottom: 15px;
  }
}
.summary-sticker__subwrap {
  position: absolute;
  right: 30px;
  top: 42%;
  transform: translate(0,-50%);
  line-height: 1;
  color: #fff;
  text-align: right;
}
.summary-sticker__program {
  display: block;
  font-size: 16px;
  font-weight: 500;
}
.summary-sticker__payment {
  display: block;
  margin-top: 12px;
}
.summary-sticker__payment-value {
  display: block;
  font-size: 24px;
  font-weight: 500;
  letter-spacing: .035em;
  strong {
    letter-spacing: -.05em;
    font-size: 40px;
    font-weight: 500;
  }
}
.summary-sticker__payment-currency {
  display: block;
  font-size: 16px;
  font-weight: 500;
}

.summary-prices {
  line-height: .6;
  position: absolute;
  bottom: 30px;
}
.summary-prices__price {
  font-size: 30px;
  font-weight: 500;
  line-height: inherit;
  padding-top: 0.07em;
  color: #000;
}
.summary-prices__credit {
  display: block;
  color: #a8a9ad;
  font-size: 18px;
  padding-top: .80em;
  padding-bottom: 3px;
  border-bottom: 1px solid #a8a9ad !important;
}
.summary-details {}
.summary-disclaimers {
  padding: 5px 72px 35px;
}
.summary-disclaimer {
  color: #000000;
  text-align: justify;
  font-size: 12px;
  line-height: 17px;
  strong {
    font-weight: 600;
    color: #2a2a2a;
  }
  & + & {
    margin-top: 13px;
  }
}

@media only screen and (max-width : $lg-max) {
  .car-view-item.summary {
    padding-top: 62px;
  }
  .summary-view {
    padding: 0 40px;
    padding-top: 35px;
    height: auto;
  }
  .summary-car-view {
    border: none;
  }
  .summary-car-view-mobile {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    border-bottom: 1px solid #E4DCD3;
    padding-bottom: 33px;
  }
  .summary-car-view-price {
    margin-bottom: 5px;
  }
  .summary-car-view-credit {
    margin-bottom: 18px;
  }
  .summary-car-view-exist {
    margin-bottom: 0;
  }
  .summary-header__up {
    margin-bottom: 24px;
  }
  .summary-header__car-name {
    margin-bottom: 11px;
  }
  .summary-car-view-left {
    display: none;
  }
  .summary-sticker {
    width: 120px;
    height: 120px;
  }
  .summary-sticker__subwrap {
    right: 19px;
    top: 46%;

  }
  .summary-sticker__program {
    font-size: 14px;
  }
  .summary-sticker__payment {
    margin-top: 7px;
  }
  .summary-sticker__payment-value {
    font-size: 18px;
  }
  .summary-sticker__payment-currency {
    font-size: 14px;
  }
  .summary-sticker .ic-svg {
    left: 10px;
    bottom: 10px;
    width: 12px;
    height: 12px;
  }
  .summary-prices {
    position: relative;
    bottom: 0;
  }
  .summary-prices__price {
    font-size: 24px;
  }
  
  .summary-disclaimers {
    padding-left: 40px;
    padding-right: 40px;
  }
}

@media only screen and (max-width : $md-max) {
  .summary-car-view-mobile {
    display: block;
    border: none;
    padding-bottom: 8px;
  }
  .summary-car-view-mobile-left {
    margin-bottom: 8px;
  }
  .summary-header__up {
    font-size: 30px;
    line-height: 32px;
  }
  .summary-header__car-name {
    font-size: 20px;
    line-height: 24px;
    margin-bottom: 3px;
  }
  .summary-header__modification-name {
    font-size: 14px;
    line-height: 21px;
  }
  .summary-car-view-price {
    font-size: 20px;
    margin-bottom: 3px;
  }
  .summary-car-view-credit {
    font-size: 14px;
    line-height: 21px;
    margin-bottom: 13px;
  }
  .summary-car-view-exist {
    font-size: 14px;
  }
  .summary-car-view-check {
    width: 100%;
  }
  .summary-prices__price {
    font-size: 20px;
    line-height: 24px;
  }
  .summary-car-view-check {
    padding-top: 12px;
    padding-bottom: 12px;
  }
}
</style>
