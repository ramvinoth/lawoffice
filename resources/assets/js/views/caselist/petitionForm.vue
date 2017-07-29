<template>
    <div>
        <label>{{title}} Petition</label>
        <div class="form-group form-inline-block form-box">
            <div class="row">
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="MP No" v-model="data[length].mpno">
                </div>
            </div>
            <div class="row mT10">
                <div class="col-sm-6">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="MP Prayer" v-model="data[length].mpprayer"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <datepicker class="form-control" placeholder="MP Disposal Date" v-model="data[length].mpdisposal" :value="data[length].mpdisposal"></datepicker>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <datepicker class="form-control" placeholder="MP Date of Returned" v-model="data[length].mpreturn" :value="data[length].mpreturn"></datepicker>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <datepicker class="form-control" placeholder="MP Date of Re-Presented" v-model="data[length].mprepresent" :value="data[length].mprepresent"></datepicker>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <button class="btn btn-success" @click="savePetiton">Save</button>
            <button class="btn btn-danger" @click="closeSmallPopUp">Cancel</button>
        </div>
    </div>
</template>
<script>
    import Datepicker from '../../components/DatePicker.vue'
    import axios from 'axios'
    export default {
        name: 'PetitionForm',
        components:{
            Datepicker,
        },
        props: ['data', 'length', 'mode', 'parent'],
        data() {
            return{
                resource: 'Petition',
                title: 'Add',
                initialize: '/api/caseinfo/petition/create',
                redirect: '/',
                store: '/api/caseinfo/petition/create',
                method: 'post',
            }
        },
        methods: {
            savePetiton(){
                var vm = this;
                if(this.mode == 'edit'){
                    this.title = 'Edit'
                    this.store = '/api/caseinfo/petition/update';
                    this.method = 'put';
                }
                axios[this.method](this.store, this.data[0])
                    .then(function(response) {
                        if(response.data.updated) {
                            vm.data.push(response.data.petition);
                            vm.closeSmallPopUp();
                        }else if(response.data.saved){
                            vm.parent.push(response.data.petition);
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