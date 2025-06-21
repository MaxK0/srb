<script setup>
import { router, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { formateDate } from "@/Scripts/formateDate";
import { formateInf } from "@/Scripts/formateInf";

const props = defineProps({
    service: {
        type: Object,
        required: true,
    },
});

const edit = () => {
    router.get(route('branches.services.edit', [props.service.branch.id, props.service.id]));
};

const destroy = () => {
    router.delete(route('branches.services.destroy', [props.service.branch.id, props.service.id]));
};
</script>

<template>
    <AppLayout :title="service.title">
        <section class="service__show">
            <div class="container">
                <div class="service__show__btns">
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
                        <td>{{ service.title }}</td>
                    </tr>
                    <tr>
                        <th>Филиал</th>
                        <td>
                            <Link
                                :href="route('branches.show', service.branch.id)"
                                class="link-main"
                            >
                                {{ service.branch.title }}
                            </Link>
                        </td>
                    </tr>
                    <tr>
                        <th>Цена</th>
                        <td>{{ service.price }} ₽</td>
                    </tr>
                    <tr>
                        <th>Длительность</th>
                        <td>{{ service.duration }}</td>
                    </tr>
                    <tr>
                        <th>Статус</th>
                        <td :class="service.active ? 'active' : 'inactive'">
                            {{ service.active ? 'Активна' : 'Неактивна' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Описание</th>
                        <td v-html="formateInf(service.information)" />
                    </tr>
                    <tr>
                        <th>Создана</th>
                        <td>{{ formateDate(service.created_at) }}</td>
                    </tr>
                    <tr>
                        <th>Обновлена</th>
                        <td>{{ formateDate(service.updated_at) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.service__show__btns {
    display: flex;
    gap: 2.5rem;
    margin-bottom: 4rem;
    justify-content: flex-end;
}

.active {
    color: green;
}

.inactive {
    color: red;
}
</style>
