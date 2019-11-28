<template>
  <transition name="slide-up" v-on:enter="onShow" v-on:after-leave="onHide">
    <div class="notifier" v-show="active" @click.prevent.stop="hide" :class="styleType">
      <div class="notifier-body">
        <span class="notify__text" v-html="messageText"></span>
      </div>
    </div>
  </transition>
</template>

<script>
// using examples:
// this.$root.$emit('notify', { type: 'success', text: 'Success message.', persist: true })
// this.$root.$emit('notify', 'Message string')

// Assepts '\n' and converts to new line via '<br>'

// options object:
// type: @string, error | success – styling class
// text: @string, text message
// persist: @bool, no autohide if true

export default {
  name: 'Notifier',
  data () {
    return {
      options: {
        text: '',
        type: '',
        persist: false
      },
      active: false,
      timeoutID: null,
      timeoutDuration: 10000
    }
  },
  computed: {
    messageText () {
      return this.options.text.toString().replace(/\n/g, '<br>')
    },
    styleType () {
      return this.options.type || ''
    }
  },
  methods: {
    show (data) {
      clearTimeout(this.timeoutID)
      if (typeof data === 'object') {
        Object.assign(this.options, data)
      }
      if (typeof data === 'string') {
        Object.assign(
          this.options,
          {
            text: data,
            type: '',
            persist: false
          }
        )
      }
      this.active = true
    },
    hide () {
      this.active = false
    },
    onShow () {
      if (!this.options.persist) {
        this.timeoutID = setTimeout(() => {
          this.hide()
        }, this.timeoutDuration)
      }
    },
    onHide () {
      Object.assign(
        this.options,
        {
          text: '',
          type: '',
          persist: false
        }
      )
    }
  },
  mounted () {
	this.$root.$on('notify', this.show)
  }
}
</script>

<style lang="scss" scoped>
@import '../assets/_mixins.scss';

.notifier {
  position: fixed;
  bottom: 0;
  right: 0;
  background: #082c56;
  color: #fff;
  font-size: em(16);
  @include head-font;
  font-weight: 500;
  line-height: 1.2;
  letter-spacing: .015em;
  cursor: pointer;
  z-index: 5000;
  &.error {
    background: $bright-red;
    .notify__ic {
      display: none;
    }
  }
  &.success {
    .notify__text {
      max-width: 200px;
      margin-left: 90px;
      &::before {
        content: url('../assets/image/notifier-success.png');
        position: absolute;
        top: 50%;
        left: 45px;
        transform: translate(0, -50%);
      }
    }
  }
}
.notifier-body {
  position: relative;
  padding: 30px 25px;
}
.notify__text {
  cursor: inherit;
  max-width: 350px;
  display: block;
}

</style>
