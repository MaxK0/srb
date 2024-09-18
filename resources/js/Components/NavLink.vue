<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'aside-link active'
        : 'aside-link';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />    
    </Link>
</template>

<style scoped>
.aside-link {
    font-size: var(--font-size-normal);
    color: var(--color-second);
    transition: var(--transition);
}

.aside-link.active {
    cursor: default;
    position: relative;
}

.aside-link.active::after {
    position: absolute;
    content: "";
    width: 100%;
    bottom: -0.1rem;
    left: 0;
    height: 0.2rem;
    background-color: var(--color-btn);
    border-radius: var(--border-radius);
}
</style>