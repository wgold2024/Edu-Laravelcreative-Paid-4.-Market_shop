<template>
    <article class="w-full bg-gray-50 p-4 min-h-screen">
        <div class="w-3/4 mx-auto">
            <div class="mb-4">
                <div v-for="cart in order.carts" class="mb-2">
                    {{ cart.product_title }} x {{ cart.qty }} - {{ cart.total_sum }}
                </div>
            </div>
            <div class="text-right">
                <div class="mb-4">
                    Итого: {{ this.$page.props.auth.user.carts_total_sum }}
                </div>
                <div>
                    <a
                        href="#"
                        class="inline-block py-2 px-3 bg-indigo-800 border border-indigo-900 text-center text-white"
                    >Оплатить</a>
                </div>
            </div>
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
    name: "CreateTransaction",

    layout: MainLayout,

    props: {
        order: Object
    },

    components: {Link},
})
</script>

<style scoped>

</style>
