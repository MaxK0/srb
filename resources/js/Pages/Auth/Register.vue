<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";

import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

import Select from "primevue/select";
import InputMask from "primevue/inputmask";
import Password from "primevue/password";

const props = defineProps({
    sexes: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: "",
    lastname: "",
    patronymic: "",
    email: "",
    phone: "",
    password: "",
    password_confirmation: "",
    sex: [],
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <h1>Регистрация</h1>
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Имя" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
                <InputError class="mt-8" :message="form.errors.name" />
            </div>

            <div class="mt-8">
                <InputLabel for="lastname" value="Фамилия" />
                <TextInput
                    id="lastname"
                    v-model="form.lastname"
                    type="text"
                    class="mt-1 block w-full"
                />
                <InputError class="mt-8" :message="form.errors.lastname" />
            </div>

            <div class="mt-8">
                <InputLabel for="patronymic" value="Отчество" />
                <TextInput
                    id="patronymic"
                    v-model="form.patronymic"
                    type="text"
                    class="mt-1 block w-full"
                />
                <InputError class="mt-8" :message="form.errors.patronymic" />
            </div>

            <div class="mt-8">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                />
                <InputError class="mt-8" :message="form.errors.email" />
            </div>

            <div class="form__block mt-8">
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
                <InputError class="mt-8" :message="form.errors.phone" />
            </div>

            <div class="form__block mt-8">
                <InputLabel for="sex" value="Пол" />
                <Select
                    id="sex"
                    v-model="form.sex"
                    :options="sexes"
                    filter
                    optionLabel="title"
                    placeholder="Выберите пол"
                    class="select"
                >
                </Select>
                <InputError class="mt-8" :message="form.errors.sex" />
            </div>

            <div class="mt-8">
                <InputLabel for="password" value="Пароль" />
                <Password
                    id="password"
                    v-model="form.password"
                    toggleMask
                    :feedback="false"
                    placeholder="password"
                    autocomplete="current-password"
                />
                <InputError class="mt-8" :message="form.errors.password" />
            </div>

            <div class="mt-8">
                <InputLabel
                    for="password_confirmation"
                    value="Подтверждение пароля"
                />
                <Password
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    toggleMask
                    :feedback="false"
                    placeholder="password"
                    autocomplete="current-password"
                />
                <InputError
                    class="mt-8"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div
                v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
                class="mt-8"
            >
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox
                            id="terms"
                            v-model:checked="form.terms"
                            name="terms"
                            required
                        />

                        <div class="ms-2">
                            I agree to the
                            <a
                                target="_blank"
                                :href="route('terms.show')"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >Terms of Service</a
                            >
                            and
                            <a
                                target="_blank"
                                :href="route('policy.show')"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >Privacy Policy</a
                            >
                        </div>
                    </div>
                    <InputError class="mt-8" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="flex items-center justify-end mt-14">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-white-600 hover:text-blue-400 leading-6"
                >
                    Уже зарегистрированы?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Зарегистрироваться
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
