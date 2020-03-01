<template>
  <div class="step">
    <div class="step__content container">
      <transition name="fade">
        <div style="height: 100%" class="row">
          <div style="height: 100%" class="col-md-12">
            <div class="content-wrapper">
              <div class="content-main">
                <div class="content-main__inner">
                  <transition name="fade" appear>
                  <div class="modification-list" v-if="modificationListSorted">
                    <label class="modification-item" v-for="item in modificationListSorted" :key="item.id" :class="{ 'is-selected': modification === item.id }">
                      <input type="radio" name="modification-selector" :value="item.id" v-model="modification">
                      <div class="modification-circle"></div>
                      <span class="modification-head">
                        <span class="modification-list__row modification-list__row--top">
                          <strong class="modification-name">{{ item.name }}</strong>
                          <strong class="modification-price">от {{ item.minPrice | priceFormat }}</strong>
                        </span>
                      </span>
                      <span class="modification-body">
                        <span class="modification-list__row list-row--brief">
                          <span class="modification-brief">Расход топлива – {{ item.fuelConsumption }}&nbsp;л./100 км</span>
                        </span>
                        <span class="modification-list__row list-row--brief">
                          <span class="modification-brief">Мощность — {{ item.power }} л.с.</span>
                        </span>
                        <span class="modification-list__row modification-list__row--more">
                          <a href="#" @click.prevent="toggleFull" class="df-iconed-link df-iconed-link--small">
                              Подробнее
                              <svg>
                                  <use xlink:href="#arrow-link"></use>
                              </svg>
                          </a>
                        </span>
                      </span>
                    </label>
                  </div>
                  </transition>
                  <transition name="fade" appear>
                  <div class="content-footer" v-if="modificationListSorted" >
                    <router-link class="df-button button content-footer__button" :to="{ name: 'Complectation', params: { id: this.$store.getters.GET_CURRENT_ID }}">
                      Продолжить
                    </router-link>
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
                    <span class="full-list__title">Модификации</span>
                    <a href="#" @click.prevent="hideFull" class="close"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-close-popup"></use></svg></a>
                  </div>

                  <!-- <1280 -->
                  <div class="full-list__slider-wrap hidden-desctop">
                    <div class="full-list__slider">
                      <carousel class="slider-m slider-m--1" :nav="false" :dots="false" :items="1" :startPosition="currentModificationId" :pullDrag="false" :touchDrag="false" :mouseDrag="false" ::loop="false" :rewind="false" @changed="slideChanged1">
                        <div class="slider-m__item" v-for="(mod, key) in modificationList" :key="mod.id">
                          <label class="option">
                            <input type="radio" class="option__input" name="mod" :value="mod.id" v-model="modification" :class="{ 'is-current' : mod.id === modification }">
                            <div class="option__circle"></div>
                            <div class="option__description">
                              <div class="option__name">{{ mod.name }}</div>
                              <div class="option__price">{{ mod.minPrice | priceFormat }}</div>
                            </div>
                            <div class="option__nav">
                              <a href="#" @click.prevent="prevSlide('slider-m--1')" class="option__prev">
                                <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-left"></use></svg>
                              </a>
                              <div class="option__status">
                                <span class="option__current">{{ key + 1 }}</span>
                                <span class="option__sep">|</span>
                                <span class="option__total">{{ Object.keys(modificationList).length }}</span>
                              </div>
                              <a href="#" @click.prevent="nextSlide('slider-m--1')" class="option__next">
                                <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-right"></use></svg>
                              </a>
                            </div>
                          </label>
                        </div>
                      </carousel>
                      <carousel class="slider-m slider-m--2" :nav="false" :dots="false" :items="1" :startPosition="currentModificationId + 1" :pullDrag="false" :touchDrag="false" :mouseDrag="false" :loop="false" :rewind="false" @changed="slideChanged2">
                        <div class="slider-m__item" v-for="(mod, key) in modificationList" :key="mod.id">
                          <label class="option">
                            <input type="radio" class="option__input" name="mod" :value="mod.id" v-model="modification" :class="{ 'is-current' : mod.id === modification }">
                            <div class="option__circle"></div>
                            <div class="option__description">
                              <div class="option__name">{{ mod.name }}</div>
                              <div class="option__price">{{ mod.minPrice | priceFormat }}</div>
                            </div>
                            <div class="option__nav">
                              <a href="#" @click.prevent="prevSlide('slider-m--2')" class="option__prev">
                                <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-left"></use></svg>
                              </a>
                              <div class="option__status">
                                <span class="option__current">{{ key + 1 }}</span>
                                <span class="option__sep">|</span>
                                <span class="option__total">{{ Object.keys(modificationList).length }}</span>
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
                      <td v-for="mod in modificationList" :key="mod.id">
                        <label class="option">
                          <input type="radio" class="option__input" name="mod" :value="mod.id" v-model="modification" :class="{ 'is-current' : mod.id === modification }">
                          <div class="option__circle"></div>
                          <div class="option__description">
                            <div class="option__name">{{ mod.name }}</div>
                            <div class="option__price">{{ mod.minPrice | priceFormat }}</div>
                          </div>
                        </label>
                      </td>
                      <td class="w32"></td>
                    </tr>
                  </table>
                  <div class="fm-diff-body" v-if="fullSpecifications.modifications.length > 1">
                      <checkbox name="isDifferentOnly" v-model="isDifferentOnly">
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
                          <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M11 1L6.66896 4.89793C6.28866 5.24021 5.71134 5.24021 5.33104 4.89793L1 1" stroke="black" stroke-width="2"/>
						  </svg>
                        </div>
                      </div>
                      <div class="fm-group-table" :data-collapse-target="key">
                        <table class="fm-t fm-group">
                          <template v-if="isDifferentOnly">
                          <template v-for="specRow in spec.data">
                            <template v-if="specRow.diff">
                              <tr class="spec-subtitle">
                                <td :colspan="fullSpecifications.modifications.length" v-html="specRow.name"></td>
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
                              <td :colspan="fullSpecifications.modifications.length" v-html="specRow.name"></td>
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
                                  <td colspan="2" v-html="specRow.name"></td>
                                </tr>
                                <tr class="spec-subrow">
                                  <td>
                                    <div class="spec-subrow__flex">
                                      <div class="spec-subrow__column">
                                        <template v-if="specRow.values[specModificationId1] === false">
                                          <svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg>
                                        </template>
                                        <template v-else-if="specRow.values[specModificationId1] === true">
                                          <svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg>
                                        </template>
                                        <template v-else>
                                          {{ specRow.values[specModificationId1] }}
                                        </template>
                                      </div>
                                      <div class="spec-subrow__column">
                                        <template v-if="specRow.values[specModificationId2] === false">
                                          <svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg>
                                        </template>
                                        <template v-else-if="specRow.values[specModificationId2] === true">
                                          <svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg>
                                        </template>
                                        <template v-else>
                                          {{ specRow.values[specModificationId2] }}
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
                                <td colspan="2 "v-html="specRow.name"></td>
                              </tr>
                              <tr class="spec-subrow">
                                <td>
                                  <div class="spec-subrow__flex">
                                    <div class="spec-subrow__column">
                                      <template v-if="specRow.values[specModificationId1] === false">
                                        <svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg>
                                      </template>
                                      <template v-else-if="specRow.values[specModificationId1] === true">
                                        <svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg>
                                      </template>
                                      <template v-else>
                                        {{ specRow.values[specModificationId1] }}
                                      </template>
                                    </div>
                                    <div class="spec-subrow__column">
                                      <template v-if="specRow.values[specModificationId2] === false">
                                        <svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg>
                                      </template>
                                      <template v-else-if="specRow.values[specModificationId2] === true">
                                        <svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg>
                                      </template>
                                      <template v-else>
                                        {{ specRow.values[specModificationId2] }}
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
                  <div class="fm-disclaimers">
                    <p class="fm-disclaimer" v-for="(disclaimer, key) of disclaimers">
                      <strong>{{ key }}</strong> – {{ disclaimer }}
                    </p>
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
                      <td class="w32"></td>
                      <td v-for="mod in modificationList" :key="mod.id">
                        <label class="option">
                          <input type="radio" class="option__input" name="mod" :value="mod.id" v-model="modification" :class="{ 'is-current' : mod.id === modification }">
                          <div class="option__circle"></div>
                          <div class="option__description">
                            <div class="option__name">{{ mod.name }}</div>
                            <div class="option__price">{{ mod.minPrice | priceFormat }}</div>
                          </div>
                        </label>
                      </td>
                      <td class="w32"></td>
                    </tr>
                  </table>
                  <a href="#" @click.prevent="hideFull" class="close"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-close-popup"></use></svg></a>
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
                    <carousel class="slider-m slider-m--1" :nav="false" :dots="false" :items="1" :startPosition="currentModificationId" :pullDrag="false" :touchDrag="false" :mouseDrag="false" :loop="false" :rewind="false" @changed="slideChanged1">
                      <div class="slider-m__item" v-for="(mod, key) in modificationList" :key="mod.id">
                        <label class="option">
                          <input type="radio" class="option__input" name="mod" :value="mod.id" v-model="modification" :class="{ 'is-current' : mod.id === modification }">
                          <div class="option__circle"></div>
                          <div class="option__description">
                            <div class="option__name">{{ mod.name }}</div>
                            <div class="option__price">{{ mod.minPrice | priceFormat }}</div>
                          </div>
                          <div class="option__nav">
                            <a href="#" @click.prevent="prevSlide('slider-m--1')" class="option__prev">
                              <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-left"></use></svg>
                            </a>
                            <div class="option__status">
                              <span class="option__current">{{ key + 1 }}</span>
                              <span class="option__sep">|</span>
                              <span class="option__total">{{ Object.keys(modificationList).length }}</span>
                            </div>
                            <a href="#" @click.prevent="nextSlide('slider-m--1')" class="option__next">
                              <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-right"></use></svg>
                            </a>
                          </div>
                        </label>
                      </div>
                    </carousel>
                    <carousel class="slider-m slider-m--2" :nav="false" :dots="false" :items="1" :startPosition="currentModificationId + 1" :pullDrag="false" :touchDrag="false" :mouseDrag="false" :loop="false" :rewind="false" @changed="slideChanged2">
                      <div class="slider-m__item" v-for="(mod, key) in modificationList" :key="mod.id">
                        <label class="option">
                          <input type="radio" class="option__input" name="mod" :value="mod.id" v-model="modification" :class="{ 'is-current' : mod.id === modification }">
                          <div class="option__circle"></div>
                          <div class="option__description">
                            <div class="option__name">{{ mod.name }}</div>
                            <div class="option__price">{{ mod.minPrice | priceFormat }}</div>
                          </div>
                          <div class="option__nav">
                            <a href="#" @click.prevent="prevSlide('slider-m--2')" class="option__prev">
                              <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-left"></use></svg>
                            </a>
                            <div class="option__status">
                              <span class="option__current">{{ key + 1 }}</span>
                              <span class="option__sep">|</span>
                              <span class="option__total">{{ Object.keys(modificationList).length }}</span>
                            </div>
                            <a href="#" @click.prevent="nextSlide('slider-m--2')" class="option__next">
                              <svg tabindex="-1" aria-visible="false"><use xlink:href="#ic-slider-arrow-right"></use></svg>
                            </a>
                          </div>
                        </label>
                      </div>
                    </carousel>
                  </div>
                  <a href="#" @click.prevent="hideFull" class="close"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-close-popup"></use></svg></a>
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
import Loader from '../Loader'
import toggleSlide from '../../assets/lib/slideToggle.js'
import carousel from 'vue-owl-carousel'

export default {
  name: 'Modifications',
  components: { Sidebar, Loader, carousel },
  data () {
    return {
      isFullActive: false,
      isDifferentOnly: false,
      isSticked: false,
      controlElement: null,
      controlElementContainer: null,
      controlElementContainerWidth: '100%',
      specModificationId1: 0,
      specModificationId2: 0
    }
  },
  computed: {
    modification: {
      get () {
        return this.$store.state.configuration.modification
      },
      set (value) {
        this.$store.dispatch('UPDATE_MODIFICATION', value)
      }
    },
    modificationList () {
		if (this.fullSpecifications) {
			return this.fullSpecifications.modifications.map((item)=>{
				item.minPrice = item.price

				return item;
			})
		} else {
			return this.modificationListSorted
		}
    },
    modificationListSorted () {
      let list = this.$store.getters.GET_MODIFICATION_LIST;
      let arr = [];
      for (var obj in list) {
        arr.push(list[obj])
      }
      return arr.sort(function (a, b) {
        if (a.order - b.order === 0) {
          return a.minPrice - b.minPrice
        } else {
          return a.order - b.order
        }
      })
    },
    fullSpecifications () {
      return this.$store.getters.GET_FULL_MODIFICATIONS
    },
    disclaimers () {
      return this.$store.getters.GET_FULL_MODIFICATIONS && this.$store.getters.GET_FULL_MODIFICATIONS.footnotes
    },
    currentModificationId () {
      let counter = 0

      for (var mod = 0; mod < this.modificationList.length; mod++) {
        if (this.modificationList[mod].id === this.modification) {
          counter = mod
          break
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
        this.specModificationId1 = data.item.index
      } else {
        this.specModificationId1 = 0
      }
    },
    slideChanged2 (data) {
      if (typeof data.item.index !== 'undefined') {
        this.specModificationId2 = data.item.index
      } else {
        this.specModificationId2 = 0
      }
    },
    compare () {
      alert('compare')
    },
    toggleFull () {
      this.isSticked = false
      window.addEventListener('keyup', this.hideFull, false)
      this.isFullActive = !this.isFullActive
      this.$store.dispatch('SET_APP_STATE', {fullModal: true})
      this.$root.$emit('fixOverflow', true)
      this.$store.dispatch('LOAD_FULL_MODIFICATIONS', this.$store.getters.GET_CURRENT_ID)
      // set start slide id for modification list
      this.specModificationId1 = this.currentModificationId
      if (this.currentModificationId === this.modificationList.length - 1) {
        this.specModificationId2 = 0
      } else {
        this.specModificationId2 = this.currentModificationId + 1
      }
    },
    hideFull (event) {
      if (event) {
        if ((event.type === 'keyup' && event.keyCode === 27) || event.type === 'click') {
          event.preventDefault()
          this.isFullActive = false
          this.isDifferentOnly = false
          this.$root.$emit('fixOverflow', false)
          this.$store.dispatch('SET_APP_STATE', { fullModal: false })
        }
      } else {
        this.isFullActive = false
        this.isDifferentOnly = false
        this.$root.$emit('fixOverflow', false)
        this.$store.dispatch('SET_APP_STATE', { fullModal: false })
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

<style lang="scss">
@import '../../assets/_mixins.scss';

.modification {}
.modification-list {
  display: flex;
  flex-wrap: wrap;
  overflow: hidden;
}
.modification-item {
  min-height: 168px;
  width: 50%;
  background: #fff;
  border-color: #ebebeb;
  border-width: 0 1px 1px 1px;
  border-style: solid;
  cursor: pointer;
  transition: background $tr-fast;
  padding: 20px 35px 23px 56px;
  position: relative;
  margin-bottom: 0;
  box-shadow: inset 0 0 0 0px #00AAD2;
  transition: box-shadow 0.3s;
  &:nth-of-type(-n+2) {
    border-top-width: 1px;
  }
  &:nth-of-type(2n) {
    border-left: none;
  }
  &.is-selected {
    box-shadow: inset 0 0 0 2px #00AAD2;
    .modification-circle {
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
  .modification-item {
    height: 33.333%;
  }
  @media (max-height: 919px) {
    .list-row--brief {
      display: none;
    }
  }
  @media (max-height: 650px) {
    .modification-body {
      bottom: 5px;
    }
  }
  @media (max-height: 580px) {
    .modification-item {
      padding: 16px 35px 16px 33px;
    }
  }
}
[data-rows="4"] {
  .modification-item {
    height: 25%;
    min-height: auto;
  }
  @media (max-height: 919px) {
    .list-row--brief {
      display: none;
    }
  }
  @media (max-height: 680px) {
    .modification-body {
      bottom: 15px;
    }
  }
  @media (max-height: 650px) {
    .modification-item {
      padding: 20px 35px 20px 33px;
    }
  }
}
.modification-circle {
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
.modification-head {
  .modification-list__row {
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;
    align-items: top;
  }
}
.modification-list__row {
  &--more {
    margin-top: 22px;
  }
  &--top {
    margin-bottom: 15px;
  }
}
.modification-body {

}
.modification-list__row {
  display: block;
}
.modification-name {
  font-size: 2.0rem;
  font-weight: 500;
  line-height: 1.2;
  transition: color $tr-fast;
  max-width: 200px;
  color: #000;
  margin-right: 25px;
}
.modification-price {
  font-weight: 500;
  font-size: 1.6rem;
  line-height: 1.5;
  white-space: nowrap;
  color: #000;
}
.modification-brief {
  line-height: 1.35;
  display: block;
  color: #666666;
  font-size: 1.6rem;
}
.modification-full {
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
.fm-disclaimers {
  padding: 40px 50px 50px;
}
.fm-disclaimer {
  color: #b2b2b2;
  text-align: justify;
  font-size: 12px;
  line-height: 1.3;
  strong {
    font-weight: 600;
    color: #2a2a2a;
  }
  & + & {
    margin-top: 13px;
  }
}

@media only screen and (max-width : 767px) {
  .modification-item {
    width: 100%;
    padding-top: 17px;
    padding-left: 48px;
    padding-right: 16px;
  }
  .modification-item:nth-of-type(2n) {
    border-left: 1px solid #ebebeb;
  }
  .modification-item:nth-of-type(-n+2) {
    border-top: none;
  }
  .modification-item:first-of-type {
    border-top: 1px solid #ebebeb;
  }
  .modification-name {
    font-size: 16px;
  }
  .modification-price {
    font-size: 14px;
  }
  .modification-brief {
    font-size: 14px;
  }
  .modification-circle {
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
