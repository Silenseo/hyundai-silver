<template>
    <div class="main-s__wrapper">
        <div class="main-s" v-show="cost">
            <h2 class="main-s__item main-s__item--title main-s__title">Калькулятор ТО</h2>
            <div class="main-s__item main-s__item--50 df-select">
                <label class="df-label">Модель</label>
                <selectize v-model="model" :settings="settingsModel">
                    <option :value="model.code" v-for="model in data">{{ model.name }}</option>
                </selectize>
            </div>
            <div class="main-s__item main-s__item--50 df-select">
                <label class="df-label">Тип двигателя</label>
                <selectize v-model="engine" :settings="settingsEngine">
                    <option :value="key" v-for="(engine, key) in engines">{{ key }}</option>
                </selectize>
            </div>
            <div class="main-s__item">
                <label class="df-label">Объём двигателя</label>
                <ul class="v-engine">
                    <li class="v-engine__item" v-for="item in vEngines" :class="{ active: item === vEngine }" :key="item">
                        <a href="#" class="v-engine__link" @click.prevent="setVEngine(item)">{{ item }}</a>
                    </li>
                </ul>
            </div>
            <div class="main-s__item mileage">
                <div class="mileage__top">
                    <label class="df-label">Пробег, тыс. км.</label>
                    <div class="mileage__value">
                        {{ mileage }} 000 км.
                    </div>
                </div>
                <div class="df-range">
                    <div id="mileage" class="df-range__body"></div>
                </div>
                <ul class="mileage__list">
                    <li class="mileage__item" v-for="item in mileageArr" :class="{ active: mileage === item }" :key="item">
                        {{ item }}
                    </li>
                </ul>
            </div>
<!--
            <div class="main-s__item main-s__item--50 df-select">
                <label class="df-label">Город</label>
                <selectize v-model="city" :settings="settingsCity">
                    <option :value="city.city_id" v-for="(city, index) in dealersCities">{{ city.city_name }}</option>
                </selectize>
            </div>
            <div class="main-s__item main-s__item--50 df-select">
                <label class="df-label">Дилер</label>
                <selectize v-model="dealer" :settings="settingsDealer">
                    <option :value="dealer.code" v-for="dealer in filteredDealers">{{ dealer.name }}</option>
                </selectize>
            </div>
-->
<!--
            <div class="main-s__item main-s__item--map">
                <a href="#" @click.prevent="openDealer" class="main-s__show-map">
                    <svg>
                        <use xlink:href="#icon-map"></use>
                    </svg>
                    <span>Показать на карте</span>
                </a>
            </div>
-->
            <hr>
            <div class="main-s__item">
                <h5 class="main-s__f-title">Материалы</h5>
                <a v-if="model === 'solaris'" href="/assets/pdf/maintenance/maintenance-solaris.pdf" class="df-download-link df-link main-s__d-link" target="_blank">
                    <svg>
                        <use xlink:href="#download-link"></use>
                    </svg>
                    Базовые работы, входящие в периодическое ТО
                </a>
								<a v-else-if="model === 'creta' || model === 'santa fe' || model === 'tucson'" href="/assets/pdf/maintenance/maintenance-suv.pdf" class="df-download-link df-link main-s__d-link" target="_blank">
                    <svg>
                        <use xlink:href="#download-link"></use>
                    </svg>
                    Базовые работы, входящие в периодическое ТО
                </a>
								<a v-else href="/assets/pdf/maintenance/maintenance-general.pdf" class="df-download-link df-link main-s__d-link" target="_blank">
                    <svg>
                        <use xlink:href="#download-link"></use>
                    </svg>
                    Базовые работы, входящие в периодическое ТО
                </a>
								<br>
                <a href="/assets/pdf/maintenance/maintenance-harsh-conditions.pdf" target="_blank" class="df-download-link df-link main-s__d-link">
                    <svg>
                        <use xlink:href="#download-link"></use>
                    </svg>
                    Тяжелые условия эксплуатации
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import Selectize from 'vue2-selectize'
import { mapGetters } from "vuex";
import { setTimeout } from 'timers';

export default {
    name: 'MainSection',
    components: {
    	Selectize
    },
    data () {
        return {
			settingsModel: {
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
			settingsEngine: {
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
            mileageArr: [15, 30, 45, 60, 75, 90],
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
			ps: [],
			types: {
				1: 'maintenance-general',
				2: 'maintenance-solaris',
				3: 'maintenance-suv',
				4: 'maintenance-general'
			}
        }
    },
    computed: {
		...mapGetters({
            dealersCities: 'GET_DEALERS_CITIES',
            dealers: 'GET_DEALERS',
            data: 'GET_DATA',
            engines: 'GET_ENGINES',
            vEngines: 'GET_V_ENGINES'
		}),
		cost: function () {
			this.$store.dispatch('GET_COST', {
				model: this.model,
				dealer: this.dealer,
				vEngine: this.vEngine,
				engine: this.engine,
				mileage: this.mileage
			});

			return true;
		},
        model: {
            get () {
                return this.$store.state.car.code;
            },
            set (value) {
				this.$store.dispatch('SET_MODEL', value);
            }
        },
        engine: {
            get () {
                return this.$store.state.engine;
            },
            set (value) {
				if (value) {
					this.$store.dispatch('SET_ENGINE', value);
				}
            }
		},
		vEngine: {
            get () {
                return this.$store.state.vEngine;
			}
		},
		mileage: {
			get () {
                return this.$store.state.mileage;
			}
		},
		city: {
			get () {
                return this.$store.state.city;
            },
            set (value) {
				this.$store.dispatch('SET_CITY', value);
            }
		},
		dealer: {
			get () {
                return this.$store.state.dealer;
            },
            set (value) {
				if (value) {
					this.$store.dispatch('SET_DEALER', value);
				}
            }
		},
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

			return result;
		}
    },
    methods: {
		openDealer: function () {
			this.$store.dispatch('OPEN_FIND_DEALER', true);
		},
		setVEngine: function (value) {
			this.$store.dispatch('SET_V_ENGINE', value);
		},
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
            var slider = document.getElementById('mileage');

            noUiSlider.create(slider, {
                start: 0,
				connect: [true, false],
				step: 15,
                range: {
                    'min': 15,
                    'max': 90
				}
			});

			slider.noUiSlider.on('update', (values, handle, unencoded) => {
				that.$store.dispatch('SET_MILEAGE', Math.round(unencoded[0]));
			});

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

<style lang="css">

</style>
