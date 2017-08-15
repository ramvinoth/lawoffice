<template>
    <div>
        <init></init>
        <topnav></topnav>
        <leftnav></leftnav>
        <div id="product-container" class="content-wrapper">
            <router-view></router-view>
        </div>
        <alertBox></alertBox>
    </div>
</template>
<script>
    import mixin from '../mixins/mixin'
    import alertBox from '../components/AlertBox.vue'
export default{
    name: 'Home',
    components: { alertBox },
    mixins: [ mixin ],
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