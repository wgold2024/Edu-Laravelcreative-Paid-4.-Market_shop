<template>
    <div v-if="product.cart.qty" class="text-center">
        <a @click.prevent="cart.qty <= 1 ? '' : cart.qty--; updateCart()" href="#" class="inline-block px-4 py-2 bg-indigo-800 border border-indigo-900 text-white">-</a>
        <input min="1" class="p-2 border border-gray-200" type="number" v-model="cart.qty" disabled>
        <a @click.prevent="cart.qty++; updateCart()" href="#" class="inline-block px-4 py-2 bg-indigo-800 border border-indigo-900 text-white">+</a>
    </div>
    <a v-else @click.prevent="storeCart"
       href="#"
       class="block py-2 bg-indigo-800 border border-indigo-900 text-center text-white">Купить
    </a>
</template>

<script>
import {defineComponent} from 'vue'
import axios from "axios";

export default defineComponent({
    name: "AddOrUpdateCart",

    props: {
        product: Object
    },

    data() {
        return {
            cart: {
                qty: this.product.cart.qty ?? 1,
                product_id: this.product.id
            },
            cartId: null
        }
    },

    methods: {
        storeCart() {
            axios.post(route('client.carts.store'), this.cart)
                .then(res => {
                    this.product.cart = res.data;
                    this.$page.props.auth.user.carts_total_sum = res.data.carts_total_sum;
                })
        },

        updateCart() {
            axios.patch(route('client.carts.update', this.product.cart.id), this.cart)
                .then(res => {
                    console.log(res);
                    this.$page.props.auth.user.carts_total_sum = res.data.carts_total_sum;
                })
        }
    },
})
</script>


<style scoped>

</style>
