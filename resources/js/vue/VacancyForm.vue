<template>
    <div>
		<form-section @show-rules="openRules = true"></form-section>
		<rules :is-opened="openRules" @close="openRules = false"></rules>
		<simple-sent-successfully :is-opened="openSuccess" @close-this="closeSuccess"></simple-sent-successfully>
		<notifier></notifier>
    </div>
</template>

<script>
import FormSection from '@/components/vacancyForm/FormSection.vue'
import Rules from '@/components/common/Rules.vue'
import SimpleSentSuccessfully from '@/components/common/SimpleSentSuccessfully.vue'
import Notifier from '@/components/Notifier'

import { mapGetters } from "vuex";

export default {
	name: 'VacancyForm',
	components: { Notifier, Rules, FormSection, SimpleSentSuccessfully },
	data () {
		return {
			popups: 0,
			openRules: false
		}
	},
	computed: {
		...mapGetters({
			openSuccess: "OPEN_SUCCESS",
		}),
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
		this.$root.$on('fixOverflow', this.fixOverflow)
	},
	watch: {

	}
}
</script>

<style lang="scss">

</style>
