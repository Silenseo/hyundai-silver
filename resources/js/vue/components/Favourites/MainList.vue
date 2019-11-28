<template>
  <div class="f-items favourites-main-list" :style="{ 'transform' : 'translate(' + slideOffset + 'px, 0)' }">
    <transition-group name="f-list" tag="div" class="f-items__row">
        <div class="f-items-cell" v-for="(item, key) in items" @click.prevent.stop="selectCar(item.carId)" :key="item.complectationId">
          <a href="#remove" class="f-item-remove" @click.prevent.stop="removeFavourite(item.complectationId)"></a>
          <div class="f-items-cell__holder">
            <div class="f-item__image">
              <img class="f-item__img" :alt="item.carName" :src="item.carImage" v-fade-in>
            </div>
          </div>
        </div>
    </transition-group>
    <transition-group name="f-list" tag="div" class="f-items__row">
      <div class="f-items-cell" v-for="(item, index, key) in items" :key="item.complectationId">
        <div class="f-items-cell__holder">
          <div class="f-item__name" @click.prevent.stop="selectCar(item.carId)">
            <strong>{{ item.carName }}</strong>
          </div>
          <div class="i-nav">
            <a @click.prevent="prevSlide" class="i-nav__prev">
              <svg width="8" height="18" viewBox="0 0 8 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 17L1.45 9.6C1.18333 9.24444 1.18333 8.75556 1.45 8.4L7 1" stroke="#002C5F" stroke-width="2"/>
              </svg>
            </a>
            <div class="i-nav__center">
              <div class="i-nav__current">{{ index + 1 }}</div>
              <div class="i-nav__sep">|</div>
              <div class="i-nav__total">{{ items.length }}</div>
            </div>
            <a @click.prevent="nextSlide" class="i-nav__next">
              <svg width="8" height="18" viewBox="0 0 8 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.999999 17L6.55 9.6C6.81667 9.24444 6.81667 8.75556 6.55 8.4L1 1" stroke="#002C5F" stroke-width="2"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </transition-group>
    <transition-group name="f-list" tag="div" class="f-items__row">
      <div class="f-items-cell" v-for="(item, key) in items" @click.prevent.stop="selectCar(item.carId)" :key="item.complectationId">
        <div class="f-items-cell__holder">
          <div class="f-item__config">
            <span>{{ item.modName }}</span>
            <span>{{ item.complName }}</span>
          </div>
        </div>
      </div>
    </transition-group>
    <transition-group name="f-list" tag="div" class="f-items__row">
      <div class="f-items-cell" v-for="(item, key) in items" @click.prevent.stop="selectCar(item.carId)" :key="item.complectationId">
        <div class="f-items-cell__holder">
          <div class="f-item__prices">
            <span><strong>от {{ item.payment | priceBaseFormat }} ₽/мес<sup>1</sup></strong></span>
            <span>{{ item.complPrice | priceFormat }}</span>
          </div>
        </div>
      </div>
    </transition-group>
    <transition-group name="f-list" tag="div" class="f-items__row">
      <div class="f-items-cell" v-for="(item, key) in items" :key="item.complectationId">
        <div class="f-items-cell__holder">
          <button @click.prevent="creditCalc(item.carId)" class="df-button f-item__button">Рассчитать кредит</button>
        </div>
      </div>
    </transition-group>
    <transition-group name="f-list" tag="div" class="f-items__row">
      <div class="f-items-cell" v-for="(item, key) in items" @click.prevent.stop="selectCar(item.carId)" :key="item.complectationId">
        <div class="f-items-cell__holder">
          <a href="#" class="df-iconed-link df-iconed-link--small f-items-cell__about">
            О модели
            <svg>
              <use xlink:href="#arrow-link"></use>
            </svg>
          </a>
        </div>
      </div>
    </transition-group>
  </div>
</template>

<script>
export default {
  name: 'MainList',
  props: [ 'items', 'isDifferentOnly', 'slideOffset', 'currentSlide' ],
  methods: {
    selectCar (carID) {
      this.$router.push({ name: 'Summary', params: { id: carID } })
    },
    removeFavourite (complID) {
      this.$emit('removeFavourite', complID)
    },
    creditCalc (carID) {
      this.$router.push({ name: 'Summary', hash: '#calculator', params: { id: carID } })
    },
    nextSlide () {
      this.$emit('next-slide')
    },
    prevSlide () {
      this.$emit('prev-slide')
    }
  }
}
</script>

<style lang="scss" scoped>
  .f-items-cell {
    cursor: pointer;
  }
</style>
