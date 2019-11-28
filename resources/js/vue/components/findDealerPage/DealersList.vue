<template>
	<div class="d-list container">
		<div class="row">
			<div class="col-md-12">
				<div class="legend">
					<ul class="legend__list">
						<li class="legend__item df-text-small-12px">
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0 0H16L13 8L16 16H0V0Z" fill="#A36B4F"/>
							</svg>
							<span>Дилер, оформленный по&nbsp;новым стандартам бренда</span>
						</li>
						<li class="legend__item df-text-small-12px">
							<svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M12 0L15.174 7.63131L23.4127 8.2918L17.1357 13.6687L19.0534 21.7082L12 17.4L4.94658 21.7082L6.8643 13.6687L0.587322 8.2918L8.82596 7.63131L12 0Z" fill="#A36B4F"/>
							</svg>
							<span>Рекомендуемый дилер</span>
						</li>
						<li class="legend__item df-text-small-12px">
							<img src="/images/icons/wa.png" alt="WA">
							<span>Автоматизированная система обслуживания клиентов</span>
						</li>
					</ul>
				</div>
				<h2 class="d-list__title">Официальные дилеры Hyundai</h2>
				<div class="dealer-btn">
					<a href="/become-a-dealer" class="df-button">Стать дилером</a>
				</div>
				<ul class="d-list__list">
					<li class="dealer" v-for="dealer in filteredDealers" :key="dealer.id"
						:class="{
							special: dealer.special === '1',
							wa: dealer.wa === '1',
							star: dealer.rating === '1',
							citystore: dealer.code === 'C40AF11027'
						}"
					>
						<div class="dealer__wrap">
							<div class="dealer__left">
								<div class="dealer__row dealer__row--pl">
									<div class="dealer__flags">
										<div class="dealer__star">
											<svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 0L15.174 7.63131L23.4127 8.2918L17.1357 13.6687L19.0534 21.7082L12 17.4L4.94658 21.7082L6.8643 13.6687L0.587322 8.2918L8.82596 7.63131L12 0Z" fill="#A36B4F"/>
											</svg>
										</div>
										<div class="dealer__wa">
											<img src="/images/icons/wa.png" alt="WA">
										</div>
										<div class="dealer__citystore"></div>
									</div>
									<h4 class="dealer__name">{{ dealer.name }}</h4>
									<br>
									<!-- <a :href="dealer.site" class="df-iconed-link df-iconed-link--small">
										Перейти на сайт
										<svg>
											<use xlink:href="#arrow-link"></use>
										</svg>
									</a> -->
								</div>
								<div class="dealer__row d-none d-sm-block d-md-none d-lg-block">
									<div class="dealer__phone">{{ dealer.phone }}</div>
									<div class="dealer__address">{{ dealer.address }}</div>
								</div>
							</div>
							<div class="dealer__right">
								<!-- <button @click.prevent="openBackCallForm(dealer.code)" :class="{ avilon: dealer.code === 'C40AF11027' }" class="df-button dealer__button">Обратный звонок</button> -->
								<a :href="dealer.site" target="_blank" class="df-button dealer__button" :class="{ avilon: dealer.code === 'C40AF11027' }">Перейти на сайт</a>
							</div>
							<div class="dealer__bottom d-none d-md-block d-lg-none">
								<div class="dealer__phone">{{ dealer.phone }}</div>
								<div class="dealer__address">{{ dealer.address }}</div>
							</div>
						</div>
					</li>
				</ul>
				<div class="dealer-epilog">
					<div class="row">
						<p class="col-md-6 col-sm-12 dealer-epilog__text">
							Единый стандарт качества услуг – важнейший приоритет, который реализуют в&nbsp;своей работе официальные дилеры Hyundai.
							Автосалоны Hyundai могут предложить своим клиентам не&nbsp;только купить новый автомобиль, но&nbsp;и&nbsp;получить высококлассный сервис:
							профессиональные консультации обо всех моделях линейки и&nbsp;их характеристиках, организацию тест-драйвов,	помощь в&nbsp;прохождении технического осмотра и&nbsp;другие услуги.
						</p>
						<p class="col-md-6 col-sm-12">
							Специалисты центров проходят регулярное повышение квалификации и&nbsp;владеют всей актуальной информацией об&nbsp;автомобилях Hyundai.
    					C&nbsp;помощью интерактивной карты Вы сможете найти ближайший автосалон Hyundai в&nbsp;Вашем городе!
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
	name: "DealersList",
	components: {},
	data() {
		return {

		}
	},
	computed: {
		...mapGetters({
			city: "GET_CITY",
			cityName: "GET_CITY_NAME",
			dealers: "GET_DEALERS"
		}),
		filteredDealers: function () {
			var result = [];

			if (this.city !== '') {
				this.dealers.forEach((dealer) => {
					if (dealer.city_id === this.city) {
						result.push(dealer)
					}
				});
			} else {
				return this.dealers;
			}

			result.sort((a, b)=>{
						return +b.rating - (+a.rating);
					})

			result.sort((a, b)=>{
						return +b.special - (+a.special);
					})

			result.sort((a, b)=>{
						return a.code == 'C40AF11027' ? -1 : b.code == 'C40AF11027' ? 1 : 0;
					});
			
			return result		
		}
	},
	methods: {
		openBackCallForm: function (data) {
			this.$store.dispatch('OPEN_BACK_CALL', true);

			//Выберем лилера у которого в спискке была нажата кнопка Обратный звонок
			this.$store.dispatch('SET_DEALER', data);
		}
	},
	filters: {},
	mounted() {
		var that = this;

		this.$nextTick(function() {

		})
	},
	watch: {}
};
</script>

<style lang="sass">
.dealer-epilog
    padding-bottom: 66px
.dealer-btn
		margin-bottom: 30px
		text-align: center
		.df-button
				display: inline-block

@media (max-width: 767px)
	.dealer-epilog__text
			margin-bottom: 16px
</style>
