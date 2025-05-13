import { createRouter, createWebHistory } from 'vue-router'
import Login from '../components/Login.vue'
import ProductList from '../components/ProductList.vue'
import ProductForm from '../components/ProductForm.vue'

const routes = [
    { path: '/login', component: Login },
    { path: '/', component: ProductList },
    { path: '/products/new', component: ProductForm },
    { path: '/products/:id/edit', component: ProductForm }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
