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
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Court</label>
                                    <select2 :options="[{id: '1',text : 'High Court'},{id : '2', text : 'DRT'},{id : '3', text : 'Consumer Court'},{id : '4', text : 'District Court'},{id : '5', text : 'Supreme Court'}]" name="court" id="court" class="form-control" v-model="form.court">
                                        <option disabled value="0">Select Court</option>
                                    </select2>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Bench</label>
                                    <select2 :options="[{id: 1,text : 'Madurai'},{id : 2, text : 'Madras'}]" name="bench" id="bench" class="form-control" v-model="form.bench">
                                        <option disabled value="0">Select Bench</option>
                                    </select2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Case Type</label>
                                    <select2 :options="[{id: 1,text : 'Madurai'},{id : 2, text : 'Madras'}]" name="bench" id="bench" class="form-control" v-model="form.case_type">
                                        <option disabled value="0">Select Case Type</option>
                                    </select2>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>SR Number</label>
                                    <input type="text" class="form-control" v-model="form.sno">
                                    <small class="text-danger" v-if="errors.court">{{errors.court[0]}}</small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Vakalath SR</label>
                                    <input type="text" class="form-control" v-model="form.vno">
                                    <small class="text-danger" v-if="errors.vno">{{errors.court_type[0]}}</small>
                                </div>
                            </div>
                        </div>
                        <hr></hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group form-inline-block">
                                    <div class="form-hr-50 pR10">
                                        <label>Appearing for</label>
                                        <select2 :options="[{id: 'Appellant',text : 'Appellant'},{id : 'Petitioner', text : 'Petitioner'},{id : 'Respondent', text : 'Respondent'}]" name="appear" id="appear" class="form-control" v-model="form.appear">
                                            <option disabled value="0">Select Court</option>
                                        </select2>
                                    </div>
                                    <div class="form-hr-50">
                                        <label>Contact No</label>
                                        <input type="text" class="form-control" placeholder="Contact no" v-model="form.contact">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>District</label>
                                    <select2 :options="[{id:'THIRUVALLUR',text:'THIRUVALLUR'},{id:'CHENNAI',text:'CHENNAI'},{id:'KANCHEEPURAM',text:'KANCHEEPURAM'},{id:'VELLORE',text:'VELLORE'},{id:'KRISHNAGIRI',text:'KRISHNAGIRI'},{id:'DHARMAPURI',text:'DHARMAPURI'},{id:'TIRUVANNAMALAI',text:'TIRUVANNAMALAI'},{id:'VILLUPURAM',text:'VILLUPURAM'},{id:'SALEM',text:'SALEM'},{id:'NAMAKKAL',text:'NAMAKKAL'},{id:'ERODE',text:'ERODE'},{id:'THE NILGIRIS',text:'THE NILGIRIS'},{id:'COIMBATORE',text:'COIMBATORE'},{id:'DINDIGUL',text:'DINDIGUL'},{id:'KARUR',text:'KARUR'},{id:'TIRUCHIRAPPALLI',text:'TIRUCHIRAPPALLI'},{id:'PERAMBALUR',text:'PERAMBALUR'},{id:'CUDDALORE',text:'CUDDALORE'},{id:'NAGAPATTINAM',text:'NAGAPATTINAM'},{id:'THIRUVARUR',text:'THIRUVARUR'},{id:'THANJAVUR',text:'THANJAVUR'},{id:'PUDUKKOTTAI',text:'PUDUKKOTTAI'},{id:'SIVAGANGA',text:'SIVAGANGA'},{id:'MADURAI',text:'MADURAI'},{id:'THENI',text:'THENI'},{id:'VIRDHUNAGAR',text:'VIRDHUNAGAR'},{id:'RAMANATHAPURAM',text:'RAMANATHAPURAM'},{id:'THOOTHUKKUDI',text:'THOOTHUKKUDI'},{id:'TIRUNELVELI',text:'TIRUNELVELI'},{id:'KANNIYAKUMARI',text:'KANNIYAKUMARI'},{id:'ARIYALUR',text:'ARIYALUR'},{id:'TIRUPPUR',text:'TIRUPPUR'}]" name="district" id="district" class="form-control" v-model="form.district">
                                        <option disabled value="0">Select District</option>
                                    </select2>
                                </div>
                            </div>
                        
                            <div class="col-sm-6">
                                <label>Other Side Counsel</label>
                                <div class="form-group form-inline-block form-box">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" placeholder="Other Side Counsel" v-model="other_counsel.court_type">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" placeholder="Contact no" v-model="other_counsel.other">
                                        </div>
                                        <input type="hidden" name="other_counsel" v-model='form.other'/>
                                        <div class="col-sm-6 mT10">
                                            <button class="btn btn-success">Add</button>
                                            <button class="btn btn-danger">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <hr></hr>
                        
                        <div class="row datepicker">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <datepicker v-model="form.filing_date" placeholder="Date of Filing"></datepicker>
                                    <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <datepicker v-model="form.admission" placeholder="Date of Admission"></datepicker>
                                    <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row datepicker">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <datepicker v-model="form.returned" placeholder="Date of Return"></datepicker>
                                    <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <datepicker v-model="form.return_expiry" placeholder="Date of Expiry"></datepicker>
                                    <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <datepicker v-model="form.represent" placeholder="Date of Representation"></datepicker>
                                    <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Refered By</label>
                                    <select2 :options="[{id: 'Appellant',text : 'Appellant'},{id : 'Petitioner', text : 'Petitioner'},{id : 'Respondent', text : 'Respondent'}]" name="refer_by" id="refer_by" class="form-control" v-model="form.refer_by">
                                        <option disabled value="0">Select Court</option>
                                    </select2>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <div class="form-hr-50">
                                    <label>Contact No</label>
                                    <input type="text" class="form-control" placeholder="Contact no" v-model="form.refer_contact">
                                </div>
                            </div>
                        </div>
                        
                        <label>Lower Court Number</label>
                        <div class="form-group form-inline-block form-box">
                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" placeholder="Type" v-model="lower_court.ltype">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" placeholder="Lower Court Number" v-model="lower_court.lno">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" placeholder="Year" v-model="lower_court.lyear">
                                </div>
                                <div class="col-sm-2 datepicker">
                                    <input type="text" class="form-control" placeholder="Court" v-model="lower_court.lcourt">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" placeholder="Place" v-model="lower_court.lplace">
                                </div>
                                <div class="col-sm-2 datepicker">
                                    <datepicker v-model="lower_court.order" placeholder="Order Date"></datepicker>
                                </div>
                                <input type="hidden" name="against" :value="lower_court"/>
                            </div>
                            <hr></hr>
                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" placeholder="Type" v-model="lower_court1.ltype">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" placeholder="Lower Court Number" v-model="lower_court1.lno">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" placeholder="Year" v-model="lower_court.lyear">
                                </div>
                                <div class="col-sm-2 datepicker">
                                    <input type="text" class="form-control" placeholder="Court" v-model="lower_court1.lcourt">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" placeholder="Place" v-model="lower_court1.lplace">
                                </div>
                                <div class="col-sm-2 datepicker">
                                    <datepicker v-model="lower_court1.order" placeholder="Order Date"></datepicker>
                                </div>
                                <input type="hidden" name="against1" :value="lower_court1"/>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Case Number</label>
                                    <input type="text" name="case_no" class="form-control" placeholder="Case Number" v-model="form.case_no">
                                    <small class="text-danger" v-if="errors.case_no">{{errors.address[0]}}</small>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Category</label>
                                    <input type="text" name="category" class="form-control" placeholder="Category" v-model="form.category">
                                    <small class="text-danger" v-if="errors.category">{{errors.category[0]}}</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Appellant/Petitioner</label>
                            <textarea name="petitioner" class="form-control" v-model="form.address"></textarea>
                            <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                        </div>
                        <div class="form-group">
                            <label>Respondant</label>
                            <textarea name="respondant" class="form-control" v-model="form.address"></textarea>
                            <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Prayer</label>
                                <textarea name="c_prayer" class="form-control" v-model="form.address"></textarea>
                                <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                            </div>
                            
                            <div class="col-sm-6">
                                <label>Citation</label>
                                <textarea name="citation" class="form-control" v-model="form.address"></textarea>
                                <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                            </div>
                        </div>
                        
                        <hr></hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Miscellaneous SR</label>
                                <div class="form-group form-inline-block form-box">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" placeholder="Category" v-model="misc_sr[0].mcat">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" placeholder="SR No" v-model="misc_sr[0].mno">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" placeholder="Year" v-model="misc_sr[0].myear">
                                        </div>
                                        <div class="col-sm-3 datepicker">
                                            <datepicker v-model="misc_sr[0].mdate" placeholder="DD/MM/YYYY"></datepicker>
                                        </div>
                                        <input type="hidden" name="misc_sr" v-model='misc_sr'>
                                        <div class="col-sm-6 mT10">
                                            <button class="btn btn-success">Add</button>
                                            <button class="btn btn-danger">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <hr></hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Connected Case</label>
                                <div class="form-group form-inline-block form-box">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" placeholder="Type" v-model="connected[0].type">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" placeholder="Case No" v-model="connected[0].cno">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" placeholder="Year" v-model="connected[0].year">
                                        </div>
                                        <input type="hidden" name="connected" v-model='connected'>
                                        <div class="col-sm-6 mT10">
                                            <button class="btn btn-success">Add</button>
                                            <button class="btn btn-danger">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr></hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Miscellaneous Petition</label>
                                <div class="form-group form-inline-block form-box">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" placeholder="MP No" v-model="misc_pet.mpno">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" placeholder="Year" v-model="misc_pet.mpyear">
                                        </div>
                                        <div class="col-sm-3 datepicker">
                                            <datepicker v-model="misc_pet.date" placeholder="DD/MM/YYYY"></datepicker>
                                        </div>
                                    </div>
                                    <div class="row mT10">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="MP Prayer" v-model="misc_pet.mpyear"></textarea>
                                                <small class="text-danger" v-if="errors.address">{{errors.address[0]}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="MP Disposal Date" v-model="misc_pet.mpdisposal">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="MP Date of Returned" v-model="misc_pet.mpreturn">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="MP Date of Re-Presented" v-model="misc_pet.mprepresent">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="misc_pet" v-model="misc_pet"/>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button @click="addGroup('misc_pet')" class="btn btn-success">Add</button>
                                            <button @click="removeGroup('misc_pet')" class="btn btn-danger">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <label>Status</label>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select2 :options="[{id: 'Admit',text : 'Admit'},{id: 'Adjourned Admission',text : 'Adjourned Admission'},{id : 'Notice Before Admission', text : 'Notice Before Admission'}]" name="status" id="status" class="form-control" v-model="form.status">
                                        <option disabled value="0">Select Bench</option>
                                    </select2>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Status" v-model="form.s_text">
                                </div>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-sm-4 datepicker">
                                <label>Posted on</label>
                                <datepicker v-model="form.posted_date" placeholder="DD/MM/YYYY"></datepicker>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Main Case Disposal</label>
                                    <input type="text" class="form-control" placeholder="Main Case Disposal" v-model="form.disposal">
                                    <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                                </div>
                            </div>
                        </div>
                        <hr></hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Judge</label>
                                    <input type="text" class="form-control" placeholder="Judge" v-model="form.by_whom">
                                    <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Result</label>
                                    <textarea class="form-control" placeholder="Result" v-model="form.result"></textarea>
                                    <small class="text-danger" v-if="errors.address">{{errors.address[0]}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Upload File</label>  
                                    <input type="file" name="upload" v-on:change="form.upload" class="form-control" id="uploadFile">
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
    import Datepicker from 'vuejs-datepicker'

    var state = {
        date1: new Date()
    }
    
    export default {
        name: 'CaseListForm',
        components: {
            Datepicker
        },
        data() {
            return {
                form: {},
                errors: {},
                option: {},
                title: 'Create Case',
                initialize: '/api/caselist/create',
                redirect: '/',
                store: '/api/caselist',
                method: 'post',
                lower_court: { ltype: '', lno: '', lyear: '', lcourt: '', lplace: '', lorder: '', against: ''},
                lower_court1:{ltype: '',lno: '', lyear: '', lcourt: '', lplace: '', lorder: '', against: ''},
                misc_sr:[{mcat: '',mno: '', myear: '', mdate: ''}],
                connected:[{type: '',cno: '', year: ''}],
                misc_pet: { mpno: '', mpyear: '', mpdate: '', mpprayer: '', mpdisposal: '', mpreturn: '', mprepresent: ''},
                other_counsel: {},
                format: 'dd/MM/yyyy',
                disabled: {},
                eventMsg: null,
                state: state
            }
        },
        beforeMount() {
            if(this.$route.meta.mode === 'edit') {
                this.title = 'Edit'
                this.initialize = '/api/caselist/' + this.$route.params.id + '/edit'
                this.store = '/api/caselist/' + this.$route.params.id
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