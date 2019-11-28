<template>
  <li class="list-item" :value="item[valueKey] ? item[valueKey] : valueKey" @click.prevent="click(valueKey)" :class="classes">
    <template v-if="textKeyRight">
      <span>{{ textKey ? item[textKey] : item }}</span> <span v-if="textKeyRight && item[textKeyRight]">{{ item[textKeyRight] }}</span>
    </template>
    <template v-else>
      {{ textKey ? item[textKey] : item }}
    </template>
  </li>
</template>

<script>
export default {
  name: 'ListItem',
  props: [ 'item', 'textKey', 'textKeyRight', 'valueKey', 'currentValue', 'disabled' ],
  computed: {
    classes () {
      return {
        'is-active': this.item[this.valueKey] === this.currentValue,
        'is-composite': this.textKeyRight
      }
    }
  },
  methods: {
    click (newValue) {
      if (this.item[newValue]) {
        this.item[newValue] !== this.currentValue ? this.select(this.item[newValue]) : this.hide()
      } else {
        newValue !== this.currentValue ? this.select(newValue) : this.hide()
      }
    },
    select (value) {
      this.$emit('select', value)
    },
    hide () {
      this.$emit('hide')
    }
  }
}
</script>
<style lang="scss">
@import '../../assets/_mixins.scss';
$baseTransition: .05s ease-in-out 0s;
$hoverTransition: .15s ease-in-out 0s;

.list-item {
  &.is-active {
    text-decoration: underline;
    &.is-composite {
      text-decoration: none;
      span:nth-of-type(1) {
        text-decoration: underline;
      }
    }
  }
  &:hover {
    background: #00aed5;
    transition: background $hoverTransition, color $hoverTransition;
  }
  transition: background $baseTransition, color $baseTransition;
  border-radius: 23px;
  margin: 0;
  padding: 14px 15px 12px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  font-size: inherit;
  cursor: pointer;
  user-select: none;
  display: block;
  &:not(.selected-item):last-of-type {
    margin-bottom: 23px;
  }
  &.is-composite {
    display: flex;
    justify-content: space-between;
    align-items: center;
    span + span {
      text-decoration: none;
    }
  }
}
</style>
