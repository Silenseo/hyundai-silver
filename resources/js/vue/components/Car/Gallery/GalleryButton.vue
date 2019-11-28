<template>
  <a href="#" @click.prevent="toggleGallery">
    <svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-gallery"></use></svg>
  </a>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'GalleryButton',
  computed: {
    ...mapGetters({
      app_state: 'GET_APP_STATE'
    })
  },
  methods: {
    toggleGallery () {
      window.addEventListener('keyup', this.hideGallery, false)
      this.$root.$emit('fixOverflow', !this.app_state.gallery)
      this.$store.dispatch('SET_APP_STATE', { gallery: !this.app_state.gallery })
    },
    hideGallery (event) {
      if (event && (event.type === 'keyup' && event.keyCode === 27)) {
        event.preventDefault()
        this.$root.$emit('fixOverflow', false)
        this.$store.dispatch('SET_APP_STATE', { gallery: false })
        window.removeEventListener('keyup', this.hideFull, false)
      }
    }
  }
}
</script>
