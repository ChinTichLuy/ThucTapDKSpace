import { createRouter, createWebHistory } from 'vue-router'
// import Login from '../components/Login.vue'
import Products from '../components/Products/index.vue'
const routes = [
    { path: '/', component: Products },
    //   { path: '/login', component: Login },
    // { path: '/products/new', component: ProductForm },
    // { path: '/products/:id/edit', component: ProductForm }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
