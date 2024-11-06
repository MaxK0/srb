<script setup>
import { useForm, router } from "@inertiajs/vue3";

import AppLayout from "@/Layouts/AppLayout.vue";

import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import Select from "primevue/select";
import InputMask from "primevue/inputmask";
import { onMounted } from "vue";

const props = defineProps({
    employee: {
        type: Object,
        required: true,
    },
    branches: {
        type: Object,
        required: true,
    },
    positions: Object,
    branch_id: String,
});

const form = useForm({
    branch: props.branches.find((branch) => branch.id == (props.branch_id ?? props.employee.branches[0].id)),
    position: props.positions.find((position) => position.id == props.employee.position.id),
    work_phone: props.employee.work_phone,
});

const fetchPositions = () => {
    const branchId = form.branch.id;

    router.get(
        route("employees.edit", {
            branch_id: branchId,
            employee: props.employee,
        })
    );
};

const submit = () => {
    form.put(route("employees.update", props.employee));
};
</script>

<template>
    <AppLayout title="Редактировать сотрудника">
        <section class="employees__edit">
            <div class="container">
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
                        Редактировать сотрудника
                    </PrimaryButton>
                </form>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped></style>
