import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import LoginView from '../views/LoginView.vue';

const routes = [
    { path: '/', name: 'home', component: Home },
    { path: '/login', name: 'login', component: LoginView },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
