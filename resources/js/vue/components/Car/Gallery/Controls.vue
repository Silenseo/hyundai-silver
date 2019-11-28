<template>
  <div class="gallery-controls">
    <div class="gallery-arrows" v-if="total > 1">
      <span class="gallery-arrow gallery-arrow--previous" :class="{ 'is-disabled' : index <= 0 }" title="Previous" @click.prevent="slideBack">
        <svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-gallery-arrow"></use></svg>
      </span>
      <span class="gallery-arrow gallery-arrow--next" :class="{ 'is-disabled' : (index + 1) >= total }" title="Next" @click.prevent="slideForward">
        <svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-gallery-arrow"></use></svg>
      </span>
    </div>
    <div class="gallery-counter" :class="{ 'is-single': total === 1 }">
      <span class="gallery-counter__item">{{ index + 1 | counterFormat }}</span> / <span class="gallery-counter__item">{{ total | counterFormat }}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Thumbnails',
  props: [ 'images', 'index', 'total', 'maxCount' ],
  methods: {
    slideTo (to) {
      this.$emit('slideTo', to)
    },
    slideBack () {
      let newIndex = this.index > 0 ? this.index - 1 : 0
      this.slideTo(newIndex)
    },
    slideForward () {
      let newIndex = (this.index + 1) < (this.total - 1) ? this.index + 1 : (this.total - 1)
      this.slideTo(newIndex)
    }
  },
  filters: {
    counterFormat (value) {
      return value < 10 ? '0' + String(value) : String(value)
    }
  }
}
</script>

<style lang="scss">
@import '../../../assets/_mixins.scss';

.gallery-controls {
  user-select: none;
  position: static;
}
.gallery-arrows {
  position: absolute;
  z-index: 1;
  top: 70px;
  left: 60px;
  right: 60px;
  bottom: 120px;
  height: 0;
  margin: auto;
}
.gallery-arrow {
  position: absolute;
  width: 60px;
  height: 60px;
  top: -30px;
  cursor: pointer;
  transition: opacity .15s cubic-bezier(.47,0,.74,.71) 0s;
  &::before {
    content: '';
    border-radius: 50%;
    position: absolute;
    background: #00aed5;
    width: 70px;
    height: 70px;
    left: 50%;
    top: 50%;
    margin: -35px 0 0 -35px;
    transition: transform .15s cubic-bezier(.47,0,.74,.71) 0s;
    transform: scale(0.85);
  }
  &::before {}
  .ic-svg {
    fill: #fff;
    width: 14px;
    height: 24px;
    @include abs-center;
    transform: translate(2px, 0);
  }
  &:hover {
    &::before {
      transform: scale(1);
    }
  }
  &#{&}--previous {
    left: 0;
    .ic-svg {
      transform: scale(-1, 1) translate(1px, 0);
    }
  }
  &#{&}--next {
    right: 0;
  }
  &.is-disabled {
    pointer-events: none;
    cursor: default;
    opacity: .5;
  }
}
.gallery-counter {
  font-size: 16px;
  color: #fff;
  pointer-events: none;
  white-space: nowrap;
  line-height: 1;
  width: 60px;
  display: flex;
  justify-content: space-between;
  z-index: 1;
  position: absolute;
  right: 60px;
  bottom: 160px;
  &.is-single {
    bottom: 40px;
  }
}
.gallery-counter__item {
  &:first-of-type {
    font-weight: 600;
  }
}
</style>
