<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.product-groups.index')" class="inline-block py-2 px-3 bg-sky-600 border border-sky-700 text-white">Назад</Link>
        </div>
        <div v-if="success" class="p-4 bg-green-100 mb-4">
            Успешно сохранено!
        </div>
        <div>
            <div class="mb-4">
                <input type="text" v-model="productGroup.title" class="border border-gray-200 p-2 w-1/4" placeholder="Заголовок">
            </div>
            <div class="mb-4">
                <a href="#" @click.prevent="updateProductGroup"  class="inline-block py-2 px-3 bg-indigo-600 border border-indigo-700 text-white">Обновить</a>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: "Edit",

    layout: AdminLayout,

    props: {
        productGroup: Object,
    },

    data() {
        return {
            success: false
        }
    },

    components: {
        Link
    },

    methods: {
        updateProductGroup() {
            axios.patch(route('admin.product-groups.update', this.productGroup), this.productGroup)
                .then(res => {
                    this.success = true;
                })
        },
    },

    watch: {
        productGroup: {
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
