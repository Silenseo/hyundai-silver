<template>
	<section class="where-buy">
		<div class="where-buy__left">
			<div class="where-buy__top">
				<h3 class="where-buy__title">Где купить</h3>
				<div class="where-buy__text">
					Вы&nbsp;можете предварительно
					заказать интересующий товар
					в&nbsp;ближайшем дилерском центр
				</div>
			</div>
			<div class="where-buy__bottom">
				<cities-list></cities-list>
				<div class="where-buy__footer">
					<div class="where-buy__icon">
						<img src="/images/map/Point.png" alt="Дилер, оформленный по новым стандартам бренда">
					</div>
					<div class="where-buy__description df-text-small-12px">
						Дилер, оформленный по&nbsp;новым стандартам бренда
					</div>
				</div>
			</div>
		</div>
		<div class="where-buy__map">
			<find-dealer :disable-scroll="true" :is-opened="true" :city="city" @city-detected="cityFromMap"></find-dealer>
		</div>
		<div class="where-buy__mobile">
			<div class="where-buy__icon">
				<img src="/images/map/Point.png" alt="Дилер, оформленный по новым стандартам бренда">
			</div>
			<div class="where-buy__description df-text-small-12px">
				Дилер, оформленный по&nbsp;новым стандартам бренда
			</div>
		</div>
		<notifier></notifier>
	</section>
</template>

<script>
import FindDealer from '../common/FindDealer'
import CitiesList from '../brandCollection/CitiesList'
import Notifier from '@/components/Notifier'
import { mapGetters } from "vuex";

export default {
  name: "WhereBuy",
  components: { FindDealer, CitiesList, Notifier },
  data() {
    return {
		
	};
  },
  computed: {
	...mapGetters({
        city: 'GET_CITY'
	}),
  },
  methods: {
	  cityFromMap: function (city) {
		  this.$store.dispatch('SET_CITY', city);
	  }
  },
  mounted() {
	//Получим список дилеров и городов и запишем их в хранилище
	this.$store.dispatch('GET_DEALERS')
			.catch(() => {
				this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
			})
  },
  watch: {}
};
</script>

<style lang="sass">

</style>