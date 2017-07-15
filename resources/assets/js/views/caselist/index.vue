<template>
    <div>
        <data-viewer :source="source" :thead="thead" :filter="filter" :create="create" :title="title" :params="params">
            <template scope="props">
                <tr @click="loadCase(props.item.id)">
                    <td>{{props.item.id}}</td>
                    <td>{{props.item.sno}}</td>
                    <td>{{props.item.case_type}}</td>
                    <td>{{props.item.vno}}</td>
                    <td>{{props.item.petitioner}}</td>
                    <td>{{props.item.respondant}}</td>
                    <td>{{props.item.refer_by}}</td>
                </tr>
            </template>
        </data-viewer>
        <mpopup><viewcase :model="case_data"></viewcase></mpopup>
    </div>
</template>
<script>
    import DataViewer from '../../components/DataViewer.vue'
    import mpopup from '../../components/PopUp.vue'
    import viewcase from '../caselist/show.vue'
    import axios from 'axios'

    export default {
        name: 'CaseListIndex',
        data() {
            return {
                title: 'CaseList',
                source: '/api/caselist',
                create: '/caselist/create',
                thead: [
                    {title: 'SNO', key: 'id', sort: true},
                    {title: 'SR.NO', key: 'srno', sort: true},
                    {title: 'CASE TYPE', key: 'case_type', sort: true},
                    {title: 'CASE NO', key: 'case_no', sort: true},
                    {title: 'PETITIONER', key: 'petitioner', sort: true},
                    {title: 'RESPONDANT', key: 'respondant', sort: true},
                    {title: 'REFERED BY', key: 'refered_by', sort: true},
                ],
                filter: [
                    'id', 'court', 'bench', 'sno', 'vno', 'case_type', 'filing_date', 'admission', 'petitioner', 'respondant', 'appear', 'contact', 'no_of', 'refer_by', 'refer_contact', 'refer_to', 'to_contact', 'district', 'c_prayer', 'citation', 'status', 's_text', 'disposal', 'expiry_date', 'by_whom', 'category', 'case_no', 'against', 'against1', 'mcdisposal', 'mcjudge', 'judge', 'main_petitioner', 'posted_date', 'mpno', 'other', 'crime_no', 'police_st', 'loan', 'bank', 'branch', 'loan_cat', 'possession', 'sale', 'upload', 'returned', 'represent', 'present', 'return_expiry', 'result', 'priority'
                ],
                params: {
                    column: 'id',
                    direction: 'desc',
                    per_page: 25,
                    page: 1,
                    search_column: 'id',
                    search_operator: 'equal_to',
                    search_query_1: '',
                    search_query_2: ''
                },
                case_data: [],
            }
        },
        components: {
            DataViewer,
            mpopup,
            viewcase
        },
        methods:{
            fetchData(url, data_var) {
                return new Promise((resolve, reject) => {
                    var vm = this
                    axios.get(url)
                        .then(function(response) {
                            Vue.set(vm.$data, data_var , response.data);
                            resolve(response); // the request was successfull
                        })
                        .catch(function(error) {
                            console.log(error);
                            reject(error); // the request failed
                        })
                });
            },
            loadCase(caseId){
                //this.$router.push('/caselist/' + caseId);
                this.fetchData('/api/caselist/' + caseId,'case_data');
                this.showPopUp();
            },
            showPopUp(){
                this.$store.commit('set_ispopshow',true);  
            },
        }
    }
</script>