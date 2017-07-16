<template>
    <div class="panel panel-default">
        <div class="panel-heading bold">
            {{title}}
        </div>
        <div class="panel-body">
            <form class="form" @submit.prevent="save" enctype="multipart/form-data">
                <div class="row">
                    <!-- First Column -->
                    <div class="col-sm-12">
                        <label>Event</label>
                        <div class="row">
                            <div class="col-sm-12">
                                    <input type="text" placeholder="Event Title" class="form-control" v-model="form.title">
                                    <small class="text-danger" v-if="errors.ctype">{{errors.ctype[0]}}</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <datepicker :value="form.start" v-model="form.start" placeholder="DD/MM/YYYY"></datepicker>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <datepicker :value="form.end" v-model="form.end" placeholder="DD/MM/YYYY"></datepicker>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Event type</label>
                                    <select id="type_id" name="type_id" class="form-control" v-model="form.type_id">
                                        <option disabled value="">Select Event Type</option>
                                        <option v-for="type in option.event_types" :value="type.id">
                                              {{type.name}}
                                        </option>
                                    </select>
                                    <small class="text-danger" v-if="errors.item">{{errors.item[0]}}</small>
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
        name: 'EventForm',
        components: {
            Datepicker
        },
        data() {
            return {
                form: {},
                errors: {},
                option: {},
                title: 'Create Event',
                initialize: '/api/event/create',
                redirect: '/',
                store: '/api/event',
                method: 'post',
                format: 'dd/MM/yyyy',
                disabled: {},
                eventMsg: null,
                state: state,
            }
        },
        beforeMount() {
            if(this.$route.meta.mode === 'edit') {
                this.title = 'Edit'
                this.initialize = '/api/event/' + this.$route.params.id + '/edit'
                this.store = '/api/event/' + this.$route.params.id
                this.method = 'put'
            }
            this.fetchData();
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
        }
    }
</script>
