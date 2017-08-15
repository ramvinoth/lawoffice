<template>
    <transition name="alertbox">
        <div class="alertbox-mask" v-if="active" @click.self="close">
            <div class="alertbox-wrapper">
                <div class="alertbox-container">
                    <div class="alertbox-header">
                        <slot name="header">{{title}}</slot>
                    </div>

                    <div class="alertbox-body">
                        <slot name="body">{{body}}</slot>
                    </div>

                    <div class="alertbox-footer">
                        <slot name="footer">
                            <button class="btn alertbox-default-button" @click="close">OK</button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
    import Hub from '../events/Hub';
export default {
    data (){
        return{  
            active: false,
            data: {},
            title: null,
            body: "Case Id not Attached",
        }
    },

    components: {
        
    },

    destroyed() {
        Hub.$off('set-modal-data', this.set);
        Hub.$off('open-modal', this.open);
    },

    methods: {
        close() {
            this.active = false;
        },

        open() {
            this.active = true;
        },

        set(data, title) {
            this.data = data;
            this.body = data.body;
            this.title = title;
            //this.component = title.split(' ').join('-').toLowerCase(); // of course you could just pass the component through the method too...
        }
    },

    mounted() {
        this.$nextTick(function () {
            Hub.$on('set-modal-data', this.set);
            Hub.$on('open-modal', this.open);
        }.bind(this));
    }
}
    
</script>

<style>
.alertbox-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.alertbox-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.alertbox-container {
  width: 400px;
  margin: 0px auto;
  padding: 20px 20px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
}
.alertbox-header{
    color: #D14836;
    font-size: 1.6em;
    /*border-bottom: 1px solid #efefef;*/
}

.alertbox-body {
  padding : 20px 0;
  font-size: 1.1em;
  /*border-bottom: 1px solid #efefef;*/
}
.alertbox-footer {
    height: 40px;
    padding-top: 8px;
}
.alertbox-default-button {
  padding: 5px 20px;
  color: #fff;
  background-color: #018ee0;
  float: right;
  font-weight: 600;
}
.alertbox-default-button:hover {
    color: #FFF;
}
/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.alertbox-enter {
  opacity: 0;
}

.alertbox-leave-active {
  opacity: 0;
}

.alertbox-enter .alertbox-container,
.alertbox-leave-active .alertbox-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>