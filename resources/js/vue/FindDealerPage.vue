<template>
    <div id="finddealerpage">
		<cities-list></cities-list>
		<find-dealer :fullscreen-control="true" v-bind:disable-scroll="true" :ctrl-zoom="true" v-bind:is-find-dealer-page="true" v-bind:city="city" v-bind:dealer="dealer" v-bind:is-opened="openFindDealer" v-on:city-detected="setCityFromMap" v-on:dealer-selected="selectDealerFromMap"></find-dealer>
		<dealers-list></dealers-list>
		<!-- <back-call-form v-bind:is-opened="openBackCallPopup"></back-call-form> -->
		<rules v-bind:is-opened="openRules"></rules>
		<sent-successfully v-bind:is-opened="openSuccess" v-on:close-this="closeSuccess"></sent-successfully>
		<notifier></notifier>
    </div>
</template>

<script>
import FindDealer from '@/components/common/FindDealer.vue'
import Rules from '@/components/common/Rules.vue'
import SentSuccessfully from '@/components/common/SentSuccessfully.vue'
import DealersList from '@/components/FindDealerPage/DealersList.vue'
import CitiesList from '@/components/FindDealerPage/CitiesList.vue'
import BackCallForm from '@/components/FindDealerPage/BackCallForm.vue'
import Notifier from '@/components/Notifier'

import { mapGetters } from "vuex";

export default {
	name: 'FindDealerPage',
	components: { FindDealer, DealersList, CitiesList, Notifier, BackCallForm, Rules, SentSuccessfully },
	data () {
		return {
			openFindDealer: true
		}
	},
	computed: {
		...mapGetters({
			city: "GET_CITY",
			dealer: "GET_DEALER",
			openBackCallPopup: "OPEN_BACK_CALL",
			openRules: "OPEN_RULES",
			openSuccess: "OPEN_SUCCESS"
		})
	},
	methods: {
		setCityFromMap: function (city) {
			this.$store.dispatch('SET_CITY', city);
		},
		selectDealerFromMap: function (dealerCode) {
			this.$store.dispatch('SET_DEALER', dealerCode);
		},
		closeSuccess: function () {
			this.$store.dispatch('OPEN_SUCCESS', false);
		}
	},
	filters: {

	},
	mounted () {
		//Получим список дилеров и городов и запишем их в хранилище
		this.$store.dispatch('GET_DEALERS')
			.catch(() => {
				this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
			})
	},
	watch: {

	}
}
</script>

<style lang="scss">

</style>
