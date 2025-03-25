<template>
    <div class="mb-4">
        <Link :href="route('admin.product-groups.index')" class="inline-block px-2 py-3 bg-sky-500 border border-sky-700 text-white">Назад</Link>
    </div>
    <div>
        <div class="mb-4">
            <input v-model="productGroup.title" type="text" class="border border-gray-200 p-2 w-1/4" placeholder="Заголовок">
        </div>
        <div class="mb-4">
            <a href="#" @click.prevent="storeProductGroup" class="inline-block px-2 py-3 bg-indigo-500 border border-indigo-700 text-white">Создать</a>
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
        filterTypes: Array
    },

    layout: AdminLayout,

    data() {
        return {
            productGroup: {}
        }
    },

    methods: {
        storeProductGroup() {
            axios.post(route('admin.product-groups.store'), this.productGroup)
                .then(res => {
                    console.log(res);
                    this.productGroup = {}
                })
        }
    }
}
</script>


<style scoped>

</style>
