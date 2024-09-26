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
                <table class="table business__table">
                    <thead class="thead">
                        <tr>
                            <th>Название</th>
                            <th>Информация</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <tr>
                            <td>Название</td>
                            <td>Текст</td>
                            <div>
                                <button class="btn-main"></button>
                                <button class="btn-main"></button>
                            </div>
                        </tr>
                    </tbody>
                </table>
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
