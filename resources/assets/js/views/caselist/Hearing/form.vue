<template>
<div>
    <label>Hearing</label>
    <div class="form-group form-inline-block form-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Hearing Case" v-model="data[length].case_id" :value="data[length].case_id" disabled>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Hearing Title" v-model="data[length].title">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <datepicker class="form-control" placeholder="Hearing Date" v-model="data[length].date" :value="data[length].date"></datepicker>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <textarea class="form-control" placeholder="Hearing Description" v-model="data[length].description"></textarea>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Judges" v-model="data[length].judges">
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <button class="btn btn-success" @click="saveHearing">Save</button>
        <button class="btn btn-danger" @click="closeSmallPopUp">Cancel</button>
    </div>
</div>
</template>
<script>
    import Datepicker from '../../../components/DatePicker.vue'
    import axios from 'axios'
    export default {
        name: 'HearingForm',
        components:{
            Datepicker,
        },
        props: ['data', 'length', 'mode', 'parent'],
        data() {
            return{
                resource: 'caselist',
                initialize: '/api/hearing/',
                redirect: '/',
                store: '/api/caselist',
                method: 'post',
            }
        },
        methods: {
            saveHearing(){
                var vm = this;
                if(this.mode == 'edit'){
                    this.initialize = '/api/hearing/'+this.data[0].id;
                    this.method = 'put';
                }
                axios[this.method](this.initialize, this.data[0])
                    .then(function(response) {
                        if(response.data.updated) {
                            vm.data.push(response.data.hearing);
                            vm.closeSmallPopUp();
                        }else if(response.data.saved){
                            vm.parent.push(response.data.hearing);
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