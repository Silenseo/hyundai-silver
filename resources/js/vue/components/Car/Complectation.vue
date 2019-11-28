<template>
  <div class="step">
    <div class="step__content complectation container">
      <transition name="fade">
      <div style="height: 100%" class="row">
        <div style="height: 100%" class="col-md-12">
          <div class="content-wrapper">
            <div class="content-main">
              <div class="content-main__inner">
                <transition name="fade" appear>
                <div class="complectation-list" v-if="complectationList">
                  <label class="complectation-item radio-box" v-for="item in complectationList" :key="item.id" :class="{ 'is-selected': complectation === item.id }">
                    <input type="radio" name="complectation-selector" :value="item.id" v-model="complectation">
                    <div class="complectation-circle"></div>
                    <span class="complectation-head">
                      <span class="complectation-item__row">
                        <strong class="complectation-name">{{ item.name }}</strong>
                        <strong class="complectation-price">{{ item.price | priceFormat }}</strong>
                      </span>
                      <span class="complectation-item__row" v-if="item.packets">
                        <span class="complectation-item__packets">пакеты опций</span>
                      </span>
                      <span class="complectation-item__row list-row--brief">
                        <span class="complectation-brief">{{ item.short_description }}</span>
                      </span>
                    </span>
                    <span class="complectation-body">
                      <a href="#" @click.prevent="toggleFull" class="df-iconed-link df-iconed-link--small">
                          Подробнее
                          <svg>
                              <use xlink:href="#arrow-link"></use>
                          </svg>
                      </a>
                    </span>
                  </label>
                </div>
                </transition>
                <transition name="fade" appear>
                <div class="content-footer" v-if="complectationList" >
                  <!-- <compare-button/> -->
                  <router-link class="df-button button content-footer__button" :to="{ name: ( this.packetsList === null ? 'Design' : 'Packets' ), params: { id: this.$store.getters.GET_CURRENT_ID }}">Продолжить</router-link>
                </div>
                </transition>
              </div>
            </div>
            <div class="content-aside">
              <sidebar/>
            </div>
          </div>
        </div>
      </div>
      </transition>
    </div>
    <transition name="modal-in-out" v-on:afterEnter="onFullEnter">
      <div class="full-list-wrapper" v-if="isFullActive">
        <div class="full-list container">
          <div class="full-list__content row">
            <transition name="fade">
              <div class="col-md-12">
                <div class="full-list__subwrap" v-if="fullSpecifications" :class="{ 'is-loading': fullSpecifications === null }">
                  <div class="full-list__header">
                    <span class="full-list__title">Комплектации</span>
                    <a href="#" @click.prevent="hideFull" class="close"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-close-popup"></use></svg></a>
                  </div>
                  <!-- <1280 -->
                  <div class="full-list__slider-wrap hidden-desctop">
                    <div class="full-list__slider">
                      <carousel class="slider-m slider-m--1" :nav="false" :dots="false" :items="1" :startPosition="currentComplectationId" :pullDrag="false" :touchDrag="false" :mouseDrag="false" ::loop="false" :rewind="false" @changed="slideChanged1">
                        <div class="slider-m__item" v-for="(comp, key, index) in complectationList" :key="comp.id">
                          <label class="option">
                            <input type="radio" class="option__input" name="mod" :value="comp.id" v-model="complectation" :class="{ 'is-current' : comp.id === complectation }">
                            <div class="option__circle"></div>
                            <div class="option__description">
                              <div class="option__name">{{ comp.name }}</div>
                              <div class="option__price">{{ comp.price | priceFormat }}</div>
                            </div>
                            <div class="option__nav">
                              <a href="#" @click.prevent="prevSlide('slider-m--1')" class="option__prev">
                                <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-left"></use></svg>
                              </a>
                              <div class="option__status">
                                <span class="option__current">{{ index + 1 }}</span>
                                <span class="option__sep">|</span>
                                <span class="option__total">{{ Object.keys(complectationList).length }}</span>
                              </div>
                              <a href="#" @click.prevent="nextSlide('slider-m--1')" class="option__next">
                                <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-right"></use></svg>
                              </a>
                            </div>
                          </label>
                        </div>
                      </carousel>
                      <carousel class="slider-m slider-m--2" :nav="false" :dots="false" :items="1" :startPosition="currentComplectationId + 1" :pullDrag="false" :touchDrag="false" :mouseDrag="false" :loop="false" :rewind="false" @changed="slideChanged2">
                        <div class="slider-m__item" v-for="(comp, key, index) in complectationList" :key="comp.id">
                          <label class="option">
                            <input type="radio" class="option__input" name="mod" :value="comp.id" v-model="complectation" :class="{ 'is-current' : comp.id === complectation }">
                            <div class="option__circle"></div>
                            <div class="option__description">
                              <div class="option__name">{{ comp.name }}</div>
                              <div class="option__price">{{ comp.price | priceFormat }}</div>
                            </div>
                            <div class="option__nav">
                              <a href="#" @click.prevent="prevSlide('slider-m--2')" class="option__prev">
                                <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-left"></use></svg>
                              </a>
                              <div class="option__status">
                                <span class="option__current">{{ index + 1 }}</span>
                                <span class="option__sep">|</span>
                                <span class="option__total">{{ Object.keys(complectationList).length }}</span>
                              </div>
                              <a href="#" @click.prevent="nextSlide('slider-m--2')" class="option__next">
                                <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-right"></use></svg>
                              </a>
                            </div>
                          </label>
                        </div>
                      </carousel>
                    </div>
                  </div>
                  <!-- END <1280 -->
                  <table class="fm-t fm-th hidden-mobile">
                    <tr>
                      <td class="w32"></td>
                      <td v-for="compl in fullSpecifications.complectations">
                        <!-- <span class="fm-th-holder" :class="{ 'is-current' : compl.id === complectation }">
                          <strong class="fm-compl-name">{{ compl.name }}</strong>
                          <span class="fm-compl-price">{{ compl.price | priceFormat }}</span>
                        </span> -->
						<label class="option">
                          <input type="radio" class="option__input" name="mod" :value="compl.id" v-model="complectation" :class="{ 'is-current' : compl.id === complectation }">
                          <div class="option__circle"></div>
                          <div class="option__description">
                            <div class="option__name">{{ compl.name }}</div>
                            <div class="option__price">{{ compl.price | priceFormat }}</div>
                          </div>
                        </label>
                      </td>
                      <td class="w32"></td>
                    </tr>
                  </table>
                  <div class="fm-diff-body">
                      <checkbox name="isDifferentOnly" v-model="isDifferentOnly" v-if="fullSpecifications.complectations.length > 1">
                        <span class="svg-check" slot="input-box">
                          <svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-checkmark"></use></svg>
                        </span>
                        Только различия
                      </checkbox>
                  </div>
                  <div class="fm-groups">
                    <div v-for="(spec, key) in fullSpecifications.specifications" class="fm-group fm-group--bordered hidden-mobile">
                      <div class="fm-group-title" :data-collapse-trigger="key" @click.prevent.stop="collapseGroup(key)">
                        <div class="fm-group-title__inner">
                          {{ spec.name }}
                          <svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-dropdown-corner"></use></svg>
                        </div>
                      </div>
                      <div class="fm-group-table" :data-collapse-target="key">
                        <table class="fm-t fm-group">
                          <template v-if="isDifferentOnly">
                          <template v-for="specRow in spec.data">
                            <template v-if="specRow.diff">
                              <tr class="spec-subtitle">
                                <td :colspan="fullSpecifications.complectations.length" v-html="specRow.name.name"></td>
                              </tr>
                              <tr class="spec-subrow">
                                <td v-for="specItem in specRow.values">
                                  <template v-if="specItem === false">
                                    <svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg>
                                  </template>
                                  <template v-else-if="specItem === true">
                                    <svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg>
                                  </template>
                                  <template v-else>
                                    {{ specItem }}
                                  </template>
                                </td>
                              </tr>
                            </template>
                          </template>
                          </template>
                          <template v-else>
							<template v-for="specRow in spec.data">
								<tr class="spec-subtitle">
								<td :colspan="fullSpecifications.complectations.length" v-html="specRow.name.name"></td>
								</tr>
								<tr class="spec-subrow">
								<td v-for="specItem in specRow.values">
									<template v-if="specItem === false">
									<svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg>
									</template>
									<template v-else-if="specItem === true">
									<svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg>
									</template>
									<template v-else>
									{{ specItem }}
									</template>
								</td>
								</tr>
							</template>
                          </template>
                        </table>
                      </div>
                    </div>

                    <!-- <1280 -->
                    <div v-for="(spec, key) in fullSpecifications.specifications" v-if="(isDifferentOnly && spec.hasDiff) || (!isDifferentOnly)" class="fm-group fm-group--bordered hidden-desctop">
                      <div class="fm-group-title" :data-collapse-trigger="key + 100" @click.prevent.stop="collapseGroup(key + 100)">
                        <div class="fm-group-title__inner">
                          {{ spec.name }}
                          <svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-dropdown-corner"></use></svg>
                        </div>
                      </div>
                      <div class="fm-group-table" :data-collapse-target="key + 100">
                        <table class="fm-t fm-group">
                          <template v-if="isDifferentOnly">
                            <template v-for="specRow in spec.data">
                              <template v-if="specRow.diff">
                                <tr class="spec-subtitle">
                                  <td colspan="2" v-html="specRow.name.name"></td>
                                </tr>
                                <tr class="spec-subrow">
                                  <td>
                                    <div class="spec-subrow__flex">
                                      <div class="spec-subrow__column">
                                        <template v-if="specRow.values[specComplectationId1] === false">
                                          <svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg>
                                        </template>
                                        <template v-else-if="specRow.values[specComplectationId1] === true">
                                          <svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg>
                                        </template>
                                        <template v-else>
                                          {{ specRow.values[specComplectationId1] }}
                                        </template>
                                      </div>
                                      <div class="spec-subrow__column">
                                        <template v-if="specRow.values[specComplectationId2] === false">
                                          <svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg>
                                        </template>
                                        <template v-else-if="specRow.values[specComplectationId2] === true">
                                          <svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg>
                                        </template>
                                        <template v-else>
                                          {{ specRow.values[specComplectationId2] }}
                                        </template>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </template>
                            </template>
                          </template>
                          <template v-else>
                            <template v-for="specRow in spec.data">
                              <tr class="spec-subtitle">
                                <td colspan="2" v-html="specRow.name.name"></td>
                              </tr>
                              <tr class="spec-subrow">
                                <td>
                                  <div class="spec-subrow__flex">
                                    <div class="spec-subrow__column">
                                      <template v-if="specRow.values[specComplectationId1] === false">
                                        <svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg>
                                      </template>
                                      <template v-else-if="specRow.values[specComplectationId1] === true">
                                        <svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg>
                                      </template>
                                      <template v-else>
                                        {{ specRow.values[specComplectationId1] }}
                                      </template>
                                    </div>
                                    <div class="spec-subrow__column">
                                      <template v-if="specRow.values[specComplectationId2] === false">
                                        <svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg>
                                      </template>
                                      <template v-else-if="specRow.values[specComplectationId2] === true">
                                        <svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg>
                                      </template>
                                      <template v-else>
                                        {{ specRow.values[specComplectationId2] }}
                                      </template>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </template>
                          </template>
                        </table>
                      </div>
                    </div>
                    <!-- END <1280 -->
                  </div>
                </div>
                <loader v-else></loader>
              </div>
            </transition>
          </div>
        </div>
        <div class="full-list-sticky hidden-mobile" :class="{ 'is-sticked': isSticked }" v-if="fullSpecifications" :style="{ 'width': controlElementContainerWidth }">
          <div class="container">
            <div class="full-list-sticky__layout row">
              <div class="col-md-12">
                <div class="full-list-sticky__holder">
                  <table class="fm-t fm-th">
                    <tr>
                      <th class="w50"></th>
                      <th v-for="compl in fullSpecifications.complectations">
                        <span class="fm-th-holder" :class="{ 'is-current' : compl.id === complectation }">
                          <strong class="fm-compl-name">{{ compl.name }}</strong>
                          <span class="fm-compl-price">от {{ compl.price | priceFormat }}</span>
                        </span>
                      </th>
                      <th class="w50"></th>
                    </tr>
                  </table>
                  <a href="#" @click.prevent="hideFull" class="close"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-close"></use></svg></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- <1280 -->
        <div class="full-list-sticky hidden-desctop" :class="{ 'is-sticked': isSticked }" v-if="fullSpecifications" :style="{ 'width': controlElementContainerWidth }">
          <div class="container">
            <div class="full-list-sticky__layout row">
              <div class="col-md-12">
                <div class="full-list-sticky__holder">
                  <div class="full-list__slider">
                    <carousel class="slider-m slider-m--1" :nav="false" :dots="false" :items="1" :startPosition="currentComplectationId" :pullDrag="false" :touchDrag="false" :mouseDrag="false" ::loop="false" :rewind="false" @changed="slideChanged1">
                      <div class="slider-m__item" v-for="(comp, key, index) in complectationList" :key="comp.id">
                        <label class="option">
                          <input type="radio" class="option__input" name="mod" :value="comp.id" v-model="complectation" :class="{ 'is-current' : comp.id === complectation }">
                          <div class="option__circle"></div>
                          <div class="option__description">
                            <div class="option__name">{{ comp.name }}</div>
                            <div class="option__price">{{ comp.price | priceFormat }}</div>
                          </div>
                          <div class="option__nav">
                            <a href="#" @click.prevent="prevSlide('slider-m--1')" class="option__prev">
                              <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-left"></use></svg>
                            </a>
                            <div class="option__status">
                              <span class="option__current">{{ index + 1 }}</span>
                              <span class="option__sep">|</span>
                              <span class="option__total">{{ Object.keys(complectationList).length }}</span>
                            </div>
                            <a href="#" @click.prevent="nextSlide('slider-m--1')" class="option__next">
                              <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-right"></use></svg>
                            </a>
                          </div>
                        </label>
                      </div>
                    </carousel>
                    <carousel class="slider-m slider-m--2" :nav="false" :dots="false" :items="1" :startPosition="currentComplectationId + 1" :pullDrag="false" :touchDrag="false" :mouseDrag="false" :loop="false" :rewind="false" @changed="slideChanged2">
                      <div class="slider-m__item" v-for="(comp, key, index) in complectationList" :key="comp.id">
                        <label class="option">
                          <input type="radio" class="option__input" name="mod" :value="comp.id" v-model="complectation" :class="{ 'is-current' : comp.id === complectation }">
                          <div class="option__circle"></div>
                          <div class="option__description">
                            <div class="option__name">{{ comp.name }}</div>
                            <div class="option__price">{{ comp.price | priceFormat }}</div>
                          </div>
                          <div class="option__nav">
                            <a href="#" @click.prevent="prevSlide('slider-m--2')" class="option__prev">
                              <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-left"></use></svg>
                            </a>
                            <div class="option__status">
                              <span class="option__current">{{ index + 1 }}</span>
                              <span class="option__sep">|</span>
                              <span class="option__total">{{ Object.keys(complectationList).length }}</span>
                            </div>
                            <a href="#" @click.prevent="nextSlide('slider-m--2')" class="option__next">
                              <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-right"></use></svg>
                            </a>
                          </div>
                        </label>
                      </div>
                    </carousel>
                  </div>
                  <a href="#" @click.prevent="hideFull" class="close"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-close"></use></svg></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END <1280 -->
      </div>
    </transition>
  </div>
</template>

<script>
import Sidebar from './Sidebar'
import CompareButton from './Compare/CompareButton'
import Loader from '../Loader'
import toggleSlide from '../../assets/lib/slideToggle.js'
import carousel from 'vue-owl-carousel'

import { mapGetters } from 'vuex'

export default {
  name: 'Complectations',
  components: { Sidebar, CompareButton, Loader, carousel },
  data () {
    return {
      isFullActive: false,
      isDifferentOnly: false,
      isSticked: false,
      controlElement: null,
      controlElementContainer: null,
      controlElementContainerWidth: '100%',
      specComplectationId1: 0,
      specComplectationId2: 0
    }
  },
  computed: {
    complectation: {
      get () {
        return this.$store.state.configuration.complectation
      },
      set (value) {
        this.$store.dispatch('UPDATE_COMPLECTATION', value)
      }
    },
    ...mapGetters({
      fullSpecifications: 'GET_FULL_COMPLECTATIONS',
      complectationList: 'GET_COMPLECTATION_LIST',
      packetsList: 'GET_PACKETS_LIST'
    }),
    currentComplectationId () {
      let counter = 0

      for (var comp in this.complectationList) {
        if (this.complectationList[comp].id === this.complectation) {
          break
        } else {
          counter++
        }
      }

      return counter
    }
  },
  methods: {
    nextSlide (id) {
      var selectors = document.querySelectorAll('.' + id)

      for (var i = 0; i < selectors.length; i++) {
        selectors[i].querySelector('.owl-next').dispatchEvent(new Event('click'))
      }
    },
    prevSlide (id) {
      var selectors = document.querySelectorAll('.' + id)

      for (var i = 0; i < selectors.length; i++) {
        selectors[i].querySelector('.owl-prev').dispatchEvent(new Event('click'))
      }
    },
    slideChanged1 (data) {
      if (typeof data.item.index !== 'undefined') {
        this.specComplectationId1 = data.item.index
      } else {
        this.specComplectationId1 = 0
      }
    },
    slideChanged2 (data) {
      if (typeof data.item.index !== 'undefined') {
        this.specComplectationId2 = data.item.index
      } else {
        this.specComplectationId2 = 0
      }
    },
    toggleFull () {
      this.isSticked = false
      window.addEventListener('keyup', this.hideFull, false)
      this.isFullActive = !this.isFullActive
      this.$root.$emit('fixOverflow', true)
      this.$store.dispatch('SET_APP_STATE', {fullModal: true})
      this.$store.dispatch('LOAD_FULL_COMPLECTATIONS', this.$store.state.configuration.modification)
      // set start slide id for modification list
      this.specComplectationId1 = this.currentComplectationId
      if (this.currentComplectationId === Object.keys(this.complectationList).length - 1) {
        this.specComplectationId2 = 0
      } else {
        this.specComplectationId2 = this.currentComplectationId + 1
      }
    },
    hideFull (event) {
      if (event) {
        if ((event.type === 'keyup' && event.keyCode === 27) || event.type === 'click') {
          event.preventDefault()
          this.isFullActive = false
          this.isDifferentOnly = false
          this.$root.$emit('fixOverflow', false)
          this.$store.dispatch('SET_APP_STATE', {fullModal: false})
        }
      } else {
        this.isFullActive = false
        this.isDifferentOnly = false
        this.$root.$emit('fixOverflow', false)
        this.$store.dispatch('SET_APP_STATE', {fullModal: false})
        window.removeEventListener('keyup', this.hideFull, false)
      }
    },
    collapseGroup (key) {
      let trigger = document.querySelector('[data-collapse-trigger="' + key + '"]')
      let table = document.querySelector('[data-collapse-target="' + key + '"]')
      toggleSlide(table)
      if (trigger.classList.contains('is-collapsed')) {
        trigger.classList.remove('is-collapsed')
      } else {
        trigger.classList.add('is-collapsed')
      }
    },
    onFullEnter () {
      this.controlElementContainer = document.querySelector('.full-list-wrapper')
      this.controlElement = document.querySelectorAll('.fm-groups')[0]
      if (this.controlElement && this.controlElementContainer) {
        this.controlElementContainerWidth = this.controlElementContainer.clientWidth + 'px'
        this.handleScroll()
        this.controlElementContainer.addEventListener('scroll', this.handleScroll)
      }
    },
    handleScroll () {
      if (!this.controlElement) {
        return false
      }
      if (this.controlElement.getBoundingClientRect().top <= 0) {
        this.isSticked = true
      } else {
        this.isSticked = false
      }
    }
  },
  activated () {
    window.addEventListener('resize', this.onFullEnter)
  },
  deactivated () {
    window.removeEventListener('resize', this.onFullEnter)
    this.controlElementContainerWidth = '100%'
    this.controlElementContainer && this.controlElementContainer.removeEventListener('scroll', this.handleScroll)
    this.hideFull()
  }
}
</script>
<style lang="scss" scoped>
.full-list__subwrap {
	padding-bottom: 50px;
}
</style>

<style lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.complectation {
  height: 100%;
  position: relative;
}
.complectation-list {
  display: flex;
  flex-flow: row wrap;
  height: 100%;
}
.complectation-item {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  min-height: 168px;
  flex: 1 1 50%;
  max-width: 50%;
  background: #fff;
  border-color: #ebebeb;
  border-width: 0 1px 1px 1px;
  border-style: solid;
  cursor: pointer;
  transition: background $tr-fast;
  padding: 20px 35px 23px 56px;
  position: relative;
  margin-bottom: 0;
  &:nth-of-type(-n+2) {
    border-top-width: 1px;
  }
  &:nth-of-type(2n) {
    border-left: none;
  }
  &.is-selected {
    box-shadow: inset 0 0 0 2px #00AAD2;
    .complectation-circle {
      border-color: #00AAD2;
      &::after {
        transform: scale(1);
      }
    }
  }
  input {
    height: 0;
    width: 0;
    position: absolute;
    visibility: hidden;
  }
}
.complectation-circle {
  position: absolute;
  top: 22px;
  left: 22px;
  width: 16px;
  height: 16px;
  border: 2px solid #B7B7B7;
  border-radius: 50%;
  transition: 0.3s;
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
    border-radius: 50%;
    margin: auto;
    background-color: #00AAD2;
    transform: scale(0);
    transition: 0.3s;
  }
    
}
[data-rows="1"] {
  @media (max-height: 650px) {
    .list-row--brief {
      display: none;
    }
  }
}
[data-rows="2"] {
  @media (max-height: 650px) {
    .list-row--brief {
      display: none;
    }
  }
}
[data-rows="3"] {
  .complectation-item {
    height: 33.333%;
  }
  @media (max-height: 919px) {
    .list-row--brief {
      display: none;
    }
  }
  @media (max-height: 650px) {
    .complectation-body {
      bottom: 15px;
    }
  }
  @media (max-height: 580px) {
    .complectation-item {
      padding: 16px 35px 16px 33px;
    }
  }
}
[data-rows="4"] {
  .complectation-item {
    height: 25%;
    min-height: auto;
  }
  @media (max-height: 919px) {
    .list-row--brief {
      display: none;
    }
  }
  @media (max-height: 680px) {
    .complectation-body {
      bottom: 15px;
    }
  }
  @media (max-height: 650px) {
    .complectation-item {
      padding: 20px 35px 20px 33px;
    }
  }
}
.complectation-head {
  .complectation-item__row {
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;
    align-items: center;
  }
}
.complectation-body {

}
.complectation-item__row {
  display: block;
}
.complectation-name {
  font-size: 2.0rem;
  font-weight: 500;
  line-height: 1;
  transition: color $tr-fast;
  max-width: 200px;
  margin-right: 25px;
}
.complectation-full {
  display: inline-block;
  line-height: 25px;
  font-size: 14px;
  font-weight: 500;
  color: $sky;
  margin-top: 5px;
  padding-right: 10px;
  transition: opacity $tr-fast;
  text-decoration: underline;
  &:hover {
    opacity: .5;
  }
}
.complectation-price {
  font-weight: 500;
  font-size: 1.6rem;
  line-height: 1;
  white-space: nowrap;
}
.complectation-brief {
  display: block;
  color: #b3b3b3;
  font-size: 14px;
  padding-top: 20px;
  padding-bottom: 20px;
}

.button--compare {
  font-size: 14px;
  font-weight: 600;
  display: inline-block;
  color: $sky;
  background: transparent;
  &:hover {
    color: #1bc6ec;
    background: transparent;
  }
}
.compare-ic {
  height: 38px;
  width: 38px;
  border-radius: 50%;
  display: inline-block;
  vertical-align: middle;
  margin-right: 7px;
  background: currentColor;
  position: relative;
  .ic-svg {
    width: 20px;
    height: 16px;
    @include abs-center;
    fill: #fff;
  }
}
.complectation-item__packets {
  font-size: 1.2rem;
  font-weight: 600;
  letter-spacing: .05em;
  text-transform: uppercase;
  &::before {
    content: '+ ';
    font-size: 16px;
    vertical-align: middle;
  }
}

.slide-up {}
.slide-up-enter-active, .slide-up-leave-active {
  transition: opacity .5s cubic-bezier(.55,0,.1,1), transform .5s cubic-bezier(.55,0,.1,1);
}
.slide-up-enter, .slide-up-leave-active {
  opacity: 0;
  transform: translate(0, 100px);
}

@media only screen and (max-width : $lg-max) {
  .complectation {
    height: auto;
  }
}

@media only screen and (max-width : $md-max) {
  .complectation-item {
    width: 100%;
    max-width: 100%;
    padding-top: 17px;
    padding-left: 48px;
    padding-right: 16px;
    flex: 1 1 100%;
  }
  .complectation-item:nth-of-type(2n) {
    border-left: 1px solid #ebebeb;
  }
  .complectation-item:nth-of-type(-n+2) {
    border-top: none;
  }
  .complectation-item:first-of-type {
    border-top: 1px solid #ebebeb;
  }
  .complectation-name {
    font-size: 16px;
  }
  .complectation-price {
    font-size: 14px;
  }
  .complectation-brief {
    font-size: 14px;
  }
  .complectation-circle {
    top: 16px;
    left: 16px;
    width: 20px;
    height: 20px;
    &::after {
      width: 8px;
      height: 8px;
    }
  }
}
</style>
