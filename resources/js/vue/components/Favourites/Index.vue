<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="favourites" :class="favouritesClasses">
            <div class="favourites-header">
              <div class="favourites-header-holder">
                <div class="favourites-title">Сравнение</div>
                <router-link :to="{ name: 'Carlist' }">
                  <div class="df-download-link summary-buttons__compare favourites-add">
                    <svg aria-visible="false">
                        <use xlink:href="#ic-compare-i"></use>
                    </svg>
                    Добавить еще
                  </div>
                </router-link>
              </div>
            </div>
            <div class="favourites-body">
              <transition name="fade">
                <div class="favourites-inner-holder" v-if="savedFavourites && favouritesData">
                  <div class="favourites-content">
                    <div class="f-list-header d-sm-none d-lg-block">
                      <checkbox v-model="isDifferentOnly">
                        <div class="f-list-check" slot="input-box">
                          <svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
                          </svg>
                        </div>
                        <span>Только различия</span>
                      </checkbox>
                    </div>
                    <div class="f-list">
                      <div class="f-list__body">
                        <div class="f-list-holder">
                          <transition name="fade">
                            <slide-controls v-if="true" :is-last="isLastSlideActive" :is-first="isFirstSlideActive" @slideNext="slideNext" @slidePrev="slidePrev"></slide-controls>
                          </transition>
                          <div class="f-list__center">
                            <main-list :current-slide="index" :items="favouritesData.carData" :is-different-only="isDifferentOnly" @removeFavourite="removeFavourite" :slideOffset="slideOffset" @next-slide="slideNext" @prev-slide="slidePrev"></main-list>
                            <div class="m-diff d-sm-block d-lg-none">
                              <checkbox v-model="isDifferentOnly">
                                <div class="f-list-check" slot="input-box">
                                  <svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
                                  </svg>
                                </div>
                                <span>Только различия</span>
                              </checkbox>
                            </div>
                            <modifications-list :items="favouritesData.modifications" :is-different-only="isDifferentOnly" :isExpanded="isModificationsExpanded" @toggleExpanded="newValue => { isModificationsExpanded = newValue }" :slideOffset="slideOffset" @calcHeight="calcHeight" @setCurrentSlide="setCurrentSlide"></modifications-list>
                            <complectations-list :items="favouritesData.complectations" :is-different-only="isDifferentOnly" :isExpanded="isComplectationsExpanded" @toggleExpanded="newValue => { isComplectationsExpanded = newValue }" :slideOffset="slideOffset" @calcHeight="calcHeight1" @setCurrentSlide="setCurrentSlide1"></complectations-list>
                          </div>
                          <div class="f-disclaimers" v-if="disclaimers">
                            <!-- <p class="f-disclaimer" v-for="(disclaimer, key) of disclaimers">
                              <strong>{{ key }}</strong> – {{ disclaimer }}
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
                      </div>
                    </div>
                    <transition name="fade-left">
                      <promo v-if="isPromoActive" :current-slide="currentSlide" :rows="rows" :current-slide1="currentSlide1" :rows1="rows1" :items="favouritesData.promo" :is-different-only="isDifferentOnly" :isModificationsExpanded="isModificationsExpanded" :isComplectationsExpanded="isComplectationsExpanded" @updateSliding="updateSliding"></promo>
                    </transition>
                  </div>
                  <sticky-header :isSliderActive="isSliderActive" :isLastSlideActive="isLastSlideActive" :isFirstSlideActive="isFirstSlideActive" :favouritesData="favouritesData" :slideOffset="slideOffset" :isPromoActive="isPromoActive" :hasExpanded="true" @removeFavourite="removeFavourite" @updateSliding="updateSliding" @slideNext="slideNext" @slidePrev="slidePrev"></sticky-header>
                </div>
                <loader v-else></loader>
              </transition>
            </div>
          </div>
        </div>
      </div>
    </div>
    <transition name="slide-bottom">
      <mobile-bottom-line v-if="isPromoActive" :items="favouritesData.promo" @update-data="refreshData"></mobile-bottom-line>
    </transition>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios'
import Loader from '@/components/Loader'
import MainList from './MainList'
import ModificationsList from './ModificationsList'
import ComplectationsList from './ComplectationsList'
import SlideControls from './SlideControls'
import Promo from './Promo'
import MobileBottomLine from './MobileBottomLine'
import StickyHeader from './StickyHeader'
import cloneDeep from 'lodash/cloneDeep'
import { setTimeout } from 'core-js';

export default {
  name: 'Favourites',
  components: { Loader, MainList, ModificationsList, ComplectationsList, SlideControls, Promo, StickyHeader, MobileBottomLine },
  data () {
    return {
      savedFavourites: [],
      index: 1,
      itemWidth: 250,
      isDifferentOnly: true,
      favouritesData: null,
      isModificationsExpanded: false,
      isComplectationsExpanded: false,
      firstDisclaimer: 'Расчет кредита является предварительным. Обязательное условие — оформление страхования КАСКО в страховой компании, соответствующей требованиям банков партнеров. Более подробную информацию обо всех условиях кредитования Вы можете получить, обратившись к банкам-партнерам программы и официальным дилерам Hyundai. Банки оставляют за собой право вносить изменения в программы кредитования без предварительного уведомления. Данное предложение носит информационный характер и не является публичной офертой (ст.437 ГК РФ).',
      rows: [],
      currentSlide: 999,
      rows1: [],
      currentSlide1: 999,
      visibleCount: 0
    }
  },
  computed: {
    ...mapGetters({
      apiUrl: 'GET_API_COMPARE',
      cookieName: 'GET_COOKIE_NAME'
    }),
    isPromoActive () {
      return this.$store.state.isPromoVisible !== false && this.favouritesData !== null && this.favouritesData.promo !== null
    },
    totalCount () {
      return this.savedFavourites.length
    },
    isFirstSlideActive () {
      return this.index <= 1
    },
    isLastSlideActive () {
      return this.index >= this.totalCount - this.visibleCount + 1
    },
    isSliderActive () {
      return this.totalCount > this.visibleCount
    },
    favouritesClasses () {
      return {
        'has-promo': this.isPromoActive,
        'has-slider': this.isSliderActive
      }
    },
    slideOffset () {
      return (this.index - 1) * this.itemWidth * -1
    },
    isSomeListExpanded () {
      return this.isModificationsExpanded || this.isComplectationsExpanded
    },
    disclaimers () {
      if (!(this.favouritesData && this.favouritesData.footnotes)) {
        return null
      }
      let result = cloneDeep(this.favouritesData.footnotes)
      result['1'] = this.firstDisclaimer
      return result
    }
  },
  methods: {
    updateSavedFavourites () {
      this.savedFavourites = this.$cookie.get(this.cookieName) ? JSON.parse(this.$cookie.get(this.cookieName)) : []
    },
    getData () {
      return new Promise((resolve, reject) => {
        this.updateSavedFavourites()
        if (!this.savedFavourites.length) {
          return reject('No favourites found.')
        }
        return this.loadData().then(response => {
          return resolve(response.data)
        }, error => {
          return reject(error.message)
        })
      })
    },
    loadData () {
      return axios.get(this.apiUrl, { params: { id: this.savedFavourites } })
    },
    removeFavourite (complID) {
      this.$store.dispatch('REMOVE_FAVOURITE', complID).then(result => {
        this.onRemoved(complID)
      }, (error) => {
        this.$root.$emit('notify', { type: 'error', text: 'Ошибка удаления позиции.' })
        console.error('Unable to remove favourite item!\nError: ' + error)
      })
    },
    onRemoved (complID) {
      this.updateSavedFavourites()
      // Если длина равна 1 - то вычищаем вообще все
      if (this.savedFavourites.length === 0) {
        return this.$router.push({ path: '/' })
      }
      let removeIndex = -1

      this.favouritesData.carData.forEach((currentValue, index, array) => {
        if (currentValue.complectationId === complID) {
          removeIndex = index
        }
      })
      // выдрали индекс удаляемого элемента

      // Первое, что делаем - удаляем тачку
      this.favouritesData.carData = this.favouritesData.carData.filter((car) => {
        return car.complectationId !== complID
      })

      this.favouritesData.modifications.map((value) => {
        value.data.map((spec) => {
          spec.values.splice(removeIndex, 1)
          return spec
        })
        return value
      })

      this.favouritesData.complectations.map((value) => {
        value.data.map((spec) => {
          spec.values.splice(removeIndex, 1)
          return spec
        })
        return value
      })
      this.updateSliding()
    },
    updateSliding () {
      if (this.isLastSlideActive && !this.isFirstSlideActive) {
        this.index = this.totalCount - this.visibleCount + 1
      }
    },
    slideNext () {
      this.index = !this.isLastSlideActive ? ++this.index : this.index
    },
    slidePrev () {
      this.index = !this.isFirstSlideActive ? --this.index : this.index
    },
    calcHeight (arr) {
      this.rows = arr;
    },
    setCurrentSlide (slide) {
      this.currentSlide = slide;
    },
    calcHeight1 (arr) {
      this.rows1 = arr;
    },
    setCurrentSlide1 (slide) {
      this.currentSlide1 = slide;
    },
    setVisibleCount () {
      //Подсчёт видимых колонок для правильной работы слайдера
      if ($(window).width() >= 1263) {
        if (this.isPromoActive) {
          this.visibleCount = 3;
        } else {
          this.visibleCount = 4;
        }
      } else if ($(window).width() > 900) {
        this.visibleCount = 3;
      } else if ($(window).width() >= 768) {
        this.visibleCount = 2;
      } else {
        this.visibleCount = 2;
      }
    },
    refreshData () {
      this.getData().then(result => {
          this.favouritesData = result;

          //Отмотаем в конец списка
          this.index = this.totalCount - 1;
        }, error => {
          this.$root.$emit('notify', { type: 'error', text: 'Произошла неожиданная ошибка при загрузке данных.' })
          console.error('An error occured: ', error)
          this.$router.push({ path: '/' })
        })
    }
  },
  watch: {
    isPromoActive: function () {
      this.setVisibleCount();
    },
    favouritesData: function () {
      //Определение размера айтема в слайдере после отрисовки айтемов
      setTimeout(()=>{
        this.itemWidth = $('.f-items-cell').eq(0).outerWidth();
        this.setVisibleCount();
      }, 1000)
    }
  },
  mounted () {
    this.getData().then(result => {
      this.favouritesData = result
    }, error => {
      this.$root.$emit('notify', { type: 'error', text: 'Произошла неожиданная ошибка при загрузке данных.' })
      console.error('An error occured: ', error)
      this.$router.push({ path: '/' })
    })
    //Определение размера айтема в слайдере
    var that = this;

    this.$nextTick(()=>{
      $(window).on('resize', function () {
        that.itemWidth = $('.f-items-cell').eq(0).outerWidth();
        that.setVisibleCount();
      })
    })
  }
}
</script>

<style lang="scss" scope>
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.fade-left-enter-active, .fade-left-leave-active {
  transition: opacity .75s cubic-bezier(.5,.11,.11,1), transform .75s cubic-bezier(.5,.11,.11,1);
}
.fade-left-enter, .fade-left-leave-active {
  opacity: 0;
  transform: translate(100%, 0);
}

.slide-bottom-leave-active {
  transform: translateY(100%);
}

.f-items-cell {
  &.f-list-enter-active, &.f-list-leave-active {
    transition: opacity .25s cubic-bezier(.5,.11,.11,1) 0s;
  }
  &.f-list-enter, &.f-list-leave-to {
    transition: opacity .25s cubic-bezier(.5,.11,.11,1) 0s;
    opacity: 0;
  }
}
.view-item {
  background: #F8F8F8 url('../../assets/image/bgr_1.jpg') no-repeat center bottom / 100% auto;
}

.favourites {
  .loader-overlay {
    background: #F9F8FA;
  }
  .checkbox-component {
    font-size: 1.4rem;
    line-height: 1.5;
    color: $text_black;
    font-weight: 500;
    cursor: pointer;
    user-select: none;
    label {
      display: flex;
      align-items: center;
    }
    .f-list-check {
      position: relative;
      width: 16px;
      height: 16px;
      border: 2px solid $third_text;
      margin-right: 12px;
      cursor: pointer;
      svg {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        transform: scale(0);
        transition: 0.3s;
      }
    }
    .svg-check {
      position: absolute;
      left: 0;
      top: 50%;
      margin-top: -21px;
      height: 42px;
      width: 42px;
      border-radius: 50%;
      background: #fff;
      transition: background $tr-fast;
      .ic-svg {
        @include abs-center;
        height: 18px;
        width: 21px;
        transform: scale(0);
        fill: #fff;
        transition: transform .25s cubic-bezier(.77,0,.24,1.42) 0s;
      }
    }
    input {
      &:checked + label {
        .svg-check {
          background: $hollow;
        }
        .ic-svg, svg {
          transform: scale(1);
        }
      }
    }
    &:hover {
    }
  }
}
.favourites-header {
  
}
.favourites-header-holder {
  margin: 0 auto;
  padding: 30px 0;
  padding-bottom: 20px;
  width: auto;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.favourites-title {
  font-size: 4.2rem;
  line-height: 1.14;
  font-weight: 500;
}
.favourites-add {
  font-size: 1.6rem;
  line-height: 1.25;
  color: $main_blue;
  padding-left: 30px;
  svg {
    width: 20px;
    height: 15px;
  }
}
.favourites-body {
  position: relative;
  padding: 0 0 40px;
  min-height: calc(100vh - 97px);
}
.f-list__center {
  position: relative;
  overflow: hidden;
}
.favourites-inner-holder {
  margin: 0 auto;
  overflow: hidden;
  width: auto;
  position: relative;
  background: #fff;
}
.favourites-content {
  padding: 40px 0 55px;
  position: relative;
}
.f-list-header {
  padding: 0 15px 0 72px;
  margin-bottom: 13px;
  position: relative;
  max-width: 100%;
  transition: max-width .75s cubic-bezier(.5,.11,.11,1);
}
.has-promo {
  .f-list-holder {
    width: calc(100% - 348px);
  }
}
.f-list-holder {
  overflow: hidden;
  padding-left: 72px;
  padding-right: 72px;
  position: relative;
  z-index: 1;
}
// promo
.promo {
  transition: opacity .25s ease-in-out 0s;
}
// main list
.f-items {
  position: relative;
  max-width: 100%;
  transition: max-width .75s cubic-bezier(.5,.11,.11,1) 0s, transform .75s cubic-bezier(.5,.11,.11,1) 0s;
}
.f-items__row {
  display: flex;
  flex-flow: row nowrap;
  align-items: flex-start;
  justify-content: flex-start;
  transition: transform .75s cubic-bezier(.5,.11,.11,1) 0s;
}

.has-promo {
  .f-items-cell {
    flex: 0 0 33.33%;
  }
}

.f-items-cell {
  flex: 0 0 25%;
  padding: 0 32px;
  position: relative;
  span {
    display: block;
  }
  strong {
    font-weight: 500;
  }
  &:hover {
    .f-item__img {
      opacity: .5;
    }
    .f-item-remove {
      opacity: 1;
      &:hover {
        opacity: .5
      }
    }
  }
}
.f-items-cell__holder {
  position: relative;
}
.f-item__image {
  position: relative;
  padding-top: 50px;
  margin-bottom: 30px;
}
.f-item__backstage {
  position: absolute;
  z-index: 0;
  color: #fbf9f9;
  font-size: 50px;
  line-height: 0.9;
  text-align: center;
  font-weight: 500;
  left: 50%;
  pointer-events: none;
  user-select: none;
  top: 25%;
  transform: translate(-50%, -45%);
  max-height: 1.7em;
  overflow: hidden;
}
.f-item__img {
  transition: opacity $tr-fast;
  position: relative;
  z-index: 1;
  display: block;
  max-width: 100%;
  pointer-events: none;
  user-select: none;
}
.f-item__name {
  font-size: 2.0rem;
  line-height: 1.2;
}
.f-item__config {
  font-size: 1.6rem;
  line-height: 1.5;
  color: $second_text;
  margin-bottom: 17px;
  span {
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
}
.f-item__prices {
  font-size: 1.6rem;
  line-height: 1.5;
  color: $second_text;
  padding-top: 15px;
  border-top: 1px solid $sand_bg;
  margin-bottom: 3px;
  span {
    display: block;
  }
  strong {
    font-weight: 500;
    color: $text_black;
  }
  sup {
    font-size: .6em;
    margin-left: .2em;
  }
}
.f-item__button {
  display: block;
  width: 100%;
  text-align: center;
  padding: 12px 0;
  margin-top: 25px;
  margin-bottom: 17px;
}
.f-item-remove {
  position: absolute;
  z-index: 2;
  top: 0;
  right: 0;
  height: 40px;
  width: 40px;
  font-size: 0;
  line-height: 0;
  transition: opacity $tr-fast;
  opacity: 0;
  &::before, &::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    background: $second_text;
    height: 2px;
    width: 22px;
  }
  &::before {
    transform: rotate(45deg);
  }
  &::after {
    transform: rotate(-45deg);
  }
}

// specs list
.favourites-modifications {
  margin-top: 62px;
  .f-items-cell {

  }
}
.favourites-complectations {
  margin-top: 49px;
}
.favourites-list-toggler {
  font-size: 2rem;
  line-height: 1.2;
  color: $text_black;
  font-weight: 500;
}
.favourites-list-wrapper {
  overflow: hidden;
  transition: max-height .5s cubic-bezier(0,.89,.17,1) 0s;
  &.is-expanded {
    transition: max-height .5s cubic-bezier(.76,.05,.86,.06) 0s;
  }
}
.favourites-list-holder {
  padding-top: 26px;
}
.f-items__row-wrapper {
  padding-top: 15px;
  hr {
    margin: 0 32px;
    margin-top: 19px;
  }
  &:last-of-type {
    hr {
      display: none;
    }
  }
}
.f-items__row-group {
  border: 1px solid $sand;
  &:not(:last-of-type) {
    border-bottom: none;
  }
}
.f-items__group-name {
  position: relative;
  font-size: 1.6rem;
  line-height: 1.25;
  font-weight: 500;
  padding: 18px 32px;
  cursor: pointer;
  svg {
    display: block;
    position: absolute;
    top: 50%;
    transform: translateY(-50%) rotate(180deg);
    right: 32px;
    transition: 0.3s;
  }
  &.is-expanded {
    svg {
      transform: translateY(-50%) rotate(0deg);
    }
  }
}
.f-items__row {
  display: flex;
  flex-flow: row nowrap;
  align-items: flex-start;
  justify-content: flex-start;
}
.f-items__row-name {
  font-size: 1.6rem;
  line-height: 1.25;
  color: $second_text;
  white-space: nowrap;
  margin-bottom: 8px;
  padding: 0 32px;
}
.f-disclaimers {
  padding-top: 49px;
}
.f-disclaimer {
  color: #b2b2b2;
  text-align: justify;
  font-size: 12px;
  line-height: 1.3;
  strong {
    font-weight: 600;
    color: #2a2a2a;
  }
  & + & {
    margin-top: 13px;
  }
}

.df-info {
  &:not(:last-of-type) {
    margin-bottom: 5px;
  }
}

.f-items__dd {
  overflow: hidden;
  padding-bottom: 19px;
  &:not(.is-expanded) {
   //display: none;
  }
}

.i-nav {
  display: none;
  align-items: center;
  font-size: 1.4rem;
  line-height: 1;
  font-weight: 500;
  color: $text_black;
  margin-top: 10px;
  padding-bottom: 24px;
  margin-bottom: 15px;
  border-bottom: 1px solid $sand_bg;
  &__center {
    display: flex;
    align-items: center;
    margin: 0 11px;
  }
  &__sep {
    margin: 0 5px;
  }
  &__prev, &__next {
    display: block;
    position: relative;
    width: 6px;
    height: 16px;
    &::after {
      content: '';
      display: block;
      position: absolute;
      top: -50%;
      bottom: -50%;
      right: -150%;
      left: -150%;
    }
  }
}

@media only screen and (max-width : $xl-max) {
  .has-promo {
    .f-list-holder {
      width: calc(100% - 290px);
    }
  }
}
@media only screen and (max-width : $lg-max) {
  .i-nav {
    display: flex;
  }
  .m-diff {
    margin-top: 23px;
    margin-bottom: 32px;
  }
  .f-items-cell__about {
    display: none;
  }

  .favourites {
    min-width: 100%;
    margin-left: -40px;
    margin-right: -40px;
    background-color: $white_bg;
  }
  .f-list__center {
    margin-left: 40px;
    margin-right: 40px;
  }
  .favourites-header {
    padding-left: 40px;
    padding-right: 40px;
    background-color: $gray_bg;
  }
  .favourites-content {
    padding-top: 0;
  }
  .favourites-title {
    font-size: 30px;
  }
  .favourites-header-holder {
    padding-top: 20px;
  }
  .f-list-holder, .has-promo .f-list-holder {
    width: 100%;
    padding-left: 0px;
    padding-right: 0px;
    &::before {
	  content: '';
	  display: none;
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 560px;
      background-color: $gray_bg;
    }
  }
  .f-item__prices {
    padding-top: 9px;
  }
  .f-item__button {
    margin-top: 15px;
  }
  .f-item__image {
    padding-top: 20px;
  }
  .f-item-remove {
    opacity: 1;
  }
  .f-items-cell {
    flex: 0 0 33.33%;
    padding: 0 32px;
    position: relative;
    font-size: 14px;
    &:hover {
      .f-item__img {
        opacity: 1;
      }
    }
  }
  .favourites-modifications {
    margin-top: 0;
    min-width: 100%;
    padding-top: 38px;
    //background-color: $white_bg;
  }
  .f-items__row-name {
    font-size: 14px;
  }
  .f-disclaimers {
    padding-left: 40px;
    padding-right: 40px;
    padding-top: 30px;
  }
}
@media only screen and (max-width : 900px) {
  .f-items-cell, .has-promo .f-items-cell {
    flex: 0 0 50%;
    max-width: 50%;
  }
}
@media only screen and (max-width : $md-max) {
  .favourites {
    min-width: 100%;
    margin-left: -16px;
    margin-right: -16px;
    background-color: $white_bg;
  }
  .favourites-header {
    padding-left: 16px;
    padding-right: 16px;
  }
  .f-list-holder, .has-promo .f-list-holder {
    &::before {
      height: 500px;
    }
  }
  .f-list__center {
    margin-left: 16px;
    margin-right: 16px;
  }
  .favourites-title {
    font-size: 20px;
  }
  .f-item__button {
    display: none;
  }
  .i-nav {
    font-size: 12px;
    color: $second_text;
  }
  .f-items-cell {
    padding-left: 16px;
    padding-right: 16px;
  }
  .f-item-remove {
    &::after, &::before {
      width: 17px;
    }
  }
  .f-item__name {
    strong {
      display: block;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }
  }
  .f-item__config {
    font-size: 14px;
    line-height: 21px;
    span {
      &:last-of-type {
        margin-top: 14px;
      }
    }
  }
  .f-item__prices {
    border-top: none;
    margin-bottom: 0;
    padding-bottom: 27px;
    border-bottom: 1px solid rgba(#000, 0.1);
    span {
      &:last-of-type {
        font-size: 14px;
        line-height: 21px;
      }
    }
  }
  .favourites-modifications {
    padding-top: 30px;
    // padding-left: 16px;
    // padding-right: 16px;
  }
  .favourites-complectations {
    // padding-left: 16px;
    // padding-right: 16px;
  }
  .favourites-list-holder {
    padding-top: 10px;
  }
  .f-items__group-name {
    padding-left: 16px;
    padding-right: 25px;
    svg {
      right: 16px;
    }
    span {
      display: block;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }
  }
  .f-items__row-name {
    padding-left: 16px;
    padding-right: 16px;
    white-space: initial;
  }
  .f-disclaimers {
    padding-left: 16px;
    padding-right: 16px;
    padding-top: 26px;
  }

  .favourites-add {
    margin-left: 16px;
  }
}
</style>
