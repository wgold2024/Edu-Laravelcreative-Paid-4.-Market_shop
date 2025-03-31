<template>
    <aside class="w-1/4 min-h-screen bg-gray-900">
        <nav class="p-4">
            <div>
                <template v-for="param in params">
                    <div v-if="param.filter_type === 3" class="mb-4 pb-4 border-b border-gray-300">
                        <div>
                            <h3 class="text-white mb-2">{{ param.title }}</h3>
                        </div>
                        <div class="text-white">
                            {{ this.filters.checkbox[param.id] }}
                        </div>
                        <div>
                            <div v-for="value in param.param_values" class="mb-2 flex items-center">
                                <input @change="setFilter(param, value)" class="mr-2" type="checkbox" :value="value" :id="value">
                                <label v-if="param.label === 'color'" :style="`background: ${value}; width: 32px; height: 16px`" class="block text-sm text-gray-200" :for="value"></label>
                                <label v-else class="text-sm text-gray-200" :for="value">{{ value }}</label>
                            </div>
                        </div>
                    </div>
                    <div v-if="param.filter_type === 1" class="mb-4 pb-4 border-b border-gray-300">
                        <div>
                            <h3 class="text-white mb-2">{{ param.title }}</h3>
                        </div>
                        <div>
                            <div class="mb-2 flex items-center">
                                <input v-model="filters.integer.from[param.id]" type="text" placeholder="От" class="w-1/2 border border-gray-200 p-2">
                                <input v-model="filters.integer.to[param.id]" type="text" placeholder="До" class="w-1/2 border border-gray-200 p-2">
                            </div>
                        </div>
                    </div>
                </template>
                <div>
                    <a @click.prevent="getPosts"
                       href="#"
                       class="block text-center px-3 py-2 text-gray-300 bg-indigo-800 border-indigo-900">Фильтр</a>
                </div>
            </div>
        </nav>
    </aside>
    <article class="w-3/4 bg-gray-50 p-4">
        <div class="mb-4">
            <template v-for="breadCrumb in breadCrumbs">
                <Link  :href="route('client.categories.products.index', breadCrumb.id)">{{ breadCrumb.title }}</Link>
                <span>/</span>
            </template>
            <span>{{ category.title }}</span>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <ProductItem v-for="product in productsData" :product="product"></ProductItem>
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
    name: "ProductIndex",

    layout: MainLayout,

    components: {ProductItem, Link},

    props: {
        category: Object,
        products: Array,
        breadCrumbs: Array,
        params: Array
    },

    data() {
        return {
            productsData: this.products,

            // id - параметра (характеристики): значение
            filters: {
                integer: {
                    from: {},
                    to: {}
                },
                select: {},
                checkbox: {}
            },
        }
    },

    methods: {
        setFilter(param, value) {
            if (this.filters.checkbox[param.id]) {
                this.toggleItem(this.filters.checkbox[param.id], value)
                return
            }

            this.filters.checkbox[param.id] = []
            this.filters.checkbox[param.id].push(value)
        },

        toggleItem(arr, value) {
            let index = arr.indexOf(value)
            index === -1 ? arr.push(value) : arr.splice(index, 1)
        },

        getPosts() {
            this.clean(this.filters.integer.from);
            this.clean(this.filters.integer.to);

            axios.get(route('client.categories.products.index', this.category.id), {
                params: this.filters
            })
                .then( res => {
                    this.productsData = res.data
                })
        },

        clean(obj) {
            Object.keys(obj).forEach(key => {
                if (!obj[key]) {
                    delete obj[key]
                }
            })
        }
    }


})
</script>

<style scoped>

</style>
