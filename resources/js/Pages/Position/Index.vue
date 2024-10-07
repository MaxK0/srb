<script setup>
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

import Paginator from "@/Components/Paginator.vue";



const edit = (business) => {
    router.get(route("businesses.edit", business));
};

const destroy = (business) => {
    router.delete(route("businesses.destroy", business));
};
</script>

<template>
    <AppLayout title="Бизнесы">
        <section class="business">
            <div class="container">
                
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
