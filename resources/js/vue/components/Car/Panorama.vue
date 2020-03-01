<template>
  <div class="panorama-component">
    <div class="panorama-element">
      <div id="pannellum" class="pannellum">
        <!-- <iframe class="pannellum-frame" :src="path"></iframe> -->
      </div>
    </div>
  </div>
</template>

<script>
import Loader from '@/components/Loader'

export default {
  name: 'Panorama',
  components: { Loader },
  props: [ 'source' ],
  data () {
    return {
      viewer: null,
      baseUrl: process.env.NODE_ENV === 'production' ? '' : '',
      frameBase: 'https://cdn.pannellum.org/2.5/pannellum.htm#panorama='
    }
  },
  computed: {
    path () {
      return this.baseUrl + this.frameBase + this.source + '&amp;amp;autoLoad=true'
    }
  },
  methods: {
    init () {
      if (this.viewer) this.viewer.destroy();

      if (document.querySelector('#pannellum')) {
        this.viewer = pannellum.viewer('pannellum', {
          "type": "equirectangular",
          "autoLoad": true,
          "panorama": this.source
        });
      }
    }
  },
  activated () {
    this.init()
  },
  watch: {
    source () {
      this.init()
    }
  }
}
</script>

<style lang="scss">
@import '../../assets/_mixins.scss';
.pannellum {
  width: 100%;
  height: 350px;
}
.pannellum-frame {
  display: block;
  width: 100%;
  height: 350px;
}
</style>
