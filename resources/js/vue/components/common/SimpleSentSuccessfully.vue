<template>
	<transition name="popup">
		<div class="s-success df-popup" v-show="isOpened">
			<div class="df-popup__wrap" @click.self="closeSuccess">
				<div class="s-success__center df-popup__center">
					<a href="#" @click.prevent="closeSuccess" class="s-success__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<div class="s-success__icon">
						<svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="28" cy="28" r="27" stroke="#666666" stroke-width="2"/>
							<path d="M16 29L24.5 37.5L40.5 18" stroke="#666666" stroke-width="2"/>
						</svg>
					</div>
					<h3 class="s-success__title">{{ text }}</h3>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
export default {
	name: "SimpleSentSuccessfully",
	components: {},
	props: ['isOpened', 'innerText'],
	data() {
		return {
			closeTimeOut: 5000
		};
	},
	computed: {
		text: function () {
			if (this.innerText) {
				return this.innerText;
			} else {
				return 'Благодарим вас за обращение';
			}
		}
	},
	methods: {
		closeSuccess: function () {
			this.$emit('close-this');
		}
	},
	filters: {},
	mounted() {
		
	},
	watch: {
		isOpened: function () {
			//автоматическое закрытие
			var that = this;

			if (this.isOpened) {
				setTimeout(function () {
					that.$emit('close-this');
				}, that.closeTimeOut)
			}
		}
	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'
@import '../../../../sass/common/components/_simple-sent-successfully.sass'
</style>