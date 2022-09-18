import './bootstrap';

import { createApp } from 'vue';
import router from "./router.js";

import App from './Layouts/App.vue';

createApp(App).use(router).mount('#app');
