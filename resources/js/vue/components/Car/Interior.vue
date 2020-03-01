<template>
  <div class="interior">
    <div class="design-layer__top">
      <a href="#" @click.prevent="subRoute" class="df-back-link">
        Экстерьер
        <svg aria-visible="false">
            <use xlink:href="#back-link"></use>
        </svg>
      </a>
      <div class="design-layer__controls">
        <!-- <gallery-button class="design-control design-control--gallery" v-if="gallery"></gallery-button> -->
      </div>
    </div>
    <div class="design-view-body">
      <div class="design-layer">
        <div class="design-layer__main">
          <interior-view></interior-view>
        </div>
      </div>
    </div>

    <div class="content-footer content-footer--sb">
      <div class="design-footer">
        <ul class="color-list" v-if="colors">
          <li v-for="color in colors" class="color-list__item">
          <label class="color-selector" :class="{ 'is-active' : color.id === currentColor }" :title="color.nameRus">
            <input type="radio" :name="'color[' + color.id + ']'" :value="color.id" v-model="currentColor">
            <span tabindex="-1" class="color-pick" :style="{ 'background-color': color.colorCode }"></span>
          </label>
          </li>
        </ul>
        <span class="current-color" v-if="colors">{{ colors[currentColor].name }}</span>
      </div>
      <div class="design-footer__bottom">
        <router-link class="df-button content-footer__button" :to="{ name: 'Summary', params: { id: this.$store.getters.GET_CURRENT_ID }}">
          Продолжить
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import GalleryButton from './Gallery/GalleryButton'
import InteriorView from './InteriorView'

export default {
  name: 'Interior',
  data () {
    return {}
  },
  components: { GalleryButton, InteriorView },
  computed: {
    ...mapGetters({
      colors: 'GET_INTERIOR_COLORS',
      gallery: 'GET_GALLERY'
    }),
    currentColor: {
      get () {
        return this.$store.state.configuration.interiorColor
      },
      set (value) {
        this.$store.dispatch('UPDATE_INTERIOR_COLOR', value)
      }
    }
  },
  methods: {
    subRoute () {
      this.$emit('subRoute', 'exterior')
    },
    getStyleString (id) {
      let styleString = 'url(' + this.colors[id].color_img + ')'
      return styleString
    }
  }
}
</script>

<style scoped lang="scss">
.design-layer__top {
  flex: none;
}
.design-view-body {
  flex-basis: 100%;
  margin-bottom: 0px;
}
.design-layer__main {
  @media (max-height: 670px) {
    //transform: translate(0, -15px);
  }
  @media (min-height: 800px) {
    //top: 35%;
    transform: translate(0, 0)
  }
}
</style>
