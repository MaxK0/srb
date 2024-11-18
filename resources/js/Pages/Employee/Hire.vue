<script setup>
import { useForm, router } from "@inertiajs/vue3";

import AppLayout from "@/Layouts/AppLayout.vue";

import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import Select from "primevue/select";
import InputMask from "primevue/inputmask";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
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

const form = useForm({
    branch: props.branches.find((branch) => branch.id == props.filter.branchId),
    position: [],
    work_phone: "",
    user: props.user
});

const fetchPositions = () => {
    const branchId = form.branch.id;

    router.get(route('employees.hire', {branch_id: branchId, user: props.user}));
};

const submit = () => {
    form.post(route("employees.hire.store", props.user));
};
</script>

<template>
    <AppLayout title="Нанять пользователя">
        <section class="employees__create">
            <div class="container">
                <h5 class="mb-6">Пользователь: {{ user.fio_short }}</h5>
                <form class="form" @submit.prevent="submit">
                    <div class="form__blocks">
                        <div class="form__block">
                            <InputLabel for="branch" value="Филиал" />
                            <Select
                                v-model="form.branch"
                                :options="branches"
                                filter
                                optionLabel="title"
                                placeholder="Выберите филиал"
                                class="select"
                                @change="fetchPositions"
                            >
                            </Select>
                            <InputError :message="form.errors.branch" />
                            <InputError :message="form.errors.branch_id" />
                        </div>
                        <div class="form__block">
                            <InputLabel for="position" value="Должность" />
                            <Select
                                v-model="form.position"
                                :options="positions"
                                filter
                                optionLabel="title"
                                placeholder="Выберите должность"
                                class="select"
                            >
                            </Select>
                            <InputError :message="form.errors.position" />
                            <InputError :message="form.errors.position_id" />
                        </div>
                    </div>

                    <div class="form__block">
                        <InputLabel for="work_phone" value="Рабочий телефон" />
                        <InputMask
                            id="work_phone"
                            class="input"
                            v-model="form.work_phone"
                            autocomplete="work_phone"
                            mask="+9 (999) 999 99-99"
                            placeholder="+9 (999) 999 99-99"
                        />
                        <InputError :message="form.errors.work_phone" />
                    </div>

                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Нанять пользователя
                    </PrimaryButton>
                </form>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.form__create-user {
    display: flex;
    flex-direction: column;
    row-gap: 3rem;
}

.form__choose-user > p {
    align-self: center;
    height: fit-content;
}
</style>
