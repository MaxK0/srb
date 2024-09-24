<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

import Select from "primevue/select";

const cities = ref([
    {'title': 'Уфа'}, {'title': 'Москва'}
]);

const selectedCity = ref("");

const form = useForm({
    title: "",
});

const submit = () => {};
</script>

<template>
    <AppLayout title="Создать бизнес">
        <section class="business__create">
            <div class="container">
                <form class="form" @submit.prevent="submit">
                    <div class="form__block">
                        <InputLabel for="title" value="Название" />
                        <TextInput
                            id="title"
                            v-model="form.title"
                            type="text"
                            required
                            autofocus
                            autocomplete="title"
                        />
                    </div>
                    <div class="form__blocks">
                        <div class="form__block">
                            <InputLabel for="city" value="Город" />
                            <Select
                                v-model="selectedCity"
                                :options="cities"
                                filter
                                optionLabel="title"
                                placeholder="Выберите город"
                                class="select"
                            >
                            </Select>
                        </div>
                        <div class="form__block">
                            <InputLabel for="address" value="Адрес" />
                            <TextInput
                                id="address"
                                v-model="form.address"
                                type="text"
                                required
                                autocomplete="address"
                            />
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
