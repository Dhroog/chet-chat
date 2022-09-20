<template>
    <nav class="  navbar navbar-expand-sm bg-dark navbar-dark">

        <router-link v-if="$store.getters.getToken !== 0 "  :to="{name :'Home' }" >Requests Friendship</router-link>
        <router-link  v-if="$store.getters.getToken === 0"  :to="{name :'Auth' }">Sign in/up</router-link>
        <router-link v-if="$store.getters.getToken !== 0 "  :to="{name :'Chat' }">Chat</router-link>
        <router-link v-if="$store.getters.getToken !== 0 "  :to="{name :'Dashboard' }">Users</router-link>
        <router-link v-if="$store.getters.getToken !== 0 "  :to="{name :'Logout' }">Profile</router-link>
        <a  v-if="$store.getters.getToken !== 0"  @click="logout">
            Log out
        </a>
    </nav>
        <router-view></router-view>

</template>

<script>
import store from "../Store/index.js";
import router from "../router";
import axios from "axios";

export default {
methods:{
    logout(){
        axios.get('api/logout',{
            headers: {
                'Authorization' : 'Bearer ' + store.getters.getToken,
            }
        })
            .then( response => {
                if(response.data.status === true){
                    this.user = response.data.data
                }
            } ).catch( error =>{
            console.log(error);
        } )
        router.push({name : 'Auth'});
        store.dispatch('removeToken');
    }
}
}
</script>

<style scoped>
nav{
    background-color: black;
}
.center {
    margin: auto;
    width: 50%;
    border: 3px solid green;
    padding: 10px;
}
a{
    color: darkblue;
    margin: auto;
    width: 10%;
    padding: 10px;
    background-color: lightgreen;
}
a:link {
    color: red;
    text-decoration: none;
}

/* visited link */


/* mouse over link */
a:hover {
    color: hotpink;
    text-decoration: underline;
}

/* selected link */

</style>
