<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.products.index')" class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Назад</Link>
        </div>
        <div  class="mb-4">
            <table class="border-collapse table-auto w-full text-sm">
                <tbody class="bg-white dark:bg-slate-800">
                <tr>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">ID</td>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ product.id }}</td>
                </tr>
                <tr>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">Заголовок</td>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ product.title }}</td>
                </tr>
                <tr>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">Описание</td>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ product.description }}</td>
                </tr>
                <tr>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">Цена</td>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ product.price }}</td>
                </tr>
                <tr>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">Старая цена</td>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ product.old_price }}</td>
                </tr>
                <tr>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">Склад</td>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ product.qty }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div>
            <div class="flex">
                <div v-for="image in product.images">
                    <img :src="image.url" :alt="product.title">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Show",

    props: {
        product: Object
    },

    layout: AdminLayout,

    components: {
        Link
    }
}
</script>

<style scoped>

</style>
