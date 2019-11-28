<template>
  <div class="f-sticky" :class="{ 'is-sticked': isSticked }">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="f-sticky-body">
            <div class="f-items-holder">
              <transition name="fade">
                <slide-controls v-if="true" :is-last="isLastSlideActive" :is-first="isFirstSlideActive" @slideNext="slideNext" @slidePrev="slidePrev"></slide-controls>
              </transition>
              <div class="f-list__center">
                <div class="f-items favourites-main-list" :style="{ 'transform' : 'translate(' + slideOffset + 'px, 0)' }">
                  <transition-group name="f-list" tag="div" class="f-items__row">
                    <div class="f-items-cell" v-for="(item, index, key) in cars" :key="item.complectationId">
                      <a href="#remove" class="f-item-remove" @click.prevent.stop="removeFavourite(item.complectationId)"></a>
                      <div class="f-items-cell__holder">
                        <div class="f-item__image d-sm-none d-lg-block">
                          <img class="f-item__img" :alt="item.carName" :src="item.carImage" v-fade-in>
                        </div>
                        <div class="f-item__name" @click.prevent.stop="selectCar(item.carId)">{{ item.carName }}</div>
                        <div class="f-item__config" @click.prevent.stop="selectCar(item.carId)">
                          <span>{{ item.modName }}</span>
                          <span>{{ item.complName }}</span>
                        </div>
                        <div class="f-item__image d-sm-lock d-lg-none" @click.prevent.stop="selectCar(item.carId)">
                          <img class="f-item__img" :alt="item.carName" :src="item.carImage" v-fade-in>
                        </div>
                        <div class="i-nav">
                          <a @click.prevent="slidePrev" class="i-nav__prev">
                            <svg width="8" height="18" viewBox="0 0 8 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M7 17L1.45 9.6C1.18333 9.24444 1.18333 8.75556 1.45 8.4L7 1" stroke="#002C5F" stroke-width="2"/>
                            </svg>
                          </a>
                          <div class="i-nav__center">
                            <div class="i-nav__current">{{ index + 1 }}</div>
                            <div class="i-nav__sep">|</div>
                            <div class="i-nav__total">{{ cars.length }}</div>
                          </div>
                          <a @click.prevent="slideNext" class="i-nav__next">
                            <svg width="8" height="18" viewBox="0 0 8 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M0.999999 17L6.55 9.6C6.81667 9.24444 6.81667 8.75556 6.55 8.4L1 1" stroke="#002C5F" stroke-width="2"/>
                            </svg>
                          </a>
                        </div>
                      </div>
                    </div>
                  </transition-group>
                </div>
              </div>
            </div>
            <transition name="fade-left">
              <div class="favourites-promo" v-if="isPromoActive">
                <!-- <div class="f-promo__badge" v-if="promoCar.isStart">
                  <div class="f-promo__badge-holder">
                    <div class="f-promo__badge-name">«{{ promoCar.programName }}»</div>
                  </div>
                </div> -->
                <a href="#close" class="f-promo-close" @click.prevent.stop="hidePromo"></a>
                <div class="f-items-cell" @click.prevent.stop="selectCar(item.carId)">
                  <div class="f-items-cell__holder">
                    <div class="f-item__image">
                      <!-- <span class="f-item__backstage">{{ promoCar.carName }}</span> -->
                      <img class="f-item__img" :alt="promoCar.carName" :src="promoCar.carImage" v-fade-in>
                    </div>
                    <div class="f-item__name">{{ promoCar.carName }}</div>
                    <div class="f-item__config">{{ promoCar.complName }} {{ promoCar.modName }}</div>
                  </div>
                </div>
              </div>
            </transition>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SlideControls from './SlideControls'

export default {
  name: 'StickyHeader',
  components: { SlideControls },
  props: [ 'favouritesData', 'isPromoActive', 'slideOffset', 'isSliderActive', 'isLastSlideActive', 'isFirstSlideActive', 'hasExpanded' ],
  data () {
    return {
      isSticked: false,
      topPointElement: null,
      botttomPointElement: null
    }
  },
  computed: {
    cars () {
      return this.favouritesData.carData
    },
    promoCar () {
      return this.favouritesData.promo.carData[Object.keys(this.favouritesData.promo.carData)[0]]
    }
  },
  methods: {
    hidePromo () {
      this.$store.commit('HIDE_PROMO')
      this.$emit('updateSliding')
    },
    slideNext () {
      this.$emit('slideNext')
    },
    slidePrev () {
      this.$emit('slidePrev')
    },
    handleScroll () {
      if (this.hasExpanded && (this.topPointElement.getBoundingClientRect().top <= 0 && this.botttomPointElement.getBoundingClientRect().bottom >= 100)) {
        this.isSticked = true
      } else {
        this.isSticked = false
      }
    },
    selectCar (carID) {
      this.$router.push({ name: 'Summary', params: { id: carID } })
    },
    removeFavourite (complID) {
      this.$emit('removeFavourite', complID)
    }
  },
  mounted () {
    this.topPointElement = document.querySelector('.favourites-modifications')
    this.botttomPointElement = document.querySelector('.f-list-holder')
    this.handleScroll()
    window.removeEventListener('scroll', this.handleScroll)
    if (this.topPointElement !== null && this.botttomPointElement !== null) {
      window.addEventListener('scroll', this.handleScroll)
    }
  }
}
</script>

<style lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.f-sticky {
  overflow: hidden;
  position: fixed;
  background: #fff;
  top: 72px;
  left: 0;
  right: 0;
  z-index: 40;
  border-top: 1px solid rgba(#000, 0.1);
  box-shadow: 0 0 22px 0 rgba(#000, .1);
  transform: translate(0,-100%);
  opacity: 0;
  pointer-events: none;
  user-select: none;
  transition: transform .25s cubic-bezier(.5,.11,.11,1) 0s, opacity .25s cubic-bezier(.5,.11,.11,1) 0s;
  &.is-sticked {
    user-select: auto;
    opacity: 1;
    pointer-events: auto;
    transform: translate(0,0);
  }
  .f-item__backstage {
    color: #f4f4f4;
    line-height: .8;
    top: 30%;
  }
  .f-item__image {
    margin-bottom: 7px;
    padding-top: 10px;
  }
  .f-item__name {
    font-weight: 500;
    line-height: 1;
    margin-bottom: 2px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .f-items-cell {
    cursor: pointer;
  }
  .f-items__row {
  }
  .f-slide-controls {
    top: 50%;
    z-index: 2;
  }
  .f-promo-close {
    top: 7px;
    right: -10px;
  }
  .f-promo__badge {
    padding: 6px 12px;
    border-radius: 15px;
    width: auto;
    white-space: nowrap;
    height: 23px;
    right: 0;
    top: 16px;
  }
  .f-promo__badge-holder {
    font-size: 11px;
    transform: none;
    top: auto;
    position: static;
  }
  .favourites-promo {
    background-color: transparent;
    border-left: 1px solid rgba(#000, 0.1);
    padding-top: 0;
    padding-bottom: 0;
    .f-items-cell {
      padding: 0;
    }
  }
}
.f-sticky-body {
  position: relative;
}
.f-items-holder {
  position: relative;
  overflow: hidden;
  max-width: 100%;
  padding: 0 72px;
  transition: max-width .75s cubic-bezier(.5,.11,.11,1);
  @at-root .has-promo & {
    width: calc(100% - 348px);
  }
}

@media only screen and (max-width : $xl-max) {
  .has-promo {
    .f-items-holder {
      width: calc(100% - 290px);
    }
  }
}
@media only screen and (max-width : $lg-max) {
  .f-sticky {
    top: 56px;
    background-color: $gray_bg;
    border-top: none;
    padding-top: 23px;
    padding-bottom: 23px;
  }
  .f-sticky-body {
    min-width: 100%;
    margin-right: -40px;
    margin-left: -40px;
  }
  .f-items-holder, .has-promo .f-items-holder {
    width: 100%;
    padding-left: 0;
    padding-right: 0;
  }
  .f-sticky {
    .f-item-remove {
      display: none;
    }
    .f-item__image {
      margin: 0;
      padding: 0;
      margin-top: -24px;
      text-align: right;
      img {
        display: inline-block;
        max-width: 160px;
      }
    }
    .f-item__config {
      margin-bottom: 0;
    }
    .f-item__name {
      font-size: 16px;
    }
    .i-nav {
      position: absolute;
      left: 0;
      bottom: 0;
      padding: 0;
      margin: 0;
      border-bottom: none;
    }
  }
}
@media only screen and (max-width : $md-max) {
  .f-sticky-body {
    margin-right: -16px;
    margin-left: -16px;
  }
  .f-sticky {
    .f-item__image {
      display: none;
    }
    .f-item__config {
      span {
        margin: 0;
      }
    }
    .i-nav {
      position: relative;
      margin-top: 8px;
    }
  }
}
</style>
