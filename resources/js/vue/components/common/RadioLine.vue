<template>
  <div class="radio-line-component">
    <ul class="radio-line" :data-active-index="activeIndex">
      <radio-line-item v-for="(item, key) in items" :key="key" :item="item" :textKey="textKey" :valueKey="valueKey" :disabledKey="disabledKey" :currentValue="currentValue" @select="select"></radio-line-item>
    </ul>
  </div>
</template>

<script>
import RadioLineItem from './RadioLineItem'

export default {
  name: 'List',
  components: { RadioLineItem },
  props: [ 'items', 'textKey', 'valueKey', 'activeValue', 'disabledKey' ],
  computed: {
    currentValue: {
      get () {
        return this.activeValue
      },
      set (value) {
        this.$emit('change', value)
      }
    },
    activeIndex () {
      return Object.keys(this.items).map((key) => this.items[key][this.valueKey]).indexOf(this.currentValue)
    }
  },
  methods: {
    select (value) {
      this.currentValue = value
    }
  }
}
</script>
<style lang="scss">
@import '../../assets/_mixins.scss';

$transition: .15s ease-in-out 0s;
$radius: 28px;

.radio-line-component {
  border: 1px solid #0f4d8f;
  border-radius: $radius;
  position: relative;
}
.radio-line {
  display: flex;
  justify-content: stretch;
  flex-flow: row nowrap;
  color: #fff;
  line-height: 1;
  font-size: 16px;
  &::before {
    transition: left $transition, margin $transition;
    content: '';
    position: absolute;
    z-index: 0;
    background: #00aed5;
    width: 96px;
    // width: calc(100% / 5);
    width: 33.33%;
    top: 0;
    bottom: 0;
    border-radius: $radius;
    margin-top: -1px;
    margin-bottom: -1px;
  }
  &[data-active-index="0"]::before {
    margin-left: -1px;
    left: 0;
  }
  &[data-active-index="1"]::before {
    left: 33.33%;
  }
  &[data-active-index="2"]::before {
    left: 66.66%;
  }
//   &[data-active-index="3"]::before {
//     left: 60%;
//   }
//   &[data-active-index="4"]::before {
//     margin-right: -1px;
//     left: 80%;
//   }
}
// .list-fx-enter-active, .list-fx-leave-active {
//   transition: opacity .15s cubic-bezier(.55,0,.1,1) 0s, transform .15s cubic-bezier(.55,0,.1,1) 0s;
// }
// .list-fx-enter, .list-fx-leave-active {
//   opacity: 0;
//   transform: translate(0,-20px)
// }
</style>
