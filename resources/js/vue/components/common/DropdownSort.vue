<template>
	<div class="dd-sort" :ref="selectId" :class="{ active: isOpened }">
		<a href="#" class="dd-sort__head" @click.self.prevent="toggleDropdown" :class="{ active: isOpened, full: selectedItem >= 0 }">
			{{ options[selectedItem] ? options[selectedItem] : placeholder }}
			<div class="dd-sort__arrow">
				<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="black"/>
				</svg>
			</div>
		</a>
		<div class="dropdown" :class="{ active: isOpened }">
			<ul class="dropdown__list">
				<li class="dropdown__item" v-for="(option, index) in options" :key="index">
					<label>
						<input type="radio" v-model="proxySelectedItem" :value="index" name="sort">
						<div class="dropdown__description">
							{{ option }}
						</div>
					</label>
				</li>
			</ul>
		</div>
	</div>
</template>

<script>

export default {
	name: 'DropdownSort',
	props: {
		placeholder: {
			type: String,
			required: true
		},
		options: {
			type: Array,
			required: true
		},
		selectedItem: {
			type: Number,
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
		proxySelectedItem: {
			set (value) {
				this.$emit('change', value)
				this.isOpened = false;
			},
			get () {
				return this.selectedItem
			}
		}
	},
	methods: {
    	toggleDropdown: function () {
			this.isOpened = !this.isOpened			
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
.dd-sort
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
		padding-left: 20px
		padding-right: 45px
		color: $second_text
		white-space: nowrap
		transition: 0.3s
		span
			pointer-events: none
		&.active
			background-color: #fff
			z-index: 101
			.dd-sort__arrow
				svg
					transform: rotate(180deg)
		&.full
			font-size: 16px
			font-weight: 500
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
.dropdown
	display: none
	position: absolute
	top: 100%
	left: 0
	right: 0
	padding-bottom: 15px
	background-color: #fff
	color: #000
	box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.16)
	z-index: 10
	transition: 0.3s
	&.active
		display: block
	&__item
		font-size: 1.4rem
		line-height: 34px
		white-space: nowrap
		transition: 0.3s
		&:hover
			background-color: $light_grey_hover
		label
			display: block
			width: 100%
			cursor: pointer
		input
			display: none
			&:checked
				& + .dropdown__description
					background-color: #103A71
					color: #fff
	&__description
		padding: 0px 20px
		transition: 0.3s


</style>
