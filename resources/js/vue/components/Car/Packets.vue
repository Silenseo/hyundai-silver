<template>
  <div class="step">
    <div class="step__content packets container">
      <transition name="fade">
      <div style="height: 100%" class="row">
        <div style="height: 100%" class="col-md-12">
          <div class="content-wrapper">
            <div class="content-main">
              <div class="content-main__inner">
                <transition name="fade" appear>
                <div class="packets-list" v-if="packetsList">
                  <label class="packet-item check-box" v-for="packet in packetsList" :key="packet.id" :class="{ 'is-checked': packets.indexOf(packet.id) !== -1 }">
                    <input type="checkbox" :name="packet.id" :value="packet.id" :checked="packets.indexOf(packet.id) !== -1" @change="packetSelect($event, packet.id)">
                    <span class="checkbox-icon">
                      <svg>
                        <use xlink:href="#ic-check"></use>
                      </svg>
                    </span>
                    <span class="packet-info">
                      <span class="packet-header">
                        <strong class="packet-name">{{ packet.name }}</strong>
                        <strong class="packet-price">+ {{ packet.price | priceFormat }}</strong>
                        <a @click.prevent="togglePacketsDetail($event, packet.id)" href="#" class="df-iconed-link df-iconed-link--small packets-more">
                            Подробнее
                            <svg>
                                <use xlink:href="#arrow-link"></use>
                            </svg>
                        </a>
                      </span>
                      <span class="packet-notes" v-if="packet.unique === true">Пакет не совмещается с другими опциями</span>
                      <span class="packet-notes" v-else-if="packet.dependency !== null && packet.dependency !== 0">Пакет добавляется только вместе с <strong>«{{packetsList[packet.dependency].name}}»</strong></span>
                      <a @click.prevent="togglePacketsDetail($event, packet.id)" href="#" class="df-iconed-link df-iconed-link--small packets-more-m">
                          Подробнее
                          <svg>
                              <use xlink:href="#arrow-link"></use>
                          </svg>
                      </a>
                    </span>
                  </label>
                </div>
                </transition>

                <div class="content-footer">
                  <!-- <compare-button></compare-button> -->
                  <router-link class="button df-button content-footer__button" :to="{ name: 'Design', params: { id: this.$store.getters.GET_CURRENT_ID }}">Продолжить</router-link>
                </div>
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

    <transition name="modal-in-out">
      <div class="packet-details-wrapper" v-if="isPacketInfoActive" @click.prevent="togglePacketsDetail">
        <div class="packet-details" @click.prevent.stop="">
          <div class="packet-details__header">
              <span class="packet-details__title">{{packetsList[packetInfoID].name}}</span>
              <a href="#" @click.prevent="togglePacketsDetail" class="df-popup__close packet-close">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
                  <rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
                </svg>
              </a>
          </div>
          <div class="packet-details__body">
            <ul v-if="packetsList[packetInfoID]" class="packet__list">
              <li class="packet__item" v-for="detail in packetsList[packetInfoID].specifications" v-if="detail.value === true">{{ detail.name }}</li>
            </ul>
          </div>
          <div class="packet-details__footer">
            <span class="packet-details__price">+ {{ packetsList[packetInfoID].price | priceFormat }}</span>
            <a href="#" class="button button--ripple packet-details__add" @click.prevent="togglePacket(packetInfoID, packets.indexOf(packetInfoID) !== -1)" :class="{ 'is-added': packets.indexOf(packetInfoID) !== -1 }">
              <svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-checkmark"></use></svg>
              <div class="df-button packet-toadd">Добавить</div>
              <div class="packet-details__add-text">Добавлено</div>
            </a>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import Sidebar from '@/components/Car/Sidebar'
import CompareButton from '@/components/Car/Compare/CompareButton'

import { mapGetters } from 'vuex'

export default {
  name: 'Packets',
  components: { Sidebar, CompareButton },
  data () {
    return {
      isPacketInfoActive: false,
      packetInfoID: 0
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
    packets () {
      return this.$store.state.configuration.packets
    },
    ...mapGetters({
      complectationList: 'GET_COMPLECTATION_LIST',
      packetsList: 'GET_PACKETS_LIST'
    })
  },
  methods: {
    packetSelect (event, id, forceRemove) {
      let element = event ? event.target : null
      let array = this.packets.slice() // clone array of literal values w/o reference (so, w/o modifying store)
      const _packetsList = this.packetsList
      const packet = _packetsList[id]
      const unique = packet.unique
      const dependency = packet.dependency

      if ((element === null || (element && element.checked === true)) && !forceRemove) {
        if (unique === true) {
          array = [id]
        } else if (dependency !== null && dependency !== 0) {
          array.push(id)
          if (array.indexOf(dependency) < 0) {
            array.push(dependency)
          }
        } else if (array.length > 0) {
          array.push(id)
          // remove unique packet from array, if exist (on pushing something)
          Object.keys(_packetsList).map(function (objectKey, index) {
            let _packet = _packetsList[objectKey]
            let _index = array.indexOf(_packet.id)
            if (_packet.unique === true && _index !== -1) {
              array.splice(_index, 1)
            }
          })
        } else {
          array.push(id)
        }
      } else {
        let index = array.indexOf(id)
        array.splice(index, 1)
        // remove dependent packet if their dependency has been unchecked
        Object.keys(_packetsList).map(function (objectKey, index) {
          let _packet = _packetsList[objectKey]
          if (_packet.dependency !== null && _packet.dependency !== 0 && _packet.dependency === id) {
            if (array.indexOf(_packet.id) >= 0) {
              array.splice(array.indexOf(_packet.id), 1)
            }
          }
        })
      }
      // finally push new data
      this.$store.dispatch('UPDATE_PACKETS', array.sort(function (a, b) { return a - b }))
    },
    togglePacket (id, forceRemove, event) {
      this.packetSelect(null, id, forceRemove)
      if (!forceRemove) {
        this.togglePacketsDetail()
      }
    },
    togglePacketsDetail (event, id) {
      if (id && typeof id === 'number') {
        window.addEventListener('keyup', this.togglePacketsDetail, false)
        this.isPacketInfoActive = true
        this.packetInfoID = id
      } else if (!event || (event.type === 'keyup' && event.keyCode === 27) || event.type === 'click') {
        window.removeEventListener('keyup', this.togglePacketsDetail, false)
        this.isPacketInfoActive = false
        this.packetInfoID = 0
      }
      this.$root.$emit('fixOverflow', this.isPacketInfoActive)
      this.$store.dispatch('SET_APP_STATE', {fullModal: this.isPacketInfoActive})
    }
  },
  deactivated () {
    this.togglePacketsDetail()
  }
}
</script>

<style lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.packets {}
.complectation-item__packets {
  font-size: 12px;
  font-weight: 500;
  letter-spacing: .05em;
  text-transform: uppercase;
  &::before {
    content: '+ ';
    font-size: 16px;
    vertical-align: middle;
  }
}
.complectation-tab-wrap {
  height: 100%;
  width: 100%;
  overflow: hidden;
  position: relative;
}
.complectation-tab {
  height: 100%;
  width: 100%;
  position: absolute;
  transition: opacity .5s cubic-bezier(.55,0,.1,1), transform .5s cubic-bezier(.55,0,.1,1);
  &.complectation-tab--base {}
  &.complectation-tab--packets {
  }
}
.packet__item {
  position: relative;
  font-size: 16px;
  line-height: 24px;
  color: #000;
  font-weight: 500;
  padding-left: 20px;
  &::before {
    content: '';
    display: block;
    position: absolute;
    left: 0;
    top: 0.5em;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background-color: #000;
  }
  &:not(:last-of-type) {
    margin-bottom: 10px;
  }
}
.packets-list {
  position: relative;
  // height: calc(100% - 48px);
}
.packet-item {
  display: flex;
  flex-flow: row nowrap;
  align-items: flex-start;
  justify-content: space-between;
  height: calc(100% / 4);
  max-height: 104px;
  background: #fff;
  border-color: #ebebeb;
  border-width: 1px;
  border-style: solid;
  cursor: pointer;
  transition: background $tr-fast;
  padding: 30px 30px 32px 30px;
  position: relative;
  & + & {
    border-top-width: 0;
  }
  &::after {
    content: '';
    left: -1px;
    right: -1px;
    top: -1px;
    bottom: -1px;
    pointer-events: none;
    user-select: none;
    transition: border-width .35s ease-out 0s, .35s ease-out 0s;
    border-width: 0;
    border-color: #00add5;
    border-style: solid;
    position: absolute;
    opacity: 0;
  }
  &.is-checked {
    .checkbox-icon {
      border: 2px solid $second_blue;
      svg {
        transform: scale(1);
      }
   }
  }
  .checkbox-icon {
    display: block;
    position: relative;
    width: 16px;
    height: 16px;
    border: 2px solid $third_text;
    flex: 0 0 auto;
    margin-right: 24px;
    margin-top: 2px;
    svg {
      display: block;
      position: absolute;
      top: 0;
      right: 0;
      left: 0;
      bottom: 0;
      width: 80%;
      height: 80%;
      margin: auto;
      transform: scale(0);
      transition: 0.3s;
    }
  }
  &:hover {
    .packet-name {
      color: $hollow;
    }
  }
  input {
    height: 0;
    width: 0;
    position: absolute;
    visibility: hidden;
  }
}
.packet-info {
  flex: 1 1 auto;
  //overflow: hidden;
}
.packet-notes {
  display: block;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  line-height: 1;
  color: #666666;
  font-size: 16px;
  margin-top: 7px;
}
.packet-header {
  display: flex;
  align-items: baseline;
  justify-content: space-between;
}
.packet-name {
  flex: 0 0 auto;
  font-size: 2.0rem;
  font-weight: 500;
  line-height: 1;
  transition: color $tr-fast;
}
.packet-price {
  flex: 0 0 auto;
  font-weight: 400;
  font-size: 1.6rem;
  line-height: 1;
  margin-top: 2px;
  margin-right: 20px;
  margin-left: auto;
}
.packet-trigger-detail {
  flex: 0 0 auto;
  text-decoration: underline;
  margin-left: 60px;
  line-height: 25px;
  font-size: 14px;
  font-weight: 500;
  color: $sky;
  transition: opacity $tr-fast;
  &:hover {
    opacity: .5;
  }
  .ic-svg {
    width: 19px;
    height: 19px;
    margin-top: -1px;
    margin-right: 8px;
  }
}
.packet-details-wrapper {
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(#000,.35);
  position: fixed;
  min-height: 100%;
  max-width: 100%;
  width: 100%;
  overflow-x: hidden;
  overflow-y: auto;
  z-index: 201;
}
.packet-close {
  top: 20px;
  right: 20px;
}
.packet-details {
  background: #fff;
  padding: 54px 50px;
  padding-top: 78px;
  margin: 0 auto;
  overflow: hidden;
  max-width: 460px;
  left: 0;
  right: 0;
  position: absolute;
  top: 50%;
  transform: translate(0, -49%);
  @media (max-height: 650px) {
    transform: none;
    position: relative;
    top: 0;
    margin: 50px auto;
  }
}
.packets-more-m {
  display: none;
}
.packet-details__header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  .close {
    height: 36px;
    width: 36px;
    padding: 5.5px;
    .ic-svg {
      fill: #dcdcdc;
      width: 25px;
      height: 25px;
      transition: fill $tr-fast;
    }
    &:hover {
      opacity: 1;
      .ic-svg {
        fill: $hollow;
      }
    }
  }
}
.packet-details__title {
  font-size: 20px;
  line-height: 24px;
  font-weight: 500;
}
.packet-details__body {
  margin-top: 30px;
}
.packet-details__list {
  list-style: none;
  margin-bottom: 55px;
}
.packet-details__list-item {
  position: relative;
  display: block;
  font-size: 16px;
  padding-left: 30px;
  margin-bottom: 0.72em;
  line-height: 1.2;
  &::before {
    content: '';
    width: 4px;
    height: 4px;
    border-radius: 50%;
    position: absolute;
    left: 3px;
    top: .65em;
    display: inline-block;
    background: rgba(#353535, .2);
  }
}
.packet-details__footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 107px;
}
.packet-details__price {
  flex: none;
  font-size: 22px;
  font-weight: 500;
  color: #002C5F;
  line-height: 56px;
}
.button.button--ripple {
  position: relative;
  line-height: 56px;
}
.packet-details__add {
  display: block;
  flex-grow: 0;
  flex-shrink: 0;
  padding: 0;
  backface-visibility: hidden;
  overflow: hidden;
  transition: background $tr-fast, color $tr-fast, padding $tr-fast;
  &.is-added {
    background: transparent;
    opacity: 1;
    color: #013368;
    padding-left: 30px;
    .packet-toadd {
      display: none;
    }
    .packet-details__add-text {
      &:nth-of-type(1) {
        display: none;
      }
      &:nth-of-type(2) {
        display: block;
      }
    }
    &:hover {
      color: #15488b;
    }
    .ic-svg {
      opacity: 1;
      transform: scale(1)
    }
  }
  .packet-details__add-text {
    transition: opacity $tr-fast;
    will-change: transform;
    &:nth-of-type(2) {
      display: none;
    }
  }
  .ic-svg {
    transition: opacity $tr-fast, transform $tr-fast;
    transform: scale(0);
    fill: currentColor;
    opacity: 0;
    position: absolute;
    top: 18px;
    left: 0px;
    height: 19px;
    width: 21px;
  }
}

@media only screen and (max-width : 767px) {
  .packet-item {
    max-height: 100%;
    padding: 16px 15px 16px 15px;
  }
  .packet-item .checkbox-icon {
    width: 20px;
    height: 20px;
    margin-right: 13px;
    margin-top: -3px;
  }
  .packet-name {
    font-size: 16px;
  }
  .packet-price {
    font-size: 14px;
    margin-right: 0;
  }
  .packet-notes {
    font-size: 14px;
    margin-top: 15px;
    white-space: initial;
  }
  .packets-more {
    display: none;
  }
  .packets-more-m {
    display: inline-block;
    margin-top: 20px;
  }
  .content-footer__button {
    width: 100%;
    text-align: center;
  }
  .packet-details {
    padding-top: 50px;
    padding-left: 16px;
    padding-right: 16px;
  }
  .packet-details__price {
    width: 100%;
    margin-bottom: 10px;
  }
  .packet-details__footer {
    flex-wrap: wrap;
    margin-top: 50px;
  }
}
</style>
