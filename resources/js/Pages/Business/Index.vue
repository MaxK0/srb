<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    businesses: Object
});


</script>

<template>
    <AppLayout title="Бизнесы">
        <section class="business">
            <div class="container">
                <Link class="btn-main business__create-link" :href="route('businesses.create')">Создать бизнес</Link>
                <table class="table business__table">
                    <thead class="thead">
                        <tr>
                            <th>Название</th>
                            <th>Информация</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <tr>
                            <td>Название</td>
                            <td class="business__table-inf">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam eius aliquam blanditiis eligendi quis soluta accusamus corporis iste unde molestias nesciunt modi ea repudiandae eaque sunt, aperiam et! Hic, nisi.
                            Voluptatem, earum dicta facilis consequuntur tempore consectetur laudantium repellendus voluptates vel quisquam itaque odit iure? A obcaecati, omnis magni consequuntur tenetur ratione dolore accusamus at dolor debitis aspernatur quaerat illo.
                            Vero consequuntur atque accusamus deserunt iure alias facere assumenda velit quo odit ullam voluptatem debitis necessitatibus, quasi, eaque quas repudiandae eos similique mollitia repellendus. Beatae vel voluptates id corrupti tenetur!
                            Id in tenetur dolore ipsum, reiciendis illum esse obcaecati iusto nesciunt nemo sit dicta officiis nam quo voluptate alias ullam quibusdam numquam. Ab veritatis atque sequi. Dolor amet sit ipsum?</td>
                            <td>
                                <div class="table__btns">
                                    <button class="btn-main">Изменить</button>
                                    <button class="btn-main delete">Удалить</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.business__create-link {
    align-self: flex-end;
    margin-bottom: 4rem;
}
</style>
