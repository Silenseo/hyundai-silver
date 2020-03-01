<template>
  <div class="summary-tables">
    <div class="summary-table summary-modification">
      <div class="summary-table-toggler">Характеристики</div>
      <div class="summary-groups-holder">
        <div class="summary-groups">
          <div class="summary-group" v-for="(group, key) in modification" @click="setCurrentSlide(key)">
            <span class="f-items__group-name" :class="{ 'is-expanded': currentSlide === key }">
              {{ group.name }}
            </span>
            <div class="summary-sub-groups-holder" :data-collapsed="key" :class="{ 'is-expanded': currentSlide === key }">
              <table class="sm-t">
                <tr class="sm-tr sm-tr--1" v-for="item in group.values">
                  <td class="sm-td sm-td--name" v-html="item.name">
                  </td>
                  <td class="sm-td sm-td--value">
                    <template v-if="item.value === false">
                      <svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg>
                    </template>
                    <template v-else-if="item.value === true">
                      <svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg>
                    </template>
                    <template v-else>
						{{ item.value }}
                    </template>
                  </td>
                </tr>
                <tr class="sm-tr-m" v-for="item in group.values">
                  <td>
                    <table>
                      <tr>
                        <td class="sm-td-m sm-td-m--name" v-html="item.name">
                        </td>
                      </tr>
                      <tr>
                        <td class="sm-td-m sm-td-m--value">
                          <template v-if="item.value === false">
                            <svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg>
                          </template>
                          <template v-else-if="item.value === true">
                            <svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg>
                          </template>
                          <template v-else>
							  {{ item.value }}
                          </template>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="summary-table summary-complectation">
      <div class="summary-table-toggler summary-table-toggler--pt">Комплектация и опции</div>
      <div class="summary-groups-holder">

        <div class="summary-groups">
          <table class="summary-tab">
            <tr>
              <td>Экстерьер</td>
              <td>
                <div class="summary-tab__flex">
                  <div class="summary-tab__marker" :style="{ 'background-color': exteriorColors[exteriorID].colorCode }"></div>
                  <div class="summary-tab__text">
                    {{ exteriorColors[exteriorID].nameRus }} / {{ exteriorColors[exteriorID].name }} / <span class="summary-tab__price">{{ exteriorColors[exteriorID].cost | priceFormat }}</span>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>Интерьер</td>
              <td>
                <div class="summary-tab__flex">
                   <div class="summary-tab__marker" :style="{ 'background-image': 'url(' + interiorColors[interiorID].color_img, 'background-color': interiorColors[interiorID].color }"></div>
                   <div class="summary-tab__text">
                     {{ interiorColors[interiorID].name }}
                    </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>Комплектация и опции</td>
              <td>
                <div class="summary-tab__flex">
                  {{ comp }}
                  <span class="summary-tab__packet" v-if="packetsSelected">&nbsp;+&nbsp;пакет</span>
                  <ul class="summary-tab__packets">
                    <li v-for="packet in packetsSelected">
                      {{ packetsList[packet].name }}
                    </li>
                  </ul>
                  / 
                  <span class="summary-tab__price">{{ (compPrice + packPrice) | priceFormat }}</span>
                </div>
              </td>
            </tr>
          </table>

          <table class="summary-tab-m">
            <tr>
              <td>Экстерьер</td>
            </tr>
            <tr>
              <td>
                <div class="summary-tab-m__flex">
                  <div class="summary-tab-m__marker" :style="{ 'background-color': exteriorColors[exteriorID].colorCode }"></div>
                  <div class="summary-tab-m__text">
                    {{ exteriorColors[exteriorID].nameRus }} / {{ exteriorColors[exteriorID].name }} / <span class="summary-tab-m__price">{{ exteriorColors[exteriorID].cost | priceFormat }}</span>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>Интерьер</td>
            </tr>
            <tr>
              <td>
                <div class="summary-tab-m__flex">
                   <div class="summary-tab-m__marker" :style="{ 'background-image': 'url(' + interiorColors[interiorID].color_img, 'background-color': interiorColors[interiorID].color }"></div>
                   <div class="summary-tab-m__text">
                     {{ interiorColors[interiorID].name }}
                   </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>Комплектация и опции</td>
            </tr>
            <tr>
              <td>
                <div class="summary-tab-m__flex">
                  {{ comp }}
                  <span class="summary-tab-m__packet" v-if="packetsSelected">&nbsp;+&nbsp;пакет</span>
                  <ul class="summary-tab-m__packets">
                    <li v-for="packet in packetsSelected">
                      {{ packetsList[packet].name }}
                    </li>
                  </ul>
                  / 
                  <span class="summary-tab-m__price">{{ (compPrice + packPrice) | priceFormat }}</span>
                </div>
              </td>
            </tr>
          </table>

          <div class="summary-group" v-for="(group, key) in complectation" @click="setCurrentSlide(key+100)">
            <span class="f-items__group-name" :class="{ 'is-expanded': currentSlide === key+100 }">
              {{ group.name }}
            </span>
            <div class="summary-sub-groups-holder" :data-collapsed="key+100" :class="{ 'is-expanded': currentSlide === key+100 }">
              <table class="sm-t">
                <tr class="sm-tr" v-for="item in group.values">
                  <td class="sm-td sm-td--value" v-html="item.name">
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import toggleSlide from '../../assets/lib/slideToggle.js'

export default {
  name: 'SummaryTables',
  props: [ 'summaryData' ],
  data () {
    return {
      currentSlide: 999,
      collapseStates: {
        modifications: false,
        complectations: false,
        submodifications: false
      }
    }
  },
  computed: {
    ...mapGetters({
      packetsSelected: 'GET_CURRENT_PACKETS',
      packetsList: 'GET_PACKETS_LIST',
      exteriorID: 'GET_EXTERIOR_COLOR',
      interiorID: 'GET_INTERIOR_COLOR',
      exteriorColors: 'GET_EXTERIOR_COLORS',
      interiorColors: 'GET_INTERIOR_COLORS',
      comp: 'GET_COMPLECTATION_NAME',
      compPrice: 'GET_COMPLECTATION_PRICE',
      packPrice: 'GET_CURRENT_PACKETS_PRICE'
    }),
    modification () {
      return this.summaryData.modification
    },
    complectation () {
      return this.summaryData.complectation
    }
  },
  methods: {
    setCurrentSlide (key) {
      let target = document.querySelector('[data-collapsed="' + key + '"]')

      if (this.currentSlide !== key) {
        this.currentSlide = key
        $(target).slideToggle();
      } else {
        this.currentSlide = 999
        $(target).slideToggle();
      }
    },
    toggleGroup (targetString) {
      let target = document.querySelector('[data-collapse-target="' + targetString + '"]')
      if (target) {
        this.collapseStates[targetString] = !this.collapseStates[targetString]
        toggleSlide(target)
      }
    }
  }
}
</script>

<style lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.summary-tables {
  padding-bottom: 35px;
}
.summary-tab-m {
  display: none;
}
.summary-tab {
  width: 100%;
  color: #000;
  text-align: left;
  vertical-align: middle;
  border-collapse: collapse;
  table-layout: fixed;
  margin-bottom: 40px;
  &__price {
    font-weight: 500;
    margin-left: 5px;
    white-space: nowrap;
  }
  &__flex {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    padding-top: 5px;
    padding-bottom: 5px;
  }
  &__text {
    max-width: calc(100% - 40px);
  }
  &__packet {

  }
  &__packets {
    display: flex;
    align-items: center;
    margin-left: 5px;
    margin: 5px;
    li {
      position: relative;
      &:not(:last-of-type) {
        margin-right: 15px;
        &::after {
          position: absolute;
          content: '+';
          display: block;
          right: -12px;
          top: 0;
        }
      }
    }
  }
  &__marker {
    width: 24px;
    height: 24px;
    background-repeat: no-repeat;
    background-position: 50%;
    background-size: cover;
    margin-right: 16px;
    flex: none;
  }
  tr {
    td {
      font-size: 1.6rem;
      line-height: 1.5;
      height: 48px;
      padding: 0 32px;
      &:first-of-type {
        font-weight: 500;
        background-color: #E4DCD3;
        border: 1px solid #ffffff;
      }
      &:not(:first-of-type) {
        border: 1px solid #E4DCD3;
      }
    }
  }
}
.summary-group {
  border: 1px solid #E4DCD3;
  &:not(:first-of-type) {
    border-top: none;
  }
}
.f-items__group-name {
  display: block;
  position: relative;
  font-size: 1.6rem;
  font-weight: 500;
  line-height: 1;
  padding: 19px 32px;
  position: relative;
  cursor: pointer;
  transition: 0.3s;
  &::after {
    content: '';
    display: block;
    position: absolute;
    top: 50%;
    transform: translateY(-50%) rotate(45deg);
    right: 32px;
    width: 7px;
    height: 7px;
    border-bottom: 2px solid #000;
    border-right: 2px solid #000;
    transition: 0.5s;
  }
  &:hover {
    //background-color: #F8F8F8;
  }
  &.is-expanded {
    &::after {
      transform: translateY(-50%) rotate(-135deg);
    }
  }
}
.summary-table {
  padding-left: 72px;
  padding-right: 72px;
}
.summary-table-toggler {
  font-size: 2.0rem;
  font-weight: 500;
  color: #000;
  cursor: pointer;
  user-select: none;
  line-height: 1;
  padding: 30px 0 16px;
  .ic-svg {
    margin-left: 2px;
    width: 10px;
    height: 6px;
    fill: $sky;
    transition: fill $tr-fast, transform $tr-fast;
    transform: scale(1, 1);
  }
  &.is-expanded {
    .ic-svg {
      transform: scale(1, -1);
    }
  }
}
.sm-t {
  table-layout: fixed;
  text-align: left;
  font-size: 12px;
  margin: 0 64px;
  margin-bottom: 40px;
  width: calc(100% - 128px);
}
.sm-tr-m {
  display: none;
}
.sm-tr {
  height: 62px;
  line-height: 1.2;
  &:nth-of-type(odd) {

  }
}
.sm-td {
  &.sm-td--name {
	width: 50%;
    font-size: 1.4rem;
    line-height: 1.5;
    color: #666666;
    font-weight: 500;
    padding-right: 15px;
  }
  &.sm-td--value {
    font-size: 1.4rem;
    line-height: 1.5;
    color: #000000;
  }
}
.summary-sub-groups-holder {
	display: none;
  &:not(.is-expanded) {
    //max-height: 0;
  }
  overflow: hidden;
  transition: max-height .35s cubic-bezier(.5,0,.24,1) 0s;
}
.summary-colors-group {
  padding: 20px 0 35px;
}
.summary-color {
  font-size: 0;
  line-height: 0;
  white-space: nowrap;
  flex-shrink: 1;
  &.summary-color--ext {
    flex-grow: 9;
  }
  &.summary-color--int {
    flex-grow: 10;
  }
}
.summary-color__visual {
  display: inline-block;
  vertical-align: middle;
}
.summary-color__pick {
  height: 50px;
  width: 50px;
  display: block;
  border-radius: 50%;
  pointer-events: none;
  user-select: none;
  margin-right: 26px;
}
.summary-color__text {
  display: inline-block;
  vertical-align: middle;
  font-size: 16px;
  line-height: 1;
  white-space: nowrap;
}
.summary-color__title {
  display: block;
  font-size: 18px;
  margin-bottom: 4px;
  font-weight: 500;
}

@media only screen and (max-width : $lg-max) {
  .summary-table {
    padding-left: 40px;
    padding-right: 40px;
  }
  
  .f-items__group-name {
    padding-top: 16px;
    padding-bottom: 16px;
  }
  .sm-t {
    margin: 0 32px;
    margin-top: 8px;
    width: calc(100% - 64px);
  }
}

@media only screen and (max-width : $md-max) {
  .summary-table {
    padding-left: 16px;
    padding-right: 16px;
  }
  .summary-table-toggler {
    padding-top: 12px;
    &--pt {
      padding-top: 24px;
    }
  }
  .f-items__group-name {
    padding-left: 16px;
    &::after {
      right: 25px;
    }
  }
  .sm-t {
    margin: 0 32px;
    margin-top: 8px;
    width: auto;
  }
  .sm-tr--1 {
    display: none;
  }
  .sm-tr-m {
    display: table-row;
  }
  .sm-td-m--name {
    font-size: 12px;
    line-height: 21px;
    color: #B7B7B7;
    font-weight: 500;
    padding-bottom: 18px;
  }
  .sm-td-m--value {
    font-size: 14px;
    line-height: 21px;
    color: #000000;
    padding-bottom: 16px;
  }
  .summary-tab {
    margin-bottom: 24px;
  }

  .summary-disclaimers .df-info__text {
    font-size: 12px;
  }
  .summary-disclaimers {
    padding: 0 16px;
  }
  .summary-tab {
    display: none;
  }
  .summary-tab-m {
    display: table;
    width: 100%;
    border: 1px solid #E4DCD3;
    margin-bottom: 24px;
  }
  .summary-tab-m tr:nth-of-type(odd) {
    td {
      background-color: #E4DCD3;
      font-size: 16px;
      font-weight: 500;
      color: #000;
      padding: 12px 16px;
    }
  }
  .summary-tab-m tr:nth-of-type(even) {
    td {
      font-size: 14px;
      color: #000;
      padding: 13px 16px;
    }
  }
  .summary-tab-m__flex {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
  }
  .summary-tab-m__marker {
    width: 24px;
    height: 24px;
    margin-right: 12px;
  }
  .summary-tab-m__text {
    width: calc(100% - 36px);
  }
  .summary-tab-m__packets {
    display: flex;
    align-items: center;
    margin: 5px;
    li {
      position: relative;
      &:not(:last-of-type) {
        margin-right: 15px;
        &::after {
          position: absolute;
          content: '+';
          display: block;
          right: -12px;
          top: 0;
        }
      }
    }
  }
  .summary-tab-m__price {
    margin-left: 5px;
    white-space: nowrap;
  }
}
</style>
