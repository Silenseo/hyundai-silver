<template>
    <div class="s-dropdown" :class="{ isOpened: isOpened }">
        <a href="#" @click.prevent="toggleDropdown" class="s-dropdown__head">
            {{ selectedItem }}
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 6L5.33104 2.10207C5.71134 1.75979 6.28866 1.75979 6.66896 2.10207L11 6" stroke-width="2"/>
            </svg>
        </a>
        <div class="s-dropdown__holder">
            <div class="s-dropdown__drop">
                <ul class="s-dropdown__list">
                    <li class="s-dropdown__item" v-for="item in list" :key="item">
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 5.2L5 8L9 1" stroke="#00AAD2" stroke-width="2"/>
                        </svg>
                        {{ item }}
                    </li>
                </ul>
                <div class="s-dropdown__more">
                    <a href="/service/best" class="df-iconed-link">
                        Узнать больше
                        <svg>
                            <use xlink:href="#arrow-link"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Dropdown',
    data () {
        return {
            list: ['Комплексная диагностика автомобиля по 36 ключевым пунктам**', 'Проверка аккумуляторной батареи', 'Замена внешних ламп освещения', 'Замена щеток стеклоочистителя', 'Регулировка уровня рабочих жидкостей', 'Установка салонного фильтра'],
            selectedItem: 'Вам доступны следующие бесплатные услуги',
            isOpened: false
        }
    },
    computed: {

    },
    methods: {
        toggleDropdown: function () {
            $('.s-dropdown__drop').slideToggle();
            this.isOpened = !this.isOpened;
        }
    },
    mounted () {
        var that = this;

        this.$nextTick(function () {
           $(document).on('click', function (e) {
               if ($(e.target).parents('.s-dropdown').length === 0 && that.isOpened) {
                   that.isOpened = false;
                   $('.s-dropdown__drop').slideToggle();
               }
           })
        })
    }
}
</script>
