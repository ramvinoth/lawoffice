<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title"><h4>{{model.petitioner}} VS {{model.respondant}}</h4></span>
                <div>
                    <router-link :to="'/caselist/' + model.id + '/edit'" class="btn btn-primary btn-sm">Edit</router-link>
                    <button class="btn btn-danger btn-sm" @click="remove">Delete</button>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Court</label>
                        <p>{{model.court_type}}</p>
                    </div>
                    <div class="col-sm-4">
                        <label>Case no</label>
                        <p>{{model.case_no}}</p>
                    </div>
                    <div class="col-sm-4">
                        <label>Filing Date</label>
                        <p>{{model.filing_date}}</p>
                    </div>
                </div>
                <h4 class="page-header">Case Details</h4>

                <div class="row" id="case_info">
                    <div class="col-md-12">
                      <!-- Custom Tabs -->
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
                          <li><a href="#petition" data-toggle="tab">Petitions</a></li>
                          <li><a href="#hearings" data-toggle="tab">Hearings</a></li>
                          <li><a href="#connected" data-toggle="tab">Connected Case</a></li>
                          <li><a href="#documents" data-toggle="tab">Documents</a></li>
                          <li><a href="#result" data-toggle="tab">Result</a></li>
                          <li><a href="#activities" data-toggle="tab">Activities</a></li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="info">
                                <div class="row caseinfo">
                                    <div class="col-sm-4">
                                        <div v-if="model.appear == 'Respondent'">
                                            <label>Vakalath No</label>
                                            <span :title="model.vno">{{model.vno}}</span>
                                        </div>
                                        <div v-if="model.sno === 'Petitioner' || model.sno === 'Appelant'">
                                            <label>SR No</label>
                                            <span :title="model.sno">{{model.sno}}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Client Type</label>
                                            <span :title="model.appear">{{model.appear}}</span>
                                        </div>
                                        <div>
                                            <label>Contact no</label>
                                            <span :title="model.contact">{{model.contact}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Refer By</label>
                                            <span :title="model.refer_by">{{model.refer_by}}</span>
                                        </div>
                                        <div>
                                            <label>Referer Contact</label>
                                            <span :title="model.refer_contact">{{model.refer_contact}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Filing Date</label>
                                            <span :title="model.filing_date">{{model.filing_date}}</span>
                                        </div>
                                        <div>
                                            <label>District</label>
                                            <span :title="model.district">{{model.district}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4" v-for="(other, index) in model.other">
                                        <div>
                                            <label>Other Side Counsel {{index+1}}</label>
                                            <span :title="other.other_counsel">{{other.other_counsel}}</span>
                                        </div>
                                        <div>
                                            <label>Contact</label>
                                            <span :title="other.contact">{{other.contact}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Respondant</label>
                                            <span :title="model.respondant">{{model.respondant}}</span>
                                        </div>
                                        <div>
                                            <label>Priority</label>
                                            <span :title="model.priority">{{model.priority}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="petition">
                                <div class="" v-for="(obj, index) in petition" key="obj.id" :id="'petition_'+obj.id">
                                    <div class="petition_div caseinfo">
                                        <hr v-if="index !== 0"></hr>
                                        <div>
                                            <div class="pet_title">
                                                <div class="pet_number"><h4>Petition {{index+1}}</h4> </div>
                                                <div class="pet_options">
                                                    <div class="btn btn-primary btn-sm pet_edit_btn" @click='editPetition(obj)'><i class="fa fa-pencil"></i></div>
                                                    <div class="btn btn-danger btn-sm pet_delete_btn" @click="removePetition(obj.id)"><i class="fa fa-trash"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>
                                                    <label>SR number</label>
                                                    <span :title="obj.mpno">{{obj.sno}}</span>
                                                </div>
                                                <div>
                                                    <label>Petition no</label>
                                                    <span :title="obj.mpno">{{obj.mpno}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>
                                                    <label>Prayer</label>
                                                    <span :title="obj.mpno">{{obj.mpprayer}}</span>
                                                </div>
                                                <div>
                                                    <label>Disposal date</label>
                                                    <span :title="obj.mpdisposal">{{obj.mpdisposal}}</span>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div>
                                                    <label>Return date</label>
                                                    <span :title="obj.mpreturn">{{obj.mpreturn}}</span>
                                                </div>
                                                <div>
                                                    <label>Representation date</label>
                                                    <span :title="obj.mprepresent">{{obj.mprepresent}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" @click='addPetition'>Add Petition</button>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="hearings">
                                <div class="" v-for="(obj, index) in hearings" key="obj.id" :id="'hearing_'+obj.id">
                                    <div class="hearings_div caseinfo">
                                        <hr v-if="index !== 0"></hr>
                                        <div id="hearing_">
                                            <div class="pet_title">
                                                <div class="pet_number"><h4>Hearing {{index+1}}</h4> </div>
                                                <div class="pet_options">
                                                    <div class="btn btn-success btn-sm pet_delete_btn" @click="viewHearing(obj)"><i class="fa fa-eye"></i></div>
                                                    <div class="btn btn-primary btn-sm pet_edit_btn" @click='editHearing(obj)'><i class="fa fa-pencil"></i></div>
                                                    <div class="btn btn-danger btn-sm pet_delete_btn" @click="removeHearing(obj.id)"><i class="fa fa-trash"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>
                                                    <label>Hearing Date</label>
                                                    <span :title="obj.item">{{obj.cdate}}</span>
                                                </div>
                                                <div>
                                                    <label>Posted on</label>
                                                    <span :title="obj.posted">{{obj.posted}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>
                                                    <label>Item no.</label>
                                                    <span :title="obj.item">{{obj.item}}</span>
                                                </div>
                                                <div>
                                                    <label>Judges</label>
                                                    <span :title="obj.created_at">{{obj.judges}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>
                                                    <label>Remarks</label>
                                                    <span :title="obj.what">{{obj.what}}</span>
                                                </div>
                                                <div>
                                                    <label>Status</label>
                                                    <span :title="obj.status">{{obj.status}}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" @click='addHearing'>Add Hearing</button>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="connected">
                                <div class="" v-for="(obj, index) in connected" key="obj.id" :id="'con_case_'+obj.id">
                                    <div class="con_case_div caseinfo">
                                        <hr v-if="index !== 0"></hr>
                                        <div id="con_case">
                                            <div class="con_case_title">
                                                <div class="con_case_number"><h4>Connected Case {{index+1}}</h4> </div>
                                                <div class="con_case_options">
                                                    <div class="btn btn-primary btn-sm pet_edit_btn" @click='editConCase(obj)'><i class="fa fa-pencil"></i></div>
                                                    <div class="btn btn-danger btn-sm pet_delete_btn" @click="removeConCase(obj.id)"><i class="fa fa-trash"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>
                                                    <label>Case number</label>
                                                    <span :title="obj.con_no">{{obj.con_no}}</span>
                                                </div>
                                                <div>
                                                    <label>SR number</label>
                                                    <span :title="obj.sno">{{obj.sno}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" @click='addConnectedCase' @closePopUp='closeSmallPopUp'>Add Connected Case</button>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="documents">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Upload File</label>  
                                            <input type="file" name="upload" @change="formData = filesChange($event.target.name, $event.target.files,$event.target.files.length);" accept="image/*" class="form-control" id="uploadFile">
                                        </div>
                                    </div>
                                    <button class="btn btn-success" @click="addDocument">Save</button>
                                </div>
                            </div>
                            <div class="tab-pane" id="result">
                                <div class="row caseinfo">
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Citation</label>
                                            <span :title="model.prayer">{{model.citation}}</span>
                                        </div>
                                        <div>
                                            <label>Prayer</label>
                                            <span :title="model.prayer">{{model.prayer}}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Status</label>
                                            <span :title="model.status">{{model.status}}</span>
                                        </div>
                                        <div>
                                            <label>Status text</label>
                                            <span :title="model.s_text">{{model.s_text}}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Posted on</label>
                                            <span :title="model.posted_date">{{model.posted_date}}</span>
                                        </div>
                                        <div>
                                            <label>Main Case Disposal</label>
                                            <span :title="model.disposal">{{model.disposal}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Judge</label>
                                            <span :title="model.by_whom">{{model.result}}</span>
                                        </div>
                                        <div>
                                            <label>Result</label>
                                            <span :title="model.disposal">{{model.result}}</span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="activities">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="timeline">
                                        <!-- timeline time label -->
                                        <div v-for="(value, key, index) in activities">
                                            
                                            <li class="time-label">
                                                <span class="bg-red">
                                                    {{key}}
                                                </span>
                                            </li>
                                            <!-- /.timeline-label -->

                                            <div v-for="(activity, index) in value">
                                            <!-- timeline item -->
                                            <li>
                                                <!-- timeline icon -->
                                                <i class="fa fa-envelope bg-blue"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fa fa-clock-o"></i> {{activity['act_date']}}</span>

                                                    <h3 class="timeline-header"><a href="#">{{activity['act_title']}}</a></h3>

                                                    <div v-if="activity['act_content']" class="timeline-body">
                                                        ... Content goes here
                                                    </div>

                                                    <div class="timeline-footer hide">
                                                        <a class="btn btn-primary btn-xs">...</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- END timeline item -->
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                      </div>
                      <!-- nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>
        <spopup>
            <span class="pop-title" slot="header">{{pop_title}}</span>
            <component :is='currentView' :data='pop_data' :options='pop_option' :mode='pop_mode' :parent='parent_data' :length='0'></component>
        </spopup>
    </div>
</template>
<script>
    import spopup from '../../components/SmallPopUp.vue'
    import petitionForm from '../caselist/petitionForm.vue'
    import connectedCaseForm from '../caselist/connectedCaseForm.vue'
    import hearingForm from '../caselist/Hearing/form.vue'
    import viewHearing from '../caselist/Hearing/show.vue'
    import mixin from '../../mixins/mixin'
    import axios from 'axios'
    export default {
        name: 'CategoryShow',
        props: ['model'],
        mixins: [mixin],
        components: {
            petitionForm,
            connectedCaseForm,
            hearingForm,
            viewHearing,
            spopup
        },
        data() {
            return {
                resource: 'caselist',
                initialize: '/api/caseinfo/create',
                redirect: '/caselist',
                store: '/api/caselist',
                method: 'post',
                currentView: 'petitionForm',
                pop_title: '',
                pop_option: [],
                petition: [],
                hearings: [],
                connected: [],
                activities: [],
                documents: [],
                connected_case: [{con_no : '', sno : '', cid : ''}],
                misc_pet: [{'cid': '', 'sno': '', 'mpno' : '', 'mpprayer' : '', 'mpdisposal' : '', 'mpreturn' : '', 'mprepresent' : ''}],
                case_hearing : [{'case_id': '', 'title': '', 'item' : '', 'cdate' : '', 'posted' : '', 'what' : '', 'to_whom' : '', 'status' : '', 'what' : '', 'judges' : ''}],
                pop_data: [],
                pop_mode: '',
                parent_data: [],
                formData: new FormData(),
            }
        },
        beforeMount() {
            //this.fetchData()
        },
        watch: {
            //'$route': 'fetchData'
        },
        mounted() {
            var vm = this;
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                var target = $(e.target).attr("href") // activated tab
                //if ($(target).is(':empty')) {
                if(target !== '#info' && target !== '#result'){
                    target = target.replace('#', '');
                    vm.fetchData(`api/caseinfo/${target}/show`, `id=${vm.model.id}`, target);
                    vm.misc_pet[0].cid = vm.model.id;
                    vm.misc_pet[0].sno = vm.model.sno;
                }
            });
        },
        methods: {
            remove() {
                var vm = this;
                axios.delete(`api/${this.resource}/${this.model.id}`)
                    .then(function(response) {
                        if (response.data.deleted) {
                            vm.closeMainPopUp();
                            vm.$router.push(vm.redirect)
                        }
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
            
            removePetition(id) {
                var vm = this;
                axios.delete(`api/caseinfo/petition/${id}`)
                    .then(function(response) {
                        if (response.data.deleted) {
                            var child_div = document.getElementById("petition_"+id);
                            child_div.parentNode.removeChild(child_div);
                        }
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
            
            removeConCase(id) {
                var vm = this;
                axios.delete(`api/caseinfo/connected/${id}`)
                    .then(function(response) {
                        if (response.data.deleted) {
                            var child_div = document.getElementById("con_case_"+id);
                            child_div.parentNode.removeChild(child_div);
                        }
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
            
            fetchData(url, params, data_var) {
                var vm = this
                axios.get(url + "?" + params)
                    .then(function(response) {
                        Vue.set(vm.$data, data_var, response.data)
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
            showSmallPopUp(){
                this.$store.commit('set_spopshow',true);  
            },
            closeSmallPopUp(){
                this.$store.commit("set_spopshow", false);
                //document.getElementsByTagName("body")[0].style.overflow = "";
            },
            
            closeMainPopUp(){
                this.$store.commit("set_ispopshow", false);
                document.getElementsByTagName("body")[0].style.overflow = "";
            },
            addPetition(){
                this.misc_pet = [{'cid': '', 'sno': '', 'mpno' : '', 'mpprayer' : '', 'mpdisposal' : '', 'mpreturn' : '', 'mprepresent' : ''}];
                this.misc_pet[0].cid = this.model.id;
                this.misc_pet[0].sno = this.model.sno;
                this.pop_data = this.misc_pet;
                this.pop_mode = 'add';
                this.parent_data = this.petition;
                this.currentView = 'petitionForm';
                this.showSmallPopUp();
            },
            
            addConnectedCase(){
                this.connected_case = [{'con_no' : '', 'sno' : this.model.sno, 'cid' : this.model.id}];
                this.pop_data = this.connected_case;
                this.pop_mode = 'add';
                this.parent_data = this.connected;
                this.currentView = 'connectedCaseForm';
                this.showSmallPopUp();
                
            },
            
            editPetition(obj){
                this.misc_pet[0] = obj;
                this.pop_data = this.misc_pet;
                this.pop_mode = 'edit';
                this.currentView = 'petitionForm';
                this.showSmallPopUp();
            },
            
            editConCase(obj){
                this.connected_case[0] = obj;
                this.pop_data = this.connected_case;
                this.pop_mode = 'edit';
                this.currentView = 'connectedCaseForm';
                this.showSmallPopUp();
            },
            addHearing(){
                this.case_hearing = [{'case_id': '', 'item' : '', 'cdate' : '', 'posted' : '', 'what' : '', 'to_whom' : '', 'status' : '', 'judges' : '', 'created_at' : '', 'updated_at' : ''}];
                this.case_hearing[0].case_id = this.model.id;
                this.case_hearing[0].case_no = this.model.case_no;
                this.pop_data = this.case_hearing;
                this.pop_mode = 'add';
                this.parent_data = this.hearings;
                this.currentView = 'hearingForm';
                this.showSmallPopUp();
            },
            editHearing(obj){
                this.case_hearing[0] = obj;
                this.pop_data = this.case_hearing;
                this.pop_mode = 'edit';
                this.currentView = 'hearingForm';
                this.showSmallPopUp();
            },
            viewHearing(obj){
                this.case_hearing[0] = obj;
                this.case_hearing[0].title = this.model.petitioner+" Vs "+ this.model.respondant;
                this.pop_data = this.case_hearing;
                this.pop_title = 'View hearing';
                this.pop_mode = 'edit';
                this.currentView = 'viewHearing';
                this.showSmallPopUp();
            },
            removeHearing(id){
                var vm = this;
                axios.delete(`api/caseinfo/hearings/${id}`)
                    .then(function(response) {
                        if (response.data.deleted) {
                            var child_div = document.getElementById("hearing_"+id);
                            child_div.parentNode.removeChild(child_div);
                        }
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
            addDocument(){
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                this.formData.append('case_id',this.model.id);
                this.sendAjax('/api/caselist/documents/add','',this.formData,'post', '',function(){
                    
                }, config);
            },
        }
    }

</script>
<style>
    #info>div.row>div{
        margin-top: 15px;
        margin-bottom: 10px;
    }
    #case_info label{
        width: 35%;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }
    #case_info .caseinfo span{
        display: inline-block;
        width: 60%;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
        margin-bottom: 5px;
        padding-left: 5px;
    }
    #case_info label:after{
        content: ":";
        float: right;
    }
    .petition_div, .con_case_div, .hearings_div{
        display: inline-block;
        width: 100%;
        margin-bottom: 20px;
    }
    .pet_title, .con_case_title{
        height: 50px;
    }
    .pet_options, .pet_number, .con_case_options, .con_case_number{
        width: auto;
        margin-right: 15px;
        display: inline-block;
    }
    .pet_edit_btn, .pet_delete_btn{    
        padding: 0px 5px;
        border-radius: 0px;
        margin-bottom: 10px;
    }
    .btn{
        border-radius: 0px;
    }
</style>
