<template>
  <div class="interior-view">
    <div class="interior-layer">
    <transition name="fade">
      <div class="panorama-layer" v-if="panorama">
        <panorama :source="panorama"></panorama>
      </div>
      <div class="static-layer" v-else-if="gallery">
        <img class="static-layer__image" :src="gallery[0]">
      </div>
      <pre v-else>Sorry, there is nothing to display.</pre>
    </transition>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import Panorama from './Panorama'

export default {
  name: 'InteriorView',
  components: { Panorama },
  data () {
    return {}
  },
  computed: {
    ...mapGetters({
      panorama: 'GET_PANORAMA',
      gallery: 'GET_GALLERY_NEW'
    })
  },
  methods: {}
}
</script>

<style scoped lang="scss">
@import '../../../../sass/common/variables';

.interior-view {
  position: relative;
  padding: 0 50px;
  height: 100%;
  .design-view-body {
    height: 100%;
  }
}
.interior-layer {
  position: relative;
  z-index: 1;
  padding-top: 0px;
  height: 100%;
}
.static-layer {
  position: relative;
  z-index: 2;
  margin: 0 auto;
  //height: 350px;
  height: 100%;
  width: 100%;
  overflow: hidden;
}
.static-layer__image {
  display: block;
  max-width: 100%;
}
.panorama-layer {
  height: 350px;
  position: relative;
}

@media only screen and (max-width : $lg-max) {
  .interior-layer {
    padding-top: 5px;
  }
  .interior-view {
    padding: 0 40px;
  }
}

@media only screen and (max-width : $md-max) {
  .interior-view {
    padding: 0 16px;
  }
}
</style>
