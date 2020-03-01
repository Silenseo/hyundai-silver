<template>
  <div class="summary-conf-controls">
    <div class="summary-buttons">
      <div class="summary-buttons__left summary-buttons__left--top">
<!--
        <a href="#" @click.prevent="creditCalc" class="df-button summary-buttons__button test-calc-button">Рассчитать кредит</a>
        <a href="#" @click.prevent="sendTestDrive" class="df-button df-button--border summary-buttons__button test-td-button"  v-if="!isDealer && ID != 16">Тест-драйв</a>
        <a href="/test-drive" target="_blank" class="df-button df-button--border summary-buttons__button test-td-button" v-if="isDealer && ID != 16">Тест-драйв</a>
-->
        <!-- <a href="#" @click.prevent="sendDealer" class="button button--ripple button-summary button--deep"  v-if="!isDealer">Отправить дилеру</a> -->
      </div>
      <div class="summary-buttons__right">
        <!-- <a href="#" @click.prevent="favourites" class="button-summary button--iconized"><span class="ic-svg-holder"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-add_list"></use></svg></span>Сравнить</a>
        <a href="#" @click.prevent="sendTestDrive" target="_blank" class="button-summary button--iconized" v-if="!isDealer && ID != 16"><span class="ic-svg-holder"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-testdrive"></use></svg></span>Тест-драйв</a>
        <a href="/test-drive" target="_blank" class="button-summary button--iconized" v-if="isDealer && ID != 16"><span class="ic-svg-holder"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-testdrive"></use></svg></span>Тест-драйв</a> -->
      </div>
    </div>
    <div class="summary-buttons">
      <div class="summary-buttons__left summary-buttons__left--bottom">
        <a @click.prevent="favourites" href="#" class="df-download-link summary-buttons__compare test-compare-button">
            <svg aria-visible="false">
                <use xlink:href="#ic-compare-i"></use>
            </svg>
            К сравнению
        </a>
        <div class="summary-buttons__line"></div>
        <a @click.prevent="sendEmail" href="#" class="df-download-link summary-buttons__send test-send-button">
            <svg aria-visible="false">
                <use xlink:href="#mail-icon"></use>
            </svg>
            Отправить
        </a>
        <div class="summary-buttons__line"></div>
        <a :href="priceList" target="_blank"  class="df-download-link summary-buttons__download">
            <svg aria-visible="false">
                <use xlink:href="#download-link"></use>
            </svg>
            Прайс-лист
        </a>
      </div>
    </div>
	<div class="summary-buttons summary-buttons--mb">
      <div class="summary-buttons__left summary-buttons__left--top">
        <a href="#" @click.prevent="creditCalc" class="df-button df-button--border summary-buttons__button test-calc-button">Рассчитать кредит</a>
        <a href="#" @click.prevent="sendTestDrive" class="df-button df-button--border summary-buttons__button test-td-button"  v-if="!isDealer && ID != 16">Тест-драйв</a>
        <a href="/test-drive" target="_blank" class="df-button df-button--border summary-buttons__button test-td-button" v-if="isDealer && ID != 16">Тест-драйв</a>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'SummaryConfControls',
  computed: {
    ...mapGetters({
	  car: 'GET_CAR',
      ID: 'GET_CURRENT_ID',
      priceList: 'GET_CAR_PRICELIST',
      isDealer: 'GET_IS_DEALER'
    })
  },
  methods: {
    favourites () {
      this.$store.dispatch('ADD_FAVOURITE')
      this.$router.push({name: 'Favourites'})
    },
    creditCalc () {
      this.$store.dispatch('OPEN_CALC')
    },
    sendEmail () {
      this.$emit('showSendEmail')
    },
    sendDealer () {
      this.$emit('showSendDealer')
    },
    sendTestDrive () {
	  //Установим активной модель. Св-во code!!!!!!
	  vueStore.dispatch('SET_SAVED_MODEL', this.car.codeName);
	  vueStore.dispatch('SET_MODEL', this.car.codeName);
      vueStore.dispatch('OPEN_TEST_DRIVE_POPUP', true);
    },
    compare () {
      this.$store.dispatch('OPEN_COMPARING')
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';


.summary-conf-controls {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 39px 72px 42px;
}
.summary-buttons {
  font-size: 0;
  display: flex;
  flex-flow: row nowrap;
  justify-content: space-between;
  align-items: center;
  &__compare {
    svg {
      width: 20px;
      height: 15px;
    }
  }
  &__send {
    svg {
      width: 18px;
      height: 13px;
      stroke: #002C5F;
      fill: transparent;
    }
  }
}
.df-button {
  display: block;
  width: 224px;
  text-align: center;
  padding-left: 0px;
  padding-right: 0px;
  &--border {
    background-color: transparent;
    border: 2px solid #002C5F;
    color: #002C5F;
    font-weight: 500;
    padding-top: 14px;
    padding-bottom: 14px;
    &:hover {
	  background-color: #002C5F;
	  color: #fff;
	}
  }
}
.test-td-button {
    margin-left: 16px;
  }
.summary-buttons__left {
  display: flex;
  align-items: flex-start;
  margin-right: auto;
  .df-download-link {
    padding-left: 26px;
    &:not(:last-of-type) {
      margin-right: 25px;
    }

  }
}
.summary-buttons__right {
  margin-left: auto;
}
.button-summary {
  font-weight: 500;
  font-size: 16px;
  line-height: 61px;
  padding: 0;
  width: 236px;
  border: 2px solid #00aed5;
  & + & {
    margin-left: 8px;
  }
  &.button--deep {
    border-color: #003b70;
    background: #003b70;
    &:hover {
      border-color: #15488b;
      background: #15488b;
    }
  }
  &.button--light {
    border-color: #00aed5;
    background: transparent;
    color: #00aed5;
    &:hover {
      color: #fff;
      background: #00aed5;
      border-color: #00aed5;
    }
  }
  &.button--small-iconized {
    @include button-reset;
    font-size: 12px;
    color: #b4b4b4;
    letter-spacing: .05em;
    text-transform: uppercase;
    font-weight: 400;
    line-height: 45px;
    transition: color $tr-fast;
    padding-right: 25px;
    .ic-svg {
      fill: currentColor;
      margin-right: 10px;
      vertical-align: middle;
      width: 26.6px;
      height: 25px;
    }
    &:hover {
      color: #053b75;
    }
  }
  &.button--iconized {
    @include button-reset;
    font-size: 16px;
    line-height: 65px;
    width: 190px;
    font-weight: 500;
    .ic-svg-holder {
      width: 60px;
      height: 60px;
      vertical-align: middle;
      display: inline-block;
      margin-right: 15px;
      position: relative;
      &::before {
        content: '';
        border-radius: 50%;
        transition: width $tr-fast, height $tr-fast;
        width: 60px;
        height: 60px;
        background: #00aed5;
        transform: translate(-50%, -50%);
        left: 50%;
        top: 50%;
        position: absolute;
        z-index: 0;
      }
    }
    .ic-svg {
      fill: #fff;
      width: 30px;
      height: 30px;
      z-index: 1;
      @include abs-center;
    }
    &:hover {
      .ic-svg-holder::before {
        width: 70px;
        height: 70px;
      }
    }
  }
}
.summary-buttons__line {
  display: none;
}


@media only screen and (max-width : $lg-max) {
  .summary-conf-controls {
    flex-direction: column-reverse;
    align-items: flex-start;
    padding: 32px 40px 46px;
  }
  .summary-buttons--mb {
    margin-bottom: 27px;
  }
  .df-button {
    width: 200px;
  }
  .test-td-button {
    margin-left: 8px;
  }

}

@media only screen and (max-width : $md-max) {
  .summary-conf-controls {
    padding-left: 16px;
    padding-right: 16px;
    padding-top: 0;
  }
  .summary-buttons__left {
    margin-right: 0;
    width: 100%;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: initial;
    &--top {
      display: block;
    }
    &--bottom {
      flex-wrap: nowrap;
    }
  }
  .summary-buttons__button {
    margin: 0;
    width: 100%;
    &:first-of-type {
      margin-bottom: 8px;
    }
  }
  .summary-buttons__compare, .summary-buttons__send, .summary-buttons__download {
    width: 33.33%;
    padding-left: 0!important;
    padding-top: 20px;
    margin-right: 0!important;
    text-align: center;
    svg {
      left: 50%;
      top: 0;
      transform: translateY(0) translateX(-50%);
    }

  }
  .summary-buttons__line {
    display: block;
    width: 1px;
    background-color: #E4DCD3;
  }
  .summary-buttons {
    width: 100%;
  }
  .test-calc-button, .test-td-button {
    padding-top: 12px;
    padding-bottom: 12px;
  }
}
</style>
