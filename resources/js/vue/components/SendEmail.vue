<template>
  <transition name="modal-in-out">
    <div class="common-modal send-email-modal" v-if="isActive">
      <transition name="fade">
      <div class="common-modal-holder" v-on-clickaway="close" v-show="!isRulesActive">
        <div class="common-modal-context">
          <div class="common-modal__header">
            <span class="common-modal__title">Отправить на&nbsp;email</span>
            <a href="#" @click.prevent="close" class="close"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-close"></use></svg></a>
          </div>
          <div class="common-modal__body">
            <div class="common-modal__content">
              <form class="send-email-form" :class="{ 'is-busy' : sending }">
                <div class="send-email-form__row">
                  <label class="mdl-input-label" :class="{ 'warn' : !validation.email && processing }">
                    <input type="text" name="mdl_email" class="mdl-input" placeholder="E-Mail" v-model="collected.email" :disabled="sending">
                    <span class="mdl-input-warn-hepler">Формат email name@email.ru</span>
                  </label>
                </div>
                <div class="send-email-form__row">
                  <label class="mdl-input-label" :class="{ 'warn' : !validation.firstName && processing }">
                    <input type="text" name="mdl_first_name" class="mdl-input" placeholder="Имя" v-model="collected.firstName" :disabled="sending" v-filter="'[a-zA-Zа-яА-Я]'">
                    <span class="mdl-input-warn-hepler">Заполните поле</span>
                  </label>
                </div>
                <div class="send-email-form__row">
                  <label class="mdl-input-label" :class="{ 'warn' : !validation.lastName && processing }">
                    <input type="text" name="mdl_last_name" class="mdl-input" placeholder="Фамилия" v-model="collected.lastName" :disabled="sending" v-filter="'[a-zA-Zа-яА-Я]'">
                    <span class="mdl-input-warn-hepler">Заполните поле</span>
                  </label>
                </div>
                <div class="send-email-form__row">
                  <label class="mdl-input-label mdl-checkbox-label" :class="{ 'warn' : !validation.agreement && processing }">
                    <input type="checkbox" name="mdl_agreement" v-model="collected.agreement" class="mdl-checkbox">
                    <span class="mdl-checkbox-tick"></span>
                    Я согласен с <a href="#" class="mdl-checkbox-rules-link" @click.prevent.stop="showRules">правилами обработки</a> персональных данных
                  </label>
                </div>
                <div class="send-email-form__row">
                  <button type="submit" class="button button--ripple mdl-submit send-email-form__submit" @click.prevent="submit" :disabled="sending">{{ sending ? 'Отправка...' : 'Отправить'}}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      </transition>
    </div>
  </transition>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'
import { mixin as clickaway } from 'vue-clickaway'

export default {
  name: 'SendEmail',
  props: [ 'isActive', 'pdfData', 'isRulesActive' ],
  mixins: [ clickaway ],
  data () {
    return {
      processing: false,
      sending: false,
      collected: {
        email: '',
        firstName: '',
        lastName: '',
        agreement: false
      }
    }
  },
  computed: {
    ...mapGetters({
      pdfApi: 'GET_API_GET_PDF',
      emailApi: 'GET_API_SEND_EMAIL'
    }),
    validation () {
      const reEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
      return {
        email: reEmail.test(this.collected.email),
        firstName: !!this.collected.firstName.trim(),
        lastName: !!this.collected.lastName.trim(),
        agreement: this.collected.agreement
      }
    },
    isValid () {
      const validation = this.validation
      return Object.keys(validation).every(function (key) {
        return validation[key]
      })
    },
    calculatorProgram () {
      return this.$store.state.configuration.currentProgramID
    },
    emailData () {
      let googleId = 0
      let yandexId = 0

      if (typeof window.ga !== 'undefined') {
        googleId = window.ga.getAll()[0].get('clientId')
      }

      if (typeof window.yaCounter23259694 !== 'undefined') {
        yandexId = window.yaCounter23259694.getClientID()
      }

      return {
        email: this.collected.email, // - мыло из формы
        file: '', // - имя файла из предыдущего запроса
        name: this.collected.firstName, // - имя из формы
        last_name: this.collected.lastName, // - фамилия из формы
        car_id: this.$store.getters.GET_CURRENT_ID, // - ID тачки.
        car_name: this.$store.getters.GET_CAR_NAME,
        googleId: googleId,
        yandexId: yandexId
      }
    }
  },
  methods: {
    close () {
      this.$emit('close')
    },
    submit () {
      this.processing = true
      if (!this.pdfData) {
        this.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки запроса.\nПожалуйста, попробуйте позже.' })
        console.error('PDF data error.')
        return false
      }
      if (this.isValid) {
        this.processing = false
        this.sending = true
        this.send().then(() => {
          this.sending = false
          this.$root.$emit('notify', { type: 'success', text: 'Успешно.' })
          this.close()
        }, (error) => {
          this.sending = false
          this.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки запроса.\nПожалуйста, попробуйте позже.' })
          console.error(error)
        })
      }
    },
    send () {
      return axios.get(this.pdfApi, { params: this.pdfData })
        .then((response) => {
          if (!response || !response.data || !response.data.success) {
            throw new Error('Error getting PDF.')
          }
          this.$gtm.trackEvent({
            event: 'custom_event',
            category: 'Конфигуратор',
            action: 'Отправка письма на e mail',
            label: this.emailData.car_name
          })
          return axios.get(this.emailApi, { params: Object.assign(this.emailData, { file: response.data.file }) })
        })
        .then((response) => {
          if (!response || !response.data || !response.data.result) {
            throw new Error('Error sending request.')
          }
        })
    },
    showRules () {
      this.$emit('showRules')
    }
  }
}
</script>
<style lang="scss">
@import '../assets/_mixins.scss';

.send-email-modal {
  .common-modal-holder {
    background: #fff url('../assets/image/popup_bgr-3.jpg') no-repeat center bottom / cover;
  }
  .common-modal__content {
    margin-bottom: 10px;
  }
  .common-modal__header {
    margin-bottom: 45px;
  }
}
.send-email-form {
  font-size: 12px;
}
.send-email-form__submit {
  font-size: 1.083em;
  font-weight: 600;
  padding: 0;
  width: 190px;
  line-height: 52px;
}
</style>
