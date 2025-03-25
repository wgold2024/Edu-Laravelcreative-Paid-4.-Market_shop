<template>
    <div class="mb-4">
        <Link :href="route('admin.products.index')" class="inline-block px-2 py-3 bg-sky-500 border border-sky-700 text-white">Назад</Link>
    </div>
    <div v-if="success" class="p-4 bg-green-100 mb-4">
        Успешно добавлен!
    </div>
    <div>
        <div class="mb-4">
            <input v-model="entries.product.title" type="text" class="border border-gray-200 p-2 w-1/4" placeholder="Заголовок">
        </div>
        <div class="mb-4">
            <input v-model="entries.product.article" type="text" class="border border-gray-200 p-2 w-1/4" placeholder="Артикул">
        </div>
        <div class="mb-4">
            <textarea v-model="entries.product.description" type="text" class="border border-gray-200 p-2 w-1/4" placeholder="Описание"></textarea>
        </div>
        <div class="mb-4">
            <input v-model="entries.product.content" type="text" class="border border-gray-200 p-2 w-1/4" placeholder="Контент">
        </div>
        <div class="mb-4">
            <input v-model="entries.product.price" type="number" class="border border-gray-200 p-2 w-1/4" placeholder="Цена">
        </div>
        <div class="mb-4">
            <input v-model="entries.product.old_price" type="number" class="border border-gray-200 p-2 w-1/4" placeholder="Старая цена">
        </div>
        <div class="mb-4">
            <input v-model="entries.product.qty" type="number" class="border border-gray-200 p-2 w-1/4" placeholder="Количество">
        </div>
        <div class="mb-4">
            <select v-model="entries.product.category_id" class="border border-gray-200 p-2 w-1/4">
                <option :value="null" disabled selected>Выберите категорию</option>
                <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
            </select>
        </div>
        <div class="mb-4">
            <select v-model="entries.product.product_group_id" class="border border-gray-200 p-2 w-1/4">
                <option :value="null" disabled selected>Выберите группу продуктов</option>
                <option v-for="productGroup in productGroups" :value="productGroup.id">{{ productGroup.title }}</option>
            </select>
        </div>
        <div class="mb-4">
            <input ref="image_input" @change="setImages" type="file" multiple class="border border-gray-200 p-2 w-1/4">
        </div>
        <div class="mb-4 flex">
            <div class="mr-2">
                <select v-model="paramOption.paramObj" class="border border-gray-200 p-2 pr-8">
                    <option :value="{}" disabled selected>Выберите характеристику</option>
                    <option v-for="param in params" :value="param">{{ param.title }}</option>
                </select>
            </div>
            <div class="mr-2">
                <input v-model="paramOption.value" type="text" class="border border-gray-200 p-2" placeholder="Значение">
            </div>
            <div>
                <a @click.prevent="setParam" href="#" class="inline-block bg-white border border-gray-200 px-3 py-2">+</a>
            </div>
        </div>
        <div class="mb-4">
            <div v-for="entriesParam in entries.params" class="flex items-center mb-2">
                <div class="mr-2">
                    {{ entriesParam.title }} - {{ entriesParam.value }}
                </div>
                <div>
                    <svg @click="removeParam(entriesParam)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <a href="#" @click.prevent="storeProduct" class="inline-block px-2 py-3 bg-indigo-500 border border-indigo-700 text-white">Создать</a>
        </div>
    </div>
</template>


<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/vue3";

export default {
    name: "CreateChild",
    components: { Link },
    props: {
        categories: Array,
        productGroups: Array,
        params: Array,
        product: Object
    },

    layout: AdminLayout,

    data() {
        return {
            success: false,
            paramOption: {
                paramObj: {}
            },
            entries : {
                product: this.product,
                images: null,
                params: this.product.params,
            },
        }
    },

    methods: {
        storeProduct() {
            this.entries.product.parent_id = this.product.id
            axios.post(route('admin.products.store'), this.entries, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(res => {
                    this.product.images = res.data.images
                    this.$refs.image_input.value = null

                    this.$nextTick(() => {
                        this.success = true
                    })
                })
        },
        setImages(e) {
           this.entries.images = e.target.files;
        },
        setParam() {
            this.entries.params.push({
                id: this.paramOption.paramObj.id,
                title: this.paramOption.paramObj.title,
                value: this.paramOption.value,
            })
        },
        removeParam(entriesParam) {
            this.entries.params = this.entries.params.filter(res => res !== entriesParam)
        }
    },

    watch: {
        entries: {
            handler(new_val, old_val) {
                this.success = false;
            },
            deep: true
        }
    }
}
</script>


<style scoped>

</style>
