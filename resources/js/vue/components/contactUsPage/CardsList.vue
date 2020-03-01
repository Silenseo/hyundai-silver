<template>
	<div class="cards-list">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="cards-list__card">
						<div class="cards-list__description">
							<h3 class="cards-list__title">Служба клиентской поддержки</h3>
							<div class="cards-list__text">
								По&nbsp;всем вопросам, связанным с&nbsp;покупкой автомобиля, сервисным обслуживанием, действующими акциями и&nbsp;предложениями,
								вы&nbsp;можете обратиться на&nbsp;информационно- справочный ресурс Hyundai по&nbsp;телефону:
							</div>
							<div class="cards-list__bottom cards-list__phone df-lead-text-22px">
								8 800 333-71-67
							</div>
						</div>
						<div class="cards-list__icon">
							<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M38.7353 28.4353L38.7649 28.4699L38.7974 28.5016L46.117 35.6361C47.2204 36.7116 47.3025 38.53 46.2946 40.0037L46.2178 40.1159L46.1738 40.2446C46.0803 40.5179 45.8672 40.8521 45.5535 41.2258C45.2473 41.5906 44.9011 41.929 44.5921 42.2303L44.575 42.2469L44.5588 42.2643C41.7078 45.3211 37.7078 47 33.3957 47C29.0836 47 25.0836 45.3211 22.2327 42.2643L22.2195 42.2503L22.2059 42.2367L5.73677 25.8867L5.7368 25.8867L5.73023 25.8803C-0.576743 19.7328 -0.576743 9.67823 5.73023 3.53074C6.65226 2.63202 7.19635 2.10548 8.01697 1.57223C9.42636 0.656395 11.0449 0.861509 12.2569 2.03763L19.569 9.46179L19.5761 9.46906L19.5834 9.47618C20.6648 10.5302 20.7577 12.577 19.549 14.023L17.1436 16.3676L17.0264 16.4817L16.9518 16.6273C16.4998 17.5083 16.4998 18.4427 16.9518 19.3238L17.0264 19.4693L17.1436 19.5834L28.6386 30.7878C29.0095 31.3551 29.631 31.6096 30.1934 31.6096C30.7558 31.6096 31.3773 31.3551 31.7482 30.7878L34.0937 28.5016L34.1263 28.4699L34.1558 28.4353C35.2815 27.1186 37.6096 27.1186 38.7353 28.4353Z" stroke="#666666" stroke-width="2" stroke-miterlimit="10"/>
							</svg>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="cards-list__card">
						<div class="cards-list__description">
							<h3 class="cards-list__title">Официальные дилеры</h3>
							<div class="cards-list__text">
								Вопросы о&nbsp;наличии и&nbsp;стоимости новых автомобилей, запасных частей и&nbsp;расходных материалов, гарантийном обслуживании, ремонте автомобилей, программе &laquo;трейд-ин&raquo;, просим вас адресовать официальным дилерам Hyundai.
							</div>
						</div>
						<div class="cards-list__icon">
							<svg width="69" height="36" viewBox="0 0 69 36" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M11 28H5.48806C4.60484 28 3.8262 27.4207 3.57241 26.5747L2.27746 22.2582C1.48303 19.6101 2.11219 16.7395 3.94137 14.6664L15.4029 1.67676C15.7825 1.24648 16.3287 1 16.9025 1H42.1716C42.702 1 43.2107 1.21071 43.5858 1.58579L53.595 11.595C54.5176 12.5176 55.652 13.2006 56.8991 13.5844L66.5882 16.5656C67.4274 16.8238 68 17.5991 68 18.4771V26C68 27.1046 67.1046 28 66 28H60M25 28H46.5" stroke="#666666" stroke-width="2"/>
								<circle cx="18" cy="28" r="7" stroke="#666666" stroke-width="2"/>
								<circle cx="53" cy="28" r="7" stroke="#666666" stroke-width="2"/>
								<path d="M23 13H47.5" stroke="#666666" stroke-width="2"/>
							</svg>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: 'CardsList',
    components: {
    	Selectize
    },
    data () {
        return {

        }
    },
    computed: {
		...mapGetters({
			ENV: "GET_ENV",
		}),
    },
}
</script>

<style lang="sass">

</style>
