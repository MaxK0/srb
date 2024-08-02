<script setup>
import NavLink from "@/Components/NavLink.vue";
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
            </div>
            <!-- <div class="aside__nav__block">
                <h6>
                    Управление
                </h6>
                <NavLink
                    :href="route('business.index')"
                    :active="route().current('business.index')"
                >
                    Бизнесом
                </NavLink>
                <NavLink
                    :href="route('employee.index')"
                    :active="route().current('employee.index')"
                >
                    Сотрудниками
                </NavLink>
            </div> -->
        </nav>
    </aside>
</template>

<style scoped>
.aside {
    width: 15rem;
    display: flex;
    flex-direction: column;
    position: fixed;
    left: 3rem;
    top: 11rem;
    z-index: 9;
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
</style>
