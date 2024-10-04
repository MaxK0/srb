<script setup>
import { useForm } from "@inertiajs/vue3";

import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Select from "primevue/select";

const props = defineProps({
    branch: {
        type: Object,
        required: true,
    },
    cities: {
        type: Array,
        required: true,
    },
    businesses: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    title: props.branch.title,
    information: props.branch.information,
    active: props.branch.active,
    business: props.branch.business,
    city: props.branch.city,
    address: props.branch.address
});

const submit = () => {
    form.put(route("branches.update", props.branch));
};
</script>

<template>
    <AppLayout title="Редактировать филиал">
        <section class="branch__create">
            <div class="container">
                <form class="form" @submit.prevent="submit">
                    <div class="form__blocks">
                        <div class="form__block">
                            <InputLabel for="business" value="Бизнес" />
                            <Select
                                v-model="form.business"
                                :options="businesses"
                                filter
                                optionLabel="title"
                                placeholder="Выберите бизнес"
                                class="select"
                            >
                            </Select>
                            <InputError :message="form.errors.business" />
                            <InputError :message="form.errors.business_id" />
                        </div>
                        <div class="form__block">
                            <InputLabel for="title" value="Название" />
                            <TextInput
                                id="title"
                                v-model="form.title"
                                type="text"
                                required
                                autofocus
                                autocomplete="title"
                                placeholder="Филиал бизнеса"
                            />
                            <InputError :message="form.errors.title" />
                        </div>
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
                            <InputError :message="form.errors.city_id" />
                        </div>
                        <div class="form__block">
                            <InputLabel for="address" value="Адрес" />
                            <TextInput
                                id="address"
                                v-model="form.address"
                                type="text"
                                required
                                autocomplete="address"
                                placeholder="Уфа, Улица, 1"
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
                            placeholder="Информация"
                        ></TextArea>
                        <InputError :message="form.errors.information" />
                    </div>
                    <div class="form__block checkbox">
                        <Checkbox v-model:checked="form.active" name="active" />
                        <InputLabel for="active" value="Активен" />
                        <InputError :message="form.errors.active" />
                    </div>
                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Редактировать филиал
                    </PrimaryButton>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
