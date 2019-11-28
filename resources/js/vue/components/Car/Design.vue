<template>
  <div class="step">
    <div class="step__content design container">
      <div style="height: 100%" class="row">
        <div style="height: 100%" class="col-md-12">
          <div class="content-wrapper">
            <div class="content-main">
              <transition name="fade">
                <loader v-if="!isDesignReady"/>
              </transition>
              <div class="content-main__inner">
                <transition name="component-fade" mode="out-in">
                  <keep-alive>
                  <component class="design-view" :is="designView" @subRoute="subRoute"></component>
                  </keep-alive>
                </transition>
              </div>
            </div>
            <div class="content-aside">
              <sidebar/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Sidebar from '@/components/Car/Sidebar'
import Exterior from '@/components/Car/Exterior'
import Interior from '@/components/Car/Interior'
import Loader from '@/components/Loader'

export default {
  name: 'Design',
  components: { Sidebar, Interior, Exterior, Loader },
  data () {
    return {
      designView: 'exterior',
      transitionName: 'slide-left'
    }
  },
  computed: {
    isDesignReady () {
      return this.$store.getters.GET_APP_STATE['isDesignReady']
    }
  },
  methods: {
    subRoute (to, fade) {
      this.transitionName = fade === true ? 'fade' : (to === 'interior' ? 'slide-left' : 'slide-right')
      this.designView = to
    }
  },
  deactivated () {
    this.subRoute('exterior', true)
  },
  activated () {
    this.subRoute('exterior', true)
  }
}
</script>

<style scoped lang="scss">
@import '../../../../sass/common/variables';

.content-main__inner {
  height: 100%;
  min-height: 100%;
}

@media only screen and (max-width : $lg-max) {
  .content-main__inner {
    height: auto;
  }
}
</style>

<style lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.component-fade-enter-active, .component-fade-leave-active {
  transition: opacity .3s ease;
}
.component-fade-enter, .component-fade-leave-to {
  opacity: 0;
}

.design {
  .content-footer {
    padding: 0 50px;
  }
  .content-main__inner {
    padding-bottom: 0;
  }
}
.design-view {
  // position: absolute;
  // width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  min-height: 100%;
}
.design-view__inner {}
.design-view-body {
  position: relative;
  height: calc(700px * 0.45);
}
.design-layer {
  height: 100%;
  position: relative;
}
.design-layer__main {
  height: 100%;
  position: relative;
  overflow: hidden;
  @media (max-height: 670px) {
    //transform: translate(0, -15px);
  }
  @media (min-height: 800px) {
    //top: 35%;
    transform: translate(0, 20%)
  }
}

.button--subroute {
  padding-left: 55px;
  padding-right: 40px;
  align-self: flex-end;
}
.color-groups, .color-list {
  font-size: 0;
  letter-spacing: 0;
  line-height: 1;
  list-style: none;
}
.color-groups {
  display: flex;
  justify-content: start;
  align-items: start;
}
.color-group {
  flex: none;
  margin-right: 26px;
}
.color-group__name, .color-group__cost {
  font-size: 1.6rem;
  font-weight: 400;
  color: #000000;
  display: inline-block;
  margin-bottom: 12px;
  cursor: default;
  user-select: none;
  white-space: nowrap;
}
.color-group__cost {
  font-weight: 500;
}
.color-list {
  display: flex;
  //flex-flow: row wrap;
}
.color-list__item {
  display: block;
  margin-right: 8px;
  margin-bottom: 8px;
}
.color-selector {
  width: 32px;
  height: 32px;
  position: relative;
  display: block;
  cursor: pointer;
  margin-bottom: 0;
  &.is-active {
    cursor: default;
    &::after {
      content: '';
      display: block;
      position: absolute;
      top: -10px;
      right: -4px;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background-color: #00AAD2;
      background-image: url('/images/icons/check.svg');
      background-repeat: no-repeat;
      background-position: 50%;
      background-size: 60%;
    }
  }
  &:not(.is-active):hover {
    .color-pick {
      width: 32px;
      height: 32px;
    }
  }
  input {
    position: absolute;
    width: 0;
    height: 0;
    z-index: -1;
  }
}
.color-pick {
  position: absolute;
  background-position: center center;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  pointer-events: none;
  border-radius: inherit;
  width: 32px;
  height: 32px;
  transition: height $tr-fast, width $tr-fast;
}
.current-color {
  display: block;
  line-height: 1;
  margin-top: 15px;
  font-size: 1.4rem;
  font-weight: 500;
  margin-bottom: -3px;
}
.current-color__price {
  font-weight: 500;
}

// main working area
.design-layer {}
.design-layer__top {
  min-height: 44px;
  padding: 15px 50px;
  display: flex;
  flex-flow: row nowrap;
  justify-content: space-between;
  align-items: center;
  position: relative;
  z-index: 1;
}
.design-layer__controls {
  margin-left: auto;
  font-size: 0;
  line-height: 1;
}
.design-control {
  display: inline-block;
  vertical-align: middle;
  height: 44px;
  width: 44px;
  position: relative;
  transition: color $tr-fast;
  border-radius: 50%;
  &::after {
    position: absolute;
    left: 50%;
    top: 50%;
    margin: -28px 0 0 -28px;
    content: '';
    z-index: 0;
    opacity: 0;
    transform: scale(.75);
    border-radius: 50%;
    width: 56px;
    height: 56px;
    background: $sky;
    transition: transform $tr-fast, opacity $tr-fast;
  }
  & + & {
    margin-left: 15px;
  }
  .ic-svg {
    @include abs-center;
    z-index: 1;
    fill: currentColor;
  }
  &:hover {
    color: #fff;
    border-color: transparent;
    &::after {
      opacity: 1;
      transform: scale(.777);
    }
  }
  &#{&}--360 {
    pointer-events: none;
    user-select: none;
    color: #dfe1e7;
    font-weight: 500;
    font-size: 12px;
    line-height: 45px;
    text-align: center;
    .ic-svg {
      width: 45px;
      height: 45px;
    }
  }
  &#{&}--gallery {
    color: $sky;
    border: 1px solid $sky;
    cursor: pointer;
    transition: color $tr-fast, border-color .1s ease-out 0s;
    .ic-svg {
      width: 24px;
      height: 23px;
    }
    &:hover {
      border-color: transparent;
      color: #fff;
    }
  }
}

#spritespin {
  width: 100%!important;
  height: 100%!important;
}
.spritespin-backstage {
  width: 100%!important;
  height: 100%!important;
  min-height: 0!important;
}

.design-footer__bottom {
  display: flex;
  justify-content: flex-end;
  width: 100%;
}

// ie specific
@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
  .design-footer {
    flex: 0 1 540px;
  }
  .color-list {
    display: block;
  }
  .color-list__item {
    display: inline-block;
  }
}

@media only screen and (max-width : $lg-max) {
  .design .content-footer {
    padding: 0 40px;
	position: relative;
    flex-wrap: wrap;
    bottom: 0;
    margin-top: 15px;
  }
  .design-view-body {
    //height: calc((100vw - 64px) * 0.45 * 0.7);
    height: calc((100vw - 160px) * 0.45);
    max-height: calc((700px) * 0.45);
  }
  .design-layer__top {
    padding: 15px 40px;
  }
  .design-layer__main {
    top: 0;
    transform: translate(0, 0);
  }
  .design-footer {
    margin-bottom: 27px;
    width: 100%;
    border-bottom: 1px solid #E4DCD3;
    padding-bottom: 10px;
  }
}

@media only screen and (max-width : $md-max) {
  .design .content-footer {
    padding: 0;
  }
  .design-layer__top {
    padding: 0 16px;
  }
  .design .content-main {
    padding-top: 0;
  }
  .design-view-body {
	height: calc((100vw - 32px) * 0.45);
	max-height: 100%;
  }
  .current-color {
    font-size: 16px;
    margin-top: 10px;
    margin-bottom: 12px;
  }
  .color-selector {
	  width: 48px;
	  height: 48px;
  }
  .color-pick {
	  width: 48px;
	  height: 48px;
  }
  .color-groups {
	  min-width: 100%;
	  margin-right: -16px;
	  overflow-x: auto
  }
  .design-footer__bottom {
    position: fixed;
	left: 0;
	right: 0;
	bottom: 72px;
	margin: 0;
	min-height: 0;
    justify-content: flex-start;
  }
}
</style>
