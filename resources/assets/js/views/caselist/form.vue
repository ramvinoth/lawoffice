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
                                    <label>Court</label>
                                <div class="form-group select-style">
                                    <select name="court" id="court" class="form-control" v-model="form.court" v-on:change="loadCaseType">
                                        <option disabled value="">Select Court</option>
                                        <option value="1">High Court</option>
                                        <option value="2">DRT</option>
                                        <option value="3">Consumer Court</option>
                                        <option value="4">District Court</option>
                                        <option value="5">Supreme Court</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Bench</label>
                                <div class="form-group select-style">
                                    <select name="bench" id="bench" class="form-control" v-model="form.bench" placeholder="Select Bench">
                                        <option disabled value="">Select Bench</option>
                                        <option value="Madurai">Madurai</option>
                                        <option value="Madras">Madras</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Case Type</label>
                                <div class="form-group select-style">
                                    <select name="bench" id="bench" class="form-control" v-model="form.case_type">
                                        <option v-for="cases in casetype" :value="cases.value">
                                          {{cases.text}}
                                        </option>
                                    </select>
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
                                        <div class="select-style">
                                        <select name="appear" id="appear" class="form-control" v-model="form.appear">
                                            <option disabled value="">Select Court</option>
                                            <option value="Appellant" selected="">Appellant</option>
                                            <option value="Petitioner">Petitioner</option>
                                            <option value="Respondent">Respondent</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-hr-50">
                                        <label>Contact No</label>
                                        <input type="text" class="form-control" placeholder="Contact no" v-model="form.contact">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>District</label>
                                    <div class="select-style">
                                    <select name="district" id="district" class="form-control" v-model="form.district">
                                        <option disabled value="">Select District</option>
                                        <option value="">Choose District</option>
                                        <option value="THIRUVALLUR">THIRUVALLUR</option>
                                        <option value="CHENNAI">CHENNAI</option>
                                        <option value="KANCHEEPURAM">KANCHEEPURAM</option>
                                        <option value="VELLORE">VELLORE</option>
                                        <option value="KRISHNAGIRI">KRISHNAGIRI</option>
                                        <option value="DHARMAPURI">DHARMAPURI</option>
                                        <option value="TIRUVANNAMALAI">TIRUVANNAMALAI</option>
                                        <option value="VILLUPURAM">VILLUPURAM</option>
                                        <option value="SALEM">SALEM</option>
                                        <option value="NAMAKKAL">NAMAKKAL</option>
                                        <option value="ERODE">ERODE</option>
                                        <option value="THE NILGIRIS">THE NILGIRIS</option>
                                        <option value="COIMBATORE">COIMBATORE</option>
                                        <option value="DINDIGUL">DINDIGUL</option>
                                        <option value="KARUR">KARUR</option>
                                        <option value="TIRUCHIRAPPALLI">TIRUCHIRAPPALLI</option>
                                        <option value="PERAMBALUR">PERAMBALUR</option>
                                        <option value="CUDDALORE">CUDDALORE</option>
                                        <option value="NAGAPATTINAM">NAGAPATTINAM</option>
                                        <option value="THIRUVARUR">THIRUVARUR</option>
                                        <option value="THANJAVUR">THANJAVUR</option>
                                        <option value="PUDUKKOTTAI">PUDUKKOTTAI</option>
                                        <option value="SIVAGANGA">SIVAGANGA</option>
                                        <option value="MADURAI">MADURAI</option>
                                        <option value="THENI">THENI</option>
                                        <option value="VIRDHUNAGAR">VIRDHUNAGAR</option>
                                        <option value="RAMANATHAPURAM">RAMANATHAPURAM</option>
                                        <option value="THOOTHUKKUDI">THOOTHUKKUDI</option>
                                        <option value="TIRUNELVELI">TIRUNELVELI</option>
                                        <option value="KANNIYAKUMARI">KANNIYAKUMARI</option>
                                        <option value="ARIYALUR">ARIYALUR</option>
                                        <option value="TIRUPPUR">TIRUPPUR</option>
                                    </select>
                                    </div>
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
                                    <datepicker v-model="form.filing_date" :value="form.filing_date" placeholder="Date of Filing"></datepicker>
                                    <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <datepicker v-model="form.admission" :value="form.admission" placeholder="Date of Admission"></datepicker>
                                    <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row datepicker">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <datepicker v-model="form.returned" :value="form.returned" placeholder="Date of Return"></datepicker>
                                    <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <datepicker v-model="form.return_expiry" :value="form.return_expiry" placeholder="Date of Expiry"></datepicker>
                                    <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <datepicker v-model="form.represent" :value="form.represent" placeholder="Date of Representation"></datepicker>
                                    <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Refered By</label>
                                    <input type="text" class="form-control" placeholder="Refered By" v-model="form.refer_by">
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
                                    <datepicker v-model="lower_court.order" :value="lower_court.order" placeholder="Order Date"></datepicker>
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
                                    <datepicker v-model="lower_court1.order" :value="lower_court1.order" placeholder="Order Date"></datepicker>
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
                                            <datepicker v-model="misc_sr[0].mdate" :value="misc_sr[0].mdate" placeholder="DD/MM/YYYY"></datepicker>
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
                                            <datepicker v-model="misc_pet.date" :value="misc_pet.date" placeholder="DD/MM/YYYY"></datepicker>
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
                            <div class="col-sm-4 datepicker">
                                <label>Posted on</label>
                                <datepicker v-model="form.posted_date" :value="form.posted_date" placeholder="DD/MM/YYYY"></datepicker>
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
                                    <input type="file" name="upload" @change="filesChange($event.target.name, $event.target.files); fileCount = $event.target.files.length" accept="image/*" class="form-control" id="uploadFile">
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
                highcourt: [
                    {value: '', text: 'Select one'},
                    {value: 'CMA', text: '(CMA) Civil Miscellaneous Appeal'},
                    {value: 'CMSA', text: '(CMSA) Civil Miscellaneous Second Appeal'},
                    {value: 'CRP', text: '(CRP) Civil Revision Petition'},
                    {value: 'Crl-A', text: '(Crl.A) Criminal Appeal'},
                    {value: 'Crl-RC', text: '(Crl.RC) Criminal Revision Petition'},
                    {value: 'Caveat-P', text: '(Caveat.P) Caveat Petition'},
                    {value: 'Crl-OP', text: '(Crl.OP) Criminal Original Petition'},
                    {value: 'Cont-P', text: '(Cont.P) Contempt Petition'},
                    {value: 'Cross-obj', text: '(Cross.obj) Cross Objection'},
                    {value: 'AS', text: '(AS) Appeal Suit'},
                    {value: 'HCP', text: '(HCP) Habeas Corpus Petition'},
                    {value: 'Rev-P', text: '(Rev.P) Review Petition'},
                    {value: 'SA', text: '(SA) Second Appeal'},
                    {value: 'Tr-CMP', text: '(Tr.CMP) Transfer Civil Miscellaneous Petition'},
                    {value: 'WA', text: '(W.A) Writ Appeal'},
                    {value: 'WP', text: '(W.P) Writ Petition'},
                ],
                drt: [
                    {value: '', text: 'Select one'},
                    {value: 'Caveat', text: '(Caveat) Caveat'},
                    {value: 'OA', text: '(OA) OA'},
                    {value: 'SA', text: '(SA) SA'},
                ],
                consumercourt: [
                    {value: '', text: 'Select one'},
                    {value: 'Con-FA', text: '(ConFA) Consumer-FA'},
                    {value: 'Con-OP', text: '(ConOP) Consumer-OP'},
                ],
                districtcourt: [
                    {value: '', text: 'Select one'},
                    {value: 'AS', text: '(AS) Appeal Suit'},
                    {value: 'AROP', text: '(AROP) Arbitration Original Petition'},
                    {value: 'CMA', text: '(CMA) Civil Miscellaneous Appeal'},
                    {value: 'EP', text: '(E.P) Execution Petition'},
                    {value: 'GWOP', text: '(GWOP) Guardian &amp; Wards Original Petition'},
                    {value: 'HMOP', text: '(HMOP) Hindu Marriage Original Petition'},
                    {value: 'IDOP', text: '(IDOP) Indian Diverse Original Petition'},
                    {value: 'MCOP', text: '(MCOP) Motor Accident Claim Original Petition'},
                    {value: 'MHOP', text: '(MHOP) Mental Health Original Petition'},
                    {value: 'OS', text: '(O.S) Original Suit'},
                    {value: 'RCA', text: '(RCA) RCA'},
                    {value: 'RCOP', text: '(RCOP) RCOP'},
                    {value: 'SOP', text: '(SOP) Success Original Petition'},
                ],
                supremecourt: [
                    {value: '', text: 'Select one'},
                    {value: 'Civil-Appeal', text: 'Civil Appeal'},
                    {value: 'Criminal-Appeal', text: 'Criminal Appeal'},
                    {value: 'SLP-Criminal', text: 'SLP Criminal'},
                    {value: 'SLP-Civil', text: 'SLP Civil'},
                ],
                casetype: [],
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
        mounted(){
        },
        watch: {
            '$route': 'fetchData',
            form: function(val){
                this.loadCaseType()
            }
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
            },
            loadCaseType: function(){
                if(this.form.court == "1"){
                    this.casetype = this.highcourt;
                }else if(this.form.court == "2"){
                    this.casetype = this.drt;
                }else if(this.form.court == "3"){
                    this.casetype = this.consumercourt;
                }else if(this.form.court == "4"){
                    this.casetype = this.districtcourt;
                }else if(this.form.court == "5"){
                    this.casetype = this.supremecourt;
                }else{
                    this.casetype = [{'text':'Choose Court', value:''}];
                }
            },
            filesChange: function(name, files){
                
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
</style>