<template>
    <div class="p-4 border-gray-200 bg-white">
        <Link :href="route('client.products.show', product.id)"><h3>{{ product.title }}</h3></Link>
        <img :src="product.preview_image_url" :alt="product.title">
        <div class="flex items-center justify-between">
            <p>{{ product.price }}</p>
            <p>{{ product.old_price }}</p>
        </div>
        <StoreOrUpdateCart :product="product"></StoreOrUpdateCart>
    </div>
</template>

<script>
import {defineComponent} from 'vue'
import {Link} from "@inertiajs/vue3";
import StoreOrUpdateCart from "@/Components/Client/Cart/StoreOrUpdateCart.vue";

export default defineComponent({
    name: "ProductItem",

    props: {
        product: Object
    },

    components: {
        Link,
        StoreOrUpdateCart
    }
})
</script>

<style scoped>

</style>
