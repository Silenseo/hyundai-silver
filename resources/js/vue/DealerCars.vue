<template>
	<keep-alive>
		<router-view></router-view>
	</keep-alive>
</template>

<script>

export default {
	name: 'DealerCars',
	components: {  },
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
	}
}
</script>