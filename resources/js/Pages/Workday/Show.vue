<script setup>
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { formateDate, formateTime } from "@/Scripts/formateDate";

const props = defineProps({
    workday: {
        type: Object,
        required: true,
    },
});

const edit = () => {
    router.get(
        route("employees.workdays.edit", [
            props.workday.id,
            props.workday.employee_id,
        ])
    );
};

const destroy = () => {
    router.delete(
        route("employees.workdays.destroy", [
            props.workday.id,
            props.workday.employee_id,
        ])
    );
};
</script>

<template>
    <AppLayout title="Рабочий день">
        <section class="workday__show">
            <div class="container">
                <div class="workday__show__btns">
                    <button @click="edit" class="btn-main">
                        Редактировать
                    </button>
                    <button @click="destroy" class="btn-main delete">
                        Удалить
                    </button>
                </div>
                <table class="table table__show">
                    <tbody class="tbody">
                        <tr>
                            <th>Начало расчета</th>
                            <td>
                                {{ formateDate(workday.date_start) }}
                            </td>
                        </tr>
                        <tr>
                            <th>Смена</th>
                            <td>
                                {{ workday.days_work }} /
                                {{ workday.days_rest }}
                            </td>
                        </tr>
                        <tr>
                            <th>Время работы</th>
                            <td>
                                {{ formateTime(workday.time_start) }} -
                                {{ formateTime(workday.time_end) }}
                            </td>
                        </tr>
                        <tr>
                            <th>Создан</th>
                            <td>
                                {{ formateDate(workday.created_at) }}
                            </td>
                        </tr>
                        <tr>
                            <th>Обновлен</th>
                            <td>
                                {{ formateDate(workday.updated_at) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.workday__show__btns {
    align-self: flex-end;
    display: flex;
    gap: 2.5rem;
    margin-bottom: 4rem;
}
</style>
