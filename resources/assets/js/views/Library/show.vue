<template>
<div>
    <div class="form-group form-inline-block form-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group" v-if="data[length].ldate">
                    <span class="span-label">DATE</span>
                    <div class="spopview-content" v-if="data[length].ldate !== ''">{{data[length].ldate}}</div>
                    <div class="spopview-content" v-else>-</div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <span class="span-label">BOOK</span>
                    <div class="spopview-content" v-if="data[length].book !== ''">{{data[length].book}}</div>
                    <div class="spopview-content" v-else>-</div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <span class="span-label">AUTHOR</span>
                    <div class="spopview-content" v-if="data[length].author !== ''">{{data[length].author}}</div>
                    <div class="spopview-content" v-else>-</div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
    import axios from 'axios'
    export default {
        name: 'ViewBook',
        components:{
            
        },
        props: ['data', 'length', 'mode', 'parent'],
        data() {
            return{
                resource: 'library',
                initialize: '/api/library/',
                redirect: '/',
                store: '/api/library',
                method: 'post',
            }
        },
        methods: {
            saveBook(){
                var vm = this;
                if(this.mode == 'edit'){
                    this.initialize = '/api/library/'+this.data[0].id;
                    this.method = 'put';
                }
                axios[this.method](this.initialize, this.data[0])
                    .then(function(response) {
                        if(response.data.updated) {
                            vm.data.push(response.data.library);
                            vm.closeSmallPopUp();
                        }else if(response.data.saved){
                            vm.parent.push(response.data.library);
                            vm.closeSmallPopUp();
                        }
                    })
                    .catch(function(error) {
                        Vue.set(vm.$data, 'errors', error.response.data)
                    })
            },
            closeSmallPopUp(){
                this.$store.commit("set_spopshow", false);
            },
        }
    }
</script>