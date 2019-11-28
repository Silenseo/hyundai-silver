<template>
  <transition name="modal-in-out" v-on:enter="onEnter">
    <div class="common-modal send-credit-modal" v-if="isActive">
      <transition name="fade">
      <div class="common-modal-holder" v-on-clickaway="close" v-show="!isRulesActive">
        <div class="common-modal-context">
          <div class="common-modal__header">
            <span class="common-modal__title">Выбор дилера и&nbsp;переход на&nbsp;сторонний ресурс</span>
            <a href="#" @click.prevent="close" class="close"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-close"></use></svg></a>
          </div>
          <div class="common-modal__body">
            <p>После выбора дилерского центра вы будете перемещены на сторонний ресурс для заполнения анкеты. Если вы согласны, выберите дилерский центр и нажмите кнопку «Далее».</p><br clear="all"/>
            <div class="common-modal__content">

              <div class="send-dealer-col">
                <list class="list-component--dealers" :hasScroll="true" :items="dealerCities" textKey="name" :initialValue="dealerCityID" @change="changeDealerCity"></list>
                <list class="list-component--dealers" :hasScroll="true" :items="currentDealers" textKey="name" :valueKey="credit_id" :initialValue="dealerIndex" @change="changeDealer"></list>

                <div class="send-dealer-form__row">
                    <a @click.prevent="gaSend" target="_blank" class="button button--ripple mdl-submit send-dealer-form__submit" :disabled='!(this.currentDealer.credit_id > 0)'>Далее</a>
                  </div>
              </div>
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
import List from '@/components/common/List'

export default {
  name: 'SendCredit',
  components: { List },
  mixins: [ clickaway ],
  props: [ 'isActive', 'carData', 'isRulesActive' ],
  data () {
    return {
      processing: false,
      sending: false,
      collected: {
        email: '',
        firstName: '',
        lastName: '',
        phone: '',
        salutation: 'Mr.',
        agreement: false
      },
      dealerCityID: 0,
      dealerIndex: 0
    }
  },
  computed: {
    ...mapGetters({
      pdfApi: 'GET_API_GET_PDF',
      dealerApi: 'GET_API_SEND_DEALER',
      carName: 'GET_CAR_NAME',
      carPicture: 'GET_CAR_PICTURE',
      modificationName: 'GET_MODIFICATION_NAME',
      complectationName: 'GET_COMPLECTATION_NAME',
      dealerCities: 'GET_DEALERS_CREDIT',
      carId: 'GET_CURRENT_ID'
    }),
    validation () {
      const reEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
      return {
        email: reEmail.test(this.collected.email),
        firstName: !!this.collected.firstName.trim(),
        lastName: !!this.collected.lastName.trim(),
        phone: !!this.collected.phone.trim(),
        agreement: this.collected.agreement
      }
    },
    isValid () {
      return true
/*
      const validation = this.validation
      return Object.keys(validation).every(function (key) {
        return validation[key]
      })
*/
    },
    calculatorProgram () {
      return this.$store.state.configuration.currentProgramID
    },
    dealerData () {
      let googleId = 0
      let yandexId = 0

      if (typeof window.ga !== 'undefined') {
        googleId = window.ga.getAll()[0].get('clientId')
      }

      if (typeof window.yaCounter23259694 !== 'undefined') {
        yandexId = window.yaCounter23259694.getClientID()
      }
      return {
        file: '', // - имя PDF-файла
        email: this.collected.email, // - адрес электронной почты клиента, из формы
        name: this.collected.firstName, // - имя из формы
        last_name: this.collected.lastName, // - фамилия из формы
        phone: this.collected.phone, // - телефон клиента, из формы
        model: this.carName, // - название тачки
        modification: this.$store.getters.GET_MODIFICATION_NAME,
        dealer: this.currentDealer.code,  // - SAP-код дилера, есть в API по дилерам
        salutation: this.collected.salutation, // - обращение, из формы (Mr. и Ms.),
        googleId: googleId,
        yandexId: yandexId
      }
    },
    currentDealers () {
      return this.dealerCities && this.dealerCities[this.dealerCityID].dealers || []
    },
    currentDealer () {
      return this.currentDealers && this.currentDealers[this.dealerIndex] || null
    },
    urlData () {
      let fee = Math.round(this.carData.sum * this.carData.pv_perc / 100)
      let url = 'https://credit-approval.ecredit.one/?car=' + this.carData.carName + '&fee=' + fee + '&sum=' + this.carData.sum + '&term=' + this.carData.tm + '&dealer=' + this.currentDealer.credit_id

      return url
    }
  },
  methods: {
    close () {
      this.$emit('close')
    },
    onEnter () {
      this.loadDealers()
    },
    gaSend () {
        dataLayer.push({
            "event": "custom_event",
            "category" : "Конфигуратор",
            "action": "Переход на предодобрение ",
            "label" : "Предодобрение заявки " + this.dealerData.model
          });

          console.log('Аналитика отправлена');

        var win = window.open(this.urlData, '_blank');
        win.focus();
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
            action: 'Отправка расчета дилеру',
            label: this.dealerData.model + ', ' + this.dealerData.modification
          })
          return axios.get(this.dealerApi, { params: Object.assign(this.dealerData, { file: response.data.file }) })
        })
        .then((response) => {
          if (!response || !response.data || !response.data.result) {
            throw new Error('Error sending request.')
          }
        })
    },
    loadDealers () {
      this.$store.dispatch('LOAD_DEALERS_CREDIT').catch(error => {
        this.$root.$emit('notify', { type: 'error', text: 'Ошибка при попытке запроса дилеров.\nПожалуйста, попробуйте позже.' })
        console.error('Unable to load dealers: ', error)
      })
    },
    changeDealerCity (value) {
      this.dealerCityID = value
      this.dealerIndex = 0
    },
    changeDealer (value) {
      this.dealerIndex = value
    },
    showRules () {
      this.$emit('showRules')
    }
  },
  mounted () {
    this.loadDealers()
  }
}
</script>
<style lang="scss">
@import '../assets/_mixins.scss';
.mdl-input {
  height: 39px;
}
.send-credit-modal {
  .common-modal-holder {
    background: #fff url('../assets/image/popup_bgr-2.jpg') no-repeat center bottom / cover;
    width: 700px;
  }
  .common-modal__content {
    margin-bottom: 10px;
    display: flex;
    flex-flow: row nowrap;
  }
  .send-dealer-col {
    flex: 1 1 50%;
    padding: 0 00px 0 0;
    & + & {
      padding: 0 0 0 0px;
    }
  }
  .send-dealer-form__row {
    padding-top: 40px;
    text-align: center;
  }
}

.send-dealer-form__row--has-radios {
  font-size: 0;
  white-space: nowrap;
}
.send-dealer-subtitle {
  line-height: 1;
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 29px;
}
.send-dealer-car {
  display: flex;
  flex-flow: row nowrap;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 40px;
}
.send-dealer-car__image {
  flex: 0 1 50%;
  max-width: 175px;
}
.send-dealer-car__info {
  flex: 0 1 50%;
}
.send-dealer-car__name {
  margin: 5px 0 8px;
}
.send-dealer-car__config {
  color: #a3a3a3;
  font-size: 15px;
  display: block;
  line-height: 1;
}
.send-dealer-form {
  font-size: 12px;
}
.send-dealer-form__submit {
  font-size: 1.083em;
  font-weight: 600;
  padding: 0;
  width: 190px;
  line-height: 52px;
}

.list-component.list-component--dealers {
  font-size: 12px;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  color: #303030;
  border-radius: 0;
  background: transparent;
  border-width: 0;
  border-bottom: 1px solid rgba(#000, .25);
  .list-item.selected-item {
    border-radius: inherit;
    padding: 14px 30px 12px 0;
    .ic-svg {
      fill: #002c5f;
      right: 7px;
    }
  }
  .list-component-holder {
    background: #f2efec;
    border-width: 0;
    // padding: 9px 0;
    padding: 0;
    height: 140px;
    border-radius: 0;
    // overflow: scroll;
  }
  &.is-active {
    .list-item.selected-item {
      color: #a3a3a3;
      &:hover {
        color: #002c5f;
      }
    }
  }
  .list {
    .list-item:first-of-type {margin-top: 9px;}
    .list-item:last-of-type {margin-bottom: 9px;}


  }
  .list-item {
    border-radius: 0;
    padding: 6px 0 7px 28px;
    &:hover {
      color: #033a79;
      background: transparent;
    }
  }
  & + & {
    margin-top: 22px;
  }
  @for $i from 0 to 10 {
    &:nth-of-type(#{$i}) {
      z-index: 5 - $i;
    }
  }
}

</style>
