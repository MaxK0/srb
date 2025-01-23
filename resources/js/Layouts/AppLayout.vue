<script setup>
import { computed, onMounted, ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { useStore } from "vuex";

import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Aside from "@/Components/Aside.vue";

defineProps({
    title: String,
});

const store = useStore();

const showingAside = computed(() => store.state.isAsideOpen);
const showingAsideBG = ref(false);

const toggleAside = () => {
    store.commit("toggleIsAsideOpen");

    if (showingAside.value && window.innerWidth < 1240) showingAsideBG.value = true;
    else if (window.innerWidth < 1240) showingAsideBG.value = false;
};

const logout = () => {
    router.post(route("logout"));
};

onMounted(() => {
    if (window.innerWidth < 1240) store.commit("setIsAsideOpen", false);
});
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen">
            <header class="header header__main">
                <div class="container header__container">
                    <nav class="header__nav">
                        <div class="header__ul">
                            <button @click="toggleAside" class="toggle-aside">
                                <img
                                    src="/assets/img/icons/burger-menu.svg"
                                    alt="Меню"
                                />
                            </button>
                            <div
                                v-if="showingAsideBG"
                                class="fixed inset-0 z-40"
                                @click="toggleAside"
                            />

                            <Link class="link-nav" :href="route('home')">SRB</Link>

                            <div>
                                <!-- Settings Dropdown -->
                                <div class="relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <button
                                                v-if="
                                                    $page.props.jetstream
                                                        .managesProfilePhotos
                                                "
                                                class="flex border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                            >
                                                <img
                                                    class="h-8 w-8 rounded-full object-cover"
                                                    :src="
                                                        $page.props.auth.user
                                                            .profile_photo_url
                                                    "
                                                    :alt="
                                                        $page.props.auth.user
                                                            .name
                                                    "
                                                />
                                            </button>
                                            <span
                                                v-else
                                                class="inline-flex rounded-md"
                                            >
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                                                >
                                                    {{
                                                        $page.props.auth.user
                                                            .name
                                                    }}
                                                    <svg
                                                        class="ms-2 -me-0.5 h-6 w-6"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>
                                        <template #content>
                                            <!-- Account Management -->
                                            <div
                                                class="block px-4 py-2 text-xs text-gray-500"
                                            >
                                                Управление аккаунтом
                                            </div>
                                            <!-- <DropdownLink
                                                        :href="route('profile.show')"
                                                    >
                                                        Профиль
                                                    </DropdownLink>
                                                    <DropdownLink
                                                        v-if="
                                                            $page.props.jetstream
                                                                .hasApiFeatures
                                                        "
                                                        :href="route('api-tokens.index')"
                                                    >
                                                        API токены
                                                    </DropdownLink> -->
                                            <div
                                                class="border-t border-gray-200"
                                            />
                                            <!-- Authentication -->
                                            <form @submit.prevent="logout">
                                                <DropdownLink as="button">
                                                    Выйти
                                                </DropdownLink>
                                            </form>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <transition name="slide-aside">
                <Aside v-if="showingAside"></Aside>
            </transition>

            <!-- Page Content -->
            <main
                class="main"
                :class="{
                    main_collapsed: showingAside,
                    main_expanded: !showingAside,
                }"
            >
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped>
.main {
    transition: margin-left 0.3s ease;
    margin-top: 4rem;
}

.toggle-aside {
    width: 2.4rem;
    height: 2.4rem;
}

.slide-aside-enter-active {
    transition: all 0.3s ease-out;
}

.slide-aside-leave-active {
    transition: all 0.2s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-aside-enter-from,
.slide-aside-leave-to {
    transform: translateX(-30rem);
    opacity: 0;
}

.main_collapsed {
    margin-left: 10rem;
}

.main_expanded {
    margin-left: 0;
}

@media (max-width: 1024px) {
    .main_collapsed {
        margin-left: 0;
    }
}
</style>
