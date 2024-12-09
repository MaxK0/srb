<script setup>
import { useForm } from "@inertiajs/vue3";
import { formateDate, formateTime } from "@/Scripts/formateDate";

import AppLayout from "@/Layouts/AppLayout.vue";

import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import DatePicker from "primevue/datepicker";
import InputNumber from "primevue/inputnumber";

const props = defineProps({
    workday: {
        type: Object,
        required: true,
    },
});

const formattedDateStart = formateDate(props.workday.date_start);

const form = useForm({
    date_start: props.workday.date_start,
    days_work: props.workday.days_work,
    days_rest: props.workday.days_rest,
    time_start: props.workday.time_start,
    time_end: props.workday.time_end,
});



const submit = () => {
    form.put(
        route("employees.workdays.update", [
            props.workday.employee_id,
            props.workday.id,
        ])
    );
};
</script>

<template>
    <AppLayout title="Редактировать рабочий день">
        <section class="workday__edit">
            <div class="container">
                <form @submit.prevent="submit" class="form">
                    <div class="form__block">
                        <InputLabel
                            for="date_start"
                            value="Начало расчета рабочего дня"
                        />
                        <DatePicker
                            id="date_start"
                            v-model="form.date_start"
                            placeholder="10/28/2024"
                        />
                        <InputError :message="form.errors.date_start" />
                    </div>
                    <div class="form__blocks">
                        <div class="form__block">
                            <InputLabel
                                for="days_work"
                                value="Количество рабочих дней"
                            />
                            <InputNumber
                                id="days_work"
                                v-model="form.days_work"
                                :useGrouping="false"
                                placeholder="5"
                            />
                            <InputError :message="form.errors.days_work" />
                        </div>
                        <div class="form__block">
                            <InputLabel
                                for="days_rest"
                                value="Количество дней отдыха"
                            />
                            <InputNumber
                                id="days_rest"
                                v-model="form.days_rest"
                                :useGrouping="false"
                                placeholder="2"
                            />
                            <InputError :message="form.errors.days_rest" />
                        </div>
                    </div>
                    <div class="form__blocks">
                        <div class="form__block">
                            <InputLabel for="time_start" value="Начало смены" />
                            <DatePicker
                                id="time_start"
                                v-model="form.time_start"
                                timeOnly
                                placeholder="09:00"
                            />
                            <InputError :message="form.errors.time_start" />
                        </div>
                        <div class="form__block">
                            <InputLabel for="time_end" value="Конец смены" />
                            <DatePicker
                                id="time_end"
                                v-model="form.time_end"
                                timeOnly
                                placeholder="17:00"
                            />
                            <InputError :message="form.errors.time_end" />
                        </div>
                    </div>

                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Редактировать рабочий день
                    </PrimaryButton>
                </form>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped></style>
