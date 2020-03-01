<template>
    <div>
		<cards-list></cards-list>
		<questions-and-answers></questions-and-answers>
		<form-section @show-rules="openRules = true"></form-section>
		<rules :is-opened="openRules" @close="openRules = false"></rules>
		<simple-sent-successfully :is-opened="openSuccess" v-on:close-this="closeSuccess"></simple-sent-successfully>
		<notifier></notifier>
    </div>
</template>

<script>
import CardsList from '@/components/contactUsPage/CardsList'
import QuestionsAndAnswers from '@/components/contactUsPage/QuestionsAndAnswers'
import FormSection from '@/components/contactUsPage/FormSection'
import Rules from '@/components/common/Rules.vue'
import SimpleSentSuccessfully from '@/components/common/SimpleSentSuccessfully.vue'
import Notifier from '@/components/Notifier'

import { mapGetters } from "vuex";

export default {
	name: 'ContactUsPage',
	components: { Notifier, Rules, SimpleSentSuccessfully, CardsList, QuestionsAndAnswers, FormSection },
	data () {
		return {
			popups: 0,
			openRules: false
		}
	},
	computed: {
		...mapGetters({
			ENV: "GET_ENV",
			openSuccess: "OPEN_SUCCESS"
		})
	},
	methods: {
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
	filters: {

	},
	mounted () {
		//Получим список дилеров и городов и запишем их в хранилище
		if (this.ENV !== 'dealer') {
			this.$store.dispatch('GET_DEALERS')
				.catch(() => {
					this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
				})
		}
		
		//Получим данные по тачкам
		this.$store.dispatch('GET_DATA', { getOld: true })
			.catch(() => {
				this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
			})

		this.$root.$on('fixOverflow', this.fixOverflow)
	}
}
</script>

<style lang="scss">

</style>
