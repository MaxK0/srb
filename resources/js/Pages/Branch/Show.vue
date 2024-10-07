<script setup>
import { router, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    branch: {
        type: Object,
        required: true,
    },
});

const formateDate = (dateString) => {
    const date = new Date(dateString);
    const options = {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
    };
    return date.toLocaleDateString("ru-RU", options);
};

const formatInf = (info) => {
    if (!info) return "";
    return info.replace(/\n/g, "<br>");
};

const edit = () => {
    router.get(route("branches.edit", props.branch));
};

const destroy = () => {
    router.delete(route("branches.destroy", props.branch));
};
</script>

<template>
    <AppLayout :title="branch.title">
        <section class="branch__show">
            <div class="container">
                <div class="branch__show__btns">
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
                            <td>{{ branch.title }}</td>
                        </tr>
                        <tr>
                            <th>Бизнес</th>
                            <td>
                                <Link
                                    :href="
                                        route(
                                            'businesses.show',
                                            branch.business
                                        )
                                    "
                                    class="link-main"
                                    >{{ branch.business.title }}</Link
                                >
                            </td>
                        </tr>
                        <tr>
                            <th>Адрес</th>
                            <td>{{ branch.address }}</td>
                        </tr>
                        <tr>
                            <th>Информация</th>
                            <td v-html="formatInf(branch.information)"></td>
                        </tr>
                        <tr>
                            <th>Активен</th>
                            <td>{{ branch.active }}</td>
                        </tr>
                        <tr>
                            <th>Создан</th>
                            <td>{{ formateDate(branch.created_at) }}</td>
                        </tr>
                        <tr>
                            <th>Обновлен</th>
                            <td>{{ formateDate(branch.updated_at) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.branch__show__btns {
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
