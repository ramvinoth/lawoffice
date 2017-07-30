<template>
    <div>
        <init></init>
        <topnav></topnav>
        <leftnav></leftnav>
        <div id="product-container" class="content-wrapper">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
export default{
    name: 'Home',
    components: {},
    data(){
        return{
            
        }
    }
}
    
</script>