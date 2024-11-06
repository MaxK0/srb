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
    employees: Object,
    branchId: String,
});

const branch = ref(
    props.branches.find((branch) => branch.id == props.branchId)
);

const gettingData = ref(false);

const fetchEmployees = () => {
    gettingData.value = true;

    const branchId = branch.value.id;

    router.get(route("employees.index", { branch_id: branchId }));
};

const edit = (employee) => {
    router.get(route("employees.edit", employee));
};

const destroy = (employee) => {
    gettingData.value = true;

    router.delete(route("employees.destroy", employee));
};

onUpdated(() => {
    if (branch.value.id) {
        const branchId = branch.value.id;

        router.get(route("employees.index", { branch_id: branchId }));
    }
});
</script>

<template>
    <AppLayout title="Сотрудники">
        <section class="employees">
            <div class="container">
                <div class="employees-top-btns">
                    <Select
                        v-model="branch"
                        :options="branches"
                        filter
                        optionLabel="title"
                        placeholder="Выберите филиал"
                        class="select"
                        @change="fetchEmployees"
                    >
                    </Select>
                    <Link class="btn-main" :href="route('employees.create')"
                        >Создать сотрудника</Link
                    >
                </div>
                <div v-if="gettingData" class="getting-data">
                    Получение данных...
                </div>
                <table
                    v-if="employees && employees.data.length && !gettingData"
                    class="table position__table"
                >
                    <thead class="thead">
                        <tr>
                            <th>ФИО</th>
                            <th>Email</th>
                            <th>Пол</th>
                            <th>Должность</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <tr v-for="(employee, id) in employees.data" :key="id">
                            <td>
                                <Link
                                    :href="route('employees.show', employee)"
                                    class="link-main"
                                    >{{ employee.fio_short }}</Link
                                >
                            </td>
                            <td>
                                {{ employee.email }}
                            </td>
                            <td>
                                {{ employee.sex }}
                            </td>
                            <td>
                                {{ employee.position }}
                            </td>
                            <td>
                                <div class="table__btns">
                                    <button
                                        class="btn-main"
                                        @click="edit(employee)"
                                    >
                                        Изменить
                                    </button>
                                    <button
                                        class="btn-main delete"
                                        @click="destroy(employee)"
                                    >
                                        Удалить
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else-if="!gettingData">Нет сотрудников</div>
                <Paginator
                    v-if="employees && employees.links"
                    :pagination="employees"
                />
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.employees-top-btns {
    margin-bottom: 4rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
}

.employees-top-btns .select {
    width: fit-content;
}
</style>
