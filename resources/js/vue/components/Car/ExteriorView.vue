<template>
  <transition name="fade">
  <div class="exterior-view">
    <div class="exterior-layer">
      <div class="spritespin-layer" v-if="exteriorSources">
        <spritespin :ID="ID" :frames="exteriorSources" @lockControls="lockControls"></spritespin>
      </div>
      <div class="static-layer" v-else>
        <img class="static-layer__image" :src="colors[ID].carImage">
      </div>
    </div>
    <div class="exterior-controls">
      <a href="#" @click.prevent="change('prev')" class="exterior-control exterior-control--prev" title="Предыдущий">
        <svg aria-hidden="true">
            <use xlink:href="#ic-big-arrow-left"></use>
        </svg>
      </a>
      <a href="#" @click.prevent="change('next')" class="exterior-control exterior-control--next" title="Следующий">
        <svg aria-hidden="true">
            <use xlink:href="#ic-big-arrow-right"></use>
        </svg>
      </a>
    </div>
  </div>
  </transition>
</template>

<script>
import { mapGetters } from 'vuex'
import Spritespin from './Spritespin'

export default {
  name: 'ExteriorView',
  components: { Spritespin },
  data () {
    return {
      isControlsLocked: false
    }
  },
  computed: {
    ...mapGetters({
      colors: 'GET_EXTERIOR_COLORS',
      colorsArray: 'GET_EXTERIOR_COLORS_ARRAY'
    }),
    exteriorSources () {
      return this.$store.getters.GET_360
    },
    ID: {
      get () {
        return this.$store.getters.GET_EXTERIOR_COLOR
      },
      set (value) {
        this.$store.dispatch('UPDATE_EXTERIOR_COLOR', value)
      }
    },
    total () {
      return this.colorsArray.length - 1
    },
    current () {
      return this.colorsArray.indexOf(this.ID)
    },
    prevID () {
      return this.colorsArray[this.current > 0 ? this.current - 1 : this.total]
    },
    nextID () {
      return this.colorsArray[this.current < this.total ? this.current + 1 : 0]
    },
    currentBG () {
      return this.colors[this.ID].bgImage
    },
    prevBG () {
      return this.colors[this.prevID].bgImage
    },
    nextBG () {
      return this.colors[this.nextID].bgImage
    }
  },
  methods: {
    change (direction) {
      if (this.isControlsLocked === false) {
        this.ID = direction === 'next' ? this.nextID : this.prevID
      }
    },
    lockControls (value) {
      this.isControlsLocked = value
    }
  }
}
</script>

<style scoped lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.exterior-view {
  height: 100%;
  position: relative;
}
.exterior-layer {
  height: 100%;
  position: relative;
  z-index: 1;
}
.exterior-controls  {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  width: calc(100% - 80px);
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
  z-index: 1;
  top: 50%;
}
.exterior-control  {
  position: absolute;
  width: 16px;
  height: 36px;
  overflow: hidden;
  transition: all .25s;
  will-change: transform, width, height, margin;
  margin-top: -18px;
  svg {
    display: block;
    max-width: 100%;
    max-height: 100%;
    stroke: #000;
    fill: none;
  }
  &#{&}--prev {
    left: 0;
  }
  &#{&}--next {
    right: 0;
  }
}
.exterior-control__inner {
  transition: all .25s;
  user-select: none;
  pointer-events: none;
  display: block;
  height: 200px;
  width: 200px;
  background-size: 200px 200px;
  background-repeat: no-repeat;
  background-position: 0 0;
  position: absolute;
  top: 50%;
  margin-top: -100px;
}
.exterior-bg-current {
  height: 320px;
  width: 320px;
  border-radius: 50%;
  position: absolute;
  z-index: 1;
  pointer-events: none;
  user-select: none;
  overflow: hidden;
  left: 50%;
  transform: translate(-50%, 0);
}
.exterior-bg-current__inner {
  height: 320px;
  width: 320px;
  display: block;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
}
.static-layer {
  position: relative;
  z-index: 2;
  margin: 0 auto;
}
.static-layer__image {
  display: block;
  margin: 0 auto;
  pointer-events: none;
  user-select: none;
}
.spritespin-layer {
  height: 100%;
  position: relative;
  z-index: 3;
  margin: 0 auto;
}
.spritespin-instance {
  margin: 0 auto;
}

@media only screen and (max-width : $lg-max) {
  .exterior-controls {
    width: calc(100% - 80px);
    max-width: 100%;
  }
}

@media only screen and (max-width : $md-max) {

}
</style>
