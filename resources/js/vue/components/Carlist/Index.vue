<template>
  <div class="car-list">
    <div class="car-list__filter">
      <car-filter></car-filter>
    </div>
    <div class="car-list__showroom">
      <showroom></showroom>
    </div>
  </div>
</template>

<script>
import CarFilter from '@/components/Carlist/CarFilter'
import Showroom from '@/components/Carlist/Showroom'
import store from '@/store'

export default {
  name: 'carlist',
  data () {
    return {
      title: 'Выберите модель'
    }
  },
  components: { CarFilter, Showroom },
  beforeRouteEnter (to, from, next) {
    store.dispatch('CLEAR_CURRENT_CONFIGURATION')
    next()
  },
  created () {
    this.$store.dispatch('LOAD_CARLIST').catch(error => {
      this.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки запроса.\nПожалуйста, попробуйте позже.' })
      console.error('Unable to load car list: ', error.message)
    })
  }
}
</script>

<style lang="scss">
@import '../../assets/_mixins.scss';
@import '../../../../sass/common/variables';

.car-list {
  padding-top: 60px;
}
.car-list__header {
   @include layout;
}
.car-list__filter {
  position: relative;
  overflow: hidden;
  z-index: 1;
  background-color: #fff;
  box-shadow: 0 40px 50px -30px rgba(230,230,230, .45);
}
.car-list__showroom {
  position: relative;
  min-height: calc(100vh - 395px);
  background: #F9F8FA url('../../assets/image/bgr_1.jpg') no-repeat center 0 / cover;
  padding-bottom: 56px;
  padding-top: 32px;
}

// .header {
//   line-height: 0.9;
//   padding: 30px 0;
//   font-size: 40px;
//   letter-spacing: .008em;
//   font-weight: 500;
// }

@media only screen and (max-width : $lg-max) {
  .car-list {
    padding-top: 40px;
  }
}
</style>
