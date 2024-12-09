<script setup>
import { router, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { formateDate, formateTime } from "@/Scripts/formateDate";

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

const destroyWorkday = () => {
    router.delete(
        route("employees.workdays.destroy", [props.employee.id, props.employee.workday.id])
    );
};
</script>

<template>
    <AppLayout :title="employee.user.fio_short">
        <section class="employee__show">
            <div class="container">
                <div class="employee__show__btns">
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
        <section class="employee__show__workday">
            <div class="container">
                <h2 class="mb-20">Рабочий день</h2>
                <div class="employee__workday__btns">
                    <Link
                        v-if="!employee.workday"
                        class="btn-main"
                        :href="route('employees.workdays.create', employee.id)"
                        >Создать</Link
                    >
                    <Link
                        v-else
                        class="btn-main"
                        :href="
                            route('employees.workdays.edit', [
                                employee.id,
                                employee.workday.id,
                            ])
                        "
                        >Редактировать</Link
                    >
                    <button
                        v-if="employee.workday"
                        @click="destroyWorkday"
                        class="btn-main delete"
                    >
                        Удалить
                    </button>
                </div>

                <table v-if="employee.workday" class="table table__show">
                    <tbody class="tbody">
                        <tr>
                            <th>Начало расчета</th>
                            <td>
                                <Link
                                    class="link-main"
                                    :href="
                                        route('employees.workdays.show', [
                                            employee.id,
                                            employee.workday.id,
                                        ])
                                    "
                                >
                                    {{
                                        formateDate(employee.workday.date_start)
                                    }}
                                </Link>
                            </td>
                        </tr>
                        <tr>
                            <th>Смена</th>
                            <td>
                                {{ employee.workday.days_work }} /
                                {{ employee.workday.days_rest }}
                            </td>
                        </tr>
                        <tr>
                            <th>Время работы</th>
                            <td>
                                {{ formateTime(employee.workday.time_start) }} -
                                {{ formateTime(employee.workday.time_end) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.employee__show__btns {
    align-self: flex-end;
    display: flex;
    gap: 2.5rem;
    margin-bottom: 4rem;
}

.employee__workday__btns {
    align-self: flex-end;
    display: flex;
    gap: 2rem;
    margin-bottom: 4rem;
}
</style>
