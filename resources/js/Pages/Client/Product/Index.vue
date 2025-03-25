<template>
    <aside class="w-1/4 min-h-screen bg-gray-900">

    </aside>
    <article class="w-3/4 bg-gray-50 p-4">
        <div class="grid grid-cols-3 gap-4">
            <ProductItem v-for="product in products" :product="product"></ProductItem>

        </div>
    </article>
</template>

<script>
import {defineComponent} from 'vue'
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import ProductItem from "@/Components/Client/Product/ProductItem.vue";


export default defineComponent({
    name: "Index",

    layout: MainLayout,

    components: {ProductItem, Link},

    props: {
        products: Array
    }


})
</script>

<style scoped>

</style>
