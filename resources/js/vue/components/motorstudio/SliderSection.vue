<template>
	<div id="place" class="bottom-wrap">
		<section class="slider">
			<div class="slider__body">
				<div class="slider__images">
					<div class="slider__wrap">
						<transition-group :name="animName">
							<div class="slider__img" :style="'background-image: url(' + card.img + ')'" :key="card.id * 10"></div>
							<div class="slider__img slider__img--next" :style="'background-image: url(' + cardNext.img + ')'" :key="cardNext.id * 20"></div>
						</transition-group>
					</div>
					<div class="slider__wrap">
						<transition-group :name="animName">
							<div class="slider__img" :style="'background-image: url(' + cardNext.img + ')'" :key="cardNext.id * 30"></div>
							<div class="slider__img slider__img--next" :style="'background-image: url(' + cardNextNext.img + ')'" :key="cardNextNext.id * 40"></div>
						</transition-group>
					</div>
				</div>
				<div class="slider__cards">
					<ul>
						<li class="slider__card" :class="{ active: card.id === currentCard, next: card.id === currentCard + 1 }" v-for="card in cards" :key="card.id">
							<div class="slider__top">
								<div class="slider__number h4">{{ card.number }}</div>
								<transition name="fade">
									<div class="slider__small-name h5" v-if="card.id === currentCard + 1">{{ card.name }}</div>
								</transition>
							</div>
							<transition name="fade">
								<h3 class="slider__name" v-if="card.id === currentCard">{{ card.name }}</h3>
							</transition>
							<transition name="fade">
								<div class="slider__description df-text-main-16px" v-if="card.id === currentCard">{{ card.description }}</div>
							</transition>
						</li>
					</ul>
				</div>
			</div>
		</section>
		<section class="m-slider">
			<ul class="m-slider__list">
				<li class="m-slider__item" :ref="card.id" v-for="card in cards" :key="card.id">
					<div class="m-slider__body">
						<div class="m-slider__img" :style="'background-image: url(' + card.img + ')'"></div>
						<div class="m-slider__content">
							<div class="m-slider__line">
								<div class="m-slider__number h3">{{ card.number }}</div>
								<h3 class="m-slider__name">{{ card.name }}</h3>
							</div>
							<div class="m-slider__description df-text-main-16px">
								{{ card.description }}
							</div>
						</div>
					</div>
					<a class="m-slider__head" @click.prevent="toggleSlide(card.id)">
						<div class="m-slider__number m-slider__number--small h5">{{ card.number }}</div>
						<div class="m-slider__name h5">{{ card.name }}</div>
						<svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M11 1L6.66896 4.89793C6.28866 5.24021 5.71134 5.24021 5.33104 4.89793L1 1" stroke="black" stroke-width="2"/>
						</svg>
					</a>
				</li>
			</ul>
		</section>
		<map-section></map-section>
	</div>
	
</template>

<script>
import MapSection from '@/components/motorstudio/MapSection.vue'
import { setTimeout } from 'timers';

export default {
    name: 'SliderSection',
    components: {
		MapSection
    },
    data () {
        return {
			currentCard: 0,
			accept: true,
			scrollDirection: '',
			blockHeight: 0,
            cardsRu: [
				{
					id: 0,
					number: '01',
					name: 'Фасад',
					description: 'Стеклянный фасад Hyundai Motorstudio высотой 8 метров – ультрасовременное архитектурное решение, символизирующее открытость и дружелюбие: посетителей и прохожих как будто ничего не разделяет.',
					img: '/images/motorstudio/slider/1.jpg'
				},
				{
					id: 1,
					number: '02',
					name: 'Сердце MOTORSTUDIO',
					description: 'Главная задумка в интерьере Hyundai Motorstudio - уникальная мраморная лестница, создающая силуэт сердца. Лестница также служит амфитеатром, где проходят самые значимые события - презентации, семинары, показы кинофильмов и другие мероприятия.',
					img: '/images/motorstudio/slider/2.jpg'
				},
				{
					id: 2,
					number: '03',
					name: 'Выставки',
					description: 'Hyundai Motorstudio часто перевоплощается: иногда это галерея для фотовыставки, иногда - музей или даже арт-объект. Студия сотрудничает с деятелями искусства, музеями и фотографами, поэтому здесь всегда происходит что-то интересное.',
					img: '/images/motorstudio/slider/3.jpg'
				},
				{
					id: 3,
					number: '04',
					name: 'Автомобильные новинки',
					description: 'На первом этаже Hyundai Motorstudio всегда есть несколько автомобильных новинок бренда, с которыми можно познакомиться поближе. Гуру расскажут об автомобилях подробнее, помогут с выбором комплектации и запишут на тест-драйв.',
					img: '/images/motorstudio/slider/4.jpg'
				},
				{
					id: 4,
					number: '05',
					name: 'Библиотека',
					description: 'На втором этаже галереи расположилась эксклюзивная библиотека Hyundai Motorstudio, в которой собрана обширная коллекция уникальных альбомных изданий, посвященных автомобилям, фотографии, архитектуре, искусству, дизайну, моде и музыке. На уютных диванах можно почитать понравившуюся книгу, поработать или просто понаблюдать за кипящей жизнью Нового Арбата сквозь панорамные окна.',
					img: '/images/motorstudio/slider/5.jpg'
				},
				{
					id: 5,
					number: '06',
					name: 'Кафе',
					description: 'Рядом с библиотекой расположено кафе. Здесь можно удобно расположиться за столиком или у стойки бариста, откуда открывается вид на одну из самых знаменитых улиц столицы. В кафе HYUNDAI MOTORSTUDIO можно приятно провести время за чашечкой свежеприготовленного кофе или чая и угоститься кондитерскими изделиями.',
					img: '/images/motorstudio/slider/6.jpg'
				}
			],
            cardsEn: [
				{
					id: 0,
					number: '01',
					name: 'Facade',
					description: 'The 8-meter tall glass facade of the Hyundai Motorstudio is an ultramodern architectural solution to express openness and friendliness – nothing seems to be standing between the visitors and the passers-by.',
					img: '/images/motorstudio/slider/1.jpg'
				},
				{
					id: 1,
					number: '02',
					name: 'Heart',
					description: 'The unique heart-shaped marble stairway is the main point of the Hyundai Motorstudio interior. It is used as an amphitheater during the most significant events such as presentations, seminars, and film screenings.',
					img: '/images/motorstudio/slider/2.jpg'
				},
				{
					id: 2,
					number: '03',
					name: 'Exhibitions',
					description: 'The Hyundai Motorstudio space is always something unique and special. It can turn into a photo exhibition, or a museum, or even be an art object in itself. The studio collaborates with different artists, museums and photographers, so there is something interesting happening in here all the time.',
					img: '/images/motorstudio/slider/3.jpg'
				},
				{
					id: 3,
					number: '04',
					name: 'Latest Hyundai cars',
					description: 'There is always an impressive display of the latest in Hyundai cars at the ground floor. You can simply have a look or ask the specialists for the information on the car you are interested in. The Hyundai Motorstudio hosts will guide you through the best features of the vehicles and offer you a test-drive.',
					img: '/images/motorstudio/slider/4.jpg'
				},
				{
					id: 4,
					number: '05',
					name: 'Library',
					description: 'The exclusive library is situated at the Hyundai Motorstudio upper floor. It contains a huge number of unique books and albums about cars, photography, architecture, art, design, fashion and music. Take a sit in a cozy chair by the panoramic window and enjoy a good coffee with the book you like. Or just gaze lazily over the always-so-busy Novy Arbat street.',
					img: '/images/motorstudio/slider/5.jpg'
				},
				{
					id: 5,
					number: '06',
					name: 'Café',
					description: 'Café is near the library. Make yourself comfortable at the table or at the Barista stand and enjoy the view of the famous Novy Arbat. The Hyundai Motorstudio café offers you a great selection of freshly brewed coffee blends as well as tea, which is served with something sweet of course.',
					img: '/images/motorstudio/slider/6.jpg'
				}
			]
        }
    },
    computed: {
		card: function () {
			let card;

			this.cards.forEach((item)=>{
				if (item.id === this.currentCard) {
					card = item;
				}
			})

			return card;
		},
		cards: function () {
			if (lang.name === 'ru') {
				return this.cardsRu
			}
			if (lang.name === 'en') {
				return this.cardsEn
			}
		},
		cardNext: function () {
			let card;

			this.cards.forEach((item)=>{
				if (item.id === this.currentCard + 1) {
					card = item;
				}
			})

			if (!card) {
				card = this.cards[this.cards.length - 1]
			}

			return card;
		},
		cardNextNext: function () {
			let card;

			this.cards.forEach((item)=>{
				if (item.id === this.currentCard + 2) {
					card = item;
				}
			})

			if (!card) {
				card = this.cards[this.cards.length - 1]
			}

			return card;
		},
		animName: function () {
			if (this.scrollDirection === 'FORWARD') {
				return 'slide-down'
			} 
			if (this.scrollDirection === 'REVERSE') {
				return 'slide-up'
			} 
		}
    },
    methods: {
		next: function () {
			if (this.currentCard < this.cards.length - 1 && this.accept) {
				this.animName = 'slide-down'
				this.currentCard++

				this.accept = false;
				setTimeout(()=>{
					this.accept = true;
				}, 0)
			}
		},
		prev: function () {
			if (this.currentCard >= 0 && this.accept) {
				this.animName = 'slide-up'
				this.currentCard--

				this.accept = false;
				setTimeout(()=>{
					this.accept = true;
				}, 0)
			}
		},
		setCard: function (card) {
			if (card > this.currentCard) {
				this.currentCard = card;
			} else if (card < this.currentCard) {
				this.currentCard = card;
			}
		},
		toggleSlide: function (id) {
			if (this.currentCard !== id) {
				this.currentCard = id;

				var that = this,
					blockOffset = $('.m-slider').offset().top,
					position = +id,
					isComplete = false;

				$('html, body').animate({ scrollTop: (position * this.blockHeight) + blockOffset - $('.header-main').height() - $('.nav').outerHeight() }, {
					complete: function () {
						if (!isComplete) {
							$(that.$refs[id]).addClass('isOpened');
							$(that.$refs[id]).find('.m-slider__head').slideToggle();

							$('.m-slider__item').not(that.$refs[id]).removeClass('isOpened');
							$('.m-slider__item').not(that.$refs[id]).find('.m-slider__head').slideDown();

							isComplete = true;
						}
					}
				});	
			}
		}
    },
    filters: {

    },
    mounted () {
		var that = this;

        this.$nextTick(function () {
			//Открыть первый слайд
			$(that.$refs[0]).addClass('isOpened');
			$(that.$refs[0]).find('.m-slider__head').slideToggle();

           var controller = new ScrollMagic.Controller({
				globalSceneOptions: {
					triggerHook: 'onLeave'
				}
			});
			var offset = -73;

			var scene = new ScrollMagic.Scene({ triggerElement: '.bottom-wrap', duration: 800, offset: offset })
				.setPin('.bottom-wrap')
				//.addIndicators()

			if ($(window).outerWidth() < 1263) {
				scene.remove();
			} else {
				scene.addTo(controller);
			}

			$(window).on('resize', function () {
				if ($(window).outerWidth() < 1263) {
				scene.remove();
				} else {
					scene.addTo(controller);
				}
			})

			scene.on("progress", function (event) {
				that.scrollDirection = event.scrollDirection;

				if (event.progress >= 0) {
					that.setCard(0);
				}
				if (event.progress >= 0.16) {
					that.setCard(1);
				}
				if (event.progress >= 0.32) {
					that.setCard(2);
				}
				if (event.progress >= 0.48) {
					that.setCard(3);
				}
				if (event.progress >= 0.64) {
					that.setCard(4);
				}
				if (event.progress >= 0.80) {
					that.setCard(5);
				}
			});

			//Зпомним высоту блоков аккордеона для плавного выравнивания по верхнему краю при открытии
			that.blockHeight = $('.m-slider__item').not('.isOpened').outerHeight();
        })
    },
    watch: {

    }
}
</script>

<style lang="sass">

</style>
