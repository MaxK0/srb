<script setup>
import { useForm } from "@inertiajs/vue3";

import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

import Select from "primevue/select";
import { getCookie } from "@/Scripts/cookie";

const props = defineProps({
    branches: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    title: "",
    branch: props.branches.find((branch) => branch.id == getCookie('branch_id')),
});

const submit = () => {
    form.post(route("positions.store"));
};
</script>

<template>
    <AppLayout title="Создать должность">
        <section class="positions__create">
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
                            <InputLabel for="title" value="Должность" />
                            <TextInput
                                id="title"
                                v-model="form.title"
                                type="text"
                                required
                                autofocus
                                autocomplete="title"
                                placeholder="Работник"
                            />
                            <InputError :message="form.errors.title" />
                        </div>
                    </div>

                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Создать должность
                    </PrimaryButton>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
