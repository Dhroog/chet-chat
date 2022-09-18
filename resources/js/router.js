import { createWebHashHistory,createRouter } from "vue-router";
import auth from  './Pages/auth.vue';
import chat from  './Pages/chat.vue';
import home from './Pages/home.vue';
import Dashboard from "./Pages/Dashboard.vue";
const routes = [
    {
        path : '/',
        name : 'Home',
        component : home,
        meta : {
            requiresAuth:true
        }
    },
    {
        path : '/auth',
        name : 'Auth',
        component : auth,
        meta : {
            requiresAuth:false
        }
    },
    {
        path : '/chat',
        name : 'Chat',
        component : chat,
        meta : {
            requiresAuth:true
        }
    },
    {
        path : '/Dashboard',
        name : 'Dashboard',
        component : Dashboard,
        meta : {
            requiresAuth:true
        }
    },
]

const router = createRouter({
    history:createWebHashHistory(),
    routes
});

router.beforeEach((to,from) =>{
    if(to.meta.requiresAuth && !localStorage.getItem('token')){
        return {name : 'Auth' }
    }
    if( to.meta.requiresAuth === false && localStorage.getItem('token')){
        return {name : 'Chat' }
    }
})

export default router;
