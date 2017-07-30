<template>
    <transition name="spopup" v-on:before-enter="beforeEnter" v-on:after-leave="afterLeave">
        <div v-if="getIsSmallPopShow" class="spop_overlay">
            <div class="small-popup">
                <div class="topHeader"><i class="fa fa-close fr pointer" @click="closeSmallPopUp"></i></div>
                <slot name="header"></slot>
                <slot></slot>
                <slot name="footer"></slot>
            </div>
        </div>
    </transition>
</template>
<script>
    export default{
        name: "spopup",
        computed:{
            getIsSmallPopShow(){
                return this.$store.getters.is_spopshow;
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
            closeSmallPopUp(){
                this.$store.commit("set_spopshow", false);
                document.getElementsByTagName("body")[0].style.overflow = "";
            }
        },
        beforeDestroy(){
            this.closeSmallPopUp();
        }
    }
    
</script>
<style>
    .spopup-enter-active {
      transition: all .3s ease-in-out;
    }
    .spopup-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .spopup-enter, .spopup-leave-to {
      opacity: 0;
    }
    .spop_overlay{
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity 500ms;
        z-index: 99999;
    }
    .small-popup{
        margin: 20px auto;
        margin-bottom: 20px;
        padding: 15px;
        background: #fff;
        width: 50%;
        height: auto;
        position: relative;
        transition: all .5s ease-in-out;
        box-shadow: 0px 0px 8px #ffffff;
    }
    .topHeader{
        width: 100%;
        height: 40px;
    }
</style>