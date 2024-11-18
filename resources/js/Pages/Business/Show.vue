<script setup>
import { router, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { formateDate } from "@/Scripts/formateDate";
import { formateInf } from "@/Scripts/formateInf";

import Paginator from "@/Components/Paginator.vue";


const props = defineProps({
    business: {
        type: Object,
        required: true,
    },
    branches: Object
});

const edit = () => {
    router.get(route("businesses.edit", props.business));
};

const destroy = () => {
    router.delete(route("businesses.destroy", props.business));
};

const editBranch = (branch) => {
    router.get(route("branches.edit", branch))
}

const destroyBranch = (branch) => {
    router.delete(route("branches.destroy", branch))
}
</script>

<template>
    <AppLayout :title="business.title">
        <section class="business__show">
            <div class="container">
                <div class="business__show__btns">
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
                            <td>{{ business.title }}</td>
                        </tr>
                        <tr>
                            <th>Информация</th>
                            <td v-html="formateInf(business.information)"></td>
                        </tr>
                        <tr>
                            <th>Активен</th>
                            <td>{{ business.active }}</td>
                        </tr>
                        <tr>
                            <th>Создан</th>
                            <td>{{ formateDate(business.created_at) }}</td>
                        </tr>
                        <tr>
                            <th>Обновлен</th>
                            <td>{{ formateDate(business.updated_at) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="business__show__branches">
            <div class="container">
                <Link
                    class="btn-main branch__create-link"
                    :href="route('branches.create')"
                    >Создать филиал</Link
                >
                <table v-if="branches.data.length" class="table table__index branches__table">
                    <thead class="thead thead__index">
                        <tr>
                            <th>Название</th>
                            <th>Адрес</th>
                            <th>Информация</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="tbody tbody__index">
                        <tr v-for="(branch, id) in branches.data" :key="id">
                            <td data-label="Название">
                                <Link
                                    :href="route('branches.show', branch)"
                                    class="link-main"
                                    >{{ branch.title }}</Link
                                >
                            </td>
                            <td data-label="Адрес">{{ branch.address }}</td>
                            <td data-label="Информация" class="table-inf">
                                {{ branch.information }}
                            </td>
                            <td>
                                <div class="table__btns">
                                    <button
                                        class="btn-main"
                                        @click="editBranch(branch)"
                                    >
                                        Изменить
                                    </button>
                                    <button
                                        class="btn-main delete"
                                        @click="destroyBranch(branch)"
                                    >
                                        Удалить
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else>В вашем бизнесе ещё нет филиалов</div>
                <Paginator :pagination="branches" />
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.business__show__btns {
    align-self: flex-end;
    display: flex;
    gap: 2.5rem;
    margin-bottom: 4rem;
}

.branch__create-link {
    align-self: flex-end;
    margin-bottom: 4rem;
}
</style>
