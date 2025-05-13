<template>
    <div>
        <h2>{{ isEdit ? 'Edit Product' : 'Create Product' }}</h2>
        <form @submit.prevent="submitForm">
            <input v-model="product.name" placeholder="Product Name" required>
            <input v-model="product.price" type="number" step="0.01" placeholder="Price" required>
            <textarea v-model="product.description" placeholder="Description"></textarea>
            <button type="submit">{{ isEdit ? 'Update' : 'Create' }}</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            product: {
                name: '',
                price: '',
                description: ''
            },
            isEdit: false
        };
    },
    async mounted() {
        const id = this.$route.params.id;
        if (id) {
            this.isEdit = true;
            const res = await axios.get(`http://localhost:8000/api/products/${id}`, {
                withCredentials: true
            });
            this.product = res.data;
        }
    },
    methods: {
        async submitForm() {
            try {
                const id = this.$route.params.id;
                if (this.isEdit) {
                    await axios.put(`http://localhost:8000/api/products/${id}`, this.product, {
                        withCredentials: true
                    });
                } else {
                    await axios.post('http://localhost:8000/api/products', this.product, {
                        withCredentials: true
                    });
                }
                this.$router.push('/');
            } catch (err) {
                alert('Submit failed');
            }
        }
    }
};
</script>
