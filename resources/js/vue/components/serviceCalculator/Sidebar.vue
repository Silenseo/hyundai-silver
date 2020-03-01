<template>
    <div class="sidebar">
        <div class="sidebar__title">{{ name }}</div>
        <div class="sidebar__image" v-if="imageExist">
            <img :src="img" :alt="name">
        </div>
        <div class="sidebar__line">
            <div class="sidebar__text">Стоимость работ</div>
            <div class="sidebar__value">{{ cost.works| priceFormat }}</div>
        </div>
        <div class="sidebar__line" v-if="cost.partsPl2 === 0">
			<div class="sidebar__text">Стоимость оригинальных зап.частей</div>
			<div class="sidebar__value">{{ cost.parts | priceFormat }}</div>
        </div>
		<template v-else>
			 <div class="sidebar__line">
				<label class="sidebar__label">
					<input type="radio" name="parts" value="parts" v-model="parts">
					<div class="sidebar__circle"></div>
					<div class="sidebar__text">Стоимость оригинальных зап.частей</div>
					<div class="sidebar__value sidebar__value--ml">{{ cost.parts | priceFormat }}</div>
				</label>
			</div>
			<div class="sidebar__line">
				<label class="sidebar__label">
					<input type="radio" name="parts" value="partsPl2" v-model="parts">
					<div class="sidebar__circle"></div>
					<div class="sidebar__text">Стоимость запчастей PL&nbsp;-&nbsp;2</div>
					<div class="sidebar__value sidebar__value--ml">{{ cost.partsPl2 | priceFormat }}</div>
				</label>
			</div>
		</template>
        <div class="sidebar__line sidebar__line--dropdown">
            <dropdown></dropdown>
        </div>
        <hr>
        <div class="sidebar__line">
            <div class="sidebar__text">Итого</div>
            <div class="sidebar__value sidebar__value--total" :class="{error: proxyCost === 'стомость уточняйте у дилера'}"><span v-html="proxyCost"></span><sup>*</sup></div>
        </div>
<!--
        <div class="sidebar__line" v-if="cost.total <= 0">
            <div class="sidebar__text">Уточняйте у дилера</div>
        </div>
-->
        <button @click.prevent="openSendDealer" :disabled="dealer === ''" class="sidebar__button df-button js-checkout-dervice">Записаться на сервис</button>
    </div>
</template>

<script>
import Dropdown from '@/components/serviceCalculator/Dropdown'
import { mapGetters } from 'vuex'

export default {
    name: 'Sidebar',
    components: {
        Selectize,
        Dropdown
	},
	data () {
		return {
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
		openSendDealer: function () {
			this.$store.dispatch('OPEN_SEND_DEALER', true);
		},
		openFindDealer: function () {
			this.$store.dispatch('OPEN_FIND_DEALER', true);
		}
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

<style lang="sass">

</style>
