<template>
    <div v-if="cartId" class="text-center">
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
                qty: 1,
                product_id: this.product.id
            },
            cartId: null
        }
    },

    methods: {
        storeCart() {
            axios.post(route('client.carts.store'), this.cart)
                .then(res => {
                    this.cartId = res.data.id;
                })
        },

        updateCart() {
            axios.patch(route('client.carts.update', this.cartId), this.cart)
                .then(res => {
                    console.log(res);
                })
        }
    },
})
</script>


<style scoped>

</style>
