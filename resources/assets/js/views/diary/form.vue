<template>
    <div class="panel panel-default">
        <div class="panel-heading bold">
            {{title}}
        </div>
        <div class="panel-body">
            <form class="form" @submit.prevent="save" enctype="multipart/form-data">
                <div class="row">
                    <!-- First Column -->
                    <div class="col-sm-8">
                        <label>Case Number</label>
                        <div class="row">
                            <div class="col-sm-6">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" placeholder="Type" class="form-control" v-model="form.ctype">
                                    <small class="text-danger" v-if="errors.ctype">{{errors.ctype[0]}}</small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" placeholder="Case No" class="form-control" v-model="form.cno">
                                    <small class="text-danger" v-if="errors.cno">{{errors.court[0]}}</small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" placeholder="Year" class="form-control" v-model="form.cyear">
                                    <small class="text-danger" v-if="errors.cyear">{{errors.court[0]}}</small>
                                </div>
                                <input type="hidden" name="case_no" id="case_no" :value="concatValue({'type' : form.ctype, 'no' : form.cno, 'year' : form.cyear})" v-model="form.case_no" />
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group datepicker">
                                    <label>Date</label>
                                    <datepicker :value="form.cdate" v-model="form.cdate" placeholder="DD/MM/YYYY"></datepicker>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Item no</label>
                                    <input type="text" placeholder="Item no" class="form-control" v-model="form.item">
                                    <small class="text-danger" v-if="errors.item">{{errors.item[0]}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Justice</label>
                                    <input type="text" placeholder="To Whom" class="form-control" v-model="form.to_whom" />
                                    <small class="text-danger" v-if="errors.item">{{errors.item[0]}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Bench</label>
                                    <select name="status" id="status" class="form-control" v-model="form.status">
                                        <option disabled value="">Select Any</option>
										<option value="Admit">Admit</option>
										<option value="Notice Before Admission">Notice Before Admission</option>
										<option value="Adjournal Admission">Adjournal Admission</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea type="text" id="what" name="what" placeholder="Remarks" class="form-control" v-model="form.what"></textarea>
                                    <small class="text-danger" v-if="errors.what">{{errors.what[0]}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group datepicker">
                                    <label>Remarks</label>
                                    <datepicker :value="form.posted" v-model="form.posted" placeholder="DD/MM/YYYY"></datepicker>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'
    import Datepicker from '../../components/DatePicker.vue'

    var state = {
        date1: new Date()
    }
    
    export default {
        name: 'DiaryForm',
        components: {
            Datepicker
        },
        data() {
            return {
                form: {},
                errors: {},
                option: {},
                title: 'Create Diary',
                initialize: '/api/diary/create',
                redirect: '/',
                store: '/api/diary',
                method: 'post',
                format: 'dd/MM/yyyy',
                disabled: {},
                eventMsg: null,
                state: state
            }
        },
        beforeMount() {
            if(this.$route.meta.mode === 'edit') {
                this.title = 'Edit'
                this.initialize = '/api/diary/' + this.$route.params.id + '/edit'
                this.store = '/api/diary/' + this.$route.params.id
                this.method = 'put'
            }
            this.fetchData()
        },
        watch: {
            '$route': 'fetchData'
        },
        methods: {
            fetchData() {
                var vm = this
                axios.get(this.initialize)
                    .then(function(response) {
                        Vue.set(vm.$data, 'form', response.data.form)
                        Vue.set(vm.$data, 'option', response.data.option)
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
            save() {
                var vm = this
                axios[this.method](this.store, this.form)
                    .then(function(response) {
                        if(response.data.saved) {
                            vm.$router.push(vm.redirect)
                        }
                    })
                    .catch(function(error) {
                        Vue.set(vm.$data, 'errors', error.response.data)
                    })
            },
            concatValue(caseNoObj){
                //console.log("caseNoObj length : "+caseNoObj.size());
                var result= caseNoObj.type+"."+caseNoObj;
                console.log(result);
                return result;
            },
            addGroup(type){
                if(type === "misc_pet"){
                    
                }
            },
            removeGroup(type){
                if(type === "misc_pet"){
                    
                }
            }
        }
    }
</script>

<style>
.datepicker input{
    padding: .75em .5em;
    font-size: 100%;
    border: 1px solid #ccc;
    width: 100%;
}
</style>