<template>
	<section class="nav">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="nav__center" @click="openMenu">
						<div class="nav__logo">
							<img src="/images/motorstudio/HMS_Moscow_logo.png" alt="Motorstudio Moscow">
						</div>
						<div class="nav__wrap">
							<ul class="nav__menu">
								<li class="nav__item">
									<a href="#about" class="nav__link df-text-input-14px scroll">{{ lang === 'ru' ? 'О студии' : 'About' }}</a>
								</li>
								<li class="nav__item">
									<a href="#calendar" class="nav__link df-text-input-14px scroll">{{ lang === 'ru' ? 'Мероприятия' : 'Events calendar' }}</a>
								</li>
								<li class="nav__item">
									<a href="#place" class="nav__link df-text-input-14px scroll">{{ lang === 'ru' ? 'Пространство' : 'Area' }}</a>
								</li>
								<li class="nav__item">
									<a href="#contacts" class="nav__link df-text-input-14px scroll">{{ lang === 'ru' ? 'Контакты' : 'Contacts' }}</a>
								</li>
							</ul>
						</div>
						<svg class="nav__arrow" width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M4.5 6L-4.29138e-07 1.12054e-06L9 4.76837e-07L4.5 6Z" fill="#002C5F"/>
						</svg>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
export default {
    name: 'NavSection',
    components: {

    },
    data () {
        return {
            
        }
    },
    computed: {
		lang: function () {
			return lang.name;
		}
    },
    methods: {
		openMenu: function () {
			if ($(window).width() < 768) {
				$('.nav__menu').slideToggle();
				$('.nav__center').toggleClass('isOpened')
			}
		}
    },
    filters: {

    },
    mounted () {
        this.$nextTick(function () {
			//Скролл к секции
			$('a.scroll').on('click', function () {
				var href = $(this).attr('href');
				var offset = -73;

				// $('a.scroll').removeClass('active');
				// $(this).addClass('active');

				if ($(window).width() < 1263) {
					offset = offset - $('.header-main').height();
				}

				if (href === '#contacts' && $(window).width() >= 1263) {
					offset = offset + 800;
				}

				$('html, body').animate({ scrollTop: $(href).offset().top + offset }, 500)
			})
			//Фикс секции
			var controller = new ScrollMagic.Controller({
				globalSceneOptions: {
					triggerHook: 'onLeave'
				}
			});

			var scene = new ScrollMagic.Scene({ triggerElement: '.nav' })
				.setPin('.nav')
				//.addIndicators()
				.setClassToggle(".nav", "fixed")
				.addTo(controller);

			//Подсветка активной секции
			var scene1 = new ScrollMagic.Scene({ triggerElement: '#calendar', offset: -130 })
				//.addIndicators()
				//.setClassToggle("a.scroll[href='#calendar']", "active")
				.addTo(controller);

			scene1.on("enter", function (event) {
				$('a.scroll').removeClass('active');
				$('a.scroll[href="#calendar"]').addClass('active');
			});
			scene1.on("leave", function (event) {
				$('a.scroll').removeClass('active');
				$('a.scroll[href="#about"]').addClass('active');
			});

			var scene2 = new ScrollMagic.Scene({ triggerElement: '#place', offset: -130 })
				//.addIndicators()
				//.setClassToggle("a.scroll[href='#place']", "active")
				.addTo(controller);

			scene2.on("enter", function (event) {
				$('a.scroll').removeClass('active');
				$('a.scroll[href="#place"]').addClass('active');
			});
			scene2.on("leave", function (event) {
				$('a.scroll').removeClass('active');
				$('a.scroll[href="#calendar"]').addClass('active');
			});

			var scene3 = new ScrollMagic.Scene({ triggerElement: '#contacts', offset: -130 })
				//.addIndicators()
				//.setClassToggle("a.scroll[href='#place']", "active")
				.addTo(controller);

			scene3.on("enter", function (event) {
				$('a.scroll').removeClass('active');
				$('a.scroll[href="#contacts"]').addClass('active');
			});
			scene3.on("leave", function (event) {
				$('a.scroll').removeClass('active');
				$('a.scroll[href="#place"]').addClass('active');
			});

        })
    },
    watch: {

    }
}
</script>

<style lang="sass">

</style>
