<template>
<div>
    <label>Hearing</label>
    <div class="form-group form-inline-block form-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Hearing Case" v-model="data[length].case_no" :value="data[length].case_no" disabled>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Item no" v-model="data[length].item">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <datepicker class="form-control" placeholder="Hearing Date" v-model="data[length].posted" :value="data[length].posted"></datepicker>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <textarea class="form-control" placeholder="Remarks" v-model="data[length].what"></textarea>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <input class="form-control" placeholder="To Whom" v-model="data[length].to_whom">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <input class="form-control" placeholder="Status" v-model="data[length].status">
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
            Datepicker
        },
        props: ['data', 'option', 'length', 'mode', 'parent'],
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
                            notify('Hearings Updated');
                        }else if(response.data.saved){
                            vm.parent.push(response.data.hearing);
                            vm.closeSmallPopUp();
                            notify('Hearings Saved');
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