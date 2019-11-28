<template>
  <div id="configurator" class="configurator">
    <navigation></navigation>
    <configurator-view></configurator-view>
    <calculator></calculator>
    <notifier></notifier>
  </div>
</template>

<script>
import Navigation from '@/components/Navigation'
import ConfiguratorView from '@/components/Configurator-view'
import Calculator from '@/components/Calculator'
import Notifier from '@/components/Notifier'
import Loader from '@/components/Loader'

export default {
  name: 'configurator',
  components: { Navigation, ConfiguratorView, Calculator, Notifier, Loader },
  data () {
    return {
    }
  },
  computed: {
    applicationState () {
      return this.$store.getters.GET_APP_STATE
	}
  },
  methods: {
    fixOverflow (makeFixed) {
      // TODO: ADD WATCHING ON ROUTER
      if (makeFixed === true) {
        document.body.style.overflow = 'hidden'
      } else {
        document.body.style.overflow = ''
      }
    }
  },
  filters: {
    capitalize: function (value) {
      if (!value) return ''
      value = value.toString()
      return value.charAt(0).toUpperCase() + value.slice(1).replace(/\s/g, '').toLowerCase()
    }
  },
  mounted () {
    this.$root.$on('fixOverflow', this.fixOverflow)
  },
  watch: {
    '$route' (to, from) {
      if (to.meta.step === 0 || to.meta.step === 5) {
        this.fixOverflow(false)
      }
	}
  }
}
</script>

<style lang="scss">
@import './assets/_mixins.scss';
@import '../../sass/common/variables';
// main page
[v-cloak] {
  display: none;
}
// transitions
$transition: .5s cubic-bezier(.55,0,.1,1) 0s;
.fade-enter-active, .fade-leave-active {
  transition: opacity $transition;
}
.fade-enter, .fade-leave-active {
  opacity: 0;
}
.slide-up-enter-active, .slide-up-leave-active {
  transition: opacity $transition, transform $transition;
}
.slide-up-enter, .slide-up-leave-active {
  opacity: 0;
  transform: translate(0, 100px);
}
.slide-left-leave-active, .slide-left-enter-active, .slide-right-leave-active, .slide-right-enter-active {
  transition: opacity $transition, transform $transition;
}
.slide-left-enter, .slide-right-leave-active {
  opacity: 0;
  transform: translate(100px, 0);
}
.slide-left-leave-active, .slide-right-enter {
  opacity: 0;
  transform: translate(-100px, 0);
}


// modals
// common styles, modified by at place

.common-modal {
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(#000,.35);
  position: fixed;
  min-height: 100%;
  max-height: 100%;
  max-width: 100%;
  width: 100%;
  z-index: 850;
  overflow-x: hidden;
  overflow-y: hidden;
  @media (max-height: 650px) {
    overflow-x: hidden;
    overflow-y: auto;
  }
}
.common-modal-holder {
  transition: opacity .5s cubic-bezier(.55,0,.1,1) 0s, transform .5s cubic-bezier(.55,0,.1,1) 0s, margin .5s cubic-bezier(.55,0,.1,1) 0s;
  box-shadow: 10px 15px 35px rgba(#000, .15);
  background: #fff;
  padding: 50px 60px;
  margin: 0 auto;
  overflow: hidden;
  width: 500px;
  left: 0;
  right: 0;
  position: absolute;
  top: 50%;
  transform: translate(0, -50%);
  @media (max-height: 650px) {
    transform: none;
    position: relative;
    top: 0;
    margin: 50px auto;
  }
}
.common-modal-context {
  position: relative;
}
.common-modal__header {
  display: flex;
  justify-content: space-between;
  align-items: start;
  margin-bottom: 60px;
  .close {
    height: 44px;
    width: 44px;
    padding: 10px;
    margin: -10px -10px 0 auto;
    .ic-svg {
      fill: $hollow;
      width: 24px;
      height: 24px;
      transition: fill $tr-fast;
    }
    &:hover {
      opacity: 1;
      .ic-svg {
        fill: rgba($hollow,.5);
      }
    }
  }
}
.common-modal__title {
  font-size: 36px;
  font-weight: 500;
  line-height: 1;
  display: block;
  padding-right: 40px;
  margin-top: -0.15em;
}
.common-modal__body {
  margin-top: 15px;
}
.common-modal__content {}
.common-modal__footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

// inputs

.mdl-input-label {
  display: block;
  border-bottom: 1px solid rgba(#000,.25);
  line-height: 39px;
  font-size: 12px;
/*   text-transform: uppercase; */
  letter-spacing: 0.1em;
  font-weight: 400;
  color: #a3a3a3;
  position: relative;
  margin-bottom: 20px;
  &::after {
    content: '!';
    position: absolute;
    background: #f53a27;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    color: #fff;
    text-align: center;
    font-size: 12px;
    right: 0;
    bottom: 7px;
    line-height: 23px;
    font-weight: 600;
    letter-spacing: 0;
    opacity: 0;
    transform: scale(0);
    transition: opacity .25s cubic-bezier(0.57, 0.79, 0.46, 1.05) 0s, transform .25s cubic-bezier(0.96, 0.18, 0.46, 1.03) 0s;
  }
  &.mdl-checkbox-label {
    font-size: 12px;
    line-height: 21px;
    text-transform: none;
    letter-spacing: initial;
    color: #303030;
    border-bottom: none;
    text-align: right;
    margin: 30px 0 37px;
    cursor: pointer;
    transition: color .15s ease-in-out 0s;
    &::after {
      content: none;
    }
    &:hover {
      color: $hollow;
    }
    &.warn {
      color: #f53a27;
    }
    .mdl-checkbox-rules-link {
      display: inline-block;
      position: relative;
      color: $hollow;
      &::after {
        content: '';
        transition: opacity .15s ease-in-out 0s;
        height: 1px;
        background: $hollow;
        position: absolute;
        left: 0;
        right: 0;
        bottom: 1px;
      }
      &:hover {
        &::after {
          opacity: 0;
        }
      }
    }
    .mdl-checkbox-tick {
      position: relative;
      float: left;
      width: 20px;
      height: 20px;
      vertical-align: middle;
      display: inline-block;
      border: 4px solid #fff;
      margin-right: 10px;
      &::after {
        transition: opacity .15s ease-in-out 0s;
        content: '';
        width: 12px;
        height: 12px;
        background: $hollow;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
      }
    }
    .mdl-checkbox {
      position: absolute;
      visibility: hidden;
      opacity: 0;
      width: 0;
      height: 0;
      &:checked + .mdl-checkbox-tick::after {
        opacity: 1;
      }
    }
  }
  &.mdl-radio-label {
    font-size: 15px;
    display: inline-block;
    border-bottom: none;
    line-height: 1;
    cursor: pointer;
    text-transform: none;
    letter-spacing: initial;
    color: #a3a3a3;
    width: 50%;
    &:hover {
      color: $hollow;
    }
    .mdl-radio-tick {
      position: relative;
      display: inline-block;
      transition: color .15s ease-in-out 0s;
      font: inherit;
      padding-left: 33px;
      &::before {
        border: 4px solid #fff;
        width: 20px;
        height: 20px;
        content: '';
        position: absolute;
        top: -2px;
        left: 0;
        border-radius: 50%;
      }
      &::after {
        transition: opacity .15s ease-in-out 0s;
        content: '';
        width: 12px;
        height: 12px;
        background: $hollow;
        position: absolute;
        top: 2px;
        left: 4px;
        opacity: 0;
        border-radius: 50%;
      }
    }
    .mdl-radio {
      position: absolute;
      visibility: hidden;
      opacity: 0;
      width: 0;
      height: 0;
      &:checked + .mdl-radio-tick {
        color: #303030;
        &::after {
          opacity: 1;
        }
      }
    }
  }
  &.warn {
    &::after {
      opacity: 1;
      transform: scale(1);
      transition: opacity .25s cubic-bezier(0.57, 0.79, 0.46, 1.05) 0s, transform .25s cubic-bezier(0.58, 0.19, 0.2, 1.39) 0s;
    }
    &:hover {
      .mdl-input-warn-hepler {
        opacity: 1;
        transform: translate(0,0);
        transition: opacity .25s cubic-bezier(0.57, 0.79, 0.46, 1.05) 0s, transform .25s cubic-bezier(0.58, 0.19, 0.2, 1.39) 0s;
      }
    }
  }
}
.mdl-input {
  @include input-reset;
  width: 100%;
  font: inherit;
  letter-spacing: inherit;
  color: inherit;
  text-transform: capitalize;
  &::-webkit-input-placeholder  {color: inherit; opacity: 1; font-weight: inherit;}
  &::-moz-placeholder           {color: inherit; opacity: 1; font-weight: inherit;}
  &:placeholder                 {color: inherit; opacity: 1; font-weight: inherit;}
}
.mdl-input-warn-hepler {
    pointer-events: none;
    background: #f53a27;
    color: #fff;
    font-size: 12px;
    line-height: 1.167;
    position: absolute;
    padding: 6px 25px;
    width: 142px;
    height: 40px;
    text-transform: none;
    letter-spacing: normal;
    z-index: 1;
    text-align: center;
    margin-right: -70px;
    right: 10px;
    bottom: 90%;
    opacity: 0;
    transform: translate(0,10px);
    transition: opacity .25s cubic-bezier(0.57, 0.79, 0.46, 1.05) 0s, transform .25s cubic-bezier(0.96, 0.18, 0.46, 1.03) 0s;
    &::after {
      content: '';
      position: absolute;
      border-color: #f53a27 transparent transparent;
      border-style: solid;
      border-width: 5px 9px;
      left: 50%;
      bottom: -10px;
      margin-left: -9px;
    }
}

.mdl-input, .mdl-submit {
  transition: opacity .25s ease-in-out 0s;
  &[disabled] {
    pointer-events: none;
    opacity: .75;
  }
}

// transitions
.modal-in-out-enter-active, .modal-in-out-leave-active {
  transition: opacity $transition;
  & > div {
    transition: opacity $transition, margin $transition, transform $transition;
  }
}
.modal-in-out-enter, .modal-in-out-leave-active {
  opacity: 0;
  & > div {
    opacity: 0;
    margin-top: 50px;
    @media (max-height: 650px) {
      transform: translate(0, 50px);
    }
  }
}


// vuebar styles default
.vb.vb-visible {
  &::after {
    content: '';
    width: 8px;
    top: 0;
    right: 0;
    bottom: 0;
    background: #e8e5e2;
    position: absolute;
  }
}
.vb > .vb-dragger {
  z-index: 5;
  width: 12px;
  right: 0;
  width: 8px;
  cursor: pointer;
  background: #002c5f;
}

// ie specific
::-ms-clear {
  width : 0;
  height: 0;
}

@media only screen and (max-width : $lg-max) {
  .configurator {
    min-height: calc(100vh - 56px);
  }
}

</style>
