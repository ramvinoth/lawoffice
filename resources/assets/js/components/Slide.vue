<template>
    <transition name="slide" v-on:before-enter="beforeEnter" v-on:before-leave="beforeLeave"  v-on:leave="afterLeave">
        <div v-if="getIsSliderShow" class="overlay">
            <div class="main-slide">
                <div class="topHeader"><i class="fa fa-close fr pointer" @click="closeSlide"></i></div>
                <slot name="header"></slot>
                <slot></slot>
                <slot name="footer"></slot>
            </div>
        </div>
    </transition>
</template>
<script>
    export default{
        name: "slide",
        computed:{
            getIsSliderShow(){
                return this.$store.getters.is_slide;
            }
        },
        methods:{
            beforeEnter: function (el) {
                // ...
                document.getElementsByTagName("body")[0].style.overflow = "hidden";
                setTimeout(function(){
                    jQuery(el).find(".main-slide").css({'right':'0%'});
                },200);
            },
            beforeLeave: function(el){
                jQuery(el).find(".main-slide").css({'right':'-51%'});
            },
            afterLeave: function (el, done) {
                // ...
                setTimeout(function(){
                    document.getElementsByTagName("body")[0].style.overflow = "";
                    done();
                },700);
            },
            closeSlide(){
                this.$store.commit("set_isslide", false);
            },
        }
    }
    
</script>
<style>
    .slide-enter-active {
      transition: all .3s ease-in-out;
    }
    .slide-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-enter, .slide-leave-to {
    }
    .overlay{
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity 500ms;
        z-index: 9999;
    }
    .main-slide{
        position: fixed;
        width: 50%;
        height: 100vh;
        right: -51%;
        padding: 15px;
        background: #fff;
        transition: all .5s ease-in-out;
        box-shadow: 0px 0px 8px #ffffff;
    }
    .topHeader{
        width: 100%;
        height: 40px;
    }
</style>