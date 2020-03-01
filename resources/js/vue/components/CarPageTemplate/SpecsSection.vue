// Этот компонент также используется на странице авто для дилеров
<template>
	<div class="specs">
		<div class="section__center">
			<h2 class="specs__title">Технические характеристики Hyundai {{ carName }}</h2>
			<table class="specs__main">
				<tr>
					<td>Тип модели</td>
					<td class="desctop">{{ modelType }}</td>
				</tr>
				<tr class="mobile">
					<td>{{ modelType }}</td>
				</tr>
				<tr>
					<td>Количество мест</td>
					<td class="desctop">{{ numberOfSeats }}</td>
				</tr>
				<tr class="mobile">
					<td>{{ numberOfSeats }}</td>
				</tr>
				<tr>
					<td>Двигатель</td>
					<td class="desctop">{{ engine }}</td>
				</tr>
				<tr class="mobile">
					<td>{{ engine }}</td>
				</tr>
				<tr>
					<td>Привод</td>
					<td class="desctop">{{ drive }}</td>
				</tr>
				<tr class="mobile">
					<td>{{ drive }}</td>
				</tr>
				<tr>
					<td>Коробка передач</td>
					<td class="desctop">{{ gearBox }}</td>
				</tr>
				<tr class="mobile">
					<td>{{ gearBox }}</td>
				</tr>
			</table>

			<div v-if="!success" class="specs__error">
				При загрузке данных произошла ошибка, повторите попытку позднее.
			</div>

			<div v-else class="specs__success">
				<div class="specs-dd" v-for="(spec, index) in specifications">
					<a href="#" class="specs-dd__head" @click.prevent="dropdown(index)">
						{{ spec.name }}
						<svg :ref="'arrow-' + index" width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 7L6 2L11 7" stroke="black" stroke-width="2"/>
						</svg>
					</a>
					<div class="specs-dd__dropdown" :ref="index">
						<table class="specs-dd__table">
							<tr>
								<th v-for="mod in modifications">{{ mod.name }}</th>
							</tr>
							<template v-for="param in spec.data">
								<tr>
									<td :colspan="param.values.length" class="specs-dd__subtitle" v-html="param.name"></td>
								</tr>
								<tr>
									<td v-for="value in param.values">
										<div v-if="value === true" class="specs-dd__value"><svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg></div>
										<div v-if="value === false" class="specs-dd__value"><svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg></div>
										<div v-if="value !== false && value !== true" class="specs-dd__value" v-html="value"></div>
									</td>
								</tr>
							</template>
						</table>
						<table class="specs-dd__table specs-dd__table--mobile">
							<template v-for="(mod, indexMod) in modifications">
								<tr>
									<th :class="{ first: indexMod === 0 }">{{ mod.name }}</th>
								</tr>
								<template v-for="param in spec.data">
									<tr>
										<td class="specs-dd__subtitle" v-html="param.name"></td>
									</tr>
									<tr>
										<td>
											<div v-if="param.values[indexMod] === true" class="specs-dd__value"><svg tabindex="-1" aria-visible="false" class="ic-svg ic-checkmark"><use xlink:href="#ic-checkmark"></use></svg></div>
											<div v-if="param.values[indexMod] === false" class="specs-dd__value"><svg tabindex="-1" aria-visible="false" class="ic-svg ic-minus"><use xlink:href="#ic-minus"></use></svg></div>
											<div v-if="param.values[indexMod] !== false && param.values[indexMod] !== true" class="specs-dd__value" v-html="param.values[indexMod]"></div>
										</td>
									</tr>
								</template>
							</template>
						</table>
					</div>
				</div>
				<div class="dsclmr df-text-small-12px">
					<div class="dsclmr__icon">
						<svg width="2" height="9" viewBox="0 0 2 9" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M2 6.75H0V9H2V6.75Z" fill="white"/>
							<path d="M0.133301 0H1.86663L1.5333 5.55H0.466634L0.133301 0Z" fill="white"/>
						</svg>
					</div>
					<div class="dsclmr__body">
						<span class="dsclmr__item" v-for="(dsclmr, index) in footnotes">{{ index }}. {{ dsclmr }}</span>
					</div>
				</div>
			</div>
		</div>
		<notifier></notifier>
	</div>
</template>

<script>
import axios from 'axios'
import Notifier from '@/components/Notifier'

export default {
	name: "SpecsSection",
	components: { Notifier },
	props: ['carId', 'modelType', 'numberOfSeats', 'engine', 'drive', 'gearBox', 'page', 'carName'],
	data() {
		return {
			success: true,
			specifications: [],
			modifications: [],
			footnotes: []
		};
	},
	methods: {
        getData: function () {
            var that = this;

            axios.get(this.$store.state.API.CAR_MODIFICATIONS + this.carId)
                .then(function (response) {
                    that.specifications = response.data.specifications;
                    that.modifications = response.data.modifications;
                    that.footnotes = response.data.footnotes
					that.success = true;
					setTimeout(()=>{
						that.dropdown(0);
					}, 1000)
                })
                .catch(function (error) {
					if (that.page === 'isDealerCarPage') {
						that.$emit('error')
					} else {
						that.success = false;
						that.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
						console.log(error);
					}
                });
        },
        dropdown: function(index) {
            $(this.$refs[index]).slideToggle();
            $(this.$refs['arrow-' + index]).toggleClass('rotate');
        }
    },
    mounted: function () {
		this.getData();
    }
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'

.specs
	position: relative
	height: auto
	color: #000
	padding-top: 57px
	&__title
		display: block
		font-size: 4.2rem
		font-weight: 500
		text-align: center
		margin-bottom: 26px
	&__main
		table-layout: fixed
		width: 100%
		font-size: 1.6rem
		border: 1px solid #E4DCD3
		tr
			td
				padding: 12px 32px
				border: 1px solid #E4DCD3
				&:first-of-type
					width: 311px
					background-color: #E4DCD3
					font-weight: 500
					border-bottom: 1px solid #fff
		.mobile
			display: none
	&__error
		font-size: 1.6rem
		padding-top: 50px
		padding-bottom: 50px
	&__success
		margin-top: 40px

.specs-dd
	color: #000
	border: 1px solid #E4DCD3
	border-bottom: none
	&:nth-last-of-type(2)
		border-bottom: 1px solid #E4DCD3
	&:not(:first-of-type)
		th
			display: none
	&__head
		position: relative
		display: block
		font-size: 1.6rem
		font-weight: 500
		padding: 16px 32px
		svg
			display: block
			position: absolute
			top: 50%
			right: 32px
			transform: translateY(-50%) rotate(180deg)
			transition: 0.3s
			&.rotate
				transform: translateY(-50%) rotate(0deg)
	&__dropdown
		display: none
		padding-left: 344px
	&__table
		table-layout: fixed
		width: 100%
		tr
			th
				font-size: 1.6rem
				font-weight: 500
				padding-bottom: 29px
			td
				vertical-align: bottom
				padding-bottom: 26px
				padding-right: 32px
				&:not(:first-of-type)
					.specs-dd__subtitle
						display: none
		&--mobile
			display: none
	&__subtitle
		font-size: 1.6rem
		line-height: 1.25
		color: #666666
		margin-bottom: 7px
	&__value
		max-width: 100%
		font-size: 1.4rem
		line-height: 1.14
		font-weight: 500
		overflow: hidden
		text-overflow: ellipsis
		svg
			display: block
			width: 14px
			height: 14px

.dsclmr
	position: relative
	display: block
	padding-left: 32px
	margin-top: 37px
	padding-bottom: 58px
	&__icon
		position: absolute
		left: 0
		top: 0.5em
		margin-top: -3px
		width: 16px
		height: 16px
		border-radius: 50%
		background-color: #C4C4C4
		svg
			display: block
			position: absolute
			top: 0
			left: 0
			right: 0
			bottom: 0
			margin: auto
	&__item
		font-size: 1.2rem
		line-height: 1.5
		color: #000
		&:not(:last-of-type)
			margin-right: 10px
			&::after
				content: ';'
				display: inline-block

@media only screen and (max-width : $lg-max)
	.specs-dd
		&__dropdown
			padding-top: 16px
			padding-left: 32px

@media only screen and (max-width : $md-max)
	.specs
		padding-top: 36px
		&__title
			font-size: 30px
			margin-bottom: 44px
		&__main
			tr
				td
					width: 100%
					padding: 12px 16px
					&:first-of-type
						width: 100%
			.desctop
				display: none
			.mobile
				display: table-row
				td
					width: 100%!important
					background-color: transparent!important
					border: none!important
		&__success
			margin-top: 31px

	.specs-dd
		&__head
			padding-left: 16px
		&__table
			display: none
			tr
				th
					position: relative
					padding-bottom: 23px
					&:not(.first)
						padding-top: 26px
						&::after
							content: ''
							display: block
							position: absolute
							top: 0
							left: -16px
							right: 16px
							height: 1px
							background-color: #E4DCD3
				td
					padding-bottom: 0
			&--mobile
				display: table
		&__subtitle
			padding-bottom: 1px!important
		&__value
			padding-bottom: 25px!important

</style>
