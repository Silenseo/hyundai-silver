<template>
	<transition name="popup" v-on:enter="onEnter" v-on:leave="onLeave">
		<div class="p-td df-popup" v-show="isOpened">
			<div class="df-popup__wrap" @mousedown.self="closeThis">
				<div class="p-td__center df-popup__center">
					<a href="#" @click.prevent="closeThis" class="p-td__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<sign-up-forms :noDefaultCar="noDefaultCar" form="test-drive" :page="page" @modules-loaded="modulesLoaded = true"></sign-up-forms>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
import SignUpForms from '../../SignUpForms'

import { mapGetters } from "vuex";

export default {
	name: "SignUpTestDriveFormPopup",
	components: { SignUpForms },
	props: ['page', 'noDefaultCar'],
	data() {
		return {
			modulesLoaded: false
		};
	},
	computed: {
		...mapGetters({
			isOpenedTD: "OPEN_TEST_DRIVE_POPUP",
		}),
		isOpened: function () {
			if (this.isOpenedTD && this.modulesLoaded) {
				return true
			} else {
				return false
			}
		}
	},
	methods: {
		closeThis: function () {
			this.$store.dispatch('OPEN_TEST_DRIVE_POPUP', false);
		},
		onEnter: function() {
			this.$root.$emit('fixOverflow', true)
		},
		onLeave: function() {
			this.$root.$emit('fixOverflow', false)
		},
	},
	mounted() {
		var that = this;

		this.$nextTick(function() {
			
		})
	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'

.p-td
	&__center
		padding: 40px 72px 48px
		background-color: #fff
		max-width: 1144px
		margin: 0 auto

@media only screen and (max-width : $md-max)
	.p-td
		&__center
			padding: 48px 16px 24px
			margin: 16px
			background-color: #fff
</style>