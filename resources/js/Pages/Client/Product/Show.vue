<template>
    <article class="w-full bg-gray-50 p-4 min-h-screen">
        <div class="w-3/4 mx-auto">
            <BreadCrumb :breadCrumbs="breadCrumbs" :current="product.title"/>
            <div class="flex items-start mb-4">
                <div class="flex mr-4 p-4 bg-white border border-gray-200 w-3/4">
                    <div style="width: 100px" class="mr-4">
                        <div v-for="image in product.images" class="mb-4">
                            <img class="cursor-pointer" @click="selectedImage = image" :src="image.url" :alt="product.title">
                        </div>
                    </div>
                    <div v-if="selectedImage">
                        <img :src="selectedImage.url" :alt="product.title" />
                    </div>
                </div>
                <div>
                    <div class="p-4 bg-white border border-gray-200">
                        <div class="mb-4">
                            <h3 class="text-lg">{{ product.title }}</h3>
                        </div>
                        <div class="mb-4">
                            <span class="mr-4" :class="product.old_price ? 'text-red-600' : ''">{{ product.price }}</span>
                            <span v-if="product.old_price" class="line-through">{{ product.old_price }}</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-700">{{ product.description }}</p>
                        </div>
                        <div v-if="paramProducts.length > 0" class="mb-4">
                            <div v-for="paramProduct in paramProducts" class="mb-4 pb-4 border-b border-gray-200">
                                <div class="mb-4">
                                    <h3 class="text-lg">{{ paramProduct.title }}</h3>
                                </div>
                                <div>
                                    <Link v-for="paramItem in paramProduct.data" :class="[paramItem.product_id === product.id ? 'text-white bg-sky-600' : 'text-sky-600', 'inline-block mr-2 p-2 border border-sky-600']"
                                          :href="route('client.products.show', paramItem.product_id)">
                                        {{ paramItem.value }}
                                    </Link>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="inline-block px-4 py-2 bg-indigo-800 border border-indigo-900 text-white">-</a>
                            <input min="1" class="p-2 border border-gray-200" type="number" value="1" disabled>
                            <a href="#" class="inline-block px-4 py-2 bg-indigo-800 border border-indigo-900 text-white">+</a>
                        </div>
                        <a  @click.prevent="storeCart"
                            href="#"
                            class="inline-block px-3 py-2 bg-indigo-800 border border-indigo-900 text-white">Купить</a>
                    </div>
                    <div v-if="product.group_products.length > 0" class="p-4 bg-white border border-gray-200">
                        <div class="mb-4">
                            <h3 class="text-lg">Другие варианты</h3>
                        </div>
                        <div class="grid grid-cols-4 gap-4">
                            <Link v-for="groupProduct in product.group_products" :href="route('client.products.show', groupProduct.id)">
                                <img :src="groupProduct.preview_image_url" :alt="groupProduct.title">
                                <div class="text-sm text-center">
                                    <div :class="groupProduct.old_price ? 'text-red-600' : ''">{{ groupProduct.price }}</div>
                                    <div v-if="groupProduct.old_price" class="line-through">{{ groupProduct.old_price }}</div>
                                </div>
                            </Link>
                        </div>
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
import {Link, router} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import ProductItem from "@/Components/Client/Product/ProductItem.vue";
import BreadCrumb from "@/Components/Client/Category/BreadCrumb.vue";


export default defineComponent({
    name: "Index",

    layout: MainLayout,

    props: {
        product: Object,
        breadCrumbs: Array,
        paramProducts: Array
    },

    components: {Link, BreadCrumb},

    data() {
        return {
            cart: {
                qty: 1,
                product_id: this.product.id,
            },
            selectedImage: {url: this.product.preview_image_url}
        }
    },

    methods: {
        storeCart() {
            axios.post(route('client.carts.store'), this.cart)
                .then(res => {
                    console.log(res);
                })
        }
    },

})
</script>

<style scoped>

</style>
