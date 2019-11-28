<template>
	<label class="form-accept">
		<input type="checkbox" :checked="checked" @change="change($event.target.checked)" :class="{ 'invalid' : !isValid }" name="accept" id="accept">
		<div class="form-accept__box">
			<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1 5.2L5 8L9 1" stroke="#002C5F" stroke-width="2"/>
			</svg>
		</div>
		<div class="form-accept__description">Я согласен с <a href="#" @click.prevent="openRules">правилами</a> обработки персональных данных</div>
	</label>
</template>

<script>
export default {
	name: "FormAccept",
	model: {
		prop: 'checked',
		event: 'change'
	},
	components: {},
	props: ['isValid', 'checked'],
	data() {
		return {
			
		};
	},
	computed: {
		
	},
	methods: {
		openRules: function () {
			// deprecated
			if (typeof this.$store.state.openRules !== 'undefined') {
				this.$store.dispatch('OPEN_RULES', true);
			}
			  
			// use emit event!
			this.$emit('show-rules');
		},
		change: function (value) {
			this.$emit('change', value);
		}
	},
	filters: {},
	mounted() {
		
	},
	watch: {

	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'

.form-accept
	display: flex
	align-items: center
	width: 100%
	margin-bottom: 0
	padding-right: 20px
	input
		display: none
		&:checked
			& + .form-accept__box
				svg
					transform: scale(1)
		&.invalid
			& + .form-accept__box
				border-color: #C70E0E
	&__box
		position: relative
		flex: none
		width: 24px
		height: 24px
		border: 1px solid $sand
		margin-right: 16px
		cursor: pointer
		transition: 0.3s
		svg
			display: block
			position: absolute
			top: 0
			left: 0
			bottom: 0
			right: 0
			margin: auto
			transform: scale(0)
			transition: 0.3s
	&__description
		font-size: 1.4rem
		line-height: 1.14
		a
			color: $second_blue
</style>