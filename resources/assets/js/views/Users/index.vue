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
            <div class="col-sm-2" v-for="(user, index) in users" :id="'user_'+user.id">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div class="" style="height: 20px;">
                            <div class="fl pointer"><i class="fa fa-edit"></i></div>
                            <div v-if="authuser.role.role_id == 1" class="fr pointer" @click="removeUser(user.id)"><i class="fa fa-trash"></i></div>
                        </div>
                        <img class="profile-user-img img-responsive img-circle" :src="user.avatar" alt="User profile picture">
                        <h3 class="profile-username text-center oflowEllipsis" :title="user.name">{{user.name}}</h3>
                        <p class="text-muted text-center oflowEllipsis" :title="user.email">{{user.email}}</p>
                    </div>
                </div>
            </div>
        </section>
        <slide>
            <component :is="currentView" :data="compdata" ref="cc1"></component>
        </slide>
    </div>
</template>

<script>
    import popMixin from '../../mixins/mixin'
    import Hub from '../../events/Hub'
    import addUser from "../users/form.vue"
    import slide from "../../components/Slide.vue"
    export default{
        name: "UserIndex",
        mixins: [ popMixin ],
        components: {addUser, slide},
        data(){
            return{
                users: [],
                currentView: '',
                compdata: '',
                authuser: {'role':{}},
            }  
        },
        beforeMount(){
            this.fetchUser();
            this.sendAjax('get_auth_user_data','', '', 'get','authuser');
        },
        mounted(){
            this.$nextTick(function () {
                Hub.$on('fetch-user-data', this.fetchUser);  
            }.bind(this));
        },
        methods:{
            fetchUser(){
                this.sendAjax('api/users','', '', 'get','users');  
            },
            createUser() {
                this.currentView = 'addUser';
                this.showSlide();
            },
            editUser(){
                
                this.currentView = 'editUser';
                this.showSlide();
            },
            removeUser(id){
                this.sendAjax('api/users/'+id,'','','delete','',function(response){
                     jQuery('#user_'+id).remove();
                });
            }
        },
        destroyed() {
            Hub.$off('fetch-user-data', this.fetchUser);
        },
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