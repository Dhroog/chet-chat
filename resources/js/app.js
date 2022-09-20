import './bootstrap';

import { createApp } from 'vue';
import router from "./router.js";
import store from './Store/index.js';

import App from './Layouts/App.vue';

createApp(App)
    .use(router)
    .use(store)
    .mount('#app');
