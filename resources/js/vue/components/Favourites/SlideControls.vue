<template>
  <div class="f-slide-controls">
    <button class="f-slide-control f-slide-control--prev" :class="{ 'disabled': isFirst }" @click="slidePrev" title="Previous">
		<svg width="9" height="18" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M8 1L1.57619 8.3415C1.24629 8.71852 1.24629 9.28148 1.57619 9.6585L8 17" stroke="white" stroke-width="2"/>
		</svg>
	</button>
    <button class="f-slide-control f-slide-control--next" :class="{ 'disabled': isLast }" @click="slideNext" title="Next">
		<svg width="9" height="18" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M1 17L7.42381 9.6585C7.75371 9.28148 7.75371 8.71852 7.42381 8.3415L1 0.999999" stroke="white" stroke-width="2"/>
		</svg>
	</button>
  </div>
</template>

<script>
export default {
  name: 'SlideControls',
  props: [ 'is-first', 'is-last' ],
  methods: {
    slideNext () {
      this.$emit('slideNext')
    },
    slidePrev () {
      this.$emit('slidePrev')
    }
  }
}
</script>

<style lang="scss" scoped>
  @import '../../assets/_mixins.scss';
  @import '../../../../sass/common/variables';
  .f-slide-controls {
	display: flex;
	align-items: center;
	justify-content: space-between;
	position: absolute;
	left: 0;
	right: 0;
	top: 72px;
	height: 0;
	z-index: 50;
  }
  .f-slide-control {
    @include button-reset;
    width: 40px;
    height: 40px;
    transition: color $tr-fast;
    cursor: default;
	background-color: rgba(0, 0, 0, 0.4);
	transition: 0.3s;
    &:not(.disabled) {
      color: #00aed5;
      cursor: pointer;
      pointer-events: auto;
      &:hover {
        opacity: 0.8;
      }
    }
  }
@media only screen and (max-width : $lg-max) {
	.f-slide-controls {
		display: none;
	}
}
</style>
