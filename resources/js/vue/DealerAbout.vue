<template>
	<div>
		<map-section :centers-list="centersList"></map-section>
		<call-back-form-popup v-if="callBackFormVisible" :is-opened="openCallBackForm" :from-hour="fromHour" :to-hour="toHour" :type="type" :centersList="centersList" :url="urlCallBack" @close-this="openCallBackForm = false" @open-rules="openRules = true" @open-success="openSuccess = true"></call-back-form-popup>
		<rules v-if="rulesVisible" :is-opened="openRules" @close="openRules = false"></rules>
		<simple-sent-successfully :is-opened="openSuccess" v-on:close-this="openSuccess = false"></simple-sent-successfully>
		<notifier></notifier>
	</div>
</template>

// Входные параметры:
// 	*from-hour: Number (Час начала работы для звонка клиенту)
// 	*to-hour: Number (Час окончания работы + 55 минут для звонка клиенту)
// 	*type: Number (Тип окна обратного звонка: 0 - без выбора дилерского центра, 1 - с выбором)
// 	centers-list: Array (Список дилерских центров)
// 	*url-call-back: String (URL для отправки формы обратного звонка)

// 	* - обязательные параметры 

<script>
import Notifier from '@/components/Notifier'
import SimpleSentSuccessfully from '@/components/common/SimpleSentSuccessfully'
import MapSection from '@/components/dealerAbout/MapSection'

export default {
	name: 'DealerAbout',
	components: { 
		MapSection,
		CallBackFormPopup: () => import('@/components/common/CallBackFormPopup'),
		Rules: () => import('@/components/common/Rules.vue'),
		Notifier,
		SimpleSentSuccessfully
	},
	props: {
		fromHour: {
			type: Number,
			required: true
		},
		toHour: {
			type: Number,
			required: true
		},
		type: {
			type: Number, //0 or 1
			required: true
		},
		centersList: {
			type: Array,
			required: true,
			validator: function (value) {
				let flag = value.every(item=>
					typeof item.name !== 'undefined'
					&&
					typeof item.address !== 'undefined'
					&&
					typeof item.coordinates !== 'undefined'
					&&
					typeof Array.isArray(item.coordinates)
				)
				return flag
			}
		},
		urlCallBack: {
			type: String,
			required: true
		}
	},
	data () {
		return {
			openCallBackForm: false,
			openRules: false,
			openSuccess: false,
			state: {
				callBackFormInit: false,
				rulesInit: false
			},
			popups: 0
		}
	},
	computed: {
		callBackFormVisible: function () {
			if (this.openCallBackForm) {
				this.state.callBackFormInit = true;
			}

			return this.state.callBackFormInit;
		},
		rulesVisible: function () {
			if (this.openRules) {
				this.state.rulesInit = true;
			}

			return this.state.rulesInit;
		}
	},
	methods: {
    	fixOverflow (makeFixed) {
			if (makeFixed === true) {
				document.body.style.overflow = 'hidden'
				this.popups++
			} else {
				this.popups--

				if (this.popups === 0) {
					document.body.style.overflow = ''
				}
			}
		},
		openPopup: function (value) {
			this.openCallBackForm = true
		}
	},
	mounted () {
		this.$root.$on('fixOverflow', this.fixOverflow)
		this.$root.$on('openPopup', this.openPopup)
	}
}
</script>

<style lang="sass">

</style>
