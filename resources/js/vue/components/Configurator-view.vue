<template>
  <div class="view">
    <transition name="fade" mode="out-in">
      <router-view class="view-item" :class="stepName"></router-view>
    </transition>
  </div>
</template>

<script>
export default {
  name: 'ConfiguratorView',
  computed: {
    stepName () {
      return this.$store.getters.GET_CURRENT_STEP && 'view-item--' + this.$store.getters.GET_CURRENT_STEP.toLowerCase()
    }
  }
}
</script>

<style lang="scss">
@import '../assets/_mixins.scss';

.view {
  position: relative;
  width: 100%;
  backface-visibility: hidden;
}
.view-item {
  width: 100%;
  max-width: 100%;
  min-width: 100%;
  position: relative;
  &#{&}--summary {
    background-color: #fbfbfb;
  }
}

</style>
