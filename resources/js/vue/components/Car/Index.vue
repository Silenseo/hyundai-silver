<template>
  <div class="car-view">
    <transition :name="transitionName" mode="out-in">
      <keep-alive>
        <router-view class="car-view-item"></router-view>
      </keep-alive>
    </transition>
    <gallery></gallery>
  </div>
</template>

<script>
import Gallery from '@/components/Car/Gallery/Index'
import store from '@/store'

export default {
  name: 'car-view',
  components: { Gallery },
  data () {
    return {
      transitionName: 'fade'
    }
  },
  beforeRouteLeave (to, from, next) {
    store.dispatch('SET_APP_STATE', {
      calculator: false,
      fullModal: false
    })
    next()
  },
  watch: {
    '$route' (to, from) {
      // if (from.meta.step === 0 || from.meta.step === 5 || to.meta.step === 5) {
      //   this.transitionName = 'fade'
      // } else if (to.meta.step < from.meta.step) {
      //   this.transitionName = 'slide-right'
      // } else {
      //   this.transitionName = 'slide-left'
      // }
    }
  }
}
</script>

<style lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.view-item {
  background: #fff;
}
// single car views
.car-view {
  position: relative;
  background: #fbfbfb url('../../assets/image/bgr_2.jpg') no-repeat center top / 100% auto;
  min-height: calc(100vh - 72px);
}
.car-view-item {
  position: relative;
  width: 100%;
  max-width: 100%;
  min-width: 100%;
  height: calc(100vh - 72px);
  min-height: 650px;
  transition: opacity .2s linear 0s;
  overflow: auto;
}
.step {
  padding-top: 90px;
}
.step__content {
  height: 100%;
  position: relative;
}
.content-wrapper {
  display: flex;
  flex-wrap: nowrap;
  position: relative;
  height: 100%;
}
.content-main {
  position: relative;
  flex-basis: 74%;
  flex-shrink: 0;
  flex-grow: 1;
  height: 100%;
  max-width: 74%;
  background: #fff;
  padding: 40px 72px 30px;
  overflow: auto;
}
.content-main__inner {
  position: relative;
  // max-height: 100%;
  padding-bottom: 40px;
}
.content-footer {
  min-height: 55px;
  margin-top: 40px;
  width: 100%;
  display: flex;
  justify-content: flex-end;
  flex-wrap: wrap;
  align-items: center;
  flex: none;
  &--sb {
    justify-content: space-between;
  }
}
// aside
.content-aside {
  flex: 1 1 auto;
  height: 100%;
  overflow: hidden;
  background: #E4DCD3;
}

// full specification tables
.full-list-wrapper {
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  position: fixed;
  min-height: 100%;
  max-width: 100%;
  padding-top: 30px;
  overflow-x: hidden;
  overflow-y: auto;
  z-index: 3100;
  background: #fff url('../../assets/image/bgr_2.jpg') no-repeat center top / 100% auto;
}
.full-list {
  padding-bottom: 60px;
  position: relative;
}
.full-list__content {
  padding-bottom: 50px;
  position: relative;
}

.full-list__subwrap {
  background-color: #fff;
  &.is-loading {
    .full-list__header {
    }
  }
}
.full-list__header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 32px 15px;
  background: #E4DCD3;
}
.full-list__title {
  font-size: 2.4rem;
  font-weight: 500;
  line-height: 40px;
  margin-top: 5px;
  margin-bottom: 10px;
}
.close {
  height: 40px;
  width: 40px;
  padding: 10px;
  opacity: 1;
  transition: opacity $tr-fast;
  &:hover {
    opacity: 1;
  }
  .ic-svg {
    width: 16px;
    height: 16px;
    fill: #002C5F;
  }
}
.fm-t {
  width: calc(100%);
  min-width: calc(100%);
  max-width: calc(100%);
  table-layout: fixed;
}
.fm-th {
  background: #E4DCD3;
  width: 100%;
  position: relative;
  th, td {
    font-weight: 500;
    font-size: 22px;
    color: #231f20;
    line-height: 1.5;
    padding-bottom: 18px;
    position: relative;
  }
  th, tr, td {
    background: #E4DCD3;
  }
}
.fm-diff-body {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  background: #fff;
  padding-right: 50px;
  height: 85px;
}
.w50 {
  width: 50px;
}
.w32 {
  width: 32px;
}
.fm-diff-body {
  td {
    padding: 25px 0;
  }
}
.checkbox-component {
  display: flex;
  align-items: center;
  font-size: 15px;
  line-height: 1;
  position: relative;
  font-weight: 500;
  color: #000;
  cursor: pointer;
  user-select: none;
  transition: color $tr-fast;
  label {
    display: flex;
    align-items: center;
    cursor: pointer;
    padding-left: 30px;
  }
  .svg-check {
    display: block;
    height: 16px;
    width: 16px;
    border: 2px solid #B7B7B7;
    margin-right: 16px;
    .ic-svg {
      @include abs-center;
      height: 10px;
      width: 8px;
      transform: scale(0);
      fill: #B7B7B7;
      transition: transform .25s cubic-bezier(.77,0,.24,1.42) 0s;
    }
  }
  input {
    &:checked + label {
      .svg-check {
        transform: scale(1);
      }
      .ic-svg {
        transform: scale(1);
      }
    }
  }
  .ic-svg {
  }
  &:hover {
    color: #847f7c;
  }
}
.fm-th-holder {
  position: relative;
  max-width: calc(100% - 40px);
  display: block;
  padding-left: 32px;
  &::before {
    content: '';
    position: absolute;
    top: 10px;
    left: 0;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: transparent;
    border: 3px solid transparent;
    box-shadow: 0 0 0 2px #B7B7B7;
  }
  &.is-current {
    &::before {
      background-color: #00AAD2;
      border: 3px solid #E4DCD3;
      box-shadow: 0 0 0 2px #00AAD2;
    }
  }
}
.fm-mod-name,
.fm-compl-name {
  font-size: 1.8rem;
  display: inline-block;
  line-height: 1;
  color: #000;
  font-weight: 500;
}
.fm-mod-price,
.fm-compl-price {
  display: block;
  font-size: 1.6rem;
  color: #666;
  line-height: 1;
  max-width: calc(100% - 25px);
  font-weight: 400;
}
.fm-groups {
  margin: 0 32px;
  border-bottom: 1px solid #E4DCD3;
}
.fm-group {
  color: #231f20;
  font-size: 15px;
  padding: 0 32px;
  &--bordered {
	border: 1px solid #E4DCD3;
    &:not(:last-of-type) {
      border: 1px solid #E4DCD3;
      border-bottom: 1px solid transparent;
    }
  }
}
.fm-group-title {
  position: relative;
  font-weight: 400;
  font-size: 16px;
  color: #231f20;
  cursor: pointer;
  user-select: none;
  line-height: 56px;
  max-height: 56px;
  transition: color $tr-fast;
  &.is-collapsed {
    .fm-group-title__inner {
      .ic-svg {

        transform: scale(1, 1);
	  }
	  svg {
		transform: translateY(-50%) rotate(0deg);
	  }
    }
  }
  &:hover {
    //color: $hollow;
    .fm-group-title__inner {
      
    }
  }
}
.fm-group-title__inner {
  font-size: 1.6rem;
  font-weight: 500;
  svg {
	position: absolute;
    top: 50%;
	right: 0px;
	transform: translateY(-50%) rotate(180deg);
	transition: transform 0.3s;
  }
  .ic-svg {
    position: absolute;
    top: 50%;
    right: 32px;
    transform: translateY(-50%) rotate(180deg);
    width: 10px;
    height: 6px;
    fill: $hollow;
    transition: transform 0.3s;
  }
}
.fm-group-table {
  position: relative;
  overflow: hidden;
  transition: max-height .35s cubic-bezier(.5,0,.24,1) 0s;
  &.is-collapsed {}
}
.spec-subtitle {
  color: #000;
  font-size: 1.4rem;
  font-weight: 500;
  td {
    font-size: 1.6rem;
    padding: 16px 0 9px;
    line-height: 1;
    color: #666666;
    font-weight: 400;
  }
}
.spec-subrow {
  line-height: 1.5;
  &:not(:last-of-type) {
    border-bottom: 1px solid #E4DCD3;
  }
  td {
    color: #000;
    font-size: 1.4rem;
    font-weight: 500;
    line-height: 1.5;
    padding-bottom: 18px;
    vertical-align: top;
    padding-right: 25px;
  }
  .ic-checkmark {
    fill: $sky;
  }
}

// sticky hedaer
.full-list-sticky {
  overflow: hidden;
  position: fixed;
  top: 0;
  left: 0;
  right: 0px;
  z-index: 40;
  transform: translate(0,-100%);
  opacity: 0;
  pointer-events: none;
  user-select: none;
  transition: transform .25s cubic-bezier(.5,.11,.11,1) 0s, opacity .25s cubic-bezier(.5,.11,.11,1) 0s;
  &.is-sticked {
    user-select: auto;
    opacity: 1;
    pointer-events: auto;
    transform: translate(0,0);
    backface-visibility: hidden;
  }
  .close {
    position: absolute;
    top: 5px;
    right: 25px;
  }
}
.full-list-sticky__layout {
  position: relative;
}
.full-list-sticky__holder {
  padding-top: 25px;
  padding-bottom: 0px;
  background-color: #E4DCD3;
}

// single elements, mostly common
.button--continue {
  margin-left: auto;
  padding-left: 40px;
  padding-right: 30px;
  .ic-svg {
    margin-left: 10px;
  }
}
.link-nav-back {
  color: $sky;
  font-weight: 500;
  transition: opacity $tr-fast;
  user-select: none;
  .ic-svg {
    transform: scale(-1,1);
    margin-right: 10px;
    margin-top: -3px;
    vertical-align: middle;
  }
  &:hover {
    opacity: .5;
  }
}
.check-box {
  &.is-checked {
    .check-icon {
        background: $hollow;
    }
    .ic-svg {
      transform: scale(1);
    }
  }
}
.check-icon {
  border-radius: 50%;
  width: 50px;
  height: 50px;
  background: #ebebeb;
  transition: background $tr-fast;
  position: relative;
  display: inline-block;
  .check-icon__check {
    @include abs-center;
    height: 18px;
    width: 21px;
    transform: scale(0);
    fill: #fff;
    transition: transform .25s cubic-bezier(.77,0,.24,1.42) 0s
  }
}

.content-footer__button {
  display: inline-block;
  padding: 8px 34px;
  &:hover, &:focus {
    color: #fff;
  }
}

//Compare popup
.option {
  position: relative;
  padding-left: 32px;
  cursor: pointer;
  &__input {
    display: none;
    &.is-current {
      & + .option__circle {
        border-color: #00AAD2;
        &::after {
          transform: scale(1);
        }
      }
    }
  }
  &__circle {
    position: absolute;
    left: 0;
    top: 0px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid #B7B7B7;
    &::after {
      content: '';
      display: block;
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      width: 6px;
      height: 6px;
      margin: auto;
      border-radius: 50%;
      background-color: #00AAD2;
      transform: scale(0);
    }
  }
  &__description {
    padding-right: 15px;
  }
  &__name {
    font-size: 1.8rem;
    color: #000;
    font-weight: 500;
    line-height: 1;
  }
  &__price {
    font-size: 1.6rem;
    color: #666666;
  }
  &__nav {
    display: flex;
    align-items: center;
    margin-top: 12px;
    margin-left: -32px;
  }
  &__status {
    margin: 0 15px;
  }
  &__prev, &__next {
    position: relative;
    flex: none;
    &::after {
      content: '';
      display: block;
      position: absolute;
      left: -200%;
      top: -50%;
      width: 500%;
      height: 200%;
    }
    svg {
      display: block;
      width: 6px;
      height: 16px;
      stroke: #002C5F;
    }
      
  }
  &__current, &__total, &__sep {
    font-size: 16px;
    font-weight: 500;
    color: #000;
  }
}

.full-list__slider-wrap {
  background-color: #E4DCD3;
}
.full-list__slider {
  display: flex;
  border: 1px solid #666666;
  max-width: 688px;
  margin: 0 40px;
}

.slider-m {
  position: relative;
  width: 50%;
  padding: 20px;
  padding-left: 32px;
  padding-bottom: 12px;
  &:first-of-type {
    &::after {
      content: '';
      display: block;
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 1px;
      height: 73%;
      background-color: #B3B3B3;
    }
  }
  .owl-nav {
    position: absolute;
  }
}

.hidden-desctop {
  display: none;
}

@media only screen and (max-width : $lg-max) {
  .content-wrapper {
    flex-direction: column;
    justify-content: space-between;
    background-color: #fff;
    overflow: hidden;
    height: calc(100vh - 120px);
    padding-bottom: 96px;
  }
  .step {
    padding-top: 64px;
  }
  .step__content {
    height: auto;
  }
  .car-view {
    min-height: calc(100vh - 56px);
  }
  .car-view-item {
    min-height: 100%;
    height: 100%;
  }
  .content-main {
    padding: 40px;
    padding-bottom: 0;
    flex-basis: 100%;
    max-width: 100%;
    //flex-shrink: 0;
    //height: auto;
  }
  .content-main__inner {
    padding-bottom: 0px;
    margin-bottom: 40px;
  }
  .content-footer {
    position: relative;
    margin-top: 16px;
  }
  .hidden-mobile {
    display: none;
  }
  .hidden-desctop {
    display: block;
  }

  .full-list {
    padding-bottom: 0;
  }
  .full-list-wrapper {
    padding-top: 0;
  }
  .full-list__subwrap {
    min-width: 100%;
    margin-left: -40px;
    margin-right: -40px;
  }
  .full-list__header {
    padding-left: 40px;
    padding-right: 40px;
    padding-bottom: 0;
  }

  .fm-diff-body {
    justify-content: flex-start;
    background-color: #E4DCD3;
    padding: 0 40px;
    height: 56px;
  }
  .checkbox-component {
    &:hover {
      color: #000;
    }
    label {
      padding-left: 0;
    }
  }
  .fm-groups {
    margin-top: 32px;
    margin-left: 40px;
    margin-right: 40px;
  }
  .fm-group-title {
    line-height: 48px;
  }

  .fm-t {
    table-layout: auto;
  }
  .spec-subrow__flex {
    display: flex;
    align-items: center;
    width: 100%;
  }
  .spec-subrow__column {
    width: 50%;
    max-width: 344px;
    padding-right: 15px;
  }

  .full-list-sticky__holder {
    min-width: 100%;
    margin-left: -32px;
    margin-right: -32px;
    padding-bottom: 15px;
  }
  .full-list-sticky {
    .full-list__slider {

    }
    .close {
      display: none;
    }
  }
}

@media only screen and (max-width : $md-max) {
  .content-wrapper {
    min-width: 100%;
    margin-left: -16px;
    margin-right: -16px;
    width: auto;
    min-height: calc(100vh - 96px);
    padding-bottom: 112px;
  }
  .step {
    padding-top: 40px;
  }
  .car-view-item {
    //min-height: 675px;
  }
  .content-main {
    padding: 16px;
  }
  .content-footer {
	  position: fixed;
	  left: 0;
	  right: 0;
	  bottom: 72px;
	  margin: 0;
	  min-height: 0;
  }
  .content-footer__button {
    width: 100%;
    text-align: center;
  }

  .full-list__subwrap {
    margin-left: -16px;
    margin-right: -16px;
  }
   
  .full-list__header {
    padding-left: 16px;
    padding-right: 16px;
  }

  .full-list__title {
    font-size: 20px;
  }

  .full-list__slider {
    margin-left: 16px;
    margin-right: 16px;
  }
  .slider-m {
    padding: 11px 14px;
  }
  .option {
    padding-left: 0;
    padding-top: 23px;
  }
  .option__name {
    font-size: 1.6rem;
    line-height: 1.125;
  }
  .option__price {
    font-size: 1.4rem;
  }
  .option__current, .option__total, .option__sep {
    font-size: 1.2rem;
  }
  .option__nav {
    margin-left: 0;
  }

  .fm-diff-body {
    padding-left: 16px;
    padding-right: 16px;
  }

  .fm-diff-body .checkbox-component {
    font-size: 16px;
    .svg-check {
      width: 20px;
      height: 20px;
      margin-right: 12px;
    }
  }

  .fm-groups {
    margin-left: 16px;
    margin-right: 16px;
    margin-top: 24px;
  }
  .fm-group {
    padding: 0 16px;
  }
  .fm-group-title {
    line-height: 58px;
  }
  .fm-group-title__inner .ic-svg {
    right: 9px;
  }

  .spec-subtitle td {
    font-size: 14px;
  }
  .spec-subrow td {
    font-size: 12px;
  }

  .full-list-sticky__holder {
    margin-left: -16px;
    margin-right: -16px;
  }
  .close {
    width: 30px;
    padding-right: 0;
  }
  
}
</style>
