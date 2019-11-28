<template>
  <div class="gallery-thumbnails" v-if="images" v-show="total > 1">
    <ul class="gallery-thumbnails__holder" :style="holderStyle">
      <li class="gallery-thumbnail" v-for="(image, imageIndex) in images" :class="{ 'is-active': imageIndex === index }" :style="{ 'width': 100 / total + '%' }" @click="slideTo(imageIndex)">
        <span class="gallery-thumbnail__image" :style="{ 'background-image': 'url(' + image + ')' }"></span>
        <span class="gallery-thumbnail__inner"></span>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'Thumbnails',
  props: [ 'images', 'index', 'total', 'thumbnailsGrid' ],
  data () {
    return {
      localIndex: 0,
      leftLimit: 1,
      rightLimit: this.thumbnailsGrid - 1
    }
  },
  methods: {
    slideTo (to) {
      this.$emit('slideTo', to)
    }
  },
  computed: {
    shiftValue () {
      return 100 / this.total * this.localIndex
    },
    holderStyle () {
      return {
        'width': this.total / this.thumbnailsGrid * 100 + '%',
        'transform': 'translate3d(-' + this.shiftValue + '%, 0, 0)'
      }
    }
  },
  watch: {
    index (newValue) {
      if (this.index > this.rightLimit) {
        this.localIndex = this.localIndex + 1
        this.rightLimit = this.localIndex + (this.thumbnailsGrid - 1)
        this.leftLimit = this.rightLimit - (this.thumbnailsGrid - 1)
      }
      if (this.index < this.leftLimit) {
        this.localIndex = this.localIndex - 1
        this.rightLimit = this.localIndex + (this.thumbnailsGrid - 1)
        this.leftLimit = this.rightLimit - (this.thumbnailsGrid - 1)
      }
    }
  }
}
</script>

<style lang="scss">
@import '../../../assets/_mixins.scss';

.gallery-thumbnails {
  height: 120px;
}
.gallery-thumbnails__holder {
  margin: 0;
  padding: 0;
  display: flex;
  flex-flow: row nowrap;
  height: 100%;
  transition: transform .75s ease 0s;
  transform: translate3d(0,0,0);
  backface-visibility: hidden;
}
.gallery-thumbnail {
  background-color: #353535;
  height: 100%;
  flex-grow: 0;
  flex-shrink: 0;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition: opacity .15s cubic-bezier(.47,0,.74,.71) 0s;
  &::before {
    content: '';
    position: absolute;
    pointer-events: none;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    border: 2px dashed rgba(255,255,255, .25);
    border-radius: 50%;
    width: 25px;
    height: 25px;
    margin: auto;
    z-index: 1;
    animation: spin360 2s infinite linear;
  }
  &:not(.is-active):hover {
    opacity: .5;
  }
  &.is-active {
    cursor: default;
    .gallery-thumbnail__inner {
      opacity: 1;
      transform: scale(1);
    }
  }
}
.gallery-thumbnail__image {
  background-position: center center;
  background-size: cover;
  background-repeat: no-repeat;
  display: block;
  width: 100%;
  height: 100%;
  position: relative;
  z-index: 1;
  pointer-events: none;
  user-select: none;
}
.gallery-thumbnail__inner {
  position: absolute;
  pointer-events: none;
  left: 0;
  top: 0;
  bottom: 0;
  right: 0;
  border: 6px solid #00aed5;
  opacity: 0;
  transform: scale(1.25);
  transition: opacity .25s cubic-bezier(.17,.84,.44,1) 0s, transform .25s cubic-bezier(.17,.84,.44,1) 0s;
  z-index: 1;
}
@keyframes spin360 {
  0% {
    border-color: rgba(#fff, .25);
    transform: rotate(0deg);
  }
  50% {
    border-color: rgba(#00aed5, .5);
  }
  100% {
    border-color: rgba(#fff, .25);
    transform: rotate(360deg);
  }
}
</style>
