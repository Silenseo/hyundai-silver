<template>
    <div id="signupform">
        <sign-up-service-form v-if="form === 'service'" :page="page" @open-rules="openRules = true" @open-success="openSuccess = true"></sign-up-service-form>
        <sign-up-test-drive-form v-if="form === 'test-drive'" :page="page" @set-i30n="setI30n" @open-rules="openRules = true" @open-success="openSuccess = true"></sign-up-test-drive-form>
		<find-dealer v-if="ENV !== 'dealer'" v-bind:city="city" v-bind:dealer="dealer" v-bind:isOpened="openFindDealer" v-on:city-detected="setCityFromMap" v-on:dealer-selected="selectDealerFromMap" v-on:close-this="closeFindDealer" :i30n="i30n"></find-dealer>
		<rules v-bind:isOpened="openRules" @close="openRules = false"></rules>
		<sent-successfully :phone-number="phoneNumber" v-bind:isOpened="openSuccess" v-on:close-this="closeSuccess"></sent-successfully>
		<notifier></notifier>
    </div>
</template>

<script>
import FindDealer from '@/components/common/FindDealer.vue'
import Rules from '@/components/common/Rules.vue'
import SentSuccessfully from '@/components/common/SentSuccessfully.vue'
import Notifier from '@/components/Notifier'

import { mapGetters } from "vuex";

const SignUpServiceForm = () => import('@/components/common/SignUpServiceForm.vue')
const SignUpTestDriveForm = () => import('@/components/common/SignUpTestDriveForm.vue')

export default {
	name: 'signupforms',
	components: { SignUpServiceForm, SignUpTestDriveForm, FindDealer: () => import('@/components/common/FindDealer.vue'), Rules, SentSuccessfully, Notifier },
	props: ['form', 'page', 'noDefaultCar'], //page - название страницы, на которой размещён попап, может быть undefined
	data () {
		return {
			i30n: false,
			openRules: false,
			openSuccess: false
		}
	},
	computed: {
		...mapGetters({
			ENV: "GET_ENV",
			openFindDealer: "OPEN_FIND_DEALER",
			city: "GET_CITY",
			dealer: "GET_DEALER",
			phoneNumber: "GET_USER_PHONE"
		})
	},
	methods: {
		closeFindDealer: function () {
			this.$store.dispatch('OPEN_FIND_DEALER', false);
		},
		selectDealerFromMap: function (dealerCode) {
			this.$store.dispatch('SET_DEALER', dealerCode);
		},
		setCityFromMap: function (city) {
			this.$store.dispatch('SET_CITY', city);
		},
		closeSuccess: function () {
			this.openSuccess = false;
		},
		setI30n: function (value) {
			this.i30n = value;
		},
		getData: function (getOld) {
			//Получим список дилеров и городов и запишем их в хранилище
			if (this.ENV !== 'dealer') {
				this.$store.dispatch('GET_DEALERS')
					.then(() => {
						//Обновим в форме записи на ТД список доступных городов и лилеров для i30N
						this.$root.$emit('updateI30n');
					})
					.catch((error) => {
						console.log(error)
						this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
					})
			}
			
			//Получим данные по тачкам
			if (this.noDefaultCar) {
				var flag = 'noDefaultCar'
			}

			this.$store.dispatch('GET_DATA', { flag, getOld })
				.then(() => {
					//Установка тачки по умолчанию
					if (typeof commonCarCode !== 'undefined') {
						this.$store.dispatch('SET_MODEL', commonCarCode);
					}
				})
				.catch((error) => {
					console.log(error)
					this.$root.$emit('notify', { type: 'error', text: 'Ошибка загрузки данных, повторите попытку позднее' })
				})
		}
	},
	beforeMount () {
		if (this.form === 'test-drive') {
			SignUpTestDriveForm()
				.then(()=>{
					this.$emit('modules-loaded')
					this.getData()
				})
		}
		if (this.form === 'service') {
			SignUpServiceForm()
				.then(()=>{
					this.$emit('modules-loaded')
					this.getData(true)
				})
		}
	}
}
</script>

<style lang="scss">

</style>
