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
                          <li><a href="#hearing" data-toggle="tab">Hearings</a></li>
                          <li><a href="#connected" data-toggle="tab">Connected Case</a></li>
                          <li><a href="#result" data-toggle="tab">Result</a></li>
                          <li><a href="#result" data-toggle="tab">Activities</a></li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="info">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Vakalath No</label>
                                            <span :title="model.vno">{{model.vno}}</span>
                                        </div>
                                        <div>
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
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Created At</label>
                                            <span :title="model.created_at">{{model.created_at}}</span>
                                        </div>
                                        <div>
                                            <label>Updated At</label>
                                            <span :title="model.updated_at">{{model.updated_at}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="petition">
                                <div class="" v-for="(obj, index) in petition" key="obj.id">
                                    <div class="petition_div">
                                        <hr v-if="index !== 0"></hr>
                                        <div id="petition_">
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
                            <div class="tab-pane" id="hearing">

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="connected">
                                <div class="" v-for="(obj, index) in connected" key="obj.id">
                                    <div class="con_case_div">
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
                                                    <span :title="obj.con_no">{{obj.sno}}</span>
                                                </div>
                                                <div>
                                                    <label>SR number</label>
                                                    <span :title="obj.sno">{{obj.mpno}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="result">

                            </div>
                            <!-- /.tab-pane -->
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
            <misc_pet :misc_pet='misc_pet' :length='0'></misc_pet>
            <div id="footer">
                <button class="btn btn-success" @click="savePetiton">Save</button>
                <button class="btn btn-danger" @click="closeSmallPopUp">Cancel</button>
            </div>
        </spopup>
    </div>
</template>
<script>
    import spopup from '../../components/SmallPopUp.vue'
    import misc_pet from '../../components/MiscPetition.vue'
    import axios from 'axios'
    export default {
        name: 'CategoryShow',
        props: ['model'],
        components: {
            misc_pet, 
            spopup
        },
        data() {
            return {
                resource: 'caselist',
                initialize: '/api/caseinfo/create',
                redirect: '/',
                store: '/api/caselist',
                method: 'post',
                petition: [],
                hearing: [],
                connected: [],
                misc_pet: [{'cid': '', 'sno': '', 'mpno' : '', 'mpprayer' : '', 'mpdisposal' : '', 'mpreturn' : '', 'mprepresent' : ''}],
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
                if(target !== '#info'){
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
                        if (response.deleted) {
                            //vm.$router.push(vm.redirect)
                            //this.closeSmallPopUp();
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
            addPetition(){
                this.misc_pet = [{'cid': '', 'sno': '', 'mpno' : '', 'mpprayer' : '', 'mpdisposal' : '', 'mpreturn' : '', 'mprepresent' : ''}];
                this.misc_pet[0].cid = this.model.id;
                this.misc_pet[0].sno = this.model.sno;
                this.showSmallPopUp();
            },
            savePetiton(){
                var vm = this
                axios[this.method]('/api/caseinfo/petition/create', this.misc_pet[0])
                    .then(function(response) {
                        console.log(response.data.saved);
                        if(response.data.saved) {
                            //vm.$router.push(vm.redirect)
                            console.log(response.data.petition);
                            vm.petition.push(response.data.petition);
                            vm.closeSmallPopUp();
                        }
                    })
                    .catch(function(error) {
                        Vue.set(vm.$data, 'errors', error.response.data)
                    })
            },
            editPetition(obj){
                this.misc_pet[0] = obj;
                this.showSmallPopUp();
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
    #case_info>div span{
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
    .petition_div, .con_case_div{
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
