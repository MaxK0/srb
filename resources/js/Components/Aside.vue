<script setup>
import { router } from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";

const becomeOwner = () => {
    router.post(route("owner.become"));
};
</script>

<template>
    <aside class="aside">
        <nav class="aside__nav">
            <div class="aside__nav__block">
                <NavLink
                    :href="route('schedule.index')"
                    :active="route().current('schedule.index')"
                >
                    Расписание
                </NavLink>
                <NavLink
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                >
                    Статистика
                </NavLink>
            </div>
            <div
                v-if="$page.props.auth.user.is_owner"
                class="aside__nav__block"
            >
                <h6>Управление</h6>
                <NavLink
                    :href="route('businesses.index')"
                    :active="route().current('businesses.index')"
                >
                    Бизнесом
                </NavLink>
                <!-- TODO: Сделать выбор филиала здесь, убрать из других мест (можно оставить на стр. создания, edit)
                  Для этого можно сохранить id выбранного филиала в cookie или в vuex.
                  Лучше cookie -->
                <NavLink
                    :href="route('positions.index')"
                    :active="route().current('positions.index')"
                >
                    Должностями
                </NavLink>
                <NavLink
                    :href="route('employees.index')"
                    :active="route().current('employees.index')"
                >
                    Сотрудниками
                </NavLink>
            </div>
            <div v-else class="aside__nav__block">
                <form @submit.prevent="becomeOwner">
                    <button class="btn-main">Стать владельцем</button>
                </form>
            </div>
        </nav>
    </aside>
</template>

<style scoped>
.aside {
    display: flex;
    flex-direction: column;
    position: fixed;
    left: 3rem;
    top: 11rem;
    z-index: 50;
}

.aside__nav {
    display: flex;
    flex-direction: column;
    gap: 4rem;
}

.aside__nav__block {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    position: relative;
}

.aside__nav__block h6 {
    margin-bottom: 0.5rem;
}

.aside__nav__block:not(:last-child)::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 0.2rem;
    border-radius: var(--border-radius);
    background-color: var(--color-second);
    left: 0;
    bottom: -2rem;
}

@media (max-width: 1024px) {
    .aside {
        background-color: var(--color-second);
        color: var(--color-main);
        padding: 3rem 2rem;
        border-radius: var(--border-radius);
        left: 1rem;
        top: 5rem;
    }

    .aside * {
        color: var(--color-main);
    }

    .aside__nav__block:not(:last-child)::after {
        background-color: var(--color-main);
    }
}
</style>
