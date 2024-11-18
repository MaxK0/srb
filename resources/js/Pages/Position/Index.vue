<script setup>
import { router, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { onUpdated, ref } from "vue";
import Paginator from "@/Components/Paginator.vue";
import Select from "primevue/select";

const props = defineProps({
    branches: {
        type: Object,
        required: true,
    },
    positions: Object,
    filter: {
        type: Object,
        required: true,
    },
});

const branch = ref(
    props.branches.find((branch) => branch.id == props.filter.branchId)
);

const gettingData = ref(false);

const fetchPositions = () => {
    gettingData.value = true;

    const branchId = branch.value.id;

    router.get(`/positions?branch_id=${branchId}`);
};

const edit = (position) => {
    router.get(route("positions.edit", position));
};

const destroy = (position) => {
    gettingData.value = true;

    router.delete(route("positions.destroyWithoutRedirect", position));
};

onUpdated(() => {
    fetchPositions();
});
</script>

<template>
    <AppLayout title="Должности">
        <section class="positions">
            <div class="container">
                <div class="positions-top-btns">
                    <Select
                        v-model="branch"
                        :options="branches"
                        filter
                        optionLabel="title"
                        placeholder="Выберите филиал"
                        class="select"
                        @change="fetchPositions"
                    >
                    </Select>
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
.positions-top-btns {
    margin-bottom: 4rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
}

.positions-top-btns .select {
    width: fit-content;
}
</style>
