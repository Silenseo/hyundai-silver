<template>
  <transition name="slide-up">
  <div class="gallery" v-if="isActive">
    <headerLine :title="title" :donwload="donwloadLink" @close="close"></headerLine>
    <div class="gallery-view">
      <slider :images="images" :index="index" :total="total"></slider>
      <thumbnails :images="images" :index="index" :total="total" :thumbnailsGrid="6" @slideTo="slide"></thumbnails>
      <controls :images="images" :index="index" :total="total" @slideTo="slide"></controls>
    </div>
  </div>
  </transition>
</template>

<script>
import { mapGetters } from 'vuex'
import headerLine from './headerLine'
import Slider from './Slider'
import Thumbnails from './Thumbnails'
import Controls from './Controls'

export default {
  name: 'Gallery',
  components: { headerLine, Slider, Thumbnails, Controls },
  data () {
    return {
      index: 0
    }
  },
  computed: {
    ...mapGetters({
      images: 'GET_GALLERY',
      app_state: 'GET_APP_STATE',
      title: 'GET_CAR_NAME'
    }),
    total () {
      return this.images.length
    },
    isActive () {
      return this.app_state.gallery
    },
    donwloadLink () {
      return this.images[this.index]
    }
  },
  methods: {
    close () {
      this.$root.$emit('fixOverflow', false)
      this.$store.dispatch('SET_APP_STATE', { gallery: false })
    },
    slide (to) {
      this.index = to
    }
  }
}
</script>

<style scoped lang="scss">
@import '../../../assets/_mixins.scss';

.gallery {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  height: 100vh;
  max-height: 100vh;
  min-height: 100vh;
  width: 100vw;
  min-width: 1180px;
  overflow: hidden;
  background: #fff;
  z-index: 800;
}
.gallery-header {
  position: absolute;
  width: 100%;
  left: 0;
  right: 0;
  top: 0;
  z-index: 2;
  height: 70px;
  line-height: 1;
  padding: 0 60px;
  background: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.gallery-header__name {
  color: #353535;
  font-size: 40px;
  letter-spacing: .01em;
  font-weight: 500;
}
.gallery-header__controls {
  display: flex;
  align-items: center;
}
.gallery-download {
  font-size: 12px;
  text-transform: uppercase;
  color: #bababa;
  vertical-align: middle;
  transition: color $tr-fast;
    .ic-svg {
      width: 26px;
      height: 26px;
      margin-right: 15px;
    }
  &:hover {
    color: $hollow;
  }
}
.gallery-close {
  width: 70px;
  height: 70px;
  padding: 0 20px;
  margin: 0 -20px 0 62px;
  color: $sky;
  position: relative;
  transition: color $tr-fast;
  .ic-svg {
    @include abs-center;
    width: 28px;
    height: 28px;
  }
  &:hover {
    opacity: 1;
    color: #1bc6ec;
  }
}
.gallery-view {
  position: relative;
  padding-top: 70px;
  height: 100%;
  background: #353535;
}
</style>
