<script setup>
import { useForm } from "@inertiajs/vue3";

import AppLayout from "@/Layouts/AppLayout.vue";

import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Select from "primevue/select";

const props = defineProps({
    branches: {
        type: Object,
        required: true,
    },
    positions: {
        type: Object,
        required: true,
    },
    users: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    user: [],
    branch: [],
    position: [],
    phone: "",
    work_phone: "",
    email: "",
    name: "",
    lastname: "",
    patronymic: "",
    password: "",
    password_confirmation: "",
    choose_employee: false
});

const loadUsers = () => {
    console.log('you have to use it only in first time');
}

const submit = () => {
    form.post(route("employees.store"));
};
</script>

<template>
    <AppLayout title="Создать сотрудника">
        <section class="employees__create">
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

                    <div class="form__blocks">
                        <div class="form__block checkbox">
                            <Checkbox v-model:checked="form.choose_employee" @change="loadUsers" name="choose_employee" />
                            <InputLabel for="choose_employee" value="Выбрать пользователя" />
                            <InputError :message="form.errors.choose_employee" />
                        </div>
                        <div v-if="form.choose_employee" class="form__block">
                            <InputLabel for="user" value="Пользователь" />
                            <Select
                                v-model="form.user"
                                :options="users"
                                filter
                                optionLabel="fio_short"
                                placeholder="Выберите пользователя"
                                class="select"
                            >
                            </Select>
                            <InputError :message="form.errors.user" />
                            <InputError :message="form.errors.user_id" />
                        </div>
                    </div>

                    <div v-if="!form.choose_employee" class="form__create-user">

                    </div>

                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Создать сотрудника
                    </PrimaryButton>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
