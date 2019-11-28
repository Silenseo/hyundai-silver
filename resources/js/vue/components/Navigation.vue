<template>
  <transition name="nav-transition">
    <nav class="navigation" v-if="isBelognsToNavigation">
      <ul class="navigation__list" :data-step="currentStep.toLowerCase()">
      <template v-for="step in steps">
        <router-link class="navigation__item" :class="{ 'is-active': currentStep.toLowerCase() === step.component.toLowerCase() }" :to="{ name: step.component }" v-if="step.target === '/'" exact tag="li">
          <a class="navigation__link">{{ step.title }}</a>
        </router-link>
        <router-link @click.native.capture="checkDisabled" class="navigation__item" :class="{ 'is-disabled': (id === 'null' || (step.component === 'Packets' && !packetsList) ), 'is-active': currentStep.toLowerCase() === step.component.toLowerCase() }" :to="{ name: step.component, params: { id: id }}" append v-else tag="li">
          <a class="navigation__link" :data-step="step.component" :class="{ 'is-disabled': (id === 'null' || (step.component === 'Packets' && !packetsList) ) }">{{ step.title }}</a>
        </router-link>
      </template>
      </ul>
    </nav>
  </transition>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Navigation',
  computed: {
    ...mapGetters({
      steps: 'GET_NAVIGATION',
      currentStep: 'GET_CURRENT_STEP',
      id: 'GET_CURRENT_ID',
      packetsList: 'GET_PACKETS_LIST'
    }),
    isBelognsToNavigation () {
      return Object.keys(this.steps).some((key) => {
        return this.steps[key].component.toLowerCase() === this.currentStep.toLowerCase()
      })
    }
  },
  methods: {
    checkDisabled (event) {
      if (event.target.classList.contains('is-disabled')) {
        event.preventDefault()
      }
    }
  }
}
</script>

<style lang="scss">
$stepWidth: 16.666%;

@import '../assets/_mixins.scss';
@import '../../../sass/common/variables';

.nav-transition-enter-active, .nav-transition-leave-active {
  transition: transform .6s cubic-bezier(.55,0,.1,1) 0s, opacity .6s cubic-bezier(.55,0,.1,1) 0s;
}
.nav-transition-enter, .nav-transition-leave-active {
  opacity: 0;
  transform: translate(0, -100px);
}
.navigation {
  position: fixed;
  z-index: 50;
  top: 72px;
  left: 0;
  right: 0;
  width: 100%;
  font-size: 1.6rem;
  font-weight: 500;
  color: #000;
  letter-spacing: .05em;
  background: #f1efef;
  user-select: none;
  overflow-x: auto;
}
.navigation__list {
  display: flex;
  flex-flow: row nowrap;
  justify-content: justify;
  align-items: center;
  position: relative;
  min-width: 768px;
  &::before {
    content: '';
    transition: left .7s cubic-bezier(.3,.88,.45,1) 0s;
    height: 100%;
    width: $stepWidth;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    background: $sky;
  }

  &[data-step="modification"]::before {
    left: $stepWidth;
  }
  &[data-step="complectation"]::before {
    left: $stepWidth * 2;
  }
  &[data-step="packets"]::before {
    left: $stepWidth * 3;
  }
  &[data-step="design"]::before {
    left: $stepWidth * 4;
  }
  &[data-step="summary"]::before {
    left: $stepWidth * 5;
  }
}
.navigation__item {
  flex: 1 1 20%;
  text-align: center;
  cursor: pointer;
  line-height: 60px;
  position: relative;
  z-index: 1;
  transition: color .15s ease-out 0s, opacity .15s ease-out 0s;
  &:not(.is-disabled).is-active {
    font-weight: 500;
    transition: color .5s ease-out 0s;
    &, &:hover {
      cursor: default;
      color: #fff;
    }
    & + .navigation__item::before {
      border-color: transparent;
      transform: scale(0);
    }
    &::before {
      border-color: transparent;
      transform: scale(0);
    }
    &::after {
      transform: scale(1,0.6);
      transition: transform .25s ease-in .35s;
    }
  }
  &.is-disabled {
    color: #B7B7B7;
    &, & .navigation__link { cursor: default; }
  }
  &:not(.is-disabled):hover {
    color: #00AAD2;
  }
  &::before {
    content: '';
    position: absolute;
    left: -2px;
    width: 7px;
    height: 7px;
    border-top: 2px solid #B7B7B7;
    border-right: 2px solid #B7B7B7;
    transform: rotate(45deg) translateY(-50%);
    top: 50%;
  }
  &:first-of-type::before {
    content: none;
  }
  &::after {
    content: '';
    display: none;
    position: absolute;
    left: 50%;
    top: 100%;
    border-width: 12px;
    border-style: solid;
    border-color: $sky transparent transparent transparent;
    transition: transform .05s ease-in-out 0s;
    margin: 0 0 0 -12px;
    transform: scale(0,0);
    transform-origin: 50% 0;
  }
}
.navigation__link {
  line-height: inherit;
  letter-spacing: normal;
  display: block;
  color: inherit;
  transition: opacity .6s cubic-bezier(.1,0,.3,1) .1s, transform .5s cubic-bezier(.2,.5,.3,1) 0s;
}

@media only screen and (max-width : $lg-max) {
  .navigation {
    font-size: 14px;
    top: 56px;
  }
  .navigation__item {
    line-height: 40px;
  }
  .navigation__item::before {
    left: -9px;
  }
}
</style>
