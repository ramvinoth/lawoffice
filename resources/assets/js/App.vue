<template>
    <div id="root">
        <init></init>
        <div v-if="getAuthUserData">
            <topnav></topnav>
            <leftnav></leftnav>
            <div id="product-container" class="content-wrapper">
                <router-view></router-view>
            </div>
        </div>
        <div v-else>
            <login></login>
        </div>
    </div>
</template>

<script>

export default{
    components:{
        'login' : require('./components/Login.vue')
    },
    data(){
        return{
            auth_user: '',
        }
    },
    computed:{
        getAuthUserData() {
            this.auth_user = window.Laravel.auth_user;
            return this.auth_user;
        }
    }
}

</script>
