<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const email = ref('')
const password = ref('')
const errorMessage = ref('')
const router = useRouter()

const handleLogin = async () => {
    try {
        // Bắt buộc gọi trước để Sanctum tạo CSRF cookie
        await axios.get('/sanctum/csrf-cookie')

        // Gửi login
        await axios.post('http://localhost:8000/api/login', {
            email: email.value,
            password: password.value,
        })

        // Đăng nhập thành công → chuyển hướng
        router.push('/')
    } catch (err) {
        errorMessage.value = 'Sai email hoặc mật khẩu!'
    }
}
</script>

<template>
    <div class="login-page">
        <h2>Login</h2>
        <form @submit.prevent="handleLogin">
            <div>
                <label>Email:</label>
                <input v-model="email" type="email" required />
            </div>
            <div>
                <label>Password:</label>
                <input v-model="password" type="password" required />
            </div>
            <button type="submit">Login</button>
        </form>
        <p v-if="errorMessage" style="color: red">{{ errorMessage }}</p>
    </div>
</template>

<style scoped>
.login-page {
    max-width: 400px;
    margin: 50px auto;
}
</style>
