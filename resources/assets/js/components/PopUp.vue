<template>
    <transition name="mpopup" v-on:before-enter="beforeEnter" v-on:after-leave="afterLeave">
        <div v-if="getIsMainPopShow" class="overlay">
            <div class="main-popup">
                <div id="pop_progressbar" class="lprogress">
                    <div class="loading_line"></div> 
                    <div class="loading_break dot1"></div> 
                    <div class="loading_break dot2"></div> 
                    <div class="loading_break dot3"></div> 
                    <div class="loading_break dot4"></div>
                </div>
                <div class="topHeader"><i class="fa fa-close fr pointer" @click="closePopUp"></i></div>
                <slot name="header"></slot>
                <slot></slot>
                <slot name="footer"></slot>
            </div>
        </div>
    </transition>
</template>
<script>
    export default{
        name: "mpopup",
        computed:{
            getIsMainPopShow(){
                return this.$store.getters.is_popshow;
            }
        },
        methods:{
            beforeEnter: function (el) {
                // ...
                document.getElementsByTagName("body")[0].style.overflow = "hidden";
            },
            afterLeave: function (el, done) {
                // ...
                document.getElementsByTagName("body")[0].style.overflow = "";
                //done()
            },
            closePopUp(){
                this.$store.commit("set_ispopshow", false);
                document.getElementsByTagName("body")[0].style.overflow = "";
            }
        },
        beforeDestroy(){
            this.closePopUp();
        }
    }
    
</script>
<style>
    .mpopup-enter-active {
      transition: all .3s ease-in-out;
    }
    .mpopup-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .mpopup-enter, .mpopup-leave-to {
      opacity: 0;
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
    .main-popup{
        margin: 20px auto;
        margin-bottom: 20px;
        padding: 15px;
        background: #fff;
        width: 97%;
        height: 95vh;
        position: relative;
        transition: all .5s ease-in-out;
        box-shadow: 0px 0px 8px #ffffff;
        overflow: auto;
    }
    .topHeader{
        width: 100%;
        height: 40px;
    }
</style>