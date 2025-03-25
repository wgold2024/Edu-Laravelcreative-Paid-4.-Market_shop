<template>
    <div class="mb-4">
        <Link :href="route('admin.params.index')" class="inline-block px-2 py-3 bg-sky-500 border border-sky-700 text-white">Назад</Link>
    </div>
    <div>
        <div class="mb-4">
            <input v-model="param.title" type="text" class="border border-gray-200 p-2 w-1/4" placeholder="Заголовок">
        </div>
        <div class="mb-4">
            <select v-model="param.filter_type" class="border border-gray-200 p-2 w-1/4">
                <option :value="null" disabled selected>Выберите тип фильтра</option>
                <option v-for="filterType in filterTypes" :value="filterType.value">{{ filterType.title }}</option>
            </select>
        </div>
        <div class="mb-4">
            <a href="#" @click.prevent="storeParam" class="inline-block px-2 py-3 bg-indigo-500 border border-indigo-700 text-white">Создать</a>
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
            param: {
                filter_type: null
            }
        }
    },

    methods: {
        storeParam() {
            axios.post(route('admin.params.store'), this.param)
                .then(res => {
                    console.log(res);
                    this.param = {
                        filter_type: null
                    }
                })
        }
    }
}
</script>


<style scoped>

</style>
