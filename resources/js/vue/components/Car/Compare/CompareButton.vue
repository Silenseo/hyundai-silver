<template>
  <a href="#" class="button button--ripple button--compare" @click.prevent="compare"><span class="compare-ic"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-compare"></use></svg></span>Сравнить параметры</a>
</template>

<script>
export default {
  name: 'CompareButton',
  data () {
    return {
      title: 'CompareButton'
    }
  },
  methods: {
    compare () {
      alert('compare')
    }
  }
}
</script>

<style scoped lang="scss">
@import '../../../assets/_mixins.scss';

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
</style>
