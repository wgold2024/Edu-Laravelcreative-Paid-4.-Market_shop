<template>
    <section class="w-full border-b border-gray-100 p-4">
        <header>
            Market admin
        </header>
    </section>
    <section class="flex">
        <aside class="w-1/4 min-h-screen bg-gray-900">
            <nav>
                <Link :href="route('dashboard')" class="block p-4 text-gray-200 border-b border-gray-600">Дашборд</Link>
                <Link :href="route('admin.product-groups.index')" class="block p-4 text-gray-200 border-b border-gray-600">Группа продуктов</Link>
                <Link :href="route('admin.products.index')" class="block p-4 text-gray-200 border-b border-gray-600">Продукты</Link>
                <Link :href="route('admin.categories.index')" class="block p-4 text-gray-200 border-b border-gray-600">Категории</Link>
                <Link :href="route('admin.params.index')" class="block p-4 text-gray-200 border-b border-gray-600">Характеристики</Link>
            </nav>
        </aside>
        <article class="w-3/4 bg-gray-50 p-4">
            <slot />
        </article>
    </section>
    <section>
        <footer></footer>
    </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";
export default {
    name: 'AdminLayout',
    components: { Link }
}

</script>


<style scoped>

</style>
