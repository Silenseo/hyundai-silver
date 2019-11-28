<template>
  <div class="filter">
    <a href="#" @click.prevent="isFiltersOpened = !isFiltersOpened" :class="{ isOpened: isFiltersOpened }" class="filter-h">
      <svg class="filter-h__icon" aria-hidden="true">
        <use xlink:href="#ic-filters"></use>
      </svg>
      <div class="filter-h__text">Фильтры</div>
    </a>
    <div class="filter-main container">
      <div class="filter-row row">
        <div class="col-md-12">
          <div class="filter__wrap filter__wrap--pt">
            <div class="filter-item filter-item--w100">
            <div class="filter-header filter-header--fake"><span class="filter-title" style="visibility: hidden;">0</span></div>
              <div class="radio-panel" v-if="carcases">
                <label class="df-radiobutton radio-panel__label">
                  <input class="df-radiobutton__input" value="" v-model="purpose" name="purpose" type="radio" checked>
                  <div class="df-radiobutton__box radio-panel__box"></div>
                  <div class="df-radiobutton__description radio-panel__description">Все модели</div>
                </label>
                <label class="df-radiobutton radio-panel__label" v-for="(carcase, key) in carcases" :key="key">
                  <input class="df-radiobutton__input" :key="key" :value="key" v-model="purpose" name="purpose" type="radio" checked>
                  <div class="df-radiobutton__box radio-panel__box"></div>
                  <div class="df-radiobutton__description radio-panel__description">{{ carcase }}</div>
                </label>
              </div>
            </div>
            <div class="filter-item price-range">
              <div class="filter-header"><span class="filter-title">Цена, ₽</span></div>
              <div class="ranger-input-panel">
                <label class="ranger-input-label">от<input ref="price-ranger-min" type="text" class="ranger-input" name="minCost" :value="minCost" @input="update_value" @blur="update_mincost" @focus="update_mincost" @keypress.enter="update_mincost" @change="update_mincost"></label>
                <label class="ranger-input-label">до<input ref="price-ranger-max" type="text" class="ranger-input" name="maxCost" :value="maxCost" @input="update_value" @blur="update_maxcost" @focus="update_maxcost" @keypress.enter="update_maxcost" @change="update_maxcost"></label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vueSlider from 'vue-slider-component'
import { mapGetters } from 'vuex'
export default {
  name: 'Carfilter',
  data () {
    return {
      minCost: '',
      maxCost: '',
      sliderStyles: {
        height: 4,
        tooltip: 'never',
        dotSize: 20,
        speed: 0.15,
        bgStyle: {
          'backgroundColor': '#eaeaea',
          'borderRadius': '0'
        },
        processStyle: {
          'backgroundColor': '#00AAD2'
        },
        class: 'filter-slider'
      },
      isFiltersOpened: false
    }
  },
  components: {
    vueSlider
  },
  computed: {
    ...mapGetters({
      carcases: 'GET_CARCASES',
      carList: 'GET_CARS',
      _minCostLimit: 'GET_MIN_COST_LIMIT',
      _maxCostLimit: 'GET_MAX_COST_LIMIT',
      prepayMin: 'GET_FILTER_PREPAY_MIN',
      prepayMax: 'GET_FILTER_PREPAY_MAX',
      monthlyMin: 'GET_FILTER_MONTHLY_MIN',
      monthlyMax: 'GET_FILTER_MONTHLY_MAX'
    }),
    purpose: {
      get () {
        return this.$store.getters.GET_FILTER_PURPOSE
      },
      set (value) {
        this.$store.dispatch('UPDATE_FILTER_PURPOSE', value)
      }
    },
    prepayRange: {
      get () {
        return this.$store.getters.GET_FILTER_PREPAY_RANGE
      },
      set (value) {
        this.$store.commit('UPDATE_FILTER_PREPAY_RANGE', value)
      }
    },
    monthlyRange: {
      get () {
        return this.$store.getters.GET_FILTER_MONTHLY_RANGE
      },
      set (value) {
        this.$store.commit('UPDATE_FILTER_MONTHLY_RANGE', value)
      }
    },
    isPopoversVisible: {
      get () {
        return this.$store.state.isPopoversVisible
      },
      set (value) {
        this.$store.commit('SET_POPOVERS_STATE', value)
      }
    }
  },
  methods: {
    update_mincost (event) {
      let value = event.target.value ? parseInt(event.target.value.toString().replace(/\D/g, '')) : 0
      let maxValue = typeof this.maxCost === 'number' ? this.maxCost : parseInt(this.maxCost.toString().replace(/\s/g, ''))

      if (!value || value < this._minCostLimit) {
        value = this._minCostLimit
      } else if (value > maxValue) {
        value = maxValue
      }

      this.minCost = value.toString().replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' ')
      this.$store.dispatch('UPDATE_MINCOST', value)
    },
    update_maxcost (event) {
      let value = event.target.value ? parseInt(event.target.value.toString().replace(/\D/g, '')) : 0
      let minValue = typeof this.minCost === 'number' ? this.minCost : parseInt(this.minCost.toString().replace(/\s/g, ''))

      if (!value || value > this._maxCostLimit) {
        value = this._maxCostLimit
      } else if (value < minValue) {
        value = minValue
      }

      this.maxCost = value.toString().replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' ')
      this.$store.dispatch('UPDATE_MAXCOST', value)
    },
    update_value (event) {
      // force update input fields
      if (event && event.target.value) {
        this[event.target.name] = event.target.value
      }
    },
    refreshFields () {
      // method to reset all values to initials, get them from the Store
      this.minCost = this._minCostLimit.toString().replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' ')
      this.maxCost = this._maxCostLimit.toString().replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' ')
      setTimeout(() => {
        // sliders issue fix
        // this.$refs.sliderMonth.refresh()
        // this.$refs.sliderPrepay.refresh()
      }, 99)
    }
  },
  watch: {
    'carList': function (newValue, oldValue) {
      if (newValue !== null) {
        this.refreshFields()
      }
    }
  },
  mounted () {
    this.refreshFields()
  },
  activated () {
    this.refreshFields()
  },
  beforeDestroy () {
    this.isPopoversVisible = false
  }
}

</script>


<style lang="scss">
  @import '../../assets/_mixins.scss';
  @import '../../../../sass/common/variables';

  .filter {}
  .filter-main {
    padding-top: 25px;
    padding-bottom: 43px;
  }
  .filter-additional {
    padding-top: 40px;
    border-top: 1px solid #eaeaea;
  }
  .filter-additional-leave-active {
    transition: max-height .5s ease-in-out 0s, border-color .5s ease-in-out 0s, padding-top .25s ease-in-out .25s;
    overflow: hidden;
  }
  .filter-additional-enter-active {
    transition: max-height .5s ease-in-out 0s, border-color .5s ease-in-out 0s, padding-top .25s ease-in-out 0s;
    overflow: hidden;
  }
  .filter-additional-enter, .filter-additional-leave-to {
    max-height: 0;
    padding-top: 0;
    border-color: transparent;
  }
  .filter-additional-leave, .filter-additional-enter-to {
    max-height: 400px;
    padding-top: 40px;
    border-color: #eaeaea;
  }
  .toggle-additional-filter {
    line-height: 1;
    margin-left: auto;
    margin-right: -10px;
    padding: 10px;
    color: $sky;
    font-weight: 600;
    font-size: 13px;
    transition: opacity .25s ease-out .5s, color $tr-fast;
    &:hover {
      color: #1bc6ec;
    }
    .ic-svg {
      fill: currentColor;
      display: inline-block;
      height: 6px;
      width: 10px;
      margin-left: 5px;
      transform-origin: 50% 42%;
    }
    &.is-hidden {
      transition: opacity .25s ease-out 0s;
      opacity: 0;
      pointer-events: none;
    }
    &#{&}--hide-up {
      .ic-svg {
        transform: rotate(180deg);
      }
    }
  }
  .filter-row {

  }
  .filter__wrap {
    display: flex;
    padding: 0 45px;
    &--sb {
      justify-content: space-between;
    }
  }
  .filter-item {
    &--w100 {
      width: 100%;
    }
    &--mr {
      margin-right: 100px;
    }
  }
  .month-payment, .prepay {
    width: 27%;
  }
  .price-range {
    width: auto;
  }
  .filter-header {
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;
    align-items: center;
    line-height: 1;
    margin-bottom: 19px;
    cursor: default;
  }
  .filter-title {
    margin-right: auto;
    font-weight: 500;
    font-size: 1.4rem;
  }
  .filter-title-helper {
    margin-left: auto;
    color: #000000;
    font-size: 1.4rem;
  }
  .radio-panel {
    display: flex;
    align-items: center;
    height: 40px;
    font-size: 0;
    label {
      margin-bottom: 0;
    }
  }
  .df-radiobutton {

    &:not(:last-of-type) {
      margin-right: 50px;
    }
  }
  .radio-component {
    display: inline-block;
    &:not(:first-of-type) {
      margin-left: 12px;
    }
    & > input.filter-radio {
      & + label {
        transition: background $tr-fast, border-color $tr-fast, color $tr-fast;
        display: block;
        border-radius: 26px;
        background: #fff;
        border: 1px solid #eaeaea;
        font-size: 12px;
        line-height: 1;
        white-space: nowrap;
        text-align: center;
        padding: 18px 25px 16px;
        text-transform: uppercase;
        font-weight: 400;
        letter-spacing: .05em;
        cursor: pointer;
        .input-box {
          display: none;
        }
      }
      &:checked {
        & + label {
          cursor: default;
          background: $hollow;
          border-color: $hollow;
          font-weight: 600;
          color: #fff;
        }
      }
      &:not(:checked):hover {
        & + label {
          color: #053b75;
        }
      }
    }
  }
  .ranger-input-panel {
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
  }
  .ranger-input-label {
    cursor: text;
    color: #b4b4b4;
    flex: 1 1 auto;
    border: 1px solid #eaeaea;
    padding: 3px 20px 3px 25px;
    max-height: 48px;
    line-height: 2;
    white-space: nowrap;
    margin-bottom: 0;
    & + & {
      border-left: none;
    }
  }
  .ranger-input {
    line-height: 1;
    transition: color $tr-fast;
    color: #231f20;
    font-size: 1.4rem;
    text-align: right;
    display: inline-block;
    max-width: 100px;
    margin-left: 10px;
    border: none;
    -webkit-appearance: none;
    outline: none;
  }
  .filter-slider-panel {
    position: relative;
    top: 9px;
  }
  .filter-slider {
    position: relative;
    span.vue-slider-tooltip-wrap.vue-slider-tooltip-top {
      transform: none;
      color: #fff;
      top: 9px;
      left: 0;
      right: 0;
      user-select: none;
      pointer-events: none;
      text-align: center;
    }
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
  }
  .filter-popover {
    color: #fff;
    font-weight: 600;
    line-height: 1;
    font-size: 15px;
    width: 141px;
    height: 52px;
    padding: 12px 19px 10px;
    position: absolute;
    top: -68px;
    right: 0;
    background: #00aed5;
    pointer-events: none;
    user-select: none;
    &.filter-popover--credit {
      animation: filterPopoverInOut 7s both 1s;
    }
    &.filter-popover--prepay {
      animation: filterPopoverInOut 7.075s both 1.075s;
    }
    &::after {
      content: '';
      border-color: #00aed5 transparent transparent transparent;
      border-style: solid;
      position: absolute;
      border-width: 17px;
      transform: scale(1, 0.5);
      position: absolute;
      bottom: -23px;
      left: 16px;
    }
  }
  .filter-popover__credit-name {
    letter-spacing: .05em;
    display: block;
    font-size: 12px;
    font-weight: 400;
    margin-top: -2px;
    margin-bottom: 2px;
    text-transform: uppercase;
  }
  .filter-popover__credit-monthly {
    font-weight: 600;
    letter-spacing: -.05em;
    line-height: 1;
    > span {
      font-size: 20px;
    }
  }
  @keyframes filterPopoverInOut {
    0% {
      transform: translate(0, 10px);
      opacity: 0;
    }
    3% {
      opacity: 0;
      transform: translate(0, 10px);
    }
    5% {
      opacity: 1;
      transform: translate(0,-2px);
    }
    6% {
      transform: translate(0,0);
    }
    90% {
      opacity: 1;
    }
    92% {
      transform: translate(0,0);
    }
    100% {
      opacity: 0;
      transform: translate(0,-10px);
    }
  }
  .filter-h {
    display: none;
  }

  @media only screen and (max-width : $lg-max) {
    .filter-main {
      padding-top: 21px;
      padding-bottom: 41px;
    }
    .radio-panel {
      margin-bottom: 13px;
    }
    .radio-panel__label:not(:last-of-type) {
      //margin-right: 0;
    }
    .radio-panel__description {
      white-space: nowrap;
    }
    .filter__wrap {
      flex-wrap: wrap;
    }
    .filter-header {
      margin-bottom: 3px;
      &--fake {
        display: none;
      }
    }
    .month-payment, .prepay {
      width: calc(50% - 40px);
    }
    .month-payment {
      margin-right: 40px;
    }
    .prepay {
      margin-left: 40px;
      margin-right: 0;
    }
    .ranger-input {
      max-width: 70px;
    }
    .ranger-input-panel {
      margin-top: 8px;
    }
  }

@media only screen and (max-width : $md-max) {
  .filter-h {
    position: relative;
    display: flex;
    align-items: center;
    height: 56px;
    padding: 0 16px;
    &::after {
      content: '';
      display: block;
      position: absolute;
      top: 50%;
      transform: translateY(-50%) rotate(180deg);
      right: 16px;
      width: 0;
      height: 0;
      border-left: 5px solid transparent;
      border-right: 5px solid transparent;
      border-bottom: 7px solid #002C5F;
      transition: 0.5s;
    }
    &__icon {
      display: block;
      flex: none;
      width: 28px;
      height: 22px;
      margin-right: 16px;
    }
    &__text {
      font-size: 16px;
      font-weight: 500;
      color: #002C5F;
    }
    &.isOpened {
      &::after {
        transform: translateY(-50%) rotate(0deg);
      }
    }
  }
  .filter__wrap {
    padding: 0 16px;
    &--pt {
      padding-top: 20px;
      padding-bottom: 20px;
      border-top: 1px solid $gray_bg;
    }
    &--pb {
      padding-bottom: 20px;
    }
  }
  .radio-panel {
    flex-wrap: wrap;
    justify-content: flex-start;
    height: auto;
  }
  .radio-panel__label {
    margin-bottom: 10px!important;
    &:not(:last-of-type) {
      margin-right: 20px;
    }
  }
  .radio-panel__description {
    font-size: 12px;
  }
  .month-payment, .prepay {
    width: 100%;
    margin: 0;
  }
  .month-payment {
    margin-bottom: 20px;
  }
  .filter-header {
    margin-bottom: 0;
  }
  .filter-title, .filter-title-helper {
    font-size: 1.2rem;
  }
  .ranger-input {
    font-size: 1.2rem;
  }
  .filter-main {
    max-height: 0;
    transition: max-height 0.5s;
    overflow: hidden;
    padding: 0;
  }
  .isOpened {
    & + .filter-main {
      max-height: 500px;
    }
  }
}
</style>
