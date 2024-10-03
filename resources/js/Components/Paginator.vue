<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    pagination: Object,
});
</script>

<template>
    <nav v-if="pagination.links.length > 3" class="relative flex justify-center">
        <template v-for="link in pagination.links" :key="link.label">
            <Link
                preserve-scroll
                :href="link.url ?? ''"
                v-html="link.label"
                class="flex items-center justify-center px-3 py-2 text-sm rounded-lg text-gray-600 mt-8"
                :class="{
                    'border-2 border-gray-200 cursor-default': link.active,                    
                    'cursor-default': !link.url,
                    '!text-gray-300': link.url,
                }"
            />
        </template>
    </nav>
</template>
