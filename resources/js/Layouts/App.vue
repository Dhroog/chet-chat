<template>
    <nav class=" center navbar navbar-expand-sm bg-dark navbar-dark">

                <router-link class="aa" :to="{name :'Home' }">Requests Friendship</router-link>
                <router-link class="aa" :to="{name :'Auth' }">Auth</router-link>
                <router-link class="aa" :to="{name :'Chat' }">Chat</router-link>
                 <router-link class="aa" :to="{name :'Dashboard' }">Users</router-link>

    </nav>
        <router-view></router-view>

</template>

<script>
export default {
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
.aa{
    margin: auto;
    width: 30%;
    padding: 20px;
}
.aa:link {
    color: red;
}

/* visited link */
.aa:visited {
    color: green;
}

/* mouse over link */
.aa:hover {
    color: hotpink;
}

/* selected link */
.aa:active {
    color: blue;
}
</style>
