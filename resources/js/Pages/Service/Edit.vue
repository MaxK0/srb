<script setup>
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import Checkbox from "@/Components/Checkbox.vue";

const props = defineProps({
    service: {
        type: Object,
        required: true,
    },
    branch: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    title: props.service.title,
    price: props.service.price,
    duration: props.service.duration,
    information: props.service.information,
    active: props.service.active,
});

const submit = () => {
    form.put(route('branches.services.update', [props.branch.id, props.service.id]));
};
</script>

<template>
    <AppLayout :title="`Редактировать услугу ${service.title}`">
        <section class="service__edit">
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

                    <div class="form__block checkbox">
                        <Checkbox v-model:checked="form.active" name="active" />
                        <InputLabel for="active" value="Активна" />
                        <InputError :message="form.errors.active" />
                    </div>

                    <PrimaryButton :disabled="form.processing">
                        Сохранить изменения
                    </PrimaryButton>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
