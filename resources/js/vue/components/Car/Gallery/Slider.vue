<template>
  <div class="gallery-slider">
    <ul class="gallery-slider__holder" :style="shiftStyle">
      <li class="gallery-slide" v-for="(image, imageIndex) in images" :class="{ 'is-active': imageIndex === index }" :style="{ 'width': 100 / total + '%' }">
        <span class="gallery-image" :style="{ 'background-image': 'url(' + image + ')' }"></span>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'Gallery',
  props: [ 'images', 'index', 'total' ],
  computed: {
    shiftStyle () {
      return {
        'width': this.total * 100 + '%',
        'transform': 'translate3d(-' + 100 / this.total * this.index + '%, 0, 0)'
      }
    }
  }
}
</script>

<style scoped lang="scss">
@import '../../../assets/_mixins.scss';


.gallery-slider {
  position: relative;
  height: calc(100% - 120px);
  z-index: 1;
  color: #fff;
}
.gallery-slider__holder {
  margin: 0;
  padding: 0;
  display: flex;
  flex-flow: row nowrap;
  height: 100%;
  transition: transform .75s ease 0s;
  transform: translate3d(0,0,0);
  backface-visibility: hidden;
}
.gallery-slide {
  background-color: #353535;
  height: 100%;
  flex-grow: 0;
  flex-shrink: 0;
  position: relative;
  overflow: hidden;
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
    width: 50px;
    height: 50px;
    margin: auto;
    z-index: 1;
    animation: spin360 2s infinite linear;
  }
}
.gallery-image {
  background-position: center top;
  background-size: cover;
  background-repeat: no-repeat;
  display: block;
  width: 100%;
  height: 100%;
  position: relative;
  z-index: 1;
  pointer-events: none;
  user-select: none;
  user-select: none;
  pointer-events: none;
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
