<template>
  <transition name="modal-in-out" v-on:enter="onEnter">
    <div class="common-modal test-drive-modal" v-if="isActive">
      <transition name="fade">
      <div class="common-modal-holder" v-on-clickaway="close" v-show="!isRulesActive">
        <div class="common-modal-context">
          <div class="common-modal__header">
            <span class="common-modal__title">Заявка на тест-драйв</span>
            <a href="#" @click.prevent="close" class="close"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-close"></use></svg></a>
          </div>
          <div class="common-modal__body">
            <div class="common-modal__content">
              <div class="test-drive-col">
                <div class="test-drive-subtitle">Ваша модель</div>
                  <div class="test-drive-car">
                    <img class="test-drive-car__image" :src="carPicture" :alt="carName">
                    <div class="test-drive-car__info">
                      <div class="test-drive-car__name test-drive-subtitle">{{ carName }}</div>
                    </div>
                  </div>
                <div class="test-drive-subtitle">Дилер</div>
                <list class="list-component--dealers" :hasScroll="true" :items="dealerCities" textKey="name" :initialValue="dealerCityID" @change="changeDealerCity"></list>
                <list class="list-component--dealers" :hasScroll="true" :items="currentDealers" textKey="name" :initialValue="dealerIndex" @change="changeDealer"></list>
              </div>
              <div class="test-drive-col">
                <div class="test-drive-subtitle">Ваши данные</div>
                <form class="test-drive-form" :class="{ 'is-busy' : sending }">
                  <div class="test-drive-form__row test-drive-form__row--has-radios">
                    <label class="mdl-input-label mdl-radio-label">
                      <input type="radio" value="Mr." class="mdl-radio" v-model="collected.salutation" :disabled="sending">
                      <span class="mdl-radio-tick">Уважаемый</span>
                    </label>
                    <label class="mdl-input-label mdl-radio-label">
                      <input type="radio" value="Ms." class="mdl-radio" v-model="collected.salutation" :disabled="sending">
                      <span class="mdl-radio-tick">Уважаемaя</span>
                    </label>
                  </div>
                  <div class="test-drive-form__row">
                    <label class="mdl-input-label" :class="{ 'warn' : !validation.firstName && processing }">
                      <input type="text" name="mdl_first_name" class="mdl-input" placeholder="Имя" v-model="collected.firstName" :disabled="sending" v-filter="'[a-zA-Zа-яА-Я]'">
                      <span class="mdl-input-warn-hepler">Заполните поле</span>
                    </label>
                  </div>
                  <div class="test-drive-form__row">
                    <label class="mdl-input-label" :class="{ 'warn' : !validation.lastName && processing }">
                      <input type="text" name="mdl_last_name" class="mdl-input" placeholder="Фамилия" v-model="collected.lastName" :disabled="sending" v-filter="'[a-zA-Zа-яА-Я]'">
                      <span class="mdl-input-warn-hepler">Заполните поле</span>
                    </label>
                  </div>
                  <div class="test-drive-form__row">
                    <label class="mdl-input-label" :class="{ 'warn' : !validation.phone && processing }">
                      <input type="text" name="mdl_phone" class="mdl-input" v-mask="'+7 ### ###-##-##'" placeholder="+7" v-model="collected.phone" :disabled="sending">
                      <span class="mdl-input-warn-hepler">Формат email name@email.ru</span>
                    </label>
                  </div>
                  <div class="test-drive-form__row">
                    <label class="mdl-input-label" :class="{ 'warn' : !validation.email && processing }">
                      <input type="text" name="mdl_email" class="mdl-input" placeholder="E-Mail" v-model="collected.email" :disabled="sending">
                      <span class="mdl-input-warn-hepler">Формат email name@email.ru</span>
                    </label>
                  </div>
                  <div class="test-drive-form__row">
                    <label class="mdl-input-label mdl-checkbox-label" :class="{ 'warn' : !validation.agreement && processing }">
                      <input type="checkbox" name="mdl_agreement" v-model="collected.agreement" class="mdl-checkbox">
                      <span class="mdl-checkbox-tick"></span>
                      Я согласен с <a href="#" class="mdl-checkbox-rules-link" @click.prevent.stop="showRules">правилами обработки</a> персональных данных
                    </label>
                  </div>
                  <div class="test-drive-form__row">
                    <button type="submit" class="button button--ripple mdl-submit test-drive-form__submit" @click.prevent="submit" :disabled="sending">{{ sending ? 'Отправка...' : 'Отправить'}}</button>
                  </div>
                </form>
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
  name: 'SendDealer',
  components: { List },
  mixins: [ clickaway ],
  props: [ 'isActive', 'isRulesActive' ],
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
      testDriveApi: 'GET_API_TESTDRIVE',
      carName: 'GET_CAR_NAME',
      carId: 'GET_CURRENT_ID',
      carPicture: 'GET_CAR_PICTURE',
      modificationName: 'GET_MODIFICATION_NAME',
      complectationName: 'GET_COMPLECTATION_NAME',
      dealerCities: 'GET_DEALERS'
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
      const validation = this.validation
      return Object.keys(validation).every(function (key) {
        return validation[key]
      })
    },
    calculatorProgram () {
      return this.$store.state.configuration.currentProgramID
    },
    currentDealers () {
      return this.dealerCities && this.dealerCities[this.dealerCityID].dealers || []
    },
    currentDealer () {
      return this.currentDealers && this.currentDealers[this.dealerIndex] || null
    },
    currentCity () {
      return this.dealerCities && this.dealerCities[this.dealerCityID] && this.dealerCities[this.dealerCityID].name || null
    },
    testDriveData () {
      return {
        email: this.collected.email, // - адрес электронной почты клиента, из формы
        name: this.collected.firstName, // - имя из формы
        last_name: this.collected.lastName, // - фамилия из формы
        phone: this.collected.phone, // - телефон клиента, из формы
        carName: this.carName, // - название тачки
        dealer: this.currentDealer.code,  // - SAP-код дилера, есть в API по дилерам
        salutation: this.collected.salutation, // - обращение, из формы (Mr. и Ms.)
        city: this.currentCity, // название города / региона
        carId: this.carId,
        from_url: window.location.href
      }
    }
  },
  methods: {
    close () {
      this.$emit('close')
    },
    onEnter () {
      this.loadDealers()
    },
    submit () {
      this.processing = true
      if (this.isValid) {
        this.processing = false
        this.sending = true
        this.send().then(() => {
          this.sending = false
          this.$root.$emit('notify', { type: 'success', text: 'Успешно.' })
        }, (error) => {
          this.sending = false
          this.$root.$emit('notify', { type: 'error', text: 'Ошибка отправки запроса.\nПожалуйста, попробуйте позже.' })
          console.error(error)
        })
      }
    },
    send () {
      this.$gtm.trackEvent({
        event: 'custom_event',
        category: 'Конфигуратор',
        action: 'Запись на тест-драйв',
        label: this.testDriveData.carName
      })
      return axios.get(this.testDriveApi, { params: this.testDriveData })
      .then((response) => {
        if (!response || !response.data || !response.data.result) {
          throw new Error('Error sending request.')
        }
      })
    },
    loadDealers () {
      this.$store.dispatch('LOAD_DEALERS').catch(error => {
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

.test-drive-modal {
  .common-modal-holder {
    background: #fff url('../assets/image/popup_bgr-2.jpg') no-repeat center bottom / cover;
    width: 1000px;
  }
  .common-modal__content {
    margin-bottom: 10px;
    display: flex;
    flex-flow: row nowrap;
  }
}
.test-drive-col {
  flex: 1 1 50%;
  padding: 0 60px 0 0;
  & + & {
    padding: 0 0 0 60px;
  }
}
.test-drive-form__row--has-radios {
  font-size: 0;
  white-space: nowrap;
}
.test-drive-subtitle {
  line-height: 1;
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 29px;
}
.test-drive-car {
  display: flex;
  flex-flow: row nowrap;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 40px;
}
.test-drive-car__image {
  flex: 0 1 50%;
  max-width: 175px;
}
.test-drive-car__info {
  flex: 0 1 50%;
}
.test-drive-car__name {
  margin: 5px 0 8px;
}
.test-drive-car__config {
  color: #a3a3a3;
  font-size: 15px;
  display: block;
  line-height: 1;
}
.test-drive-form {
  font-size: 12px;
}
.test-drive-form__submit {
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
