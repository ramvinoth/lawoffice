<template>
    <div id="root">
        <component :is="CurrentView"></component>
    </div>
</template>

<script>
import login from './components/Login.vue'
import home from './components/Home.vue'
import register from './components/Register.vue'

export default{
    components:{
        login,
        home,
        register,
    },
    data(){
        return{
            auth_user: '',
            CurrentView: ''
        }
    },
    mounted() {
        this.getAuthUserData;
    },
    computed:{
        getAuthUserData() {
            if(window.Laravel.auth_user === null){
                if(this.$route.name && this.$route.name === 'register'){
                    this.CurrentView = 'register';
                }else{
                    this.CurrentView = 'login';
                }
            }else{
                this.auth_user = window.Laravel.auth_user;
                this.CurrentView = 'home';
            }
            return this.auth_user;
        }
    }
}

</script>
