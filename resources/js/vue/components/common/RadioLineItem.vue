<template>
  <li class="radio-line-item" :value="item[valueKey]" @click.prevent="select(item[valueKey])" :disabled="item[disabledKey]" :class="classes">{{ item[textKey] }}</li>
</template>

<script>
export default {
  name: 'RadioLineItem',
  props: [ 'item', 'textKey', 'valueKey', 'currentValue', 'disabledKey' ],
  computed: {
    classes () {
      return {
        'is-active': this.item[this.valueKey] === this.currentValue,
        'is-disabled': this.item[this.disabledKey] === true
      }
    }
  },
  methods: {
    select (value) {
      this.$emit('select', value)
    }
  }
}
</script>
<style lang="scss">
@import '../../assets/_mixins.scss';
$transition: .15s ease-in-out 0s;
$radius: 28px;

.radio-line-item {
  &.is-active {
    padding: 18px 15px 17px;
    &, &:hover {
      font-size: 20px;
      font-weight: 500;
      color: #fff;
      cursor: default;
    }
  }
  &.is-disabled {
    &, &:hover {
      color: rgba(#fff, .35);
      cursor: default;
    }
  }
  &:hover {
    color: #00aed5;
  }
  max-height: 55px;
  transition: padding $transition, font-size $transition, color $transition;
  border-radius: $radius;
  margin: 0;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  font-size: inherit;
  text-align: center;
  cursor: pointer;
  user-select: none;
  padding: 20px 15px 19px;
  width: 96px;
  width: calc(100% / 5);
  flex: 1 1 auto;
  flex: 1 1 calc(100% / 5);
  position: relative;
  z-index: 1;
}
</style>
