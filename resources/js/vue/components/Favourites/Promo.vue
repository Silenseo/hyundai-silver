<template>
  <div class="favourites-promo">
    <div class="f-promo__header">Рекомендуем</div>
    <!-- <div class="f-promo__badge" v-if="promoCar.isStart">
      <div class="f-promo__badge-holder">
        <div class="f-promo__badge-name">«{{ promoCar.programName }}»</div>
        <div class="f-promo__badge-prices">
          <span class="f-promo__badge-payment">от <strong>{{ promoCar.payment | priceBaseFormat }}<sup>1</sup></strong></span>
          <span class="f-promo__badge-currency">₽ / месяц</span>
        </div>
      </div>
    </div> -->
    <div class="f-promo-body">
	  <a href="#close" class="f-promo-close" @click.prevent.stop="hidePromo"></a>
      <main-list :items="items.carData" :is-different-only="isDifferentOnly"></main-list>
      <modifications-list :is-promo="true" :in-current-slide="currentSlide" :inRows="rows" :items="items.modifications" :is-different-only="isDifferentOnly" :isExpanded="isModificationsExpanded"></modifications-list>
      <complectations-list :is-promo="true" :in-current-slide="currentSlide1" :inRows="rows1" :items="items.complectations" :is-different-only="isDifferentOnly" :isExpanded="isComplectationsExpanded"></complectations-list>
    </div>
  </div>
</template>

<script>
import MainList from './MainList'
import ModificationsList from './ModificationsList'
import ComplectationsList from './ComplectationsList'

export default {
  name: 'Promo',
  components: { MainList, ModificationsList, ComplectationsList },
  props: [ 'items', 'isDifferentOnly', 'isModificationsExpanded', 'isComplectationsExpanded', 'rows', 'currentSlide', 'rows1', 'currentSlide1' ],
  methods: {
    hidePromo () {
      this.$store.commit('HIDE_PROMO')
      this.$emit('updateSliding')
    }
  },
  computed: {
    promoCar () {
      return this.items.carData[Object.keys(this.items.carData)[0]]
    }
  }
}
</script>

<style lang="scss" scoped>
.f-items__row-wrapper:last-of-type {
  border-bottom: 1px solid #ddd8d8;
}
.f-items {
  @at-root .has-promo .favourites-content & {
    max-width: 100%;
  }
}
</style>

<style lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.f-promo-close {
  position: absolute;
  z-index: 1;
  top: 0px;
  right: 0px;
  height: 40px;
  width: 40px;
  font-size: 0;
  line-height: 0;
  transition: opacity $tr-fast;
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
    transition: background $tr-fast;
  }
  &::before {
    transform: rotate(45deg);
  }
  &::after {
    transform: rotate(-45deg);
  }
}
.f-promo__header {
  font-size: 2rem;
  line-height: 1.2;
  font-weight: 500;
}
.f-promo__badge {
  position: absolute;
  width: 105px;
  height: 105px;
  z-index: 2;
  background: #f53a27;
  border-radius: 50% 50% 50% 0;
  top: 36px;
  right: 18px;
  pointer-events: none;
  user-select: none;
  transition: opacity $tr-fast;
}
.f-promo__badge-holder {
  font-size: 12px;
  line-height: 1;
  color: #fff;
  white-space: nowrap;
  position: relative;
  top: 52%;
  left: 12px;
  transform: translate(0,-50%);
}
.f-promo__badge-name {
  text-transform: uppercase;
  font-weight: 500;
  letter-spacing: 0.01em;
}
.f-promo__badge-prices {}
.f-promo__badge-payment {
  line-height: 1;
  font-size: 14px;
  font-weight: 600;
  letter-spacing: 0.05em;
  strong {
    line-height: 1;
    vertical-align: baseline;
    display: inline-block;
    white-space: nowrap;
    font-weight: 500;
    font-size: 22px;
    letter-spacing: -0.05em;
  }
  sup {
    font-size: .55em;
    margin-left: .25em;
  }
}
.f-promo__badge-currency {
  font-weight: 600;
  line-height: 1;
  display: block;
}

.favourites-promo {
  position: absolute;
  top: 0;
  bottom: 0;
  right: 0;
  width: 348px;
  padding: 40px 40px;
  background: $sand_bg;
  z-index: 1;
  .f-items__row-wrapper {
    hr {
      margin-left: 0;
      margin-right: 0;
    }
  }
  .f-item-remove {
    display: none;
    visibility: hidden;
    pointer-events: none;
  }
  .favourites-list-toggler,
  .f-items__row-name,
  .f-items__group-name {
    color: transparent;
    visibility: hidden;
    white-space: nowrap;
    pointer-events: none;
  }
  .f-items__row {
    display: block;
  }
  .f-items-cell {
    padding-right: 0;
  }
  .f-item-remove {
    right: -10px;
  }
  .f-item__backstage {
    color: #f4f4f4;
  }
  .f-item__img {
    margin: 0;
  }
  .f-promo-body {
    position: relative;
    overflow: hidden;
    padding-top: 6px;
	.f-items-cell {
		width: 100%;
		padding: 0;
	}
	.f-item__prices {
		border-color: rgba(#000000, 0.2);
	}
  }
  &:hover {
    .f-promo-close {
      opacity: 1;
      &:hover {
        &::before, &::after {
          background: #013368;
        }
      }
    }
    .f-promo__badge {
      opacity: 0;
    }
  }
}

@media only screen and (max-width : $xl-max) {
  .favourites-promo  {
    width: 290px;
  }
}
@media only screen and (max-width : $lg-max) {
  .favourites-promo  {
    display: none;
  }
}
</style>
