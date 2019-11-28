<template>
	<div class="s-car" @click="goToCar">
		<div class="s-car__line s-car__line--1">
			<div class="s-car__name">{{ specifications.name | output }}</div>
			<div class="s-car__year">{{ specifications.year | output }}</div>
		</div>
		<div class="s-car__line s-car__line--2">
			<div class="s-car__price">{{ specifications.minPrice | currencyFormat }} <span v-if="specifications.maxPrice > 0">— {{ specifications.maxPrice | currencyFormat }}</span> ₽</div>
			<div class="s-car__credit">от {{ specifications.monthPayment | currencyFormat }} ₽/мес.</div>
		</div>
		<div class="s-car__img">
			<car-preview :images="previewImages"></car-preview>
		</div>
		<div class="s-car__description">
			{{ description }}
		</div>
		<div class="s-car__footer">
			<button class="df-button s-car__book" @click.stop="toBook">Забронировать</button>
			<button class="df-button s-car__calc" @click.stop="toCredit">Рассчитать кредит</button>
		</div>
	</div>
</template>

<script>
import CarPreview from './CarPreview'

export default {
	name: 'ShowroomCar',
	components: { CarPreview },
	props: {
		specifications: {
			type: Object,
			required: true
		}
	},
	data () {
		return {

		}
	},
	computed: {
		description: function() {
			let type = this.specifications.type || '';
			let doors = this.specifications.doors || '';
			let transmission = this.specifications.transmission ? (' / ' + this.specifications.transmission) : '';
			let gearBox = this.specifications.gearBox ? (' / ' + this.specifications.gearBox) : '';
			let complectation = this.specifications.complectation ? (' / ' + this.specifications.complectation) : '';
			let engineV = this.specifications.engineV ? (' / ' + this.specifications.engineV) : '';
			let power = this.specifications.power ? (' / ' + this.specifications.power) : '';
			let fuel = this.specifications.fuel ? (' / ' + this.specifications.fuel) : '';

			return  type + ' ' + doors +  transmission  +  gearBox +  complectation + engineV + power + fuel
		},
		previewImages: function () {
			return typeof this.specifications.previewImages !== 'undefined' ? this.specifications.previewImages.length > 0 ? this.specifications.previewImages : this.specifications.images : this.specifications.images
		}
	},
	methods: {
		goToCar: function() {
			this.$router.push({ name: 'car', params: { id: this.specifications.id } })
		},
    	toBook: function() {
			console.log('book')
		},
		toCredit: function() {
			console.log('credit')
		}
	},
	filters: {
		output: function (value) {
			return typeof value !== 'undefined' ? value : ''
		}
	},
	mounted () {
		
	}
}
</script>
