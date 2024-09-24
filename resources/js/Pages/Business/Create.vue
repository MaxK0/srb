<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";

import Select from "primevue/select";

const cities = ref([{ title: "Уфа" }, { title: "Москва" }]);

const form = useForm({
    title: "",
    city: "",
    address: "",
    information: "",
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
                        <InputError :message="form.errors.title" />
                    </div>
                    <div class="form__blocks">
                        <div class="form__block">
                            <InputLabel for="city" value="Город" />
                            <Select
                                v-model="form.city"
                                :options="cities"
                                filter
                                optionLabel="title"
                                placeholder="Выберите город"
                                class="select"
                            >
                            </Select>
                            <InputError :message="form.errors.city" />
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
                            <InputError :message="form.errors.address" />
                        </div>
                    </div>
                    <div class="form__block">
                        <InputLabel for="information" value="Информация" />
                        <TextArea
                            rows="5"
                            v-model="form.information"
                            autocomplete="information"
                        ></TextArea>
                        <InputError :message="form.errors.information" />
                    </div>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
