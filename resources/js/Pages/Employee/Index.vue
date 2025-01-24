<script setup>
import { router, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import Paginator from "@/Components/Paginator.vue";

const props = defineProps({
    employees: {
        type: Object,
        required: true,
    },
    filter: {
        type: Object,
        required: true,
    },
});

const gettingData = ref(false);

const edit = (employee) => {
    router.get(route("employees.edit", employee));
};

const destroy = (employee) => {
    router.delete(route("employees.destroy", employee));
};
</script>

<template>
    <AppLayout title="Сотрудники">
        <section class="employees">
            <div class="container">
                <div class="top-btns">
                    <Link class="btn-main" :href="route('employees.create')"
                        >Создать сотрудника</Link
                    >
                </div>
                <div v-if="gettingData" class="getting-data">
                    Получение данных...
                </div>
                <table
                    v-if="employees && employees.data.length && !gettingData"
                    class="table table__index employee__table"
                >
                    <thead class="thead thead__index">
                        <tr>
                            <th>ФИО</th>
                            <th>Email</th>
                            <th>Пол</th>
                            <th>Должность</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="tbody tbody__index">
                        <tr v-for="(employee, id) in employees.data" :key="id">
                            <td data-label="ФИО">
                                <Link
                                    :href="route('employees.show', employee)"
                                    class="link-main"
                                    >{{ employee.fio_short }}</Link
                                >
                            </td>
                            <td data-label="Email">
                                {{ employee.email }}
                            </td>
                            <td data-label="Пол">
                                {{ employee.sex }}
                            </td>
                            <td data-label="Должность">
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
