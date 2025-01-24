<script setup>
import { router, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import Paginator from "@/Components/Paginator.vue";

const props = defineProps({
    positions: Object,
});

const gettingData = ref(false);

const edit = (position) => {
    router.get(route("positions.edit", position));
};

const destroy = (position) => {
    router.delete(route("positions.destroy", position));
};
</script>

<template>
    <AppLayout title="Должности">
        <section class="positions">
            <div class="container">
                <div class="top-btns">
                    <Link class="btn-main" :href="route('positions.create')"
                        >Создать должность</Link
                    >
                </div>
                <div v-if="gettingData" class="getting-data">
                    Получение данных...
                </div>
                <table
                    v-if="positions && positions.data.length && !gettingData"
                    class="table table__index position__table"
                >
                    <thead class="thead thead__index">
                        <tr>
                            <th>Название</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="tbody tbody__index">
                        <tr v-for="(position, id) in positions.data" :key="id">
                            <td data-label="Название">
                                <Link
                                    :href="route('positions.show', position)"
                                    class="link-main"
                                    >{{ position.title }}</Link
                                >
                            </td>
                            <td>
                                <div class="table__btns">
                                    <button
                                        class="btn-main"
                                        @click="edit(position)"
                                    >
                                        Изменить
                                    </button>
                                    <button
                                        class="btn-main delete"
                                        @click="destroy(position)"
                                    >
                                        Удалить
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else-if="!gettingData">Нет должностей</div>
                <Paginator
                    v-if="positions && positions.links"
                    :pagination="positions"
                />
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
</style>
