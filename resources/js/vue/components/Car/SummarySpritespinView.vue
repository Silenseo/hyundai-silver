<template>
  <div class="summary-spritespin" :class="{ 'is-loading': !isLoaded }">
    <transition name="fade">
      <div class="summary-spritespin-backstage" v-show="!isLoaded">
        <loader></loader>
      </div>
    </transition>
    <transition name="fade" v-on:after-leave="set">
      <div class="summary-spritespin-element" v-show="isLoaded">
        <div id="summary-spritespin" class="summary-spritespin-instance"></div>
        <!-- <div class="spritespin-slider"> -->
          <!-- <span class="spritespin-slider__point" :style="pointStyle"> -->
          <!-- <span class="spritespin-slider__point">
            <svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-dropdown-corner"></use></svg>
            <svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-dropdown-corner"></use></svg>
          </span> -->
        <!-- </div> -->
      </div>
    </transition>
  </div>
</template>

<script>
import 'jquery'
import '@/assets/lib/spritespin.min.js'
import Loader from '@/components/Loader'
import { setTimeout } from 'timers';

export default {
  name: 'SummarySpritespinView',
  props: [ 'sources', 'ID' ],
  components: { Loader },
  data () {
    return {
      isLoaded: false,
      $spritespin: null,
      progress: 0,
      frame: 0,
      currentID: 0
    }
  },
  computed: {
    // pointStyle () {
    //   let X = this.progress * 670 / 50
    //   let Y = 30 * Math.cos((X + 200) / 200 - 9) - 30
    //   // console.log(Y)
    //   return {
    //     'transform': 'translate(' + X + 'px,' + Y + 'px)'
    //     // 'transform': 'translate(' + X + 'px, 0)'
    //   }
    // }
  },
  methods: {
    sourceArray () {
      let folder = this.sources[this.ID].folder
      let ext = this.sources[this.ID].extension
      let result = []
      for (var i = 0; i < 36; i++) {
        result.push(folder + '/' + i + '.' + ext)
      }
      return result
    },
    set () {
      const vm = this
      this.$spritespin = this.$spritespin && this.$spritespin.length > 0 ? this.$spritespin : $('#summary-spritespin')
      if (this.$spritespin.length === 0) {
        this.$spritespin = $('#summary-spritespin')
      }
      this.$spritespin.spritespin({
        source: vm.sourceArray(),
        height: 411,
        width: 910,
        animate: false,
        behavior: 'drag',
        frame: 0,
        frames: 36,
        frameTime: 40,
        lanes: 1,
        mods: ['drag', '360'],
        module: null,
        renderer: 'canvas',
        reverse: false,
        scrollThreshold: 500,
        //responsive: true,
        onInit: function () {
          vm.isLoaded = false
        },
        onLoad: function () {
          vm.currentID = vm.ID
          vm.isLoaded = true
        }
      })
      // let api = this.$spritespin.spritespin('api')
      // this.$spritespin.bind('onFrame', function (ev) {
      //   vm.frame = api.data.frame
      //   vm.progress = Math.ceil(vm.frame / 36 * 100)
      // })
    },
    unset () {
      if (this.$spritespin.length > 0) {
        this.isLoaded = false
        this.$spritespin.spritespin('destroy')
      }
    }
  },
  mounted () {
    this.set()
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

<style lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.summary-car-view {
  height: calc((100vw - 144px) * 0.45);
  max-height: calc(910px * 0.45);
}
.summary-spritespin {
  position: relative;
  width: 100%;
  height: 100%;
  .loader-overlay {
    background: transparent;
  }
  .loader {
    font-size: 8px;
    margin-top: -20px;
  }
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

#summary-spritespin {
  width: 100% !important;
  height: 100% !important;
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
