<template>
    <div class="sidebar">
        <div class="sidebar__title">{{ name }}</div>
        <div class="sidebar__image">
            <img :src="img" alt="">
        </div>
        <div class="sidebar__line">
            <div class="sidebar__text">Стоимость работ</div>
            <div class="sidebar__value" v-html="cost.works"></div>
        </div>
        <div class="sidebar__line">
            <div class="sidebar__text">Стоимость оригинальных зап.частей</div>
            <div class="sidebar__value" v-html="cost.parts"></div>
        </div>
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
		openSendDealer: function () {
			this.$store.dispatch('OPEN_SEND_DEALER', true);
		},
		openFindDealer: function () {
			this.$store.dispatch('OPEN_FIND_DEALER', true);
		}
    },
    filters: {

    },
    mounted () {
        this.$nextTick(function () {


        })
    },
    watch: {

    }
}
</script>

<style lang="sass">

</style>
