<template>
    <div class="cities-list df-select">
        <selectize v-model="city" :settings="settingsCity">
			<option :value="city.city_id" v-for="(city, index) in dealersCities">{{ city.city_name }}</option>
		</selectize>
    </div>
</template>

<script>
import Selectize from 'vue2-selectize'
import { mapGetters } from "vuex";

export default {
    name: 'CitiesList',
    components: {
    	Selectize
    },
    data () {
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
			}
        }
    },
    computed: {
		...mapGetters({
            dealersCities: 'GET_DEALERS_CITIES'
		}),
		city: {
			get () {
                return this.$store.state.city;
            },
            set (value) {
				this.$store.dispatch('SET_CITY', value);
            }
		}
    },
    methods: {
		psUpdate: function () {
			this.ps.forEach((item)=>{
				var item = item;

				setTimeout(()=>{
					item.update();
				})
			})
		}
    },
    filters: {

    },
    mounted () {
		var that = this;

        this.$nextTick(() => {
			//Scrollbars
			$('.selectize-control .selectize-dropdown-content').each(function(){
				var psb = new PerfectScrollbar(this, {
					wheelSpeed: 1,
					minScrollbarLength: 20
				});

				that.ps.push(psb);
			})
        })
    },
    watch: {
		
    }
}
</script>

<style lang="sass">

</style>
