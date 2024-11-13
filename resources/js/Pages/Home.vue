<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Главная" />
    <header class="header">
        <div class="header__container container">
            <nav v-if="canLogin" class="header__nav">
                <ul v-if="$page.props.auth.user" class="header__ul">
                    <Link :href="route('dashboard')" class="link-nav">
                        Управление бизнесом
                    </Link>
                </ul>
                <template v-else>
                    <ul class="header__ul">
                        <Link :href="route('login')" class="link-nav">
                            Войти
                        </Link>
                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="link-nav"
                        >
                            Зарегистрироваться
                        </Link>
                    </ul>
                </template>
            </nav>
        </div>
    </header>

    <main class="mt-6">
        <section class="main__section">
            <div class="container main__container">
                <div class="main__block">
                    <h1 class="main__title">SRB</h1>
                    <p class="main__desc">Система управления бизнесом</p>
                </div>
            </div>
        </section>

        <section class="opportunities">
            <div class="container opportunities__container">
                <h2 class="opportunities__tit">Возможности</h2>
                <div class="opportunities__blocks">
                    <Link class="opportunities__block" :href="route('schedule.index')">
                        <h3>Расписание</h3>
                        <p>
                            Составляйте расписание и просматривайте его в
                            качестве владельца или сотрудника.
                        </p>
                    </Link>
                    <Link class="opportunities__block" :href="route('businesses.index')">
                        <h3>Управление</h3>
                        <p>
                            Организуйте свой бизнес, управляя всем необходимым:
                            филиалами, сотрудниками, заказами, клиентами и др.
                        </p>
                    </Link>
                    <Link class="opportunities__block" :href="route('dashboard')">
                        <h3>Статистика</h3>
                        <p>Наблюдайте за развитием вашего бизнеса.</p>
                    </Link>
                </div>
            </div>
        </section>
    </main>
</template>

<style scoped>
.main__block {
    align-self: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 10rem;
    gap: 2rem;
}

.main__desc {
    font-size: var(--font-size-large);
}

/* <===================== Возможности =====================> */
.opportunities__blocks {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

.opportunities__block {
    display: flex;
    flex-direction: column;
    gap: 2.5rem;
    padding: 1rem 1.5rem;
    background-color: var(--color-second);
    color: var(--color-main);
    border-radius: var(--border-radius);
}
/* <===================== Конец возможностей =====================> */

@media (max-width: 768px) {
    .opportunities__blocks {
        grid-template-columns: 1fr;
    }
}
</style>
