<template>
  <div class="panorama-component">
    <div class="panorama-element">
      <div id="pannellum" class="pannellum">
        <iframe class="pannellum-frame" :src="path"></iframe>
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
      baseUrl: process.env.NODE_ENV === 'production' ? 'https://www.hyundai.ru/config_src/dist' : '',
      frameBase: '/static/pannellum/pannellum.htm?autoLoad=true&panorama='
    }
  },
  computed: {
    path () {
      return this.baseUrl + this.frameBase + this.source
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
