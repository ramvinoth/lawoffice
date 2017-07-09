<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">{{model.petitioner}} VS {{model.respondant}}</span>
            <div>
                <router-link :to="'/caselist/' + model.id + '/edit'" class="btn btn-primary btn-sm">Edit</router-link>
                <button class="btn btn-danger btn-sm" @click="remove">Delete</button>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <label>Court</label>
                    <p>{{model.court}}</p>
                    <label>Case no</label>
                    <p>{{model.case_no}}</p>
                </div>
                <div class="col-sm-4">
                    <label>Filing Date</label>
                    <p>{{model.filing_date}}</p>
                    <label>Refer By</label>
                    <p>{{model.refer_by}}</p>
                </div>
                <div class="col-sm-4">
                    <label>Respondant</label>
                    <p>{{model.respondant}}</p>
                    <label>Created At</label>
                    <p>{{model.created_at}}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'
    export default {
        name: 'CategoryShow',
        props: ['model'],
        data() {
            return {
                resource: 'caselist',
                redirect: '/'
            }
        },
        beforeMount() {
            //this.fetchData()
        },
        watch: {
            '$route': 'fetchData'
        },
        methods: {
            remove() {
                var vm = this;
                axios.delete(`api/${this.resource}/${this.model.id}`)
                    .then(function(response) {
                        if(response.data.deleted) {
                            vm.$router.push(vm.redirect)
                        }
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            },
            fetchData() {
                var vm = this
                axios.get(`/api/${this.resource}/${this.$route.params.id}`)
                    .then(function(response) {
                        Vue.set(vm.$data, 'model', response.data.model)
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            }
        }
    }
</script>