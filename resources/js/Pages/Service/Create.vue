<script setup>
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";

const props = defineProps({
    branch: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    title: "",
    price: "",
    duration: "00:30",
    information: "",
});

const submit = () => {
    form.post(route('branches.services.store', props.branch));
};
</script>

<template>
    <AppLayout :title="`Создать услугу для ${branch.title}`">
        <section class="service__create">
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
                            placeholder="Название услуги"
                        />
                        <InputError :message="form.errors.title" />
                    </div>

                    <div class="form__blocks">
                        <div class="form__block">
                            <InputLabel for="price" value="Цена" />
                            <TextInput
                                id="price"
                                v-model="form.price"
                                type="number"
                                min="0"
                                step="0.01"
                                required
                                placeholder="1000.00"
                            />
                            <InputError :message="form.errors.price" />
                        </div>
                        <div class="form__block">
                            <InputLabel for="duration" value="Длительность" />
                            <TextInput
                                id="duration"
                                v-model="form.duration"
                                type="time"
                                required
                                step="300"
                            />
                            <InputError :message="form.errors.duration" />
                        </div>
                    </div>

                    <div class="form__block">
                        <InputLabel for="information" value="Описание" />
                        <TextArea
                            rows="5"
                            v-model="form.information"
                            placeholder="Описание услуги"
                        />
                        <InputError :message="form.errors.information" />
                    </div>

                    <PrimaryButton :disabled="form.processing">
                        Создать услугу
                    </PrimaryButton>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
