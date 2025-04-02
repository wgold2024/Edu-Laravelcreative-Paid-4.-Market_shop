<template>
    <article class="w-3/4 bg-gray-50 p-4">
        <BreadCrumb :breadCrumbs="breadCrumbs" :current="product.title"/>
        <div class="flex">
            <div class="flex mr-4">
                <div style="width: 100px" class="mr-4">
                    <div v-for="image in product.images" class="mb-4">
                        <img :src="image.url" :alt="product.title">
                    </div>
                </div>
                <div>
                    <img :src="product.preview_image_url" :alt="product.title" />
                </div>
            </div>
            <div>
                <div>
                    <h3>{{ product.title }}</h3>
                </div>
                <div>
                    <span class="mr-4" :class="product.old_price ? 'text-red-600' : ''">{{ product.price }}</span>
                    <span v-if="product.old_price">{{ product.old_price }}</span>
                </div>
                <div>
                    <p>{{ product.description }}</p>
                </div>
                <div>
                    <input type="number" placeholder="Количество" value="1">
                    <a href="#" class="inline-block px-3 py-2 bg-indigo-800 border border-indigo-900 text-white">Купить</a>
                </div>
            </div>
        </div>
        <div>
            <h3>Описание</h3>
            <p>{{ product.content }}</p>
        </div>
        <div>
            <h3>Характеристики</h3>
            <div>
                <div v-for="param in product.params" class="flex items-center">
                    <div class="mr-2">
                        {{ param.title }}:
                    </div>
                    <span v-if="param.label === 'color'" v-for="value in param.values" class="block border border-gray-400 mr-2" :style="`background-color: ${value}; width: 32px; height: 16px;`"></span>
                    <span v-else v-for="value in param.values">{{ value }}</span>
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
import BreadCrumb from "@/Components/Client/Category/BreadCrumb.vue";


export default defineComponent({
    name: "Index",

    layout: MainLayout,


    props: {
        product: Object,
        breadCrumbs: Array
    },

    components: {Link, BreadCrumb}

})
</script>

<style scoped>

</style>
