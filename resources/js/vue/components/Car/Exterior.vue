<template>
  <transition name="fade">
  <div class="exterior" v-if="exterior">
    <div class="design-view-body">
      <div class="design-layer">
        <div class="design-layer__main">
          <exterior-view/>
        </div>
      </div>
    </div>
    <div class="content-footer content-footer--sb">
      <div class="design-footer">
        <ul class="color-groups" v-if="exterior && exterior.colors">
          <li v-for="(group, key) in exterior.colors.groups" class="color-group">
            <span class="color-group__name">{{ key }}, &nbsp;</span>
            <span class="color-group__cost">{{ group[Object.keys(group)[0]].cost | priceFormat }}</span>
            <ul class="color-list">
              <li v-for="(color, key) in group" class="color-list__item">
              <label class="color-selector" :class="{ 'is-active' : color.id === currentColor }" :title="color.nameRus">
                <input type="radio" :name="'color[' + color.id + ']'" :value="color.id" v-model="currentColor">
                <span tabindex="-1" class="color-pick" :style="{ 'background-color': color.colorCode }"></span>
              </label>
              </li>
            </ul>
          </li>
        </ul>
        <span class="current-color" v-if="colors">{{ colors[currentColor].nameRus }} / {{ colors[currentColor].name }}</span>
      </div>
      <div class="design-footer__bottom">
        <a href="#" @click.prevent="subRoute" class="df-button content-footer__button">Продолжить</a>
      </div>
    </div>
  </div>
  </transition>
</template>

<script>
import { mapGetters } from 'vuex'
import ExteriorView from './ExteriorView'
import GalleryButton from './Gallery/GalleryButton'

export default {
  name: 'Exterior',
  components: { ExteriorView, GalleryButton },
  computed: {
    ...mapGetters({
      exterior: 'GET_EXTERIOR',
      spritespin: 'GET_360',
      colors: 'GET_EXTERIOR_COLORS',
      gallery: 'GET_GALLERY'
    }),
    currentColor: {
      get () {
        return this.$store.state.configuration.exteriorColor
      },
      set (value) {
        this.$store.dispatch('UPDATE_EXTERIOR_COLOR', value)
      }
    }
  },
  methods: {
    subRoute () {
      this.$emit('subRoute', 'interior')
    }
  }
}
</script>

<style scoped lang="scss">
@import '../../assets/_mixins.scss';

.exterior {}

.design-layer__top {
  display: none;
}

</style>
