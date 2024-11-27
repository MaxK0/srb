<script setup>
import { useForm } from "@inertiajs/vue3";

import AppLayout from "@/Layouts/AppLayout.vue";

import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import DatePicker from "primevue/datepicker";
import InputNumber from "primevue/inputnumber";

const props = defineProps({
    employee: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    date_start: "",
    days_work: undefined,
    days_rest: undefined,
    time_start: "",
    time_end: "",
});

const submit = () => {
    form.post(route("employees.workdays.store", props.employee.id));
};
</script>

<template>
    <AppLayout title="Создать рабочий день">
        <section class="workday__create">
            <div class="container">
                <h2 class="mb-12">Сотрудник: {{ employee.fio_short }}</h2>
                <form class="form" @submit.prevent="submit">
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
                            <InputLabel
                                for="time_start"
                                value="Начало смены"
                            />
                            <DatePicker
                                id="time_start"
                                v-model="form.time_start"
                                timeOnly 
                                placeholder="09:00"
                            />
                            <InputError :message="form.errors.time_start" />
                        </div>
                        <div class="form__block">
                            <InputLabel
                                for="time_end"
                                value="Конец смены"
                            />
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
                        Создать рабочий день
                    </PrimaryButton>
                </form>
            </div>
        </section>
    </AppLayout>
</template>

<script scoped></script>
