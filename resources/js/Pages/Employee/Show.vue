<script setup>
import { router, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { formateDate, formateTime } from "@/Scripts/formateDate";

const props = defineProps({
    employee: {
        type: Object,
        required: true,
    },
    can: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AppLayout :title="employee.user.fio_short">
        <section class="employee__show">
            <div class="container">
                <div v-if="can.manage" class="show__btns">
                    <Link
                        class="btn-main"
                        :href="route('employees.edit', employee)"
                        >Изменить</Link
                    >
                    <Link
                        class="btn-main delete"
                        as="button"
                        method="DELETE"
                        :href="route('employees.destroy', employee)"
                        >Удалить</Link
                    >
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
                                        route('branches.show', employee.branch)
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
                <div v-if="can.manage" class="top-btns-h2">
                    <h2 class="mb-20">Рабочий день</h2>
                    <div class="top-btns-h2__btns">
                        <Link
                            v-if="!employee.workday"
                            class="btn-main"
                            :href="
                                route('employees.workdays.create', employee.id)
                            "
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
                        <Link
                            v-if="employee.workday"
                            class="btn-main delete"
                            as="button"
                            method="DELETE"
                            :href="
                                route('employees.workdays.destroy', [
                                    employee,
                                    employee.workday,
                                ])
                            "
                            >Удалить</Link
                        >
                    </div>
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
                                            employee,
                                            employee.workday,
                                        ])
                                    "
                                >
                                    {{
                                        formateDate(employee.workday.date_start, true)
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
        <section v-if="employee.workday" class="workday__extra-days">
            <div class="container">
                <div class="top-btns-h2">
                    <h2>Дополнительные смены</h2>
                    <Link
                        v-if="can.manage"
                        class="btn-main"
                        :href="
                            route('employees.workdays.extra.create', [
                                employee,
                                employee.workday,
                            ])
                        "
                        >Создать</Link
                    >
                </div>
                <table
                    v-if="employee.workday?.extra_days.length"
                    class="table table__index"
                >
                    <thead class="thead thead__index">
                        <tr>
                            <th>Дата начала</th>
                            <th>Дата конца</th>
                            <th>Время работы</th>
                            <th v-if="can.manage"></th>
                        </tr>
                    </thead>
                    <tbody class="tbody tbody__index">
                        <tr
                            v-for="(extraDay, id) in employee.workday
                                .extra_days"
                            :key="id"
                        >
                            <td data-label="Дата начала">
                                {{ formateDate(extraDay.date_start, true) }}
                            </td>
                            <td data-label="Дата конца">
                                {{ formateDate(extraDay.date_end, true) }}
                            </td>
                            <td data-label="Время работы">
                                {{ formateTime(extraDay.time_start) }} -
                                {{ formateTime(extraDay.time_end) }}
                            </td>
                            <td v-if="can.manage">
                                <div class="table__btns">
                                    <Link
                                        class="btn-main"
                                        :href="
                                            route(
                                                'employees.workdays.extra.edit',
                                                [
                                                    employee,
                                                    employee.workday,
                                                    extraDay,
                                                ]
                                            )
                                        "
                                        >Изменить</Link
                                    >
                                    <Link
                                        class="btn-main delete"
                                        as="button"
                                        method="DELETE"
                                        :href="
                                            route(
                                                'employees.workdays.extra.destroy',
                                                [
                                                    employee,
                                                    employee.workday,
                                                    extraDay,
                                                ]
                                            )
                                        "
                                        >Удалить</Link
                                    >
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section v-if="employee.workday" class="workday__workless-days">
            <div class="container">
                <div class="top-btns-h2">
                    <h2>Безрабочие смены</h2>
                    <Link
                        v-if="can.manage"
                        class="btn-main"
                        :href="route('employees.workdays.workless.create', [employee, employee.workday])"
                        >Создать</Link
                    >
                </div>
                <table
                    v-if="employee.workday?.workless_days.length"
                    class="table table__index"
                >
                    <thead class="thead thead__index">
                        <tr>
                            <th>Дата начала</th>
                            <th>Дата конца</th>
                            <th>Статус</th>
                            <th v-if="can.manage"></th>
                        </tr>
                    </thead>
                    <tbody class="tbody tbody__index">
                        <tr
                            v-for="(worklessDay, id) in employee.workday
                                .workless_days"
                            :key="id"
                        >
                            <td data-label="Дата начала">
                                {{ formateDate(worklessDay.start, true) }}
                            </td>
                            <td data-label="Дата конца">
                                {{ formateDate(worklessDay.end, true) }}
                            </td>
                            <td data-label="Статус">
                                {{ worklessDay.status.title }}
                            </td>
                            <td v-if="can.manage">
                                <div class="table__btns">
                                    <Link
                                        class="btn-main"
                                        :href="
                                            route(
                                                'employees.workdays.workless.edit',
                                                [
                                                    employee,
                                                    employee.workday,
                                                    worklessDay,
                                                ]
                                            )
                                        "
                                        >Изменить</Link
                                    >
                                    <Link
                                        class="btn-main delete"
                                        as="button"
                                        method="DELETE"
                                        :href="
                                            route(
                                                'employees.workdays.workless.destroy',
                                                [
                                                    employee,
                                                    employee.workday,
                                                    worklessDay,
                                                ]
                                            )
                                        "
                                        >Удалить</Link
                                    >
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped></style>
