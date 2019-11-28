<template>
  <div class="f-items favourites-modifications">
    <div class="favourites-list-toggler">Характеристики</div>
    <div class="favourites-list-wrapper" ref="listWrapper">
      <div class="favourites-list-holder">
        <div class="f-items__row-group" v-for="(row, index) in items" v-if="(isDifferentOnly && row.hasDiff) || (!isDifferentOnly)">
          <template v-if="isDifferentOnly">
            <div class="f-items__group-name" @click="setCurrentSlide(index)" :class="{ 'is-expanded': currentSlide === index }">
              <span v-html="row.name"></span>
              <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6.66896 2.10207C6.28866 1.75979 5.71134 1.75979 5.33104 2.10207L1 6" stroke="black" stroke-width="2"/>
              </svg>
            </div>
            <div class="f-items__dd" :data-collapsed="index" :class="{ 'is-expanded': currentSlide === index }">
              <div class="f-items__row-wrapper" v-for="(col, index) in row.data" v-if="col.diff">
                <div class="f-items__row-name" v-html="col.name.name ? col.name.name : col.name"></div>
                <div class="f-items__row row-height" :class="{ noPromo: !isPromo }" :data-index="col.name" :style="{ 'transform' : 'translate(' + slideOffset + 'px, 0)', 'height' : height(col.name) }">
                  <div class="f-items-cell" v-for="value in col.values">
                    <template v-if="value === false">
                      <svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg>
                    </template>
                    <template v-else-if="value === true">
                      <svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg>
                    </template>
                    <template v-else>
                      <strong>{{ value }}</strong>
                    </template>
                  </div>
                </div>
                <hr>
              </div>
            </div>
          </template>
          <template v-else>
            <div class="f-items__group-name" @click="setCurrentSlide(index)" :class="{ 'is-expanded': currentSlide === index }">
              <span v-html="row.name"></span>
              <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6.66896 2.10207C6.28866 1.75979 5.71134 1.75979 5.33104 2.10207L1 6" stroke="black" stroke-width="2"/>
              </svg>
            </div>
            <div class="f-items__dd" :data-collapsed="index" :class="{ 'is-expanded': currentSlide === index }">
              <div class="f-items__row-wrapper" v-for="(col, index) in row.data">
                <div class="f-items__row-name" v-html="col.name.name ? col.name.name : col.name"></div>
                <div class="f-items__row row-height" :class="{ noPromo: !isPromo }" :data-index="col.name" :style="{ 'transform' : 'translate(' + slideOffset + 'px, 0)', 'height' : height(col.name) }">
                  <div class="f-items-cell" v-for="value in col.values">
                    <template v-if="value === false">
                      <svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg>
                    </template>
                    <template v-else-if="value === true">
                      <svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg>
                    </template>
                    <template v-else>
                      <strong>{{ value }}</strong>
                    </template>
                  </div>
                </div>
                <hr>
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// TODO: add style clearing on transition end, or recalculate at every move.
//Т.к. этот элемент используется и в основном списке и в промо, то, для синхронизации
//высоты строк и состояния дропдауна используются соответствующие методы.
//Данные для отрисовки промо списка приходят из родительского компонента Promo

export default {
  name: 'ModificationsList',
  props: [ 'items', 'isDifferentOnly', 'isExpanded', 'slideOffset', 'isPromo', 'inRows', 'inCurrentSlide' ],
  data () {
    return {
      maxHeight: 0,
      rows: [],
      currentSlide: 999,
    }
  },
  methods: {
    toggleExpanded () {
      this.$emit('toggleExpanded', !this.isExpanded)
    },
    height (index) {
      var height;

      if (Array.isArray(this.inRows)) {
        this.inRows.forEach((item)=>{
          if (item.id === index) {
            if (item.height) {
              height = item.height + 'px';
            } else {
              height = 'auto';
            }
          }
        })
      }

      return height;
    },
    calcHeight () {
      var that = this;

      if (!this.isPromo) {
        that.rows = [];

        $('.row-height.noPromo').each(function () {
          that.rows.push({
            id: $(this).data('index'),
            height: $(this).outerHeight()
          });
        });

        this.$emit('calcHeight', that.rows);
        $('.f-items__dd').hide();
      }
    },
    setCurrentSlide (key) {
      if (this.isPromo) {
        var target = document.querySelector('.favourites-promo').querySelector('[data-collapsed="' + key + '"]')
      } else {
        var target = document.querySelector('.f-list').querySelector('[data-collapsed="' + key + '"]')
      }

      if (this.currentSlide !== key) {
        this.currentSlide = key
        $(target).slideToggle();
      } else {
        this.currentSlide = 999
        $('.f-items__dd').slideUp();
      }
    }
  },
  watch: {
    isExpanded () {
      this.maxHeight = this.isExpanded ? this.$refs.listWrapper.firstChild.scrollHeight : 0
    },
    isDifferentOnly () {
      this.calcHeight();
    },
    currentSlide () {
      if (!this.isPromo) {
        this.$emit('setCurrentSlide', this.currentSlide);
      }
    },
    inCurrentSlide () {
      if (this.isPromo) {
        this.setCurrentSlide(this.inCurrentSlide)
      }
    }
  },
  mounted: function () {
    var that = this;

    this.$nextTick(() => {
      this.calcHeight();
    })
  }
}
</script>
<style lang="scss" scoped>
.f-items__group-name {
  &::after {
    display: none;
  }
}
</style>
