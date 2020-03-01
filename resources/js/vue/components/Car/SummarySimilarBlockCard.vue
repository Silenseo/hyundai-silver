<template>
	<div class="s-card" v-if="'complectations' in this.modification" @click="book">
		<!-- <div class="s-card__bestseller" v-if="dataInput.count_show >= 10">
			<div>
				Лидер
				<br>продаж
			</div>
		</div> -->
		<div class="s-card__mobile">
			<div class="s-card__name s-card__name--m text-overflow">{{ car.name }}</div>
			<div class="s-card__complectation s-card__complectation--m text-overflow">{{ complectation.name }}{{ packetsText }}{{ packetsString }}</div>
		</div>
		<div class="s-card__img">
			<img :src="exteriorColor.carImage" :alt="car.name">
		</div>
		<div class="s-card__description">
			<div class="s-card__name text-overflow">{{ car.name }}</div>
			<div class="s-card__complectation text-overflow">{{ complectation.name }}{{ packetsText }}{{ packetsString }}</div>
			<div class="s-card__info text-overflow">{{ modification.name }} / {{ modification.power }} л.с.</div>
			<div class="s-card__line">
				<div class="s-card__text">Экстерьер</div>
				<div class="s-card__marker" :style="{'background-color': exteriorColor.colorCode}"></div>
				<div class="s-card__value text-overflow">{{  exteriorColor.nameRus }}, {{  exteriorColor._group }}</div>
			</div>
			<div class="s-card__line">
				<div class="s-card__text">Интерьер</div>
				<div class="s-card__marker" :style="{'background-image': 'url(' + interiorColor.color_img + ')'}"></div>
				<div class="s-card__value text-overflow">{{ interiorColor.name }}</div>
			</div>
		</div>
		<div class="s-card__actions">
			<div class="s-card__price">{{ dataInput.price | priceFormat }}</div>
			<div class="s-card__credit">Действует рассрочка</div>
			<div class="df-button s-card__select">Выбрать</div>
			<div class="s-card__count">В наличии {{ dataInput.count_available }} {{ words }}</div>
		</div>
	</div>
</template>

<script>
// import { mapGetters } from 'vuex'

export default {
	name: "SummarySimilarBlockCard",
	props: ['dataInput','carId'],
	data () {
		return {
			car: {}
		}
	},
	computed: {
		// ...mapGetters({
		// 	car: 'GET_CAR'
		// }),
		modification () {
			if ('modificationList' in this.car) {
				return this.car.modificationList[this.dataInput.modification_id] ? this.car.modificationList[this.dataInput.modification_id] : {}
			} else {
				return {}
			}
		},
		complectation () {
			if ('complectations' in this.modification) {
				return this.modification.complectations[this.dataInput.complectation_id] ? this.modification.complectations[this.dataInput.complectation_id] : {}
			} else {
				return {}
			}
		},
		exteriorColor () {
			if ('exterior' in this.complectation) {
				for (let group in this.complectation.exterior.colors.groups) {
					for (let color in this.complectation.exterior.colors.groups[group]) {
						if (color == this.dataInput.color_exterior_id) {
							this.complectation.exterior.colors.groups[group][color]._group = group

							return this.complectation.exterior.colors.groups[group][color]
						}
					}
				}
				return {}
			} else {
				return {}
			}
		},
		interiorColor () {
			if ('interior' in this.complectation) {
				for (let color in this.complectation.interior.colors.colorObj) {
					if (color == this.dataInput.color_interior_id) {
						return this.complectation.interior.colors.colorObj[color]
					}
				}
				return {}
			} else {
				return {}
			}
		},
		words: function() {
			let number = this.dataInput.count_available;
			let cases = [2, 0, 1, 1, 1, 2];
			let titles = ['автомобиль', 'автомобиля', 'автомобилей']

			return titles[(number%100>4 && number%100<20) ? 2 : cases[(number%10<5)?number%10:5]]; 
		},
		packets () {
			let currentPackets = [];
			let result = [];

			if (typeof this.dataInput.package_id === 'number') {
				currentPackets.push(this.dataInput.package_id)
			} else if (typeof this.dataInput.package_id === 'string') {
				currentPackets = this.dataInput.package_id.split(',')
			}

			if ('packets' in this.complectation) {
				for (let packet in this.complectation.packets) {
					if (currentPackets.some(p=>p == packet)) {
						result.push(this.complectation.packets[packet])
					}
				}
			}

			return result
		},
		packetsString () {
			return this.packets.map(packet=>packet.name).join(', ')
		},
		packetsText () {
			return this.packets.length === 0 ? '' : this.packets.length > 1 ? ' + пакеты ' : ' + пакет '
		},
		bookLink () {
			return this.$store.state.API.CONF_BOOK + '?modification_id=' + this.dataInput.modification_id + '&complectation_id=' + this.dataInput.complectation_id + '&package_id=' + this.dataInput.package_id + '&color_exterior_id=' + this.dataInput.color_exterior_id + '&color_interior_id=' + this.dataInput.color_interior_id 
		},
		bookLinkNew () {
			return this.$store.state.API.CONF_BOOK + 'model/'+ this.dataInput.id
		}
	},
	methods: {
		book () {
			window.open(this.bookLinkNew, '_blank');
		},
		loadCar () {
			this.$store.dispatch('LOAD_SIMILAR_CAR', this.dataInput.car_id)
				.then(
					resp=>{
						this.car = resp
					},
					err=>{
						console.error(err)
					}
				)
		}
	},
	created () {
		this.loadCar()
	},
	watch: {
		carId () {
			this.loadCar()
		}
	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/variables'

.s-card
	position: relative
	display: flex
	align-items: center
	height: 100%
	// padding-left: 104px
	padding-right: 72px
	padding-top: 16px
	padding-bottom: 28px
	background-color: #fff
	color: #000
	cursor: pointer
	&__bestseller
		position: absolute
		display: flex
		align-items: center
		justify-content: center
		top: 16px
		left: 24px
		width: 62px
		height: 62px
		border-radius: 50%
		background-color: #10B5DC
		font-size: 12px
		line-height: 12px
		color: #fff
		text-align: center
		z-index: 1
	&__mobile
		display: none
	&__img
		flex: 0 0 auto
		max-width: 566px
		img
			display: block
			margin: 0 auto
	&__description
		flex: 0 1 auto
		margin-right: 20px
		max-width: 460px
	&__actions
		flex: 0 0 auto
		margin-left: auto
	&__name
		font-size: 2rem
		line-height: 1.2
		font-weight: 500
		text-transform: uppercase
		margin-bottom: 5px
	&__complectation, &__info
		font-size: 1.4rem
		line-height: 1.14
		margin-bottom: 18px
	&__info
		margin-bottom: 13px
	&__line
		display: flex
		&:not(:last-of-type)
			margin-bottom: 8px
	&__text
		flex: 0 1 auto
		min-width: 80px
		font-size: 1.4rem
		line-height: 1.14
		color: #828282
		margin-right: 30px
	&__marker
		flex: none
		width: 16px
		height: 16px
		border-radius: 50%
		margin-right: 8px
		background-repeat: no-repeat
		background-position: 50%
		background-size: cover
	&__value
		flex: 0 1 auto
		font-size: 1.4rem
		line-height: 1.14
	&__price
		font-size: 2rem
		line-height: 1.2
		font-weight: 500
		margin-bottom: 1px
	&__credit
		font-size: 1.4rem
		line-height: 1.14
		margin-bottom: 8px
	&__select
		width: 100%
		min-width: 240px
		margin-bottom: 10px
	&__count
		font-size: 1.4rem
		line-height: 1.14
		color: #000
		font-weight: 500
		text-align: center

.text-overflow
	overflow: hidden
	text-overflow: ellipsis
	white-space: nowrap
	
@media only screen and (max-width : $xl-max)
	.s-card
		&__img
			max-width: 400px
		&__description
			max-width: 315px

@media only screen and (max-width : $lg-max)
	.s-card
		display: block
		padding: 24px 20px 17px
		&__mobile
			display: block
		&__bestseller
			left: auto
			top: 10px
			right: 10px
		&__img
			max-width: 100%
			margin: 0 auto
			margin-bottom: 16px
		&__complectation, &__name
			display: none
			&--m
				display: block
		&__description
			max-width: 100%
			margin-right: 0
			margin-bottom: 14px
		&__credit
			margin-bottom: 16px
		&__select
			min-width: 0
		&__count
			text-align: center

@media only screen and (max-width : $md-max)
	.s-card
		padding: 14px 16px 13px
		&__img
			max-width: 100%
		&__name
			font-size: 16px
			margin-bottom: 2px
		&__complectation
			font-size: 12px
		&__info, &__text, &__value, &__credit, &__count
			font-size: 12px
			line-height: 15px
		&__credit
			margin-bottom: 8px
		&__select
			padding-top: 8px
			padding-bottom: 8px
			margin-bottom: 5px



</style>