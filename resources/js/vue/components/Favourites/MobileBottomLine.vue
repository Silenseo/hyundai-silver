<template>
  <div class="b-line">
    <a href="#" class="b-line__close" @click.prevent.stop="hidePromo">
      <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect y="10.9089" width="15.4276" height="1.54276" transform="rotate(-45 0 10.9089)" fill="#666666"/>
        <rect x="1.09082" width="15.4276" height="1.54276" transform="rotate(45 1.09082 0)" fill="#666666"/>
      </svg>
    </a>
    <h5 class="b-line__title">Рекомендуем</h5>
    <div class="b-line__body">
      <div class="b-line__img">
        <img :src="car.carImage" alt="">
      </div>
      <div class="b-line__description">
        <div class="b-line__name">{{ car.name }}</div>
        <div class="b-line__mod">{{ car.mod }}, <br>{{ car.compl }}</div>
        <div class="b-line__pay">от {{ car.payment | priceBaseFormat }} ₽/мес</div>
        <button @click.prevent="addFav" class="df-button b-line__button b-line__button--desc">Добавить к сравнению</button>
      </div>
      <button @click.prevent="addFav" class="df-button b-line__button b-line__button--mob">Добавить к сравнению</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MobileBottomLine',
  components: {},
  props: ['items'],
  data () {
    return {

    }
  },
  methods: {
    hidePromo: function () {
      this.$store.commit('HIDE_PROMO')
    },
    addFav: function () {
      if (this.car.complectationId) {
        this.$store.dispatch('ADD_FAVOURITE_FROM_PROMO', this.car.complectationId);
        this.$emit('update-data');
        this.$store.commit('HIDE_PROMO');
      } else {
        this.$root.$emit('notify', { type: 'error', text: 'Ошибка добавления, повторите попытку позднее' })
      }
    }
  },
  computed: {
    car: function () {
      if ('carData' in this.items) {
        let name = this.items.carData[Object.keys(this.items.carData)[0]].carName;
        let mod = this.items.carData[Object.keys(this.items.carData)[0]].modName;
        let compl = this.items.carData[Object.keys(this.items.carData)[0]].complName;
        let payment = this.items.carData[Object.keys(this.items.carData)[0]].payment;
        let carImage = this.items.carData[Object.keys(this.items.carData)[0]].carImage;
        let complectationId = this.items.carData[Object.keys(this.items.carData)[0]].complectationId;

        return {
          name: name,
          mod: mod,
          compl: compl,
          payment: payment,
          carImage: carImage,
          complectationId: complectationId
        }
      }
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.b-line {
  display: none;
  position: fixed;
  left: 0;
  bottom: 0;
  right: 0;
  padding: 13px 40px;
  padding-bottom: 24px;
  background-color: $sand_bg;
  z-index: 100;
  transition: 0.5s;
  &__close {
    position: absolute;
    top: 18px;
    right: 40px;
  }
  &__body {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  &__img {
    width: 234px;
    margin-right: 50px;
  }
  &__name {
    font-size: 2rem;
    line-height: 1.2;
    font-weight: 500;
  }
  &__mod {
    font-size: 1.6rem;
    line-height: 1.5;
    color: $second_text;
    br {
      display: none;
    }
  }
  &__pay {
    font-size: 1.6rem;
    line-height: 1.5;
    font-weight: 500;
  }
  &__button {
    padding: 12px 20px;
    margin-top: 9px;
    &--mob {
      display: none;
    }
  }
}

@media only screen and (max-width : $lg-max) {
  .b-line {
    display: block;
  }
}
@media only screen and (max-width : $md-max) {
  .b-line {
    padding-left: 16px;
    padding-right: 16px;
    &__close {
      top: 22px;
      right: 16px;
    }
    &__title {
      font-size: 20px;
    }
    &__body {
      justify-content: space-between;
      flex-direction: row-reverse;
      flex-wrap: wrap;
      margin-top: 11px;
    }
    &__name {
      font-size: 16px;
    }
    &__img {
      width: 128px;
      margin-right: 0;
    }
    &__mod {
      font-size: 14px;
      br {
        display: inline-block;
      }
    }
    &__pay {
      display: none;
    }
    &__button {
      &--desc {
        display: none;
      }
      &--mob {
        display: block;
        width: 100%;
        margin-top: 16px;
      }
    }
  }
}
</style>
