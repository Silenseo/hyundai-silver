<template>
    <div id="servicecalculator" class="service-calculator">
        <main-section></main-section>
        <sidebar></sidebar>
        <mobile-line></mobile-line>
        <find-dealer v-bind:city="city" v-bind:dealer="dealer" v-bind:isOpened="openFindDealer" v-on:city-detected="setCityFromMap" v-on:dealer-selected="selectDealerFromMap" v-on:close-this="closeFindDealer"></find-dealer>
		<contact-form v-bind:isOpened="openSendDealer" v-on:close-this="closeSendDealer"></contact-form>
		<rules v-bind:isOpened="openRules"></rules>
		<sent-successfully :phone-number="phone" v-bind:isOpened="openSuccess" v-on:close-this="closeSuccess"></sent-successfully>
		<notifier></notifier>
    </div>
</template>

<script>
import MainSection from '@/components/ServiceCalculator/MainSection'
import Sidebar from '@/components/ServiceCalculator/Sidebar'
import MobileLine from '@/components/ServiceCalculator/MobileLine'
import FindDealer from '@/components/common/FindDealer'
import ContactForm from '@/components/common/ContactForm.vue'
import Rules from '@/components/common/Rules.vue'
import SentSuccessfully from '@/components/common/SentSuccessfully.vue'
import Notifier from '@/components/Notifier'

import { mapGetters } from "vuex";

export default {
	name: 'ServiceCalculator',
	components: { MainSection, Sidebar, MobileLine, FindDealer, ContactForm, Rules, SentSuccessfully, Notifier },
//	props: [ 'dealerSAP' ],
	data () {
		return {
			popups: 0
		}
	},
	computed: {
		...mapGetters({
			ENV: "GET_ENV",
			openFindDealer: "OPEN_FIND_DEALER",
			openSendDealer: "OPEN_SEND_DEALER",
			openRules: "OPEN_RULES",
			openSuccess: "OPEN_SUCCESS",
			city: "GET_CITY",
			dealer: "GET_DEALER",
			phone: "GET_USER_PHONE"
		})
	},
	methods: {
		closeFindDealer: function () {
			this.$store.dispatch('OPEN_FIND_DEALER', false);
		},
		closeSendDealer: function () {
			this.$store.dispatch('OPEN_SEND_DEALER', false);
		},
		selectDealerFromMap: function (dealerCode) {
			this.$store.dispatch('SET_DEALER', dealerCode);
		},
		setCityFromMap: function (city) {
			this.$store.dispatch('SET_CITY', city);
		},
		closeSuccess: function () {
			this.$store.dispatch('OPEN_SUCCESS', false);
		},
		fixOverflow (makeFixed) {
			if (makeFixed === true) {
				document.body.style.overflow = 'hidden'
				this.popups++
			} else {
				this.popups--

				if (this.popups === 0) {
					document.body.style.overflow = ''
				}
			}
		}
	},
	mounted () {
    	this.selectDealerFromMap(window.sap);
        console.log(window.sap);
		//Получим список дилеров и городов и запишем их в хранилище
		if (this.ENV !== 'dealer') {
			this.$store.dispatch('GET_DEALERS')
				.catch(() => {
					this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
				})
		}

		//Получим данные по тачкам
		this.$store.dispatch('GET_DATA_CALC_TO')
			.then(()=>{
				this.$store.dispatch('GET_ENGINES')
			})
			.catch((err) => {
				this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
				console.log(err)
			})

		this.$root.$on('fixOverflow', this.fixOverflow)
	},
	watch: {

	}
}
</script>

<style lang="scss">

</style>
