<template>
    <div class="m-line" :class="{ isOpened: isOpened }">
        <div class="m-line__wrap">
            <div class="m-line__holder">
				<div class="m-line__overlay" @click.self="toggleLine"></div>
                <div class="m-line__body">
                    <div class="m-line__top" @click.prevent="toggleLine">
                        <div class="m-line__img" v-if="imageExist">
                            <img :src="img" :alt="name">
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
                            <div class="m-line__value">{{ cost.works| priceFormat }}</div>
                        </div>
                        <div class="m-line__line" v-if="cost.partsPl2 === 0">
                            <div class="m-line__text">Стоимость оригинальных зап.частей</div>
                            <div class="m-line__value">{{ cost.parts | priceFormat }}</div>
                        </div>
						<template v-else>
							<div class="m-line__line">
								<label class="sidebar__label">
									<input type="radio" name="partsM" value="parts" v-model="parts">
									<div class="sidebar__circle"></div>
									<div class="sidebar__text">Стоимость оригинальных зап.частей</div>
									<div class="sidebar__value sidebar__value--ml">{{ cost.parts | priceFormat }}</div>
								</label> 
							</div>
							<div class="m-line__line">
								<label class="sidebar__label">
									<input type="radio" name="partsM" value="partsPl2" v-model="parts">
									<div class="sidebar__circle"></div>
									<div class="sidebar__text">Стоимость запчастей PL&nbsp;-&nbsp;2</div>
									<div class="sidebar__value sidebar__value--ml">{{ cost.partsPl2 | priceFormat }}</div>
								</label> 
							</div>
						</template>
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
                        <a href="/find-dealer" class="m-line__find-dealer" v-if="ENV !== 'dealer'">
                            <svg>
                                <use xlink:href="#icon-map"></use>
                            </svg>
                            Найти дилера
                        </a>
                    </div>
                </div>
                <button :disabled="dealer === '' && ENV !=='dealer'" class="m-line__button m-line__button--collapse df-button" @click.prevent="openSendDealer">Записаться на сервис</button>
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
			isOpened: false,
			imageExist: true
        }
    },
    computed: {
        ...mapGetters({
			ENV: "GET_ENV",
			name: 'GET_CAR_NAME',
			img: 'GET_CAR_IMG',
			cost: 'GET_COST',
			dealer: 'GET_DEALER'
		}),
		proxyCost: function() {
			if (this.cost.total === 0) {
				return 'стомость уточняйте у дилера'
			} else {
				if (this.parts === 'partsPl2') {
					return (this.cost.partsPl2 + this.cost.works).toString().replace(/\D/g, '').replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' ') + ' ₽'
				} else {
					return this.cost.total.toString().replace(/\D/g, '').replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/g, ' ') + ' ₽'
				}
			}
		},
		parts: {
			set(val) {
				this.$store.dispatch('SET_SERVICE_PARTS', val);
			},
			get() {
				return this.$store.state.serviceParts;
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
	},
	watch: {
		img () {
			let img = new Image();

			img.src = this.img
			img.onerror = () => {
				this.imageExist = false
			}
		},
		cost () {
			if (this.cost.partsPl2 === 0) {
				this.parts = 'parts'
			}
		}
	}
}
</script>