<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    businesses: Object
});


</script>

<template>
    <AppLayout title="Бизнесы">
        <section class="business">
            <div class="container">
                <Link class="btn-main business__create-link" :href="route('businesses.create')">Создать бизнес</Link>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.business__create-link {
    align-self: flex-end;
    margin-bottom: 4rem;
}
</style>
