<template>
    <div>
        <section class="content-header">
            <div class="user-header">
                <span class="header-text">Users</span>
                <div class="fr">
                    <button class="btn btn-primary" @click="createUser">Add User</button>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="col-sm-2" v-for="(user, index) in users">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" :src="user.avatar" alt="User profile picture">
                        <h3 class="profile-username text-center oflowEllipsis" :title="user.name">{{user.name}}</h3>
                        <p class="text-muted text-center oflowEllipsis" :title="user.email">{{user.email}}</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import axios from 'axios'
    export default{
        name: "UserIndex",
        data(){
            return{
                users: [],
            }  
        },
        beforeMount(){
            this.fetchData('api/users','','get','users');
        },
        mounted(){

        },
        computed: {
                getAuthUserData() {
                    return this.$store.getters.auth_user_data
                }
        },
        methods:{
            fetchData(url, params, method, data_var) {
                var vm = this;
                axios[method](url + "?" + params)
                    .then(function(response) {
                        Vue.set(vm.$data, data_var, response.data);
                        console.log('response : ',response.data);
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
        }
    }

</script>

<style>
    .user-header{
        display: inline-block;
        width: 100%;
        height: 50px;
    }
    .user-header .header-text{
         font-size: 2em;
    }
</style>