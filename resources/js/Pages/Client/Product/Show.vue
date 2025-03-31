<template>
    <article class="w-3/4 bg-gray-50 p-4">
        <div class="flex">
            <div>
                <div>
                    <img :src="product.preview_image_url" :alt="product.title" />
                </div>
            </div>
            <div>
                <div>
                    <h3>{{ product.title }}</h3>
                </div>
                <div>
                    <span>{{ product.price }}</span>
                    <span>{{ product.old_price }}</span>
                </div>
                <div>
                    <p>{{ product.description }}</p>
                </div>
            </div>
        </div>
        <div>
            <p>{{ product.content }}</p>
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


    props: {
        product: Object
    }


})
</script>

<style scoped>

</style>
