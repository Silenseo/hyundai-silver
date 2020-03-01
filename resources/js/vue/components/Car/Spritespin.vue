<template>
  <div class="spritespin-component" :class="{ 'is-loading': !isLoaded }">
    <transition name="fade">
      <div class="spritespin-backstage" v-show="!isLoaded">
        <img class="spritespin-backstage__image" :src="lastFrameSrc">
        <loader/>
      </div>
    </transition>
    <transition name="fade" v-on:after-leave="set360">
      <div class="spritespin-element" v-show="isLoaded">
        <div id="spritespin"></div>
        <!-- <div class="sprintespin-360">
          <button class="df-360" aria-label="360"></button>
        </div> -->
      </div>
    </transition>
    <div v-if="show360" class="spritespin-360">
      <img src="../../assets/image/360.svg" alt="">
    </div>
  </div>
</template>

<script>
import 'jquery'
import '@/assets/lib/spritespin.min.js'
import Loader from '@/components/Loader'
import { log } from 'util';
import { longStackSupport } from 'q';

export default {
  name: 'Spritespin',
  components: { Loader },
  props: [ 'ID', 'frames' ],
  data () {
    return {
      isLoaded: false,
      frame: 4,
      lastFrameSrc: '',
      $spritespin: null,
      show360: true
    }
  },
  computed: {
    sourceArray () {
      let result = []
      if (this.frames[this.ID]) {
        let folder = this.frames[this.ID].folder
        let ext = this.frames[this.ID].extension
        let sum = (this.frames[this.ID].sum ? this.frames[this.ID].sum : 36)
        for (var i = 0; i < sum; i++) {
          result.push(folder + '/' + i + '.' + ext)
        }
      } else {
        let folder = this.frames.folder
        let ext = this.frames.extension
        let sum = (this.frames.sum ? this.frames.sum : 36)

        for (var j = 0; j < sum; j++) {
          result.push(folder + '/' + j + '.' + ext)
        }
      }
      return result
    }
  },
  methods: {
    set360 () {
      const vm = this
      if (vm.frames[vm.ID]) {
        console.log('frames', (vm.frames[vm.ID].sum ? vm.frames[vm.ID].sum : 36))
        this.$spritespin.spritespin({
          source: vm.sourceArray,
          height: 316,
          width: 700,
          animate: false,
          behavior: 'drag',
          frame: vm.frame,
          frames: (vm.frames[vm.ID].sum ? vm.frames[vm.ID].sum : 36),
          frameTime: 40,
          lanes: 1,
          mods: ['drag', '360'],
          module: null,
          renderer: 'canvas',
          reverse: false,
          scrollThreshold: 500,
          onInit: function () {
            vm.isLoaded = false
          },
          onProgress: function () {
            vm.$emit('lockControls', false)
          },
          onLoad: function () {
            vm.isLoaded = true
            vm.$emit('lockControls', false)
          },
          onFrame: function () {
            if (vm.show360 && vm.isLoaded) {
              vm.show360 = false;
            }
          },
        }).spritespin('api')

        let api = this.$spritespin.spritespin('api')
        this.$spritespin.bind('onFrame', function () {
          vm.frame = api.data.frame
          vm.lastFrameSrc = api.data.source[vm.frame]
        })
      } else {
        this.$spritespin.spritespin({
          source: vm.sourceArray,
          height: 316,
          width: 700,
          animate: false,
          behavior: 'drag',
          frame: vm.frame,
          frames: (vm.frames.sum ? vm.frames.sum : 36),
          frameTime: 40,
          lanes: 1,
          mods: ['drag', '360'],
          module: null,
          renderer: 'canvas',
          reverse: false,
          scrollThreshold: 500,
          onInit: function () {
            vm.isLoaded = false
          },
          onProgress: function () {
            vm.$emit('lockControls', false)
          },
          onLoad: function () {
            vm.isLoaded = true
            vm.$emit('lockControls', false)
          },
          onFrame: function () {
            if (vm.show360 && vm.isLoaded) {
              vm.show360 = false;
            }
          }
        }).spritespin('api')

        let api = this.$spritespin.spritespin('api')
        this.$spritespin.bind('onFrame', function () {
          vm.frame = api.data.frame
          vm.lastFrameSrc = api.data.source[vm.frame]
        })
      }
    }
  },
  mounted () {
    this.$spritespin = $('#spritespin')
    if (this.$spritespin.length > 0) {
      this.set360()
    }
  },
  activated () {
    this.$spritespin = $('#spritespin')
    if (this.$spritespin.length > 0) {
      this.$emit('lockControls', true)
      this.set360()
    }
  },
  watch: {
    ID (value) {
      if (this.isLoaded === false) {
        this.set360()
      }
      this.$emit('lockControls', true)
      this.isLoaded = false
    }
  }
}
</script>

<style lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.spritespin-360 {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  width: 72px;
  height: 72px;
  border-radius: 50%;
  pointer-events: none;
  z-index: 1;
  img {
    display: block;
    max-width: 100%;
    height: auto;
  }
}
.spritespin-component {
  position: relative;
  width: 100%;
  max-width: 700px;
  height: 100%;
  margin: 0 auto;
  .loader-overlay {
    background: transparent;
  }
  .loader {
    font-size: 9px;
    margin-top: -20px;
  }
}
.spritespin-element {
  height: 100%;
  transition: opacity .15s ease-in;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.spritespin-instance {
  margin: 0 auto;
  cursor: move;
  cursor: grab;
  cursor: -moz-grab;
  cursor: -webkit-grab;
  &:active {
    cursor: grabbing;
    cursor: -moz-grabbing;
    cursor: -webkit-grabbing;
  }
}
.spritespin-backstage {
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
.spritespin-backstage__image {
  pointer-events: none;
  display: block;
  margin: auto;
}
.is-loading {
  .spritespin-backstage {
    transition: opacity .15s;
  }
}

@media only screen and (max-width : $lg-max) {
  .spritespin-component {
    max-width: 700px;
  }
}

@media only screen and (max-width : $md-max) {
  .spritespin-component {
    max-width: 100%;
  }
  .exterior-controls {
    display: none;
  }
}
</style>
