<template>
  <transition name="modal-in-out">
    <div class="common-modal rules-agreement" v-if="isActive">
      <div class="common-modal-holder" v-on-clickaway="close">
        <div class="common-modal-context">
          <div class="common-modal__header">
            <span class="common-modal__title">Правила обработки персональных данных</span>
            <a href="#" @click.prevent.stop="close" class="close"><svg tabindex="-1" aria-visible="false" class="ic-svg"><use xlink:href="#ic-close"></use></svg></a>
          </div>
          <div class="common-modal__body" v-bar="{ preventParentScroll: true, scrollThrottle: 30 }">
            <div class="common-modal__content">
              <p><strong>Настоящим Я, в соответствии с требованиями Федерального закона от 27.07.06 №152-ФЗ «О персональных данных» даю свое согласие лично, своей волей и в своем интересе на обработку (сбор, систематизацию, накопление, хранение, уточнение (обновление, изменение), использование, распространение, передачу (включая трансграничную передачу), обезличивание, блокирование и уничтожение) моих персональных данных, в том числе с использованием средств автоматизации.</strong></p>
              <p>Такое согласие мною даётся в отношении следующих персональных данных: фамилии, имя, отчество; контактный адрес электронной почты (e-mail); контактный телефон; для определения потребностей в производственной мощности, мониторинга исполнения сервисными центрами гарантийной политики; ведения истории обращения в сервисные центры; проведения дилерами, дистрибьюторами, контрагентами маркетинговых исследований в области продаж, сервиса и послепродажного обслуживания; для рекламных, исследовательских, информационных, а также иных целей, в том числе, путем осуществления со мной прямых контактов по различным средствам связи.</p>
              <p>Согласие дается Hyundai Motor Company (Хёндэ Мотор Компани, 231 Янгджи-Донг, Сеочо-Гу, Сеул, 137-938, Республика Корея), ООО «Хендэ Мотор СНГ» (г. Москва, ул.Тестовская, д.10), ООО «Хендэ Мотор МануфактурингPус» (197706, Санкт-Петербург, г. Сестрорецк, Левашовское ш., д. 20, литер А).</p>
              <p> Я даю свое согласие передавать мои персональные данные для обработки исследовательским агентствам: ООО «Международный институт маркетинговых и социальных исследований «ГФК-Русь» (г. Москва, 9-я Парковая улица, д. 48, корп. 4), ЗАО «Бизнес Аналитика МК» (г. Москва, ул. Новослободская, д. 31, стр. 2); АО «АВТОАССИСТАНС» (г.Москва, ул. Обручева д. 52 стр.3), ООО «Ипсос» (г. Москва, Гамсоновскийпереулок, д. 5), а также любым другим третьим лицам, для целей, указанных в настоящем согласии.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
import { mixin as clickaway } from 'vue-clickaway'

export default {
  name: 'RulesAgreement',
  mixins: [ clickaway ],
  props: [ 'isActive' ],
  methods: {
    close () {
      this.$emit('close')
    }
  }
}
</script>

<style lang="scss">
@import '../assets/_mixins.scss';
.rules-agreement {
  .common-modal-holder {
    background: #fff url('../assets/image/popup_bgr.jpg') no-repeat center bottom / cover;
    width: 750px;
    height: 600px;
  }
  .common-modal__body {
    height: 355px;
    overflow-x: hidden;
    overflow-y: scroll;
    width: calc(100% - 8px);
  }
  .vb.vb-visible::after {
    width: 1px;
    margin-right: 4px;
    background: rgba(#000, .25);
  }
  .vb > .vb-dragger {
    border-radius: 5px;
    width: 9px;
    background: #00aed5;
    &:hover {
      background: #1ac6ec;
    }
  }
  .common-modal__content {
    p {
      padding-right: 50px;
      font-size: 16px;
      line-height: 26px;
      strong {
        font-weight: 500;
        font-size: 1.125em;
      }
      &:first-of-type {
        margin-top: -5px;
      }
    }
    p + p {
      margin-top: 35px;
    }
  }
}
</style>
