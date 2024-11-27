import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import LoginView from '../views/LoginView.vue';
import RegisterView from "../views/RegisterView.vue";
import axios from 'axios';

async function isAuthenticated() {
    const token = localStorage.getItem('auth_token');
    if (!token) {
        return false;
    }
    try {
        const response = await axios.get('http://localhost:8005/api/token/validate', {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });
        return response.status === 200;
    } catch (error) {
        localStorage.removeItem('auth_token');
        return false;
    }
}
const routes = [
    { path: '/', name: 'home', component: Home,
        meta: {
            title: 'Login',
            requiresAuth: true
        }
    },
    { path: '/login', name: 'login', component: LoginView},
    { path: '/register', name: 'register', component: RegisterView},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        const authenticated = await isAuthenticated();
        if (!authenticated) {
            next({ name: 'login' });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
