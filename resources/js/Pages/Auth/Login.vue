<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";

import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

import InputMask from "primevue/inputmask";
import Password from "primevue/password";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    login: "",
    password: "",
    is_phone: false,
    remember: false,
});

const isPhoneChanged = () => {
    form.login = "";
};

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Log in" />

    <AuthenticationCard>
        <template #logo>
            <h1>Вход</h1>
        </template>

        <form @submit.prevent="submit">
            <div v-if="!form.is_phone">
                <InputLabel for="login" value="Email" />
                <TextInput
                    class="mt-1 block w-full"
                    id="login"
                    v-model="form.login"
                    type="email"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError class="mt-8" :message="form.errors.login" />
            </div>

            <div v-else class="form__block mt-8">
                <InputLabel for="phone" value="Телефон" />
                <InputMask
                    id="phone"
                    class="input"
                    v-model="form.login"
                    required
                    autocomplete="phone"
                    mask="+9 (999) 999 99-99"
                    placeholder="+9 (999) 999 99-99"
                />
                <InputError class="mt-8" :message="form.errors.phone" />
            </div>

            <div class="block mt-8">
                <label class="flex items-center">
                    <Checkbox
                        id="is_phone"
                        v-model:checked="form.is_phone"
                        name="is_phone"
                        @change="isPhoneChanged"
                    />
                    <span class="ms-4 text-sm text-white-600">Телефон</span>
                </label>
            </div>

            <div class="mt-8">
                <InputLabel for="password" value="Password" />
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

            <div class="block mt-8">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember" />
                    <span class="ms-4 text-sm text-white-600"
                        >Запомнить себя</span
                    >
                </label>
            </div>

            <div class="flex items-center justify-end mt-14">
                <!-- <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Forgot your password?
                </Link> -->
                <p class="text-sm leading-6">
                    Забыли пароль или хотите
                    <Link
                        :href="route('register')"
                        class="underline text-sm text-white-600 hover:text-blue-400"
                        >зарегистрироваться</Link
                    >?
                </p>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Войти
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
