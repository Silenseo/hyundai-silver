<template>
	<div class="t-menu">
		<div class="t-menu__wrap">
			<ul class="t-menu__list">
				<li class="t-menu__step" :key="key" v-for="(step, key) in steps">
					<router-link :to="step.link" :class="{ complete: complete(step.id) }">
						<div class="t-menu__name">
							{{ step.name }}
						</div>
						<div class="t-menu__description">
							{{ step.description }}
						</div>
					</router-link>
				</li>
			</ul>
		</div>
	</div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
	name: 'TradeinMenu',
	data () {
		return {
			steps: [
				{
					id: 1,
					name: '01',
					description: 'Выберите модель Hyundai',
					link: '/step-1'
				},
				{
					id: 2,
					name: '02',
					description: 'Укажите параметры автомобиля',
					link: '/step-2'
				},
				{
					id: 3,
					name: '03',
					description: 'Введите контактные данные',
					link: '/step-3'
				}
			]
		}
	},
	computed: {
		...mapGetters({
			state: "GET_TRADEIN_STATE",
		}),
	},
	methods: {
    	complete: function(id) {
			if (id === 1 && this.state.step1) {
				return true
			}
			if (id === 2 && this.state.step2) {
				return true
			}
			if (id === 3 && this.state.step3) {
				return true
			}
		},
		changeStep: function () {
			console.log('change')
		}
	}
}
</script>