<template>
    <div>
    <a @click="logout" class="btn btn-default btn-flat">
        Signout
    </a>
    <form id="logout-form" 
          action="/logout" 
          method="POST" 
          style="display: none;">
        <input type="hidden" name="_token" :value="csrf">
    </form>
    </div>
</template>

<script>
export default{
    data() {
            return {
                csrf: "",
            } 
        },
    methods: {
        logout(e) {
            e.preventDefault();
            document.getElementById('logout-form').submit()
        }
    },
    mounted() {
        this.csrf = window.Laravel.csrfToken        
    }
}
    
</script>