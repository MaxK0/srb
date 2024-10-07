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
    business: {
        type: Object,
        required: true,
    },
});

console.log(props.business);

const form = useForm({
    title: props.business.title,
    information: props.business.information,
    active: props.business.active,
});

const submit = () => {
    form.put(route("businesses.update", props.business));
};
</script>

<template>
    <AppLayout title="Редактировать бизнес">
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
                            placeholder="ООО 'Бизнес'"
                        />
                        <InputError :message="form.errors.title" />
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
                        Редактировать бизнес
                    </PrimaryButton>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
