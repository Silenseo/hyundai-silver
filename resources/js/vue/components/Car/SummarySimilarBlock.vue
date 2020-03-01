<template>
	<div class="similar">
		<h3 class="similar__title">Похожие конфигурации в наличии</h3>
		<ul class="similar__list">
			<li class="similar__item" v-for="(model, i) in models" :key="i">
				<summary-similar-block-card :data-input="model" :cat-id="model.car_id"></summary-similar-block-card>
			</li>
		</ul>
	</div>
</template>

<script>
import SummarySimilarBlockCard from './SummarySimilarBlockCard'

export default {
	name: "SummarySimilarBlock",
	components: { SummarySimilarBlockCard },
	props: ['models']
};
</script>

<style lang="sass">
@import '../../../../sass/common/variables'

.similar
	padding: 72px
	padding-top: 44px
	background-color: $gray_bg
	&__title
		margin-bottom: 36px
	&__item
		&:not(:last-of-type)
			margin-bottom: 8px

@media only screen and (max-width : $lg-max)
	.similar
		padding: 38px 40px 48px
		&__title
			font-size: 20px
			margin-bottom: 20px
		&__list
			display: flex
			flex-wrap: wrap
			min-width: 100%
			margin-left: -8px
			margin-right: -8px
		&__item
			width: calc(50% - 16px)
			margin: 8px

@media only screen and (max-width : $md-max)
	.similar
		padding: 22px 16px 32px
		&__title
			margin-bottom: 18px
		&__list
			display: block
			margin: 0
		&__item
			width: 100%
			margin: 0
			&:not(:last-of-type)
				margin-bottom: 8px

</style>