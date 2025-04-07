<template>
    <article class="w-full bg-gray-50 p-4 min-h-screen">
        <div class="w-3/4 mx-auto">
            <BreadCrumb :breadCrumbs="breadCrumbs" :current="product.title"/>
            <div class="flex items-start mb-4">
                <div class="flex mr-4 p-4 bg-white border border-gray-200">
                    <div style="width: 100px" class="mr-4">
                        <div v-for="image in product.images" class="mb-4">
                            <img class="cursor-pointer" @click="selectedImage = image" :src="image.url" :alt="product.title">
                        </div>
                    </div>
                    <div v-if="selectedImage">
                        <img :src="selectedImage.url" :alt="product.title" />
                    </div>
                </div>
                <div class="p-4 bg-white border border-gray-200">
                    <div class="mb-4 text-lg">
                        <h3>{{ product.title }}</h3>
                    </div>
                    <div class="mb-4">
                        <span class="mr-4" :class="product.old_price ? 'text-red-600' : ''">{{ product.price }}</span>
                        <span v-if="product.old_price" class="line-through">{{ product.old_price }}</span>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-700">{{ product.description }}</p>
                    </div>
                    <div>
                        <input type="number" placeholder="Количество" value="1">
                        <a href="#" class="inline-block px-3 py-2 bg-indigo-800 border border-indigo-900 text-white">Купить</a>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white border border-gray-200">
                <div class="mb-4 pb-4 border-b border-gray-200">
                    <h3 class="text-lg mb-2">Описание</h3>
                    <p>{{ product.content }}</p>
                </div>
                <div>
                    <h3 class="text-lg mb-2">Характеристики</h3>
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

    components: {Link, BreadCrumb},

    data() {
        return {
            selectedImage: {url: this.product.preview_image_url}
        }
    }

})
</script>

<style scoped>

</style>
