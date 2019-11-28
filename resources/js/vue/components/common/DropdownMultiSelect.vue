<template>
	<div class="dd-multi" :ref="selectId" :class="{ active: isOpened }">
		<a href="#" class="dd-multi__head" @click.self.prevent="toggleDropdown" :class="{ active: isOpened, full: selectedItems.length > 0 }">
			{{ placeholder }}
			<span v-if="selectedItems.length > 0">:&nbsp;&nbsp;{{ selectedItems.length > 1 ? selectedItems.length : selectedItems[0] }}</span>
			<div class="dd-multi__arrow" :class="{ active: selectedItems.length > 0 }">
				<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="black"/>
				</svg>
			</div>
			<div class="dd-multi__clear" @click.prevent="clearSelect" :class="{ active: selectedItems.length > 0 }">
				<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect y="7.27264" width="10.2851" height="1.02851" transform="rotate(-45 0 7.27264)" fill="black"/>
					<rect x="0.726562" width="10.2851" height="1.02851" transform="rotate(45 0.726562 0)" fill="black"/>
				</svg>
			</div>
		</a>
		<div class="dropdown" :class="{ active: isOpened }">
			<div class="dropdown__top">
				<div class="dropdown__select">Выбрать:</div>
				<a href="#" class="dropdown__value" @click.prevent="selectAll">все</a>
			</div>
			<ul class="dropdown__list">
				<li class="dropdown__item" v-for="(option, index) in options" :key="index">
					<label>
						<input type="checkbox" :value="option" v-model="proxySelectedItems">
						<div class="dropdown__box">
							<svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 4.2L2.63641 5.83641C3.04831 6.24831 3.72368 6.22237 4.10277 5.7801L8.2 1" stroke="#00AAD2" stroke-width="2"/>
							</svg>
						</div>
						<div class="dropdown__description">{{ option }}</div>
					</label>
				</li>
			</ul>
			<div class="dropdown__footer">
				<button class="df-button dropdown__button">Применить</button>
			</div>
		</div>
	</div>
</template>

<script>

export default {
	name: 'DropdownMultiSelect',
	props: {
		placeholder: {
			type: String,
			required: true
		},
		options: {
			type: Array,
			required: true
		},
		selectedItems: {
			type: Array,
			required: true
		}
	},
	data () {
		return {
			isOpened: false,
			selectId: 0
		}
	},
	computed: {
		proxySelectedItems: {
			set (value) {
				this.$emit('change', value)
			},
			get () {
				return this.selectedItems
			}
		}
	},
	methods: {
    	toggleDropdown: function () {
			this.isOpened = !this.isOpened			
		},
		selectAll: function () {
			this.proxySelectedItems = this.options
		},
		clearSelect: function () {
			this.proxySelectedItems = []
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
	&__top
		display: flex
		align-items: center
		padding: 5px 20px
		font-size: 12px
		color: #000
	&__value
		padding: 10px
		color: $main_blue
		transition: 0.3s
		&:hover
			color: #103A71
	&__list
		position: relative
		padding: 20px
		max-height: 200px
		border-top: 1px solid $light_grey_scroll_bar
		border-bottom: 2px solid $light_grey_scroll_bar
		overflow: auto
	&__item
		&:not(:last-of-type)
			margin-bottom: 18px
		label
			display: flex
			align-items: center
			cursor: pointer
			margin-bottom: 0
		input
			display: none
			&:checked
				& + .dropdown__box
					border: 2px solid $second_blue
					svg
						transform: scale(1)
	&__box
		position: relative
		width: 16px
		height: 16px
		margin-right: 18px
		border: 2px solid $third_text
		svg
			display: block
			position: absolute
			top: 0
			right: 0
			left: 0
			bottom: 0
			margin: auto
			transform: scale(0)
			transition: 0.3s
	&__description
		font-size: 1.4rem
		color: #000
	&__footer
		padding: 20px
	&__button
		padding: 6px 16px
		font-size: 13px

</style>
<style lang="sass">
.dropdown
	.ps__rail-y
		width: 8px
		background-color: #F1F1F1
	.ps__thumb-y, .ps__thumb-y:hover
		right: 0
		width: 8px
		background-color: #002C5F
		border-radius: 0
</style>
