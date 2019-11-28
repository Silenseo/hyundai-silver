<template>
  <transition name="fade">
    <div class="side-bar-holder">
      <div class="side-bar" v-if="carName" :class="{ isOpened: isMobileOpened }">
        <div class="side-bar-m">
          <div class="side-bar-m__car-image">
            <img v-fade-in class="side-bar-m__car-img" :src="carPicture" :alt="carName"/>
          </div>
          <div class="side-bar-m__info">
            <div class="side-bar-m__name">{{ carName }}</div>
            <div class="side-bar-m__total">{{ summaryPrice | priceFormat }}</div>
          </div>
          <a href="#" @click.prevent="isMobileOpened = !isMobileOpened" class="side-bar-m__more"></a>
        </div>
        <div class="side-bar__body">
          <div class="side-bar__body-row side-bar__car-name">{{ carName }}</div>
          <div class="side-bar__car-image">
            <img v-fade-in class="side-bar__car-img" :src="carPicture" height="150" :alt="carName"/>
          </div>
          <router-link :to="{ name: 'Modification', params: { id: id }}" class="side-bar__body-row side-bar__body-row--cont side-bar__modification">
            <span class="side-bar__row-section">Модификация</span>
            <span class="side-bar__row-name" :class="{ 'clip-line': currentStepID < 2 }">{{ modificationName }}</span>
            <strong class="side-bar__row-price" v-if="currentStepID < 2">от {{ modificationPrice | priceFormat }}</strong>
          </router-link>
          <transition name="unwrap">
          <router-link :to="{ name: 'Complectation', params: { id: id }}" class="side-bar__body-row side-bar__body-row--cont side-bar__complectation" v-if="currentStepID > 1">
            <span class="side-bar__row-section">Комплектация</span>
            <span class="side-bar__row-name" :class="{ 'clip-line': currentStepID > 1 }">{{ complectationName }}</span>
            <strong class="side-bar__row-price">{{ complectationPrice | priceFormat }}</strong>
          </router-link>
          </transition>
          <router-link :to="{ name: 'Packets', params: { id: id }}" class="side-bar__body-row side-bar__body-row--cont side-bar__packets" v-if="packetsSelected && packetsList && currentStepID > 2" v-for="packet in packetsSelected" :key="packet">
            <span class="side-bar__row-section side-bar__row-section--visible">Пакет</span>
            <span class="side-bar__row-name clip-line">«{{packetsList[packet].name}}»</span>
            <strong class="side-bar__row-price">{{ packetsList[packet].price | priceFormat }}</strong>
          </router-link>
          <transition name="unwrap">
          <router-link :to="{ name: 'Design', params: { id: id }}" class="side-bar__body-row side-bar__body-row--cont side-bar__color" v-if="currentStepID > 3">
            <span class="side-bar__row-section">Цвет</span>
            <span class="side-bar__row-name" :class="{ 'clip-line': currentStepID > 3 }">{{ colorName }}</span>
            <strong class="side-bar__row-price">{{ colorPrice | priceFormat }}</strong>
          </router-link>
          </transition>
          <hr class="side-bar__line">
          <router-link :to="{ name: 'Summary', params: { id: id }}" class="side-bar__body-row side-bar__body-row--cont side-bar__overall">
            <span class="side-bar__row-name side-bar__row-total clip-line">Итого</span>
            <strong class="side-bar__row-price side-bar__row-price--bold">{{ summaryPrice | priceFormat }}</strong>
          </router-link>
        </div>
        <div class="side-bar__footer">
          <div class="side-bar__footer-links">
            <a :href="priceList" class="df-download-link side-bar__footer-link" target="_blank" @click="sendGtm">
                <svg aria-hidden="true">
                    <use xlink:href="#download-link"></use>
                </svg>
                Прайс-лист
            </a>
            <a href="#" @click.prevent="toggleSendTestDrive" class="df-iconed-link df-iconed-link--small side-bar__footer-link" target="_blank" v-if="!isDealer && id != 16">
                Тест-драйв
                <svg aria-hidden="true">
                    <use xlink:href="#arrow-link"></use>
                </svg>
            </a>
            <a href="/test-drive" class="df-iconed-link df-iconed-link--small side-bar__footer-link" target="_blank" v-if="isDealer">
                Тест-драйв
                <svg aria-hidden="true">
                    <use xlink:href="#arrow-link"></use>
                </svg>
            </a>
          </div>
          <a class="side-bar__credit-link" href="#" @click.prevent="openCalc">
            <span class="side-bar__credit-row">
              <span class="side-bar__credit-program">«{{ creditProgramName }}»</span>
              <span class="side-bar__credit-price">от {{ currentStepID > 2 ? creditPaymentFixed : creditPayment | priceFormat }}/мес</span>
            </span>
            <svg tabindex="-1" aria-visible="false" class="side-bar__credit-icon ic-svg"><use xlink:href="#ic-slider-arrow-right"></use></svg>
          </a>
        </div>
        <!-- <send-test-drive :isActive="isSendTestDriveActive" :isRulesActive="isRulesActive" @close="toggleSendTestDrive" @showRules="toggleRules"></send-test-drive>
        <rules-agreement :isActive="isRulesActive" @close="toggleRules"></rules-agreement> -->
      </div>
    </div>
  </transition>
</template>

<script>
import { mapGetters } from 'vuex'
// import SendTestDrive from '@/components/SendTestDrive'
// import RulesAgreement from '@/components/RulesAgreement'

export default {
  name: 'Sidebar',
  components: { },
  data () {
    return {
      isSendTestDriveActive: false,
      isRulesActive: false
    }
  },
  computed: {
    ...mapGetters({
      car: 'GET_CAR',
      id: 'GET_CURRENT_ID',
      carName: 'GET_CAR_NAME',
      carPicture: 'GET_CAR_PICTURE',
      modificationName: 'GET_MODIFICATION_NAME',
      modificationPrice: 'GET_MODIFICATION_PRICE',
      complectationName: 'GET_COMPLECTATION_NAME',
      complectationPrice: 'GET_COMPLECTATION_PRICE',
      packetsSelected: 'GET_CURRENT_PACKETS',
      packetsList: 'GET_PACKETS_LIST',
      packetsPrice: 'GET_CURRENT_PACKETS_PRICE',
      colorName: 'GET_COLOR_NAME',
      colorPrice: 'GET_EXTERIOR_PRICE',
      summaryPrice: 'GET_SUMMARY_PRICE',
      currentStepID: 'GET_CURRENT_STEP_ID',
      creditPayment: 'GET_CREDIT_PAYMENT',
      creditPaymentBase: 'GET_CREDIT_PAYMENT_BASE',
      creditProgramName: 'GET_CREDIT_PROGRAM_NAME',
      priceList: 'GET_CAR_PRICELIST',
      isDealer: 'GET_IS_DEALER'
    }),
    creditPaymentFixed () {
      if ((this.colorPrice + this.packetsPrice) > 0) {
        return Math.round((1 + (this.colorPrice + this.packetsPrice) / this.complectationPrice) * this.creditPaymentBase)
      } else {
        return this.creditPayment
      }
    },
    isMobileOpened: {
      get () {
        return this.$store.state.isMobileOpened
      },
      set (value) {
        this.$store.commit('SET_MOBILEMENU_STATE', value)
      }
    }
  },
  methods: {
    toggleSendTestDrive () {
		//Установим активной модель. Св-во code!!!!!!
		vueStore.dispatch('SET_SAVED_MODEL', this.car.codeName);
		vueStore.dispatch('SET_MODEL', this.car.codeName);
		vueStore.dispatch('OPEN_TEST_DRIVE_POPUP', true);
    //   if (!this.isRulesActive) {
    //     this.isSendTestDriveActive = !this.isSendTestDriveActive
    //     this.$root.$emit('fixOverflow', this.isSendTestDriveActive)
    //   }
    },
    toggleRules () {
      this.isRulesActive = !this.isRulesActive
      this.$root.$emit('fixOverflow', this.isRulesActive)
    },
    openCalc () {
      this.$store.dispatch('OPEN_CALC')
    },
    sendGtm () {
      this.$gtm.trackEvent({
        event: 'custom_event',
        category: 'Конфигуратор',
        action: 'Прайс лист',
        label: this.carName
      })
    },
    closeHandler (event) {
      if (event.type === 'keyup' && event.keyCode === 27) {
        if (this.isRulesActive) {
          this.isRulesActive = false
        } else {
          this.isSendTestDriveActive = false
          this.$root.$emit('fixOverflow', false)
        }
      }
    }
  },
  activated () {
    window.addEventListener('keyup', this.closeHandler)
  },
  deactivated () {
    window.removeEventListener('keyup', this.closeHandler)
  }
}
</script>

<style lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.content-aside {}
.side-bar-m {
  display: none;
}
.side-bar-holder {
  height: 100%;
}
.side-bar {
  position: relative;
  height: 100%;
  width: 100%;
  &__row-section {
    display: none;
    &--visible {
      display: block;
      font-size: 16px;
    }
  }
  &__line {
    display: none;
  }
}
.side-bar__body {
  padding-top: 34px;
  // @media (max-height: 680px) {
  //   padding-top: 20px;
  // }
}
.side-bar__body-row {
  margin: 0 40px;
  display: block;
  line-height: 1;
  font-size: 14px;
  & + & {
    margin-top: 8px;
  }
  & + .side-bar__overall {
    margin-top: 17px;
  }
  &#{&}--cont {
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
    justify-content: space-between;
  }
  &.side-bar__modification {}
}
.side-bar__car-name {
  font-size: 2.0rem;
  font-weight: 500;
  color: #000;
  position: relative;
  z-index: 1;
}
.side-bar__car-image {
  position: relative;
  z-index: 0;
  margin-bottom: 27px;
  // @media (max-height: 770px) {
    // margin-bottom: 0;
  // }
  @media (max-height: 650px) {
    margin-bottom: 30px;
  }
}
.side-bar__car-img {
  position: relative;
  display: block;
  z-index: 2;
  margin: 0 auto;
  max-width: 87%;
  width: auto;
  height: auto;
  @media (max-height: 650px) {
    //display: none;
  }
}
.side-bar__row-name {
  font-size: 1.6rem;
  color: #000;
  &.clip-line {
    white-space: nowrap;
    max-width: 130px;
    max-width: calc(100% - 80px);
    overflow: hidden;
    text-overflow: ellipsis;
  }
}
.side-bar__row-price {
  font-size: 1.6rem;
  font-weight: 400;
  color: #000;
  white-space: nowrap;
  &--bold {
    font-weight: 500;
  }
}
.side-bar__overall {
  &, &:active {
    padding-top: 15px;
  }
}

.side-bar__footer {
  position: absolute;
  bottom: 0;
  width: 100%;
}

.side-bar__footer-links {
  display: flex;
  flex-flow: row nowrap;
  justify-content: space-between;
  padding: 0 40px 20px;
}
.side-bar__footer-link {
  font-size: 1.6rem;
}

.side-bar__credit-link {
  position: relative;
  height: 85px;
  padding: 0 40px 0 40px;
  display: flex;
  flex-flow: row nowrap;
  justify-content: space-between;
  align-items: center;
  color: #fff;
  font-size: 14px;
  background: #D4C8BA;
  line-height: 1;
  .ic-svg {
    fill: #777673;
    transition: opacity $tr-fast;
    opacity: .4;
    height: 32px;
    width: 32px;
  }
  &:hover {
    .ic-svg {
      opacity: 1;
    }
  }
}
.side-bar__credit-row {
  max-width: 100%;
  margin-right: 15px;
}
.side-bar__credit-program {
  display: block;
  line-height: 1;
  white-space: nowrap;
  font-size: 1.6rem;
  color: #000;
  margin-bottom: 3px;
  overflow: hidden;
  text-overflow: ellipsis;
}
.side-bar__credit-price {
  display: block;
  white-space: nowrap;
  font-size: 2.0rem;
  color: #000;
  line-height: 1;
  font-weight: 500;
  overflow: hidden;
  text-overflow: ellipsis;
}
.unwrap-enter-active, .unwrap-leave-active {
  transition: opacity .5s cubic-bezier(.55,0,.1,1) 0s, margin-top .25s cubic-bezier(.55,0,.1,1) 0s, max-height .25s cubic-bezier(.55,0,.1,1) 0s !important;
  max-height: 2em;
}
.unwrap-enter, .unwrap-leave-active {
  overflow: hidden;
  opacity: 0;
  max-height: 0;
  margin-top: 0 !important;
}

@media only screen and (max-width : $lg-max) {
  .content-aside {
    position: fixed;
    left: 0;
    bottom: 0;
    right: 0;
    flex: none;
    height: 96px;
    overflow: visible;
  }
  .side-bar-m {
    position: relative;
    display: flex;
    align-items: center;
    height: 96px;
    padding-left: 40px;
    padding-right: 100px;
    &__car-image {
      position: relative;
      width: 152px;
      height: 70px;
      flex: none;
      margin-right: 40px;
    }
    &__car-img {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      margin: auto;
      max-width: 100%;
      max-height: 100%;
    }
    &__name {
      font-size: 18px;
      line-height: 22px;
      font-weight: 500;
      color: #000;
    }
    &__total {
      font-size: 14px;
      line-height: 17px;
      color: #666666;
      font-weight: 500;
    }
    &__more, &__more:active, &__more:focus {
      display: block;
      position: absolute;
      right: 40px;
      top: 50%;
      margin-top: -18px;
      width: 36px;
      height: 36px;
      border: 1px solid #777673;
      border-radius: 50%;
      &::after, &::before {
        content: '';
        display: block;
        position: absolute;
        width: 12px;
        height: 2px;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        background-color: #777673;
        transition: 0.5s;
      }
      &::before {
        transform: rotate(90deg);
      }
    }
  }
  .side-bar-holder {
    position: absolute;
    width: 100%;
    bottom: 0;
    height: 0px;
    z-index: 3000;
  }
  .side-bar {
    position: absolute;
    min-height: 100%;
    height: auto;
    transform: translateY(-96px);
    background-color: #E4DCD3;
    transition: transform 0.5s;
    &.isOpened {
      transform: translateY(-100%);
      .side-bar-m__more {
        &::before {
          transform: rotate(0);
        }
      }
    }
    &__row-section {
      display: block;
      min-width: 192px;
      color: #666666;
    }
  }
  .side-bar__car-image {
    display: none;
  }
  .side-bar__car-name {
    display: none;
  }
  .side-bar__row-total {
    
  }
  .side-bar__body {
    margin-left: 40px;
    margin-right: 40px;
    padding-top: 27px;
    padding-bottom: 11px;
    border-top: 1px solid #B3B3B3;
  }
  .side-bar__body-row {
    margin-left: 0;
    margin-right: 0;
  }
  .side-bar__footer {
    position: relative;
  }
  .side-bar__body-row.side-bar__body-row--cont {
    justify-content: flex-start;
  }
  .side-bar__row-name {
    font-size: 14px;
  }
  .side-bar__row-price {
    margin-left: auto;
    font-size: 14px;
    &--bold {
      font-size: 20px;
    }
  }
  .side-bar__line {
    display: block;
    border-color: #B3B3B3;
    margin-top: 27px;
    margin-bottom: 10px;
  }
  .side-bar__footer-links {
    justify-content: flex-start;
    padding-bottom: 17px;
  }
  .side-bar__footer-link:first-of-type {
    margin-right: 50px;
  }
  .side-bar__credit-link {
    height: 96px;
  }
  .side-bar__credit-program {
    font-size: 14px;
  }
}

@media only screen and (max-width : $md-max) {
  .content-aside {
    height: 72px;
  }
  .side-bar {
	transform: translateY(-72px);
	max-height: calc(100vh - 200px);
	overflow-y: auto;
  }
  .side-bar__body {
    margin-left: 16px;
    margin-right: 16px;
    padding-top: 15px;
    padding-bottom: 37px;
  }
  .side-bar__body-row.side-bar__body-row--cont {
    flex-wrap: wrap;
  }
  .side-bar__body-row + .side-bar__body-row {
    margin-top: 13px;
  }
  .side-bar__row-section {
    width: 100%;
    margin-bottom: 3px;
  }
  .side-bar-m {
    padding-left: 16px;
    padding-right: 50px;
    height: 72px;
  }
  .side-bar-m__car-image {
    width: 86px;
    height: 40px;
    margin-right: 16px;
  }
  .side-bar-m__name {
    font-size: 16px;
  }
  .side-bar-m__total {
    font-size: 14px;
  }
  .side-bar-m__more, .side-bar-m__more:active, .side-bar-m__more:focus {
    width: 32px;
    height: 32px;
    right: 16px;
  }
  .side-bar__line {
    margin-top: 15px;
    margin-bottom: 0;
  }
  .side-bar__row-price--bold {
    font-size: 16px;
  }
  .side-bar__footer-links {
    padding-left: 16px;
    padding-right: 16px;
  }
  .side-bar__footer-link:first-of-type {
    margin-right: 25px;
  }
  .side-bar__credit-link {
    height: 72px;
    padding-left: 16px;
    padding-right: 16px;
  }
}
</style>
