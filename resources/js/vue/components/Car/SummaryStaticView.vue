<template>
  <div class="summary-static-view" v-if="colors && id">
    <img class="summary-static__image" :src="staticImage">
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'SummaryStaticView',
  data () {
    return {
      isLoaded: false
    }
  },
  computed: {
    ...mapGetters({
      id: 'GET_EXTERIOR_COLOR',
      colors: 'GET_EXTERIOR_COLORS'
    }),
    staticImage () {
      return this.colors[this.id].carImage
    }
  }
}
</script>

<style lang="scss">
.summary-static-view {
  padding-top: 50px;
}
.summary-static__image {
  display: block;
  margin: 0 auto;
  pointer-events: none;
  user-select: none;
}
</style>
