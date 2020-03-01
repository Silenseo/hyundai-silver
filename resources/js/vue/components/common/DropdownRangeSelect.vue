<template>
	<div class="dd-multi" :ref="selectId" :class="{ active: isOpened }">
		<a href="#" class="dd-multi__head" @click.self.prevent="toggleDropdown" :class="{ active: isOpened, full: to !== '0' }">
			{{ placeholder }}
			<span v-if="to !== '0'">:&nbsp;&nbsp;{{ proxyFrom }}&nbsp;-&nbsp;{{ proxyTo }}</span>
			<div class="dd-multi__arrow" :class="{ active: to !== '0' }">
				<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="black"/>
				</svg>
			</div>
			<div class="dd-multi__clear" @click.prevent="clearSelect" :class="{ active: to !== '0' }">
				<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect y="7.27264" width="10.2851" height="1.02851" transform="rotate(-45 0 7.27264)" fill="black"/>
					<rect x="0.726562" width="10.2851" height="1.02851" transform="rotate(45 0.726562 0)" fill="black"/>
				</svg>
			</div>
		</a>
		<div class="dropdown" :class="{ active: isOpened }">
			<div class="dropdown__body">
				<div class="dropdown__from">
					<span>От</span>
					<input class="df-input" type="text" v-model.lazy="proxyFrom" v-money="money">
				</div>
				<div class="dropdown__to">
					<span>До</span>
					<input class="df-input" type="text" v-model.lazy="proxyTo" v-money="money" @blur="setToValue">
				</div>
			</div>
			<div class="dropdown__footer">
				<button class="df-button dropdown__button">Применить</button>
			</div>
		</div>
	</div>
</template>

<script>
import { VMoney } from 'v-money'

export default {
	name: 'DropdownRangeSelect',
	props: {
		placeholder: {
			type: String,
			required: true
		},
		from: {
			type: String,
			required: true
		},
		to: {
			type: String,
			required: true
		}
	},
	directives: { money: VMoney },
	data () {
		return {
			isOpened: false,
			selectId: 0,
			money: {
				thousands: ' ',
				precision: 0,
				masked: false
			}
		}
	},
	computed: {
		proxyFrom: {
			set (value) {
				this.$emit('change-from', value)

				//Переведём в числовой формат
				let toNumber = this.proxyTo.split(' ').join('');
				let fromNumber = value.split(' ').join('');

				if (+toNumber < +fromNumber) {
					this.proxyTo = value
				}
			},
			get () {
				return this.from
			}
		},
		proxyTo: {
			set (value) {
				this.$emit('change-to', value)
			},
			get () {
				return this.to
			}
		}
	},
	methods: {
    	toggleDropdown: function () {
			this.isOpened = !this.isOpened			
		},
		clearSelect: function () {
			this.proxyFrom = '';
			this.proxyTo = '';
		},
		setToValue: function () {
			let toNumber = this.proxyTo.split(' ').join('');
			let fromNumber = this.proxyFrom.split(' ').join('');

			if (+toNumber < +fromNumber) {
				this.proxyTo = this.proxyFrom
			}
		}
	},
	created () {
		this.selectId = Math.floor(Math.random()*1000000)
	},
	mounted () {
		var that = this;

		document.querySelector('body').addEventListener('mousedown', function(e) {
			if ($(e.target).closest($(that.$refs[that.selectId])).length === 0) {
				that.isOpened = false;
			}
		})
	}
}
</script>

<style lang="sass" scoped>
@import '../../../../sass/common/_variables.scss'

.dd-multi
	position: relative
	transition: 0.3s
	&.active
		box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.16)
	&__head
		display: block
		position: relative
		font-size: 14px
		background-color: #fff
		line-height: 40px
		padding: 0 20px
		padding-right: 45px
		color: $second_text
		white-space: nowrap
		transition: 0.3s
		span
			pointer-events: none
		&.active
			background-color: $light_grey_hover
			z-index: 101
			.dd-multi__arrow
				svg
					transform: rotate(180deg)
		&.full
			color: #000
	&__arrow
		position: absolute
		top: 50%
		margin-top: -3px
		right: 20px
		transition: 0.3s
		svg
			display: block
			transition: 0.3s
		&.active
			right: 42px
	&__clear
		visibility: hidden
		position: absolute
		top: 50%
		margin-top: -14px
		right: 10px
		cursor: pointer
		padding: 10px
		transition: opacity 0.3s
		svg
			display: block
		&:hover
			opacity: 0.8
		&.active
			visibility: visible
			
.dropdown
	display: none
	position: absolute
	top: 100%
	left: 0
	right: 0
	background-color: #fff
	box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.16)
	z-index: 10
	transition: 0.3s
	&.active
		display: block
	&__body
		display: flex
		align-items: center
		justify-content: space-between
		padding: 13px 20px
		color: $second_text
		font-size: 1.4rem
		line-height: 21px
		input
			color: #000
			padding: 5px
	&__from, &__to
		display: flex
		align-items: center
		span
			margin-right: 30px
	&__from
		input
			margin-right: 15px
	&__footer
		padding: 20px
		border-top: 2px solid $light_grey_scroll_bar
	&__button
		padding: 6px 16px
		font-size: 13px

</style>
