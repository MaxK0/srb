<script setup>
import { router, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { formateDate } from "@/Scripts/formateDate";

const props = defineProps({
    employee: {
        type: Object,
        required: true,
    },
});

const edit = () => {
    router.get(route("employees.edit", props.employee));
};

const destroy = () => {
    router.delete(route("employees.destroy", props.employee));
};
</script>

<template>
    <AppLayout :title="employee.user.fio_short">
        <section class="position__show">
            <div class="container">
                <div class="position__show__btns">
                    <button @click="edit" class="btn-main">
                        Редактировать
                    </button>
                    <button @click="destroy" class="btn-main delete">
                        Удалить
                    </button>
                </div>
                <table class="table show__table">
                    <tbody class="tbody">
                        <tr>
                            <th>Фамилия</th>
                            <td>{{ employee.user.lastname }}</td>
                        </tr>
                        <tr>
                            <th>Имя</th>
                            <td>{{ employee.user.name }}</td>
                        </tr>
                        <tr>
                            <th>Отчество</th>
                            <td>{{ employee.user.patronymic }}</td>
                        </tr>
                        <tr>
                            <th>Телефон</th>
                            <td>{{ employee.user.formatted_phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ employee.user.email }}</td>
                        </tr>
                        <tr>
                            <th>Пол</th>
                            <td>{{ employee.user.sex_full }}</td>
                        </tr>
                        <tr>
                            <th>Место работы</th>
                            <td>
                                <Link
                                    :href="
                                        route(
                                            'branches.show',
                                            employee.branch.id
                                        )
                                    "
                                    class="link-main"
                                    >{{ employee.branch.title }}</Link
                                >
                            </td>
                        </tr>
                        <tr>
                            <th>Должность</th>
                            <td>{{ employee.position.title }}</td>
                        </tr>
                        <tr>
                            <th>Рабочий телефон</th>
                            <td>{{ employee.formatted_work_phone }}</td>
                        </tr>
                        <tr>
                            <th>Создан</th>
                            <td>{{ formateDate(employee.created_at) }}</td>
                        </tr>
                        <tr>
                            <th>Обновлен</th>
                            <td>{{ formateDate(employee.updated_at) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.position__show__btns {
    align-self: flex-end;
    display: flex;
    gap: 2.5rem;
    margin-bottom: 4rem;
}
</style>
