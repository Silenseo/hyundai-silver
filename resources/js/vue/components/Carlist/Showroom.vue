<template>
  <transition name="fade" appear>
    <div class="showroom-main container" v-if="filteredCars">
      <div class="showroom-holder row">
        <div class="col-md-12">
          <transition-group name="showroom-transition" class="showroom-car-list" tag="ul">
            <router-link v-for="car in sortedCars" class="showroom-car" :to="{ name: 'Modification', params: { id: car.id }}" exact append tag="li" :key="car.id">
              <div class="showroom-car__content">
                <div class="showroom-car__header">
                  <strong class="showroom-car__name">{{ car.name }}</strong><span class="showroom-car__promo" v-if="car.promo && car.promo.length > 0">{{ car.promo }}</span>
                  <span class="showroom-car__price-range">{{ car.minPrice | priceBaseFormat }} – {{ car.maxPrice  | priceBaseFormat }} ₽</span>
                </div>
                <div class="showroom-car__image">
                  <span class="showroom-car__backstage">{{ car.bgName }}</span>
                  <img :src="car.image" class="showroom-car__img" v-fade-in>
                </div>
                <div class="showroom-car__credit">
                  <span class="showroom-car__program">{{ car.programName }}</span>
                  <span class="showroom-car__payment">от {{ car.payment | priceBaseFormat }} ₽/мес</span>
                </div>
              </div>
            </router-link>
          </transition-group>
            <div v-if="sortedCars.length < 1" class="showroom-no-list">
              <transition name="showroom-no-list-transition" appear>
                <span class="showroom-no-list__text"><!-- Nothing was found. --></span>
              </transition>
            </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Showroom',
  computed: {
    ...mapGetters({
      filteredCars: 'GET_FILTERED_CARS'
    }),
    sortedCars () {
      return this.filteredCars.sort((a, b) => {
        if (a.order < b.order) {
          return -1
        }
        if (a.order > b.order) {
          return 1
        }
        return 0
      })
    }
  }
}
</script>

<style lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';
$carHeight: 328px;

.showroom {
  
}
.showroom-holder {

}
.showroom-car-list {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  width: 100%;
  overflow: hidden;
}
.showroom-car {
  height: $carHeight;
  margin-bottom: -1px;
  max-width: 33.333%;
  width: 33.333%;
  text-align: left;
  padding: 24px 48px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  z-index: 1;
  border-right: 1px solid #ededed;
  border-bottom: 1px solid #ededed;
  background: #fff;
  transition: all .5s cubic-bezier(.19,1,.22,1) 0s;
  &:nth-of-type(3n+3) {
    border-right-color: transparent;
  }
  &:hover {
    background: #c3b9af;
    .showroom-car__backstage {
      color: #cbc0b6;
    }
  }
  @for $i from 0 to 21 {
    &:nth-of-type(#{$i}) {
      z-index: 21 - $i;
    }
  }
  // &.is-disabled {
  //   opacity: .45;
  //   pointer-events: none;
  //   user-select: none;
  //   cursor: default;
  //   .showroom-car__backstage {
  //     color: #e6e6e6;
  //   }
  // }
}
.showroom-car__content {
  position: relative;
  height: 100%;
}
.showroom-car__header {
  white-space: nowrap;
}
.showroom-car__name {
  color: #353535;
  display: inline-block;
  font-weight: 500;
  font-size: 2.0rem;
  line-height: 1;
  vertical-align: middle;
}
.showroom-car__promo {
  display: inline-block;
  padding: 5px 11px 4px;
  border-radius: 10px;
  background: #f53a27;
  vertical-align: middle;
  font-size: 1.1rem;
  line-height: 1;
  text-transform: uppercase;
  font-weight: 500;
  letter-spacing: .002em;
  color: #fff;
  margin-left: 9px;
}
.showroom-car__price-range {
  display: block;
  color: #666666;
  font-size: 1.6rem;
  font-weight: 400;
  line-height: 1.9;
}
.showroom-car__image {
  position: relative;
  margin: 14px 0px 0;
}
.showroom-car__backstage {
  display: none;
  position: absolute;
  font-size: 80px;
  line-height: 60px;
  color: #f4f4f4;
  font-weight: 500;
  text-align: center;
  left: 0;
  right: 0;
  margin: auto;
  pointer-events: none;
  user-select: none;
  top: 25%;
  transform: translate(0,-55%);
  transition: color .5s cubic-bezier(.19,1,.22,1) 0s;
}
.showroom-car__img {
  z-index: 1;
  position: relative;
  display: block;
  margin: auto;
  max-width: 90%;
  max-height: 140px;
}
.showroom-car__credit {
  color: #666666;
  white-space: nowrap;
  letter-spacing: 0;
  position: absolute;
  bottom: 11px;
  left: 0;
  right: 0;
}
.showroom-car__program {
  display: block;
  font-weight: 400;
  font-size: 1.6rem;
  line-height: 1;
  margin-bottom: 5px;
}
.showroom-car__payment {
  line-height: 1;
  font-size: 1.6rem;
  font-weight: 500;
  display: block;
  color: #000;
}
.showroom-no-list {
  display: flex;
  justify-content: stretch;
  align-items: center;
  min-height: $carHeight;
}
.showroom-no-list__text {
  flex: 1;
  text-align: center;
  font-size: 2em;
  letter-spacing: 0.015em;
}
.showroom-no-list-transition-enter, .showroom-no-list-transition-leave-to {
  opacity: 0;
  transform: translate(0,15px);
}
.showroom-no-list-transition-enter-active, .showroom-no-list-transition-leave-active {
  transition: all .75s cubic-bezier(.19,1,.22,1) 0s;
}

.showroom-transition-enter-active, .showroom-transition-leave-active, .showroom-transition-move {
  transition: all .5s cubic-bezier(.19,1,.22,1) 0s;
}
.showroom-transition-enter, .showroom-transition-leave-to {
  opacity: 0;
  transform: scale(0);
}
.showroom-transition-leave-active {
  position: absolute;
}

@media only screen and (max-width : $lg-max) {
  .car-list__showroom {
    padding-top: 40px;
  }
  .showroom-car {
    max-width: 50%;
    width: 50%;
    height: 280px;
    padding: 19px 40px;
  }
  .showroom-car:nth-of-type(3n+3) {
    border-right-color: #ededed;
  }
  .showroom-car:nth-of-type(2n) {
    border-right-color: transparent;
  }
  .showroom-car__image {
    margin-top: 0;
  }
  .showroom-car__name {
    font-size: 16px;
  }
  .showroom-car__price-range {
    font-size: 14px;
  }
  .showroom-car__program, .showroom-car__payment {
    font-size: 14px;
  }
}

@media only screen and (max-width : $md-max) {
  .car-list__showroom {
    padding-top: 0px;
	padding-bottom: 0;
	border-top: 1px solid $gray_bg;
  }
  .showroom-car-list {
    min-width: 100%;
    margin-left: -16px;
    margin-right: -16px;
    width: auto;
  }
  .showroom-car {
    max-width: 100%;
    width: 100%;
    padding: 19px 17px;
    border-right-color: transparent;
    &__image {

    }
    &__img {

    }
  }
  .showroom-car:nth-of-type(3n+3) {
    border-right-color: transparent;
  }
}
</style>
