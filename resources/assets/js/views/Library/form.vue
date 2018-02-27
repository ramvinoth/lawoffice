<template>
<div>
    <label>Book Detials</label>
    <div class="form-group form-inline-block form-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <datepicker class="form-control" placeholder="Date" v-model="data[length].ldate" :value="data[length].ldate"></datepicker>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Book name" v-model="data[length].book">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Author Name" v-model="data[length].author" :value="data[length].author">
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <button class="btn btn-success" @click="saveBook">Save</button>
        <button class="btn btn-danger" @click="closeSmallPopUp">Cancel</button>
    </div>
</div>
</template>
<script>
    import Datepicker from '../../components/DatePicker.vue'
    import axios from 'axios'
    export default {
        name: 'bookForm',
        components:{
            Datepicker
        },
        props: ['data', 'option', 'length', 'mode', 'parent'],
        data() {
            return{
                resource: 'library',
                initialize: '/api/library/',
                redirect: '/',
                store: '/api/caselist',
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
                            notify('Book Updated');
                        }else if(response.data.saved){
                            vm.parent.push(response.data.library);
                            vm.closeSmallPopUp();
                            notify('Book Saved');
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