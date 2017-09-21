<template>
    <div>
        <section class="content-header">
            <div class="user-header">
                <span class="header-text">Documents</span>
                <div class="fr">
                    <button class="btn btn-primary hide" @click="uploadDoc">Upload</button>
                </div>
            </div>
        </section>
        <section class="content">
            <div v-if="docs.length !== 0">
            <div class="col-sm-2" v-for="(doc, index) in docs">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div class="attach-img-holder"><img class="img-responsive" :src="doc.path" alt="Case Document"></div>
                        <h3 class="profile-username text-center oflowEllipsis" :title="doc.name" style="font-size: 1em;">{{doc.name}} - {{doc.case_id}}</h3>
                        <div class="hide" style="height: 20px;">
                            <div class="fl pointer"><i class="fa fa-edit"></i></div>
                            <div v-if="authuser.role.role_id == 1" class="fr pointer"><i class="fa fa-trash"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="nodata-container" v-else>
                <div>No Documents Found. Upload some files in case.
                </div>
            </div>
        </section>
        <slide>
            <component :is="currentView" :data="compdata"></component>
        </slide>
    </div>
</template>

<script>
    import popMixin from '../../mixins/mixin'
    import addDoc from "../documents/form.vue"
    import viewDoc from "../documents/show.vue"
    import slide from "../../components/Slide.vue"
    export default{
        name: "DocumentIndex",
        mixins: [ popMixin ],
        components: {addDoc, viewDoc, slide},
        data(){
            return{
                docs: [],
                currentView: '',
                compdata: '',
                authuser: {'role':{}},
            }  
        },
        beforeMount(){
            var vm = this;
            this.sendAjax('api/documents','', '', 'get','',function(response){vm.setDocVar(response.data)});
            this.sendAjax('get_auth_user_data','', '', 'get','authuser');
        },
        methods:{
            setDocVar(docs){
                this.docs = docs;
            },
            uploadDoc() {
                this.currentView = 'addDoc';
                this.showSlide();
            },
            viewDoc(){
                
                this.currentView = 'viewDoc';
                this.showSlide();
            },
            deleteDoc(){
                
            }
        }
    }

</script>

<style>
    .user-header{
        display: inline-block;
        width: 100%;
        height: 50px;
    }
    .user-header .header-text{
         font-size: 2em;
    }
    .attach-img-holder{
        height: 100px;
        overflow: hidden;
    }
</style>