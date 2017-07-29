<template>
<div>
        <label>{{title}} Connected Case</label>
        <div class="form-group form-inline-block form-box">
            <div class="row">
                <div class="col-sm-12">
                    <input type="text" class="form-control" placeholder="Case No" v-model="data[length].cid" disabled='true'>
                </div>
            </div>
            <div class="row mT10">
                <div class="col-sm-12">
                    <input type="text" class="form-control" placeholder="SR No" v-model="data[length].sno" disabled='true'>
                </div>
            </div>
            <div class="row mT10">
                <div class="col-sm-12">
                    <input type="text" class="form-control" placeholder="Connected Case No" v-model="data[length].con_no">
                </div>
            </div>
        </div>
        <div id="footer">
            <button class="btn btn-success" @click="saveConnectedCase">Save</button>
            <button class="btn btn-danger" @click="closeSmallPopUp">Cancel</button>
        </div>
</div>
</template>
<script>
    import axios from 'axios'
    export default {
        name: 'ConnectCaseForm',
        components: [],
        props: ['data', 'length', 'mode', 'parent'],
        data() {
            return{
                method: 'post',
                store : '/api/caseinfo/connected/create',
                title: 'Add',
            }
        },
        methods: {
            saveConnectedCase(){
                var vm = this;
                if(this.mode == 'edit'){
                    this.title = 'Edit'
                    this.store = '/api/caseinfo/connected/update';
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