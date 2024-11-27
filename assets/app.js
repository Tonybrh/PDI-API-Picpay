/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import { createApp } from 'vue';
import router from './vue/router/index';
import App from './vue/App.vue';
import ToastComponent from "./vue/components/ToastComponent.vue";
const app = createApp(App)
    .use(router)
    .component('ToastComponent', ToastComponent)
    .mount('#app');
