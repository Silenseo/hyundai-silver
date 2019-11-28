<template>
  <div class="list-component" :class="{ 'is-active': isActive }" v-on-clickaway="hide">
    <span class="selected-item list-item" :value="valueKey ? items[currentValue].valueKey : ''" @click.prevent="toggle">
      {{ textKey ? items[currentValue][textKey] : items[currentValue] }}
      <svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-dropdown-corner"></use></svg>
    </span>
    <transition name="list-fx" v-on:before-leave="isTransitionActive = true" v-on:after-leave="isTransitionActive = false">
      <div class="list-component-holder" v-show="isActive" v-bar="{ preventParentScroll: true, scrollThrottle: 30 }" v-if="hasScroll">
        <ul class="list">
          <list-item v-for="(item, key) in items" :key="key" :item="item" :textKey="textKey" :textKeyRight="textKeyRight" :valueKey="valueKey ? valueKey : key " :currentValue="currentValue" :disabled="false" @select="select" @hide="hide"></list-item>
        </ul>
      </div>
      <div class="list-component-holder" v-show="isActive" v-else>
        <ul class="list">
          <list-item v-for="(item, key) in items" :key="key" :item="item" :textKey="textKey" :textKeyRight="textKeyRight" :valueKey="valueKey ? valueKey : key " :currentValue="currentValue" :disabled="false" @select="select" @hide="hide"></list-item>
        </ul>
      </div>
    </transition>
  </div>
</template>

<script>
// TODO: add slots support instead of attribute-based dependencies

import ListItem from './ListItem'
import { mixin as clickaway } from 'vue-clickaway'

export default {
  name: 'List',
  mixins: [ clickaway ],
  data () {
    return {
      isActive: false,
      isTransitionActive: false,
      timeout: 0
    }
  },
  components: { ListItem },
  props: [ 'items', 'textKey', 'textKeyRight', 'valueKey', 'initialValue', 'hasScroll' ],
  computed: {
    currentValue: {
      get () {
        return this.initialValue
      },
      set (value) {
        this.$emit('change', value)
      }
    }
  },
  methods: {
    show (event) {
      clearTimeout(this.timeout)
      if (event && event.type === 'click') {
        this.isActive = true
      } else if (this.isTransitionActive === false) {
        this.isActive = true
      }
    },
    hide () {
      this.timeout = setTimeout(() => {
        this.isActive = false
      }, 100)
    },
    toggle () {
      this[this.isActive === true ? 'hide' : 'show']()
    },
    select (value) {
      this.currentValue = value
      this.hide()
    }
  }
}
</script>
<style lang="scss">
@import '../../assets/_mixins.scss';

$radius: 28px;

.list-component {
  font-size: 16px;
  line-height: 1;
  border: 1px solid #0f4d8f;
  border-radius: $radius;
  color: #fff;
  position: relative;
  z-index: 50;
  background: #013368;
  transition: all .15s cubic-bezier(.55,0,.1,1) 0s;
  &.is-active, &:hover, &:active {
    z-index: 51;
  }
  &.is-active {
    border-bottom-color: transparent;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    .selected-item {
      color: #416b97;
      .ic-svg {
        transform: scale(1, -1);
      }
    }
    .list-component-holder {}
  }
}
.list-component-holder {
  border-width: 0 1px 1px 1px;
  border-style: solid;
  border-color: transparent #0f4d8f #0f4d8f #0f4d8f;
  border-radius: 0 0 $radius $radius;
  position: absolute !important;
  left: -1px;
  right: -1px;
  top: 100%;
  padding: 0 69px 0 23px;
  width: auto;
  width: calc(100% + 2px);
  background: inherit;
  z-index: 0;
  will-change: transform;
}
.list {
  list-style: none;
  display: block;
  padding: 0;
  margin: 0;
}
.list-item.selected-item {
  padding: 20px 84px 19px 37px;
  position: relative;
  z-index: 1;
  &:hover {
    background: transparent;
  }
  .ic-svg {
    position: absolute;
    top: 50%;
    right: 32px;
    margin-top: -4px;
    fill: #00aed5;
    width: 12px;
    height: 8px;
    transition: transform .15s cubic-bezier(.55,0,.1,1) 0s;
    transform: scale(1);
  }
}

.list-fx-enter-active, .list-fx-leave-active {
  transition: opacity .15s cubic-bezier(.55,0,.1,1) 0s, transform .15s cubic-bezier(.55,0,.1,1) 0s;
}
.list-fx-enter, .list-fx-leave-active {
  opacity: 0;
  transform: translate(0,-20px)
}
</style>
