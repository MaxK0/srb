<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

import AppLayout from "@/Layouts/AppLayout.vue";

import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";

import Select from "primevue/select";
import InputMask from "primevue/inputmask";
import Password from "primevue/password";

const props = defineProps({
    branches: {
        type: Object,
        required: true,
    },
    positions: {
        type: Object,
        required: true,
    },
});

const form = useForm({
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
    find_user: false,
});

const submitBtnText = ref('Создать пользователя');

const changedFindUser = () => {
    if (form.find_user) submitBtnText.value = 'Найти пользователя';
    else submitBtnText.value = 'Создать пользователя';
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
                            <Checkbox
                                v-model:checked="form.find_user"
                                @change="changedFindUser"
                                name="find_user"
                            />
                            <InputLabel
                                for="find_user"
                                value="Найти пользователя"
                            />
                            <InputError
                                :message="form.errors.find_user"
                            />
                        </div>
                    </div>

                    <div v-if="form.find_user" class="form__blocks form__choose-user">
                        <div class="form__block">
                            <InputLabel for="phone" value="Телефон" />
                            <InputMask
                                id="phone"
                                class="input"
                                v-model="form.phone"
                                autocomplete="phone"
                                mask="+9 (999) 999 99-99"
                                placeholder="+9 (999) 999 99-99"
                            />
                            <InputError :message="form.errors.phone" />
                        </div>
                        <p>или</p>
                        <div class="form__block">
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                autocomplete="email"
                                placeholder="ivan@gmail.com"
                            />
                            <InputError :message="form.errors.email" />
                        </div>
                    </div>

                    <div v-if="!form.find_user" class="form__create-user">
                        <div class="form__blocks">
                            <div class="form__block">
                                <InputLabel for="phone" value="Телефон" />
                                <InputMask
                                    id="phone"
                                    class="input"
                                    v-model="form.phone"
                                    required
                                    autocomplete="phone"
                                    mask="+9 (999) 999 99-99"
                                    placeholder="+9 (999) 999 99-99"
                                />
                                <InputError :message="form.errors.phone" />
                            </div>
                            <div class="form__block">
                                <InputLabel
                                    for="work_phone"
                                    value="Рабочий телефон"
                                />
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
                        </div>

                        <div class="form__blocks">
                            <div class="form__block">
                                <InputLabel for="email" value="Email" />
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    required
                                    autocomplete="email"
                                    placeholder="ivan@gmail.com"
                                />
                                <InputError :message="form.errors.email" />
                            </div>
                            <div class="form__block">
                                <InputLabel for="name" value="Имя" />
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    required
                                    autocomplete="name"
                                    placeholder="Иван"
                                />
                                <InputError :message="form.errors.name" />
                            </div>
                        </div>

                        <div class="form__blocks">
                            <div class="form__block">
                                <InputLabel for="lastname" value="Фамилия" />
                                <TextInput
                                    id="lastname"
                                    v-model="form.lastname"
                                    type="text"
                                    required
                                    autocomplete="lastname"
                                    placeholder="Иванов"
                                />
                                <InputError :message="form.errors.lastname" />
                            </div>
                            <div class="form__block">
                                <InputLabel for="patronymic" value="Отчество" />
                                <TextInput
                                    id="patronymic"
                                    v-model="form.patronymic"
                                    type="text"
                                    autocomplete="patronymic"
                                    placeholder="Иванович"
                                />
                                <InputError :message="form.errors.patronymic" />
                            </div>
                        </div>

                        <div class="form__blocks">
                            <div class="form__block">
                                <InputLabel for="password" value="Пароль" />
                                <Password
                                    id="password"
                                    v-model="form.password"
                                    toggleMask
                                    :feedback="false"
                                    placeholder="password"
                                />
                                <InputError :message="form.errors.password" />
                            </div>
                            <div class="form__block">
                                <InputLabel
                                    for="password_confirmation"
                                    value="Повтор пароля"
                                />
                                <Password
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    toggleMask
                                    :feedback="false"
                                    placeholder="password"
                                />
                                <InputError
                                    :message="form.errors.password_confirmation"
                                />
                            </div>
                        </div>
                    </div>

                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        {{ submitBtnText }}
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

.form__choose-user {
    align-items: center;
}

.form__choose-user > p {
    height: fit-content;
}
</style>
