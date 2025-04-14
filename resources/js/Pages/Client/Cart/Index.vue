<template>
    <article class="w-full bg-gray-50 p-4 min-h-screen">
        <div class="w-3/4 mx-auto">
            <table class="border-collapse table-auto w-full text-sm">
                <thead class="bg-gray-100 dark:bg-slate-800">
                <tr>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">ID</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">Наименование</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">Фото</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">Количество</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">Сумма</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">Действия</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800">
                <tr v-for="cart in cartsData">
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ cart.id }}</td>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                        <Link :href="route('client.products.show', cart.product_id)">{{ cart.product_title }}</Link>
                    </td>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                        <img class="w-12" :src="cart.product_image_url" :alt="cart.product_title">
                    </td>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                        <div>
                            <a @click.prevent="cart.qty <= 1 ? '' : cart.qty--; updateCart(cart)" href="#" class="inline-block px-4 py-2 bg-indigo-800 border border-indigo-900 text-white">-</a>
                            <input min="1" class="p-2 border border-gray-200 w-1/4" type="number" v-model="cart.qty" disabled>
                            <a @click.prevent="cart.qty++; updateCart(cart)" href="#" class="inline-block px-4 py-2 bg-indigo-800 border border-indigo-900 text-white">+</a>
                        </div>
                    </td>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ cart.total_sum }}</td>
                    <td  class="border-b bg-white border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                        <svg @click="destroyCart(cart)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-red-600 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </article>
</template>

<script>
import {defineComponent} from 'vue'
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import ProductItem from "@/Components/Client/Product/ProductItem.vue";
import axios from "axios";


export default defineComponent({
    name: "Index",

    layout: MainLayout,

    props: {
        carts: Array
    },

    components: {Link},

    data() {
        return {
            cartsData: this.carts
        }
    },

    methods: {
        updateCart(cart) {
            axios.patch(route('client.carts.update', cart.id), { qty: cart.qty })
                .then(res => {
                    cart.total_sum = res.data.total_sum;
                    this.$page.props.auth.user.carts_total_sum = res.data.carts_total_sum;
                })
        },

        destroyCart(cart) {
            axios.delete(route('client.carts.destroy', cart.id))
                .then(res => {
                    this.cartsData =  this.cartsData.filter(cartData => cartData.id !== cart.id)
                    this.$page.props.auth.user.carts_total_sum = this.$page.props.auth.user.carts_total_sum - cart.total_sum;
                })
        }
    }



})
</script>

<style scoped>

</style>
