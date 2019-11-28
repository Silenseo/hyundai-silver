<template>
	<section id="about" class="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="banner__center">
						<div class="banner__video">
							<video preload="preload" autoplay loop muted>
								<source src="/images/motorstudio/Hyundai_MotorStudio_v_Moskve_2.mp4" type="video/mp4">
							</video>
						</div>
						<div class="banner__composition">
							<h1 class="banner__title">
								<span>
									HYUNDAI
									<br>MOTORSTUDIO
								</span>
								<br>
								MOSCOW
							</h1>
							<div class="banner__subtitle">
								{{ lang === 'ru' ? 'Инновационное мультиформатное' : 'Innovative multi-format' }}
								<br>{{ lang === 'ru' ? 'бренд-пространство' : 'brand area' }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
export default {
    name: 'BannerSection',
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

    },
    filters: {

    },
    mounted () {
        this.$nextTick(function () {
           

        })
    },
    watch: {

    }
}
</script>

<style lang="sass">

</style>
