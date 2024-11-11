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

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <Head title="Главная" />
    <header class="header">
        <div class="header__container container">
            <nav v-if="canLogin" class="header__nav">
                <ul v-if="$page.props.auth.user" class="header__ul">
                    <Link
                        :href="route('dashboard')"
                        class="link-nav"
                    >
                        Управление бизнесом
                    </Link>
                </ul>
                <template v-else>
                    <ul class="header__ul">
                        <Link :href="route('login')" class="link-nav"> Войти </Link>
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

    <main class="mt-6"></main>
</template>
