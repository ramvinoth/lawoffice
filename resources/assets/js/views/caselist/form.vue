<template>
    <div id="create_case" class="panel panel-default">
        <div class="panel-heading bold">
            {{title}}
        </div>
        <div class="panel-body">
            <form class="form" @submit.prevent="save" enctype="multipart/form-data">
                <div class="row">
                    
                    <!-- First Column -->
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Case Title</label>
                                    <input type="text" name="case_title" placeholder="Case Title" class="form-control" v-model="form.case_title">
                                    <small class="text-danger" v-if="errors.title">{{errors.title[0]}}</small>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label>Court Type</label>
                                <span class="required_label">*</span>
                                <div class="form-group select-style">
                                    <select name="court" id="court" class="form-control" v-model="form.court_type_id" v-on:change="selectCourt" required>
                                        <option disabled value="">Select Court</option>
                                        <option value="1">Supreme Court</option>
                                        <option value="2">High Court</option>
                                        <option value="3">District Court</option>
                                        <option value="4">Consumer Court</option>
                                        <option value="5">DRT</option>
                                    </select>
                                </div>
                            </div>
                            <div id="bench_div" class="col-sm-12" style="display:none">
                                <label>Bench</label>
                                <div class="form-group select-style">
                                    <select name="bench" id="bench" class="form-control" v-model="form.bench" placeholder="Select Bench">
                                        <option disabled value="">Select Bench</option>
                                        <option value="Madurai">Madurai</option>
                                        <option value="Madras">Madras</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div id="state_div" class="col-sm-8" style="display:none;">
                                <label>State</label>
                                <span class="required_label">*</span>
                                <div class="form-group select-style">
                                    <select name="bench" id="bench" class="form-control" disabled>
                                        <option v-for="state in states" :value="state.value" :selected="state.value == 31 ? 'selected' : false">
                                          {{state.text}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div id="district_div" class="col-sm-8" style="display:none">
                                <div class="form-group">
                                    <label>District</label>
                                    <div class="select-style">
                                    <select name="district" id="district" class="form-control" v-model="form.district" @change="getListOfCourts">
                                        <option disabled value="">Select District</option>
                                        <option v-for="district in districts" :value="district.value">
                                              {{district.text}}
                                        </option>
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div id="court_div" class="col-sm-8" style="display:none;">
                                <div class="form-group">
                                    <label>Court</label>
                                    <div class="select-style">
                                    <select name="court_id" id="court_id" class="form-control" v-model="form.court_id" @change="getCaseTypes">
                                        <option disabled value="">Select Court</option>
                                        <option v-for="court in courts" :value="court.value">
                                              {{court.text}}
                                        </option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="casetype_div" class="col-sm-8" style="display:none;">
                                <label>Case Type</label>
                                <span class="required_label">*</span>
                                <div class="form-group select-style">
                                    <select name="bench" id="bench" class="form-control" v-model="form.case_type">
                                        <option v-for="casetype in casetypes" :value="casetype.value">
                                          {{casetype.text}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Appearing for</label>
                                <div class="select-style">
                                <select name="appear" id="appear" class="form-control" v-model="form.appear">
                                    <option disabled value="">Select One</option>
                                    <option value="Appellant" selected="">Appellant</option>
                                    <option value="Petitioner">Petitioner</option>
                                    <option value="Respondent">Respondent</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Contact No</label>
                                <input type="text" class="form-control" placeholder="Contact no" v-model="form.contact">
                            </div>
                        </div>
                        <div class="row pt10">
                            <div class="col-sm-6" v-if="form.appear == 'Appellant' || form.appear == 'Petitioner'">
                                <div class="form-group">
                                    <label>SR Number</label>
                                    <input type="text" class="form-control" placeholder="SR Number" v-model="form.sno">
                                    <small class="text-danger" v-if="errors.court">{{errors.court[0]}}</small>
                                </div>
                            </div>
                            <div class="col-sm-6" v-if="form.appear == 'Respondent'">
                                <div class="form-group">
                                    <label>Vakalath SR</label>
                                    <input type="text" class="form-control" placeholder="Vakalath SR" v-model="form.vno">
                                    <small class="text-danger" v-if="errors.vno">{{errors.court_type[0]}}</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row pt10">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date of Filing</label>
                                    <datepicker v-model="form.filing_date" :value="form.filing_date" placeholder="Date of Filing"></datepicker>
                                    <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date of Admission</label>
                                    <datepicker v-model="form.admission" :value="form.admission" placeholder="Date of Admission"></datepicker>
                                    <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Case Number</label>
                                    <input type="text" name="case_no" class="form-control" placeholder="Case Number" v-model="form.case_no">
                                    <small class="text-danger" v-if="errors.case_no">{{errors.address[0]}}</small>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <input type="text" name="category" class="form-control" placeholder="Category" v-model="form.category">
                                    <small class="text-danger" v-if="errors.category">{{errors.category[0]}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Subject (Provision)</label>
                                    <input type="text" name="subject" class="form-control" placeholder="Subject" v-model="form.subject">
                                    <small class="text-danger" v-if="errors.subject">{{errors.category[0]}}</small>
                                </div>
                            </div>
                        </div>
                        
                        <hr></hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Refered By</label>
                                    <input type="text" class="form-control" placeholder="Refered By" v-model="form.refer_by">
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-hr-50">
                                    <label>Contact No</label>
                                    <input type="text" class="form-control" placeholder="Contact no" v-model="form.refer_contact">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Other Side Counsel</label>
                                <div id="othercousel_row" class="form-group form-inline-block form-box">
                                    <div class="row mT10" v-for="(content, index) in form.other" :key="content.id">
                                        <other_counsel :other_counsel="form.other" :length="index"></other_counsel>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 mT10">
                                            <button class="btn btn-success" @click="addOtherSideCounsel($event)">Add</button>
                                            <button class="btn btn-danger" @click="removeOtherSideCounsel($event)">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <hr></hr>
                        
                        <div id="lowercourt_div" style="display:none;">
                            <label>Lower Court Number</label>
                            <div class="form-group form-inline-block form-box">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" placeholder="Type" v-model="form.against.lno">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" placeholder="Court" v-model="form.against.lcourt">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" placeholder="Place" v-model="form.against.lplace">
                                    </div>
                                    <div class="col-sm-3">
                                        <datepicker v-model="form.against.lorder" :value="form.against.lorder" placeholder="Order Date"></datepicker>
                                    </div>
                                </div>
                                <hr></hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" placeholder="Lower Court Number" v-model="form.against1.lno">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" placeholder="Court" v-model="form.against1.lcourt">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" placeholder="Place" v-model="form.against1.lplace">
                                    </div>
                                    <div class="col-sm-3">
                                        <datepicker v-model="form.against1.order" :value="form.against1.lorder" placeholder="Order Date"></datepicker>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Appellant/Petitioner</label>
                                    <input name="petitioner" id="petitioner" class="form-control" v-model="form.petitioner" />
                                    <small class="text-danger" v-if="errors.petitioner">{{errors.address[0]}}</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Appellant/Petitioner's Address</label>
                                    <textarea name="petitioner_addr" id="petitioner_addr" class="form-control" v-model="form.petitioner_addr"></textarea>
                                    <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Respondant</label>
                                    <input name="respondant" id="respondant" class="form-control" v-model="form.respondant" />
                                    <small class="text-danger" v-if="errors.respondant">{{errors.address[0]}}</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Respondant's Address</label>
                                    <textarea name="respondant_addr" id="respondant_addr" class="form-control" v-model="form.respondant_addr"></textarea>
                                    <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Priority</label>
                                <div class="select-style">
                                    <select name="c_prayer" class="form-control" v-model="form.priority" placeholder="Case Priority">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                                <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                            </div>
                        </div>
            
                        <div class="row mT10">
                            <div class="col-sm-12">
                                <label>Prayer</label>
                                <textarea name="c_prayer" class="form-control large-textarea" v-model="form.c_prayer" placeholder="Case Description"></textarea>
                                <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                            </div>
                        </div>
                        
                        <hr></hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Miscellaneous Petition</label>
                                <div class="form-group form-inline-block form-box" style="padding-top: 0px;">
                                    <div class="row misc_pet_row mT10" v-for="(content, index) in form.misc_pet" :key="content.id">
                                        <misc_petition :misc_pet="form.misc_pet" :length="index"></misc_petition>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mT10">
                                            <button class="btn btn-success" @click="addMiscPet($event)">Add</button>
                                            <button class="btn btn-danger" @click="removeMiscPet($event)">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr></hr>
                        <div class="row" style="display:none;">
                            <div class="col-sm-12">
                                <label>Miscellaneous SR</label>
                                <div class="form-group form-inline-block form-box">
                                    <div class="row misc_sr_row mT10" v-for="(content, index) in form.misc_sr" :key="content.id">
                                        <misc_row :misc_sr="form.misc_sr" :length="index"></misc_row>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mT10">
                                            <button class="btn btn-success" @click="addMiscSR($event)">Add</button>
                                            <button class="btn btn-danger" @click="removeMiscSR($event)">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--************************** To be Moved Inside **************************-->
                        <div class="row pt10" style="display:none;">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <datepicker v-model="form.returned" :value="form.returned" placeholder="Date of Return"></datepicker>
                                    <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <datepicker v-model="form.return_expiry" :value="form.return_expiry" placeholder="Date of Expiry"></datepicker>
                                    <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                </div>
                            </div>
                        </div>

                        <div id="representation" class="row" style="display:none;">
                            <hr></hr>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <datepicker v-model="form.represent" :value="form.represent" placeholder="Date of Representation"></datepicker>
                                    <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-sm-12">
                                <label>Connected Case</label>
                                <div class="form-group form-inline-block form-box">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" placeholder="Type" v-model="form.connected">
                                        </div>
                                        <input type="hidden" name="connected" v-model='form.connected'>
                                        <div class="col-sm-6 mT10">
                                            <button class="btn btn-success">Add</button>
                                            <button class="btn btn-danger">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="display:none;">
                            <div class="col-sm-6">
                                <label>Citation</label>
                                <textarea name="citation" class="form-control" v-model="form.address" placeholder="Citation"></textarea>
                                <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                            </div>
                        </div>
                        <div id="disposal_status" v-if="$route.meta.mode === 'edit'">
                            <label>Status</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group select-style">
                                        <select name="status" id="status" class="form-control" v-model="form.status">
                                            <option value="" selected="">Select Any</option>
                                            <option value="Admit">Admit</option>
                                            <option value="Adjourned Admission">Adjourned Admission</option>
                                            <option value="Notice Before Admission">Notice Before Admission</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Status" v-model="form.s_text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Posted on</label>
                                    <datepicker v-model="form.posted_date" :value="form.posted_date" placeholder="DD/MM/YYYY"></datepicker>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Main Case Disposal</label>
                                        <datepicker class="form-control" placeholder="Main Case Disposal" v-model="form.disposal" :value="form.disposal"></datepicker>
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
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Upload File</label>  
                                    <input type="file" name="upload" @change="formData = filesChange($event.target.name, $event.target.files,$event.target.files.length);" accept="image/*" class="form-control" id="uploadFile">
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
    import misc_petition from '../../components/MiscPetition.vue'
    
    //Miscellaneous SR
    Vue.component('misc_row', {
        components:{
            Datepicker,  
        },
        props: ['misc_sr','length'],
        template: '<div><div class="col-sm-3"><input type="text" class="form-control" placeholder="Category" v-model="misc_sr[length].category"></div><div class="col-sm-3"><input type="text" class="form-control" placeholder="SR No" v-model="misc_sr[length].sr_no"></div><div class="col-sm-3"><input type="text" class="form-control" placeholder="Year" v-model="misc_sr[length].year"></div><div class="col-sm-3 datepicker"><datepicker v-model="misc_sr[length].date" :value="misc_sr[length].date" placeholder="DD/MM/YYYY"></datepicker></div></div>',
    });
    //OtherSide Counsel
    Vue.component('other_counsel', {
        props: ['other_counsel','length'],
        template: '<div class="row othercousel_row"><div class="col-sm-6"><input type="text" class="form-control" placeholder="Other Side Counsel" v-model="other_counsel[length].other_counsel"></div><div class="col-sm-6"><input type="text" class="form-control" placeholder="Contact no" v-model="other_counsel[length].contact"></div></div>',
    });
    
    export default {
        name: 'CaseListForm',
        components: {
            Datepicker,
            misc_petition,
        },
        data() {
            return {
                form: {},
                errors: {},
                option: {},
                title: 'Create Case',
                initialize: '/api/caselist/create',
                redirect: '/caselist',
                store: '/api/caselist',
                method: 'post',
                against: { lno: '', lcourt: '', lplace: '', lorder: ''},
                against1: {lno: '', lcourt: '', lplace: '', lorder: ''},
                states: [],
                districts: [],
                courts: [],
                casetypes: [],
                formData: new FormData(),
            }
        },
        beforeMount() {
            this.form['against'] = this.against;
            this.form['against1'] = this.against1;
            if(this.$route.meta.mode === 'edit') {
                this.title = 'Edit';
                this.initialize = '/api/caselist/' + this.$route.params.id + '/edit';
                this.store = '/api/caselist/edit/' + this.$route.params.id;
                this.method = 'post';
            }
            this.fetchData()
        },
        mounted(){
        },
        watch: {
            '$route': 'fetchData',
            form: function(val){
                //this.loadCaseType()
            }
        },
        methods: {
            fetchData() {
                var vm = this
                axios.get(this.initialize)
                    .then(function(response) {
                        Vue.set(vm.$data, 'form', response.data.form)
                        Vue.set(vm.$data, 'option', response.data.option)
                        vm.selectCourt();
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
            getData(url,params,data_var, callback) {
                var vm = this
                axios.get(url+"?"+params)
                    .then(function(response) {
                        Vue.set(vm.$data, data_var, response.data)
                        if(typeof callback === "function"){
                            callback(response.data);
                        }
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
            save() {
                var vm = this;
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                for (var key in this.form){
                    if (this.form.hasOwnProperty(key)) {
                        if(typeof this.form[key] == "object"){
                            this.form[key] = JSON.stringify(this.form[key]);
                        }
                        this.formData.append(key, this.form[key]);
                    }
                }
                axios[this.method](this.store, this.formData, config)
                    .then(function(response) {
                        if(response.data.saved) {
                            vm.$router.push(vm.redirect)
                        }
                    })
                    .catch(function(error) {
                        console.log("Error adding Case : "+error);
                        notify("Error adding Case. Please try after sometime or Contact Technical Support");
                        //Vue.set(vm.$data, 'errors', error.response.data)
                    })
            },
            selectCourt(){
                document.getElementById("district_div").style.display = 'none';
                document.getElementById("court_div").style.display = 'none';
                document.getElementById("casetype_div").style.display = 'none';
                document.getElementById("lowercourt_div").style.display = 'none';
                document.getElementById("bench_div").style.display = 'none';
                document.getElementById("state_div").style.display = 'none';
                //this.form.court_id = '';
                this.form.district = '';
                //this.form.case_type = '';
                this.form.state_id = 31;
                
                if(this.form.court_type_id == "1") //Supreme Court
                {
                    this.getCaseTypes();
                }else if(this.form.court_type_id == "2") //High Court
                {
                    document.getElementById("lowercourt_div").style.display = 'block';
                    this.getListOfCourts();
                }else if(this.form.court_type_id == "3") //Distirct Court
                {
                    document.getElementById("state_div").style.display = 'block';
                    document.getElementById("district_div").style.display = 'block';
                    this.getData('/api/court/getdata','type=state','states');
                    this.getData('/api/court/getdata','type=district&code=31','districts');
                }else if(this.form.court_type_id == "4") //Consumer Court
                {
                    document.getElementById("state_div").style.display = 'block';
                    this.getData('/api/court/getdata','type=state','states');
                    this.getListOfCourts();
                }else if(this.form.court_type_id == "5") //Tribunal
                {
                    this.getListOfCourts();
                }
            },
            getListOfDistricts(){
                document.getElementById("district").style.display = 'block';
                this.getData('/api/court/getdata','type=district&code='+this.form.court_type_id);
            },
            getListOfCourts(){
                var vm = this;
                document.getElementById("court_div").style.display = 'block';
                this.getData('/api/court/getdata','type=court&court_type='+this.form.court_type_id+'&district_code='+this.form.district,'courts', function(){
                    if(vm.form.court_id === undefined){
                        vm.form.court_id = 507;
                    }
                    vm.getCaseTypes();
                });
            },
            getCaseTypes(){
                document.getElementById("casetype_div").style.display = 'block';
                this.getData('/api/court/getdata','type=case_type&court_type='+this.form.court_type_id+'&code='+this.form.court_id,'casetypes');
            },
            addOtherSideCounsel(event){
                this.form.other.push({
                    other_counsel: "",
                    contact: "",
                });
                event.preventDefault();
            },
            removeOtherSideCounsel(){
                if(this.form.other.length !== 1){
                    this.form.other.pop();
                }
                event.preventDefault();
            },
            addMiscSR(event){
                this.form.misc_sr.push({
                    category: "",
                    sr_no: "",
                    year: "",
                    date: "",
                });
                event.preventDefault();
            },
            removeMiscSR(event){
                if(this.form.misc_sr.length !== 1){
                    this.form.misc_sr.pop();
                }
                event.preventDefault();
            },
            addMiscPet(event){
                this.form.misc_pet.push({
                    mpno: "",
                    mpprayer: "",
                    mpdisposal: "",
                    mpreturn: "",
                    mprepresent: "",
                });
                event.preventDefault();
            },
            removeMiscPet(event){
                if(this.form.misc_pet.length !== 1){
                    this.form.misc_pet.pop();
                }
                event.preventDefault();
            },
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
    select{
        height: 38px;
        line-height: 35px;
    }
    #create_case{
        background-color: #eaeaea;
    }
    #create_case > .panel-body{
        width: 50%;
        margin: auto;
        border: 1px solid #efefef;
        margin-top: 30px;
        background-color: #fff;
    }
</style>