<template>
	<keep-alive>
		<router-view></router-view>
	</keep-alive>
</template>

<script>

export default {
	name: 'TradeinSteps',
	props: { 
		sendUrl: {
			type: String,
			required: true
		}
	},
	data () {
		return {
			popups: 0
		}
	},
	methods: {
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
		this.$root.$on('fixOverflow', this.fixOverflow)
		this.$store.dispatch('SET_TRADEIN_URL', this.sendUrl);
	}
}
</script>

<style lang="sass">
@import '../../sass/pages/dealer/tradein/steps.sass'
</style>