<script setup>
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

import Paginator from "@/Components/Paginator.vue";

const props = defineProps({
    businesses: Object,
});
</script>

<template>
    <AppLayout title="Бизнесы">
        <section class="business">
            <div class="container">
                <Link
                    class="btn-main business__create-link"
                    :href="route('businesses.create')"
                    >Создать бизнес</Link
                >
                <table v-if="businesses.data.length" class="table table__index business__table">
                    <thead class="thead thead__index">
                        <tr>
                            <th>Название</th>
                            <th>Информация</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="tbody tbody__index">
                        <tr v-for="(business, id) in businesses.data" :key="id">
                            <td data-label="Название">
                                <Link :href="route('businesses.show', business)" class="link-main">{{ business.title }}</Link>
                            </td>
                            <td class="table-inf" data-label="Информация">
                                {{ business.information }}
                            </td>
                            <td data-label="">
                                <div class="table__btns">
                                    <Link
                                        :href="route('businesses.edit', business)"
                                        class="btn-main"
                                    >Изменить</Link>
                                    <Link
                                        class="btn-main delete"
                                        as="button"
                                        method="DELETE"
                                        :href="route('businesses.destroy', business)"
                                    >Удалить</Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else>Вы ещё не открыли бизнес</div>
                <Paginator :pagination="businesses"/>
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
