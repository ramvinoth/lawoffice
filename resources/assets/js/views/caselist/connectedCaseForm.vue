<template>
<div>
        <label>Connected Case</label>
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
        props: ['data','length'],
        data() {
            return{
                method: 'post',
            }
        },
        methods: {
            saveConnectedCase(){
                var vm = this
                axios[this.method]('/api/caseinfo/connected/create', this.data[0])
                    .then(function(response) {
                        console.log(response.data.saved);
                        if(response.data.saved) {
                            vm.data.push(response.data.petition);
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