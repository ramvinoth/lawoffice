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
    },
    mounted(){
        jQuery("#opening_loader").fadeOut(1000, 'linear', function(){
            document.getElementById('opening_loader').style.display= "none"; 
        });
    },
}
    
</script>