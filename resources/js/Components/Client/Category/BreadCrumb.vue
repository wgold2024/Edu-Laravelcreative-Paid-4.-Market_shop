<script>
import {defineComponent} from 'vue'
import {Link} from "@inertiajs/vue3";

export default defineComponent({
    name: "BreadCrumb",
    components: {Link},
    props: {
        breadCrumbs: Array,
        current: String
    }
})
</script>

<template>
    <div class="mb-4">
        <Link  :href="route('client.categories.index')">Категории</Link>
        <span> / </span>
        <template v-for="breadCrumb in breadCrumbs">
            <Link  :href="route('client.categories.products.index', breadCrumb.id)">{{ breadCrumb.title }}</Link>
            <span> / </span>
        </template>
        <span>{{ current }}</span>
    </div>
</template>

<style scoped>

</style>
