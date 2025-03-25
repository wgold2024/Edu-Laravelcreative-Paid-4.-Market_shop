<template>
    <div class="mb-4">
        <Link :href="route('admin.categories.index')" class="inline-block px-2 py-3 bg-sky-500 border border-sky-700 text-white">Назад</Link>
    </div>
    <div>
        <div class="mb-4">
            <input v-model="category.title" type="text" class="border border-gray-200 p-2 w-1/4" placeholder="Заголовок">
        </div>
        <div class="mb-4">
            <select v-model="category.parent_id" class="border border-gray-200 p-2 w-1/4">
                <option :value="null" disabled selected>Выберите категорию</option>
                <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
            </select>
        </div>
        <div class="mb-4">
            <a href="#" @click.prevent="storeCategory" class="inline-block px-2 py-3 bg-indigo-500 border border-indigo-700 text-white">Создать</a>
        </div>
    </div>
</template>


<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/vue3";

export default {
    name: "Create",
    components: { Link },
    props: {
        categories: Array
    },

    layout: AdminLayout,

    data() {
        return {
            category: {
                parent_id: null
            }
        }
    },

    methods: {
        storeCategory() {
            axios.post(route('admin.categories.store'), this.category)
                .then(res => {
                    this.categories.push(res.data)
                    this.category = {
                        parent_id: null
                    }
                })
        }
    }
}
</script>


<style scoped>

</style>
