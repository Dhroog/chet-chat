<template>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <hr>
    <div class="container bootstrap snippets bootdey">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <div class="table-responsive">
                            <table class="table user-list">
                                <thead>
                                    <tr>
                                        <th><span>User</span></th>
                                        <th><span>Created</span></th>
                                        <th class="text-center"><span>Status</span></th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <home-component v-for="(friend,index) in friends"
                                                :friend="friend"
                                />
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import homeComponent from "../Components/homeComponent.vue";
export default {
    components:{
      homeComponent
    },
    data(){
        return {
            friends:null,
        }
    },
    mounted() {
        this.GetFriendShip();
    },
    methods:{
        GetFriendShip(){
            axios.get('api/User/GetFriendShip',{
                headers: {
                    'Authorization' : 'Bearer ' + localStorage.getItem('token'),
                }
            })
                .then( response => {
                    if(response.data.status === true){
                        this.friends = response.data.data
                    }
                } ).catch( error =>{
                console.log(error);
            } )
        },
        SelectClass(a,b,status){
            return status ? a : b
        },
        image(avatar){
            return '/images/' + avatar
        },
        SendFriendShip(id){
            axios.get('api/User/'+ id +'/SendFriendShip',{
                headers: {
                    'Authorization' : 'Bearer ' + localStorage.getItem('token'),
                }
            })
                .then( response => {
                    if(response.data.status === true){
                        this.users = response.data.data
                    }
                } ).catch( error =>{
                console.log(error);
            } )
        }
    }
}
</script>

<style scoped>
body{
    background:#eee;
}
.main-box.no-header {
    padding-top: 20px;
}
.main-box {
    background: #FFFFFF;
    -webkit-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -moz-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -o-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -ms-box-shadow: 1px 1px 2px 0 #CCCCCC;
    box-shadow: 1px 1px 2px 0 #CCCCCC;
    margin-bottom: 16px;
    -webikt-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
.table a.table-link.danger {
    color: #e74c3c;
}
.label {
    border-radius: 3px;
    font-size: 0.875em;
    font-weight: 600;
}
.user-list tbody td .user-subhead {
    font-size: 0.875em;
    font-style: italic;
}
.user-list tbody td .user-link {
    display: block;
    font-size: 1.25em;
    padding-top: 3px;
    margin-left: 60px;
}
a {
    color: #3498db;
    outline: none!important;
}
.user-list tbody td>img {
    position: relative;
    max-width: 50px;
    float: left;
    margin-right: 15px;
}

.table thead tr th {
    text-transform: uppercase;
    font-size: 0.875em;
}
.table thead tr th {
    border-bottom: 2px solid #e7ebee;
}
.table tbody tr td:first-child {
    font-size: 1.125em;
    font-weight: 300;
}
.table tbody tr td {
    font-size: 0.875em;
    vertical-align: middle;
    border-top: 1px solid #e7ebee;
    padding: 12px 8px;
}
a:hover{
    text-decoration:none;
}
.status{
    width:8px;
    height:8px;
    border-radius:50%;
    display:inline-block;
    margin-right:7px;
}
.green{
    background-color:#58b666;
}
.orange{
    background-color:#ff725d;
}
.blue{
    background-color:#6fbced;
    margin-right:0;
    margin-left:7px;
}
</style>
