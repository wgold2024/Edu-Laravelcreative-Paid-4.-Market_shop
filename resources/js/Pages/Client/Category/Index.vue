<template>
    <article class="w-full bg-gray-50 p-4 min-h-screen">
        <div class="w-3/4 mx-auto">
            <div class="grid grid-cols-3 gap-4">
                <div v-for="category in categories">
                    <Link :href="route('client.categories.products.index', category.id)">{{ category.title }}</Link>
                </div>
            </div>
        </div>
    </article>
</template>

<script>
import {defineComponent} from 'vue'
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import axios from "axios";


export default defineComponent({
    name: "ProductIndex",

    layout: MainLayout,

    components: {Link},

    props: {
        categories: Array,
    },

})
</script>

<style scoped>

</style>
