<script setup>
import { useForm } from "@inertiajs/vue3";

import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Select from "primevue/select";

const props = defineProps({
    position: {
        type: Object,
        required: true,
    },
    branches: {
        type: Array,
        required: true
    }
});

const form = useForm({
    title: props.position.title,
    branch: props.position.branch
});

const submit = () => {
    form.put(route("positions.update", props.position));
};
</script>

<template>
    <AppLayout title="Редактировать должность">
        <section class="position__create">
            <div class="container">
                <form class="form" @submit.prevent="submit">
                    <div class="form__blocks">
                        <div class="form__block">
                            <InputLabel for="branch" value="Филиал" />
                            <Select
                                id="branch"
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
                        Редактировать должность
                    </PrimaryButton>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
