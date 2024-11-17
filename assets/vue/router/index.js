import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import LoginView from '../views/LoginView.vue';
import RegisterView from "../views/RegisterView.vue";

function isAuthenticated() {
    return !!localStorage.getItem('auth_token');
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

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!isAuthenticated()) {
            next({ name: 'login' });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
