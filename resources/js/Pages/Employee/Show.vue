<script setup>
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { formateDate } from "@/Scripts/formateDate";

const props = defineProps({
    position: {
        type: Object,
        required: true,
    },
});

const edit = () => {
    router.get(route("positions.edit", props.position));
};

const destroy = () => {
    router.delete(route("positions.destroy", props.position));
};
</script>

<template>
    <AppLayout :title="position.title">
        <section class="position__show">
            <div class="container">
                <div class="position__show__btns">
                    <button @click="edit" class="btn-main">
                        Редактировать
                    </button>
                    <button @click="destroy" class="btn-main delete">
                        Удалить
                    </button>
                </div>
                <table class="table show__table">
                    <tbody class="tbody">
                        <tr>
                            <th>Название</th>
                            <td>{{ position.title }}</td>
                        </tr>
                        <tr>
                            <th>Филиал</th>
                            <td>{{ position.branch.title }}</td>
                        </tr>
                        <tr>
                            <th>Создан</th>
                            <td>{{ formateDate(position.created_at) }}</td>
                        </tr>
                        <tr>
                            <th>Обновлен</th>
                            <td>{{ formateDate(position.updated_at) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.position__show__btns {
    align-self: flex-end;
    display: flex;
    gap: 2.5rem;
    margin-bottom: 4rem;
}
</style>
