<template>
	<transition name="popup" v-on:enter="onEnter" v-on:leave="onLeave">
		<div class="approve-form df-popup" v-show="isOpened">
			<div class="df-popup__wrap" @mousedown.self="closeThis">
				<div class="approve-form__center df-popup__center">
					<a href="#" @click.prevent="closeThis" class="approve-form__close df-popup__close">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect y="14.5454" width="20.5702" height="2.05702" transform="rotate(-45 0 14.5454)"/>
							<rect x="1.45459" width="20.5702" height="2.05702" transform="rotate(45 1.45459 0)"/>
						</svg>
					</a>
					<h3 class="approve-form__title">Выбор дилера и переход на сторонний ресурс</h3>
					<div class="approve-form__text df-text-main-16px">
						После выбора дилерского центра вы&nbsp;будете перемещены на&nbsp;сторонний ресурс для заполнения анкеты. Если вы&nbsp;согласны, выберите дилерский центр и&nbsp;нажмите кнопку &laquo;Далее&raquo;.
					</div>
					<div class="approve-form__dropdown df-select-bordered" :class="{ 'invalid' : !validation.city }">
						<selectize v-model="city" :settings="settingsCity">
							<option :value="city" v-for="city in dealersCities">{{ city }}</option>
						</selectize>
					</div>
					<div class="approve-form__dropdown df-select-bordered" :class="{ 'invalid' : !validation.dealer }">
						<selectize v-model="dealer" :settings="settingsDealer">
							<option :value="dealer.credit_id" v-for="dealer in filteredDealers">{{ dealer.name }}</option>
						</selectize>
					</div>
					<a href="#" @click.prevent="checkout" class="approve-form__button df-button">Далее</a>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
import Selectize from 'vue2-selectize'
import axios from 'axios'

export default {
	name: "CreditApprovalForm",
	components: { Selectize },
	props: {
		isOpened: {
			type: Boolean,
			required: true
		},
		currentCar: {
			type: Object,
			required: true,
			validator: function (value) {
				return typeof value.name !== 'undefined'
			}
		},
		creditPack: {
			type: Object,
			required: true,
			validator: function (value) {
				return typeof value.prepay !== 'undefined' && typeof value.sum !== 'undefined'
			}
		},
		term: {
			type: Number,
			required: true,
		},
		page: {
			type: String,
			required: false
		},
		modification: {
			type: Object,
			required: false
		}
	},
	data() {
		return {
			ps: [],
			settingsCity: {
				placeholder: 'Выберите город',
				onDropdownOpen: this.psUpdate,
				openOnFocus: false,
				onInitialize: function () {
					var that = this;

					this.$control.on("click", function () {
						if (!that.opened) {
							that.open()
							that.opened = true
						}
					});
				},
				onDropdownClose: function () {
					setTimeout(()=>{
						this.opened = false
					}, 300)
				}
			},
			settingsDealer: {
				placeholder: 'Выберите дилера',
				onDropdownOpen: this.psUpdate,
				openOnFocus: false,
				onInitialize: function () {
					var that = this;

					this.$control.on("click", function () {
						if (!that.opened) {
							that.open()
							that.opened = true
						}
					});
				},
				onDropdownClose: function () {
					setTimeout(()=>{
						this.opened = false
					}, 300)
				}
			},
			creditDealers: [],
			dealersCities: [],
			city: '',
			dealer: '',
			process: false
		};
	},
	computed: {
		filteredDealers: function () {
			var result = [],
				resultDdealers = [];

			if (this.city !== '') {
				this.creditDealers.forEach((dealer) => {
					if (dealer.name === this.city) {
						result.push(dealer)
					}
				});

				result.forEach((item)=>{
					item.dealers.forEach((dealer)=>{
						resultDdealers.push(dealer)
					})
				})

				return resultDdealers;
			} else {
				return [];
			}
		},
		validation () {
			return {
				dealer: this.dealer !== '' || !this.process,
				city: this.city !== '' || !this.process
			}
		},
		isValid () {
			const validation = this.validation;

			return Object.keys(validation).every(function (key) {
				return validation[key]
			})
		},
	},
	methods: {
		psUpdate: function () {
			this.ps.forEach((item)=>{
				var item = item;

				setTimeout(()=>{
					item.update();
				})
			})
		},
		closeThis: function() {
			this.$emit('close');
		},
		getCreditDealers: function () {
			var that = this;

			//Св-во API.GET_DEALERS_CREDIT есть в store конфигуратора и в общем store
			axios.get(this.$store.state.API.GET_DEALERS_CREDIT)
				.then(function (response) {
					that.creditDealers = response.data.filter(item=>item.name !== 'Выберите город');

					that.creditDealers.forEach(function(item){
						that.dealersCities.push(item.name);
					})
				})
				.catch(function (error) {
					console.log(error);
					that.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' });
				})
		},
		checkout: function() {
			this.process = true;

			if (this.isValid) {
				if (this.page === 'isStartPage') {
					dataLayer.push({
						"event": "custom_event",
						"category": "Страница программы start",
						"action": "Переход на предодобрение",
						"label": "Предодобрение заявки " + this.currentCar.name + ', ' + this.modification.id
					});
				}
				else
				{
    				dataLayer.push({
                        "event": "custom_event",
                        "category" : "Конфигуратор",
                        "action": "Переход на предодобрение ",
                        "label" : "Предодобрение заявки " + this.currentCar.name
                      });
				}

				window.open('https://credit-approval.ecredit.one/?car=' + this.currentCar.name + '&fee=' + this.creditPack.prepay + '&sum=' + this.creditPack.sum + '&term=' + this.term + '&dealer=' + this.dealer, '_blank');
				// window.location = 'https://credit-approval.ecredit.one/?car=' + this.currentCar.name + '&fee=' + this.creditPack.prepay + '&sum=' + this.creditPack.sum + '&term=' + this.term + '&dealer=' + this.dealer
			}
		},
		onEnter: function() {
			this.$root.$emit('fixOverflow', true)
		},
		onLeave: function() {
			this.$root.$emit('fixOverflow', false)
		}
	},
	mounted() {
		var that = this;

		this.getCreditDealers();

		this.$nextTick(function() {
			//Scrollbars
			$('.selectize-control .selectize-dropdown-content').each(function(){
				var psb = new PerfectScrollbar(this, {
					wheelSpeed: 1,
					minScrollbarLength: 20
				});

				that.ps.push(psb);
			})
		})
	}
};
</script>

<style lang="sass">
@import '../../../../sass/common/_variables.scss'

.approve-form
	&__center
		position: relative
		width: 40%
		min-width: 592px
		padding: 40px 72px
		background-color: $white_bg
		color: #000
		transition: 0.5s
	&__title
		text-align: center
		margin-bottom: 32px
	&__text
		margin-bottom: 20px
	&__description
		font-size: 1.4rem
		line-height: 1.14
		a
			color: $second_blue
	&__dropdown
		margin-bottom: 20px
	&__button
		display: block
		max-width: 200px
		margin: 0 auto
		margin-top: 50px

@media only screen and (max-width : $md-max)
	.approve-form
		&__center
			min-width: 0%
			width: auto
			margin: 16px
			padding: 48px 16px 32px 16px
		&__title
			margin-bottom: 24px

</style>
