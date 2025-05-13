<template>
    <div>
        <h2>Product List</h2>
        <ul>
            <li v-for="product in products" :key="product.id">
                {{ product.name }} - {{ product.price }}
                <router-link :to="`/products/${product.id}/edit`">Edit</router-link>
            </li>
        </ul>
        <router-link to="/products/new">Add New Product</router-link>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: []
        };
    },
    async mounted() {
        try {
            const res = await axios.get('http://localhost:8000/api/products', {
                withCredentials: true
            });
            this.products = res.data;
        } catch (err) {
            alert('Failed to load products');
        }
    }
};
</script>
