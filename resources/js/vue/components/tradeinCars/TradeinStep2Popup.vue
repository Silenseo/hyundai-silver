<template>
	<transition name="popup" v-on:enter="onEnter" v-on:leave="onLeave">
		<div class="requirements df-popup" v-show="isOpened">
			<div class="df-popup__wrap requirements__wrap" @mousedown.self="closeThis">
				<div class="requirements__center df-popup__center" role="form">
					<a href="#" @click.prevent="closeThis" class="requirements__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<h2 class="requirements__title">
						 Требования к вашему
						 <br>автомобилю
					</h2>
					<ul class="requirements__list">
						<li class="requirements__item" :key="index" v-for="(requirement, index) in requirements">
							<div class="requirements__number">{{ requirement.name }}</div>
							<div class="requirements__description">
								{{ requirement.description }}
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>

export default {
	name: 'TradeinStep2Popup',
	props: ['isOpened'],
	data () {
		return {
			requirements: [
				{
					name: '01',
					description: 'Официально ввезен на территорию Российской Федерации и продан официальным дилером Hyundai',
				},
				{
					name: '02',
					description: 'Идентификационный номер автомобиля (VN) не поврежден и совпадает с информацией в ПТС',
				},
				{
					name: '03',
					description: 'Автомобиль находится в собственности не менее 6 месяцев',
				},
				{
					name: '04',
					description: 'Не выявлено следов ремонта силовой структуры кузова и срабатывания подушек безопасности',
				},
				{
					name: '05',
					description: 'Отсутствуют ограничения для отчуждения (залог, урон и прочие)',
				},
				{
					name: '06',
					description: 'Реальный пробег совпадает с показаниями одометра на панели приборов',
				},	
			]
		}
	},
	methods: {
		closeThis: function () {
			this.$emit('close')
		},
		onEnter: function() {
			//this.$root.$emit('fixOverflow', true)
		},
		onLeave: function() {
			//this.$root.$emit('fixOverflow', false)
		},
	}
}
</script>