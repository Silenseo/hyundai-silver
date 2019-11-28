<template>
  <div class="gallery-header">
    <div class="gallery-header__name" v-if="title">{{ title }}</div>
    <div class="gallery-header__controls">
      <a v-if="download" :href="download" target="_blank" download="download" class="gallery-download"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-download"></use></svg>скачать</a>
      <a href="#" @click.prevent="close" class="close gallery-close"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-close"></use></svg></a>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Gallery',
  props: [ 'download', 'title' ],
  methods: {
    close () {
      this.$emit('close')
    }
  }
}
</script>

<style scoped lang="scss">
@import '../../../assets/_mixins.scss';

.gallery-header {
  position: absolute;
  user-select: none;
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
}</style>
