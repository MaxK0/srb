<script setup>
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

import Paginator from "@/Components/Paginator.vue";

const props = defineProps({
    businesses: Object,
});

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
                <Link
                    class="btn-main business__create-link"
                    :href="route('businesses.create')"
                    >Создать бизнес</Link
                >
                <table v-if="businesses.data.length" class="table business__table">
                    <thead class="thead">
                        <tr>
                            <th>Название</th>
                            <th>Информация</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <tr v-for="(business, id) in businesses.data" :key="id">
                            <td>
                                <Link :href="route('businesses.show', business)" class="link-main">{{ business.title }}</Link>
                            </td>
                            <td class="table-inf">
                                {{ business.information }}
                            </td>
                            <td>
                                <div class="table__btns">
                                    <button
                                        class="btn-main"
                                        @click="edit(business)"
                                    >
                                        Изменить
                                    </button>
                                    <button
                                        class="btn-main delete"
                                        @click="destroy(business)"
                                    >
                                        Удалить
                                    </button>
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
