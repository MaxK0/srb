<script setup>
import { Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Paginator from "@/Components/Paginator.vue";

const props = defineProps({
    services: Object,
    branch: Object,
});
</script>

<template>
    <AppLayout :title="`Услуги филиала ${branch.title}`">
        <section class="service">
            <div class="container">
                <Link
                    class="btn-main service__create-link"
                    :href="route('branches.services.create', branch)"
                >
                    Добавить услугу
                </Link>

                <table v-if="services.data.length" class="table table__index service__table">
                    <thead class="thead thead__index">
                    <tr>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Длительность</th>
                        <th>Статус</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="tbody tbody__index">
                    <tr v-for="service in services.data" :key="service.id">
                        <td data-label="Название">
                            <Link
                                :href="route('branches.services.show', [branch.id, service.id])"
                                class="link-main"
                            >
                                {{ service.title }}
                            </Link>
                        </td>
                        <td data-label="Цена">{{ service.price }} ₽</td>
                        <td data-label="Длительность">{{ service.duration }}</td>
                        <td data-label="Статус">
                                <span :class="service.active ? 'active' : 'inactive'">
                                    {{ service.active ? 'Активна' : 'Неактивна' }}
                                </span>
                        </td>
                        <td>
                            <div class="table__btns">
                                <Link
                                    :href="route('branches.services.edit', [branch.id, service.id])"
                                    class="btn-main"
                                >
                                    Изменить
                                </Link>
                                <Link
                                    class="btn-main delete"
                                    as="button"
                                    method="DELETE"
                                    :href="route('branches.services.destroy', [branch.id, service.id])"
                                >
                                    Удалить
                                </Link>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div v-else>В этом филиале пока нет услуг</div>

                <Paginator :pagination="services" />
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.active {
    color: green;
}

.inactive {
    color: red;
}

.service__create-link {
    align-self: flex-end;
    margin-bottom: 4rem;
}
</style>
