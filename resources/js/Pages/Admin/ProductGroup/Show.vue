<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.product-groups.index')" class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Назад</Link>
        </div>
        <div>
            <table class="border-collapse table-auto w-full text-sm">
                <tbody class="bg-white dark:bg-slate-800">
                <tr>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">ID</td>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ productGroup.id }}</td>
                </tr>
                <tr>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">Заголовок</td>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ productGroup.title }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Show",

    props: {
        productGroup: Object
    },

    layout: AdminLayout,

    components: {
        Link
    }
}
</script>

<style scoped>

</style>
