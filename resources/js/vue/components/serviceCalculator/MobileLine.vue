<template>
    <div class="m-line" :class="{ isOpened: isOpened }">
        <div class="m-line__wrap">
            <div class="m-line__holder">
				<div class="m-line__overlay" @click.self="toggleLine"></div>
                <div class="m-line__body">
                    <div class="m-line__top" @click.prevent="toggleLine">
                        <div class="m-line__img">
                            <img :src="img" alt="">
                        </div>
                        <div class="m-line__description">
                            <div class="m-line__name">{{ name }}</div>
                            <div class="m-line__price" :class="{error: proxyCost === 'стомость уточняйте у дилера'}"><span v-html="proxyCost"></span><sup>*</sup></div>
                        </div>
                        <a href="#" class="m-line__toggle"></a>
                    </div>
                    <div class="m-line__middle">
                        <div class="m-line__line">
                            <div class="m-line__text">Стоимость работ</div>
                            <div class="m-line__value" v-html="cost.works"></div>
                        </div>
                        <div class="m-line__line">
                            <div class="m-line__text">Стоимость оригинальных зап.частей</div>
                            <div class="m-line__value" v-html="cost.parts"></div>
                        </div>
                        <div class="m-line__line m-line__line--dropdown">
                            <dropdown></dropdown>
                        </div>
                    </div>
                    <div class="m-line__bottom">
                        <div class="m-line__line">
                            <div class="m-line__text">Итого</div>
                            <div class="m-line__value m-line__value--total" :class="{error: proxyCost === 'стомость уточняйте у дилера'}"><span v-html="proxyCost"></span><sup>*</sup></div>
                        </div>
                        <button :disabled="dealer === ''" class="m-line__button df-button" @click.prevent="openSendDealer">Записаться на сервис</button>
                        <a href="/find-dealer" class="m-line__find-dealer">
                            <svg>
                                <use xlink:href="#icon-map"></use>
                            </svg>
                            Найти дилера
                        </a>
                    </div>
                </div>
                <button :disabled="dealer === ''" class="m-line__button m-line__button--collapse df-button" @click.prevent="openSendDealer">Записаться на сервис</button>
            </div>
        </div>
    </div>
</template>

<script>
import Dropdown from '@/components/serviceCalculator/Dropdown'
import { mapGetters } from 'vuex'

export default {
    name: 'MobileLine',
    components: { Dropdown },
    data () {
        return {
            isOpened: false
        }
    },
    computed: {
        ...mapGetters({
			name: 'GET_CAR_NAME',
			img: 'GET_CAR_IMG',
			cost: 'GET_COST',
			dealer: 'GET_DEALER'
		}),
		proxyCost: function() {
			if (this.cost.total === 0) {
				return 'стомость уточняйте у дилера'
			} else {
				return this.cost.total
			}
		}
    },
    methods: {
        toggleLine: function () {
            this.isOpened = !this.isOpened;
        },
		openSendDealer: function () {
			this.$store.dispatch('OPEN_SEND_DEALER', true);
		},
		openFindDealer: function () {
			this.$store.dispatch('OPEN_FIND_DEALER', true);
		}
    },
    mounted () {
        var that = this;

        this.$nextTick(function () {
           $(document).on('click', function (e) {
               if ($(e.target).parents('.m-line').length === 0 && that.isOpened) {
                   that.isOpened = false;
               }
           })
        })
    }
}
</script>