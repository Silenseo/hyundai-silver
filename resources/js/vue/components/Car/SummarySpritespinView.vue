<template>
  <div class="summary-spritespin" @touchstart="show360icon = false" @mousedown="show360icon = false" :class="{ 'is-loading': !isLoaded }">
    <div id="summary-spritespin" class="summary-spritespin-instance"></div>
    <transition v-if="isLoaded">
      <div class="view__preloader" v-if="show360icon">
        <img  class="view__img" src="/images/icons/360.svg">
      </div>
    </transition>
    <transition v-else>
       <loader></loader>
    </transition>
  </div>
</template>

<script>
import * as SpriteSpin from "spritespin"
import Loader from '@/components/Loader'
import { setTimeout } from 'timers';

export default {
  name: 'SummarySpritespinView',
  props: [ 'sources', 'ID' ],
  components: { Loader },
  data () {
    return {
      spritespinAPI: null,
      isLoaded: false,
      $spritespin: null,
      progress: 0,
      frame: 0,
      currentID: 0,
      show360icon: true
    }
  },
  computed: {
     sourceArray () {
      let result = []
      if (this.sources[this.ID]) {
        let folder = this.sources[this.ID].folder
        let ext = this.sources[this.ID].extension
        let sum = (this.sources[this.ID].sum ? this.sources[this.ID].sum : 36)
        for (var i = 0; i < sum; i++) {
          result.push(folder + '/' + i + '.' + ext)
        }
      } else {
        let folder = this.sources.folder
        let ext = this.sources.extension
        let sum = (this.sources.sum ? this.sources.sum : 36)

        for (var j = 0; j < sum; j++) {
          result.push(folder + '/' + j + '.' + ext)
        }
      }
      return result
    }
  },
  methods: {
    set () {
      var that = this;

      if (that.sources[that.ID]) {

          this.$spritespin = $("#summary-spritespin").spritespin({
            source: that.sourceArray,
            animate: false,
            frames: (that.sources[that.ID].sum ? that.sources[that.ID].sum : 36),
            frameTime: 40,
            // frame: that.frame,
            lanes: 1,
            module: null,
            renderer: 'canvas',
            reverse: false,
            scrollThreshold: 500,
    				responsive: true,
            onLoad: function () {
              that.isLoaded = true
              that.currentID = that.ID
            }
          });
      } else {
          this.$spritespin = $("#summary-spritespin").spritespin({
            source: that.sourceArray,
            animate: false,
            frames: (that.sources.sum ? that.sources.sum : 36),
            frameTime: 40,
            // frame: that.frame,
            lanes: 1,
            module: null,
            renderer: 'canvas',
            reverse: false,
            scrollThreshold: 500,
    				responsive: true,
            onLoad: function () {
              that.isLoaded = true
              that.currentID = that.ID
            }
          });
      }

      this.spritespinAPI = $("#summary-spritespin").spritespin('api');
    },
    unset () {
      if (this.$spritespin.length > 0) {
        this.isLoaded = false
        this.$spritespin.spritespin('destroy')
      }
    }
  },
  mounted () {
    this.$nextTick(()=>{
      this.set()
    })
  },
  beforeDestroy () {
    this.unset()
  },
  activated () {
    if (this.currentID !== this.ID) {
      this.set()
    }
  }
}
</script>

<style lang="sass">
@import '../../../../sass/common/variables'

#summary-spritespin
  position: absolute!important
  top: 0
  left: 0
  right: 0
  bottom: 0

.view
  &__preloader
    display: block
    position: absolute
    top: 0
    right: 0
    bottom: 0
    left: 0
    margin: auto
    width: 88px
    height: 88px
    border-radius: 50%
    background-color: rgba(#000000, 0.7)
    pointer-events: none
    img
      display: block
      position: absolute
      top: 0
      left: 0
      right: 0
      bottom: 0
      margin: auto
    &__progress
      display: block
      position: absolute
      top: 0
      left: 0
      right: 0
      bottom: 0
      margin: auto
      line-height: 88px
      font-size: 20px
      color: #fff
      font-weight: 500
      text-align: center

@media only screen and (max-width : $lg-max)
  .view
    &__preloader
      width: 72px
      height: 72px

</style>
<style lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.summary-spritespin {
  position: relative;
  width: 100%;
  height: 100%;
  max-width: 910px;
  margin: 0 auto;
  .loader-overlay {
    background: transparent;
  }
  .loader {
    font-size: 8px;
    margin-top: -20px;
  }
}
.summary-spritespin::after {
  content: '';
  display: block;
  top: 0;
  left: 0;
  padding-top: 45%;
}
.summary-spritespin-element {
  transition: opacity .15s ease-in;
  margin: 0 auto;
  position: relative;
  height: 100%;
  max-width: 910px;
  z-index: 1;
}
.summary-spritespin-instance {
  // width: 100% !important;
  cursor: move;
  cursor: grab;
  cursor: -moz-grab;
  cursor: -webkit-grab;
  margin: 0 auto;
  &:active {
    cursor: grabbing;
    cursor: -moz-grabbing;
    cursor: -webkit-grabbing;
  }
  .spritespin-canvas {
    margin: 0 auto;
    // width: 700px !important;
  }
}
.summary-spritespin-backstage {
  cursor: wait;
  transition-delay: .25s;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  margin: auto;
  z-index: 0;
  min-height: 320px;
}
.spritespin-slider {
  position: absolute;
  width: 670px;
  height: 52px;
  left: 0;
  right: 0;
  top: 350px;
  margin: 0 auto;
  background: transparent url('../../assets/image/360_path.png') no-repeat center bottom / contain;
}
.spritespin-slider__point {
  background: $hollow;
  border-radius: 50%;
  width: 40px;
  height: 0px;
  position: absolute;
  // margin-left: -20px;
  top: 31px;
  // left: 0;
  left: 50%;
  transform: translate(-50%, 0);
  .ic-svg {
    top: 13px;
    fill: #fff;
    position: absolute;
    display: none;
    &:nth-of-type(1) {
      transform: rotate(90deg);
      left: 6px;
    }
    &:nth-of-type(2) {
      transform: rotate(-90deg);
      right: 6px;
    }
  }
  &::after {
    content: '360°';
    position: absolute;
    font-size: 14px;
    color: #c7c7c7;
    top: 45px;
    left: 5px;
    right: 0;
    margin: auto;
    text-align: center;
  }
}

@media only screen and (max-width : $xl-max) {
  .summary-spritespin {
    max-width: 720px;
  }
}
@media only screen and (max-width : $md-max) {
  .car-view-item.summary {
    padding-top: 40px;
  }
  .summary-sticker {
    display: none;
  }
  .summary-layer {
    min-width: 100%;
    margin-left: -16px;
    margin-right: -16px;
  }
  .summary-view {
    padding: 16px;
    padding-bottom: 0;
    height: auto;
  }
  .summary-prices {
    position: relative;
    bottom: 0;
    margin-bottom: 16px;
  }
  .summary-car-view {
    min-width: 100%;
    margin-left: -16px;
    margin-right: -16px;
    height: 45vw;
  }
}
</style>
