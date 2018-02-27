<template>
<div>
    <div class="form-group form-inline-block form-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group" v-if="data[length].title">
                    <span class="span-label">CASE TITLE</span>
                    <div class="spopview-content" v-if="data[length].title !== ''">{{data[length].title}}</div>
                    <div class="spopview-content" v-else>-</div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <span class="span-label">CASE NUMBER</span>
                    <div class="spopview-content" v-if="data[length].case_id !== '' && data[length].case_id !== '-1'">{{data[length].case_no}}</div>
                    <div class="spopview-content" v-else>-</div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <span class="span-label">ITEM NUMBER</span>
                    <div class="spopview-content" v-if="data[length].item !== ''">{{data[length].item}}</div>
                    <div class="spopview-content" v-else>-</div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <span class="span-label">HEARING DATE</span>
                    <div class="spopview-content" v-if="data[length].posted !== ''">{{data[length].posted}}</div>
                    <div class="spopview-content" v-else>-</div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <span class="span-label">STATUS</span>
                    <div class="spopview-content" v-if="data[length].status !== ''">{{data[length].status}}</div>
                    <div class="spopview-content" v-else>-</div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <span class="span-label">REMARK</span>
                    <div class="spopview-content" v-if="data[length].what !== ''">{{data[length].what}}</div>
                    <div v-else>-</div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <span class="span-label">JUDGES</span>
                    <div class="spopview-content" v-if="data[length].judges !== ''">{{data[length].judges}}</div>
                    <div class="spopview-content" v-else>-</div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
    import axios from 'axios'
    export default {
        name: 'ViewHearing',
        components:{
            
        },
        props: ['data', 'length', 'mode', 'parent'],
        data() {
            return{
                resource: 'hearing',
                initialize: '/api/hearing/',
                redirect: '/',
                store: '/api/hearing',
                method: 'post',
            }
        },
        methods: {
            closeSmallPopUp(){
                this.$store.commit("set_spopshow", false);
            },
        }
    }
</script>