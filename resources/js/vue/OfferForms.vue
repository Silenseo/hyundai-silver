<template>
    <div id="offerform">
        <button v-if="form === 'creditOffer'" @click.prevent="openOfferCredit" class="df-button">Заявка на кредит</button>
        <offer-credit-form v-if="form === 'creditOffer'" v-bind:isOpened="openOfferCreditForm" v-bind:category="category" v-on:close-this="closeOfferCredit"></offer-credit-form>
		<rules v-bind:isOpened="openRules"></rules>
        <simple-sent-successfully :isOpened="openSuccess" innerText="Форма успешно отправлена" @close-this="closeSuccess"></simple-sent-successfully>
		<notifier></notifier>
    </div>
</template>

<script>
import OfferCreditForm from '@/components/common/OfferCreditForm.vue'
import Rules from '@/components/common/Rules.vue'
import SimpleSentSuccessfully from '@/components/common/SimpleSentSuccessfully.vue'
import Notifier from '@/components/Notifier'

import { mapGetters } from "vuex";

export default {
	name: 'offerforms',
	components: { OfferCreditForm, Rules, SimpleSentSuccessfully, Notifier },
	props: ['form', 'category'], //page - название страницы, на которой размещён попап, может быть undefined
	data () {
		return {
			i30n: false,
			sentSuccess: false,
			popups: 0
		}
	},
	computed: {
		...mapGetters({
    		openOfferCreditForm: "OPEN_OFFER_CREDIT_FORM",
			openRules: "OPEN_RULES",
			openSuccess: "OPEN_SUCCESS",
		}),
		inMap: function () {
			if (typeof this.includeMap !== 'undefined') {
				return this.includeMap
			} else {
				return true
			}
		}
	},
	methods: {
    	openOfferCredit: function () {
        	console.log('open');
			this.$store.dispatch('OPEN_OFFER_CREDIT', true);
		},
		closeOfferCredit: function () {
    		console.log('close');
			this.$store.dispatch('OPEN_OFFER_CREDIT', false);
		},
		closeSuccess: function () {
			this.$store.dispatch('OPEN_SUCCESS', false);
		},
		setI30n: function (value) {
			this.i30n = value;
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
	filters: {

	},
	mounted () {
		//Получим список дилеров и городов и запишем их в хранилище
		this.$store.dispatch('GET_DEALERS')
			.catch((error) => {
				console.log(error)
				this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
			})

		//Получим данные по тачкам
		this.$store.dispatch('GET_DATA')
			.then(() => {
				//Установка тачки по умолчанию

				if (typeof commonCarCode !== 'undefined') {
					this.$store.dispatch('SET_MODEL', commonCarCode);
				}
			})
			.catch((error) => {
				console.log(error)
				this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
			})

		this.$root.$on('fixOverflow', this.fixOverflow)
	},
	watch: {

	}
}
</script>

<style lang="scss">

</style>
