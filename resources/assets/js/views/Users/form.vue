<template>
    <div class="panel panel-default">
        <div class="panel-heading bold">
            {{title}}
        </div>
        <div class="panel-body">
            <form>
                <div class="form-group has-feedback">
                    <input type="text" name="name" v-model="form.name" class="form-control" placeholder="Full name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" name="email" v-model="form.email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" v-model="form.password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <small class="text-danger" v-if="errors.email">{{errors.password[0]}}</small>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password_confirmation" v-model="form.password_confirmation" class="form-control" placeholder="Retype password">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    <small class="text-danger" v-if="errors.email">{{errors.password_confirmation[0]}}</small>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="button" @click="addUser" class="btn btn-primary btn-block btn-flat">Add User</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'
    import mixin from '../../mixins/mixin'
    
    export default {
        name: 'UserForm',
        mixins: [mixin], 
        components: {
        },
        props: ['data'],
        data() {
            return {
                form: {org_id: '', name: '', email: '', password: '', password_confirmation: ''},
                errors: {},
                option: {},
                title: 'Add New User',
                initialize: '/api/users/create',
                redirect: '/',
                store: '/api/users',
                method: 'post',
                format: 'dd/MM/yyyy',
                disabled: {},
                eventMsg: null,
            }
        },
        beforeMount() {
            if(this.data.mode === 'edit') {
                this.title = 'Edit'
                this.initialize = '/api/users/' + this.data.id + '/edit'
                this.store = '/api/users/' + this.data.id
                this.method = 'put'
            }
            this.fetchData();
        },
        mounted() {
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
            addUser(){
                var vm = this;
                this.form['org_id'] = this.getAuthUserData.org_id;
                axios.post('/register',this.form)
                    .then(response =>{
                        console.log(response);
                    })
                    .catch(function(error) {
                        Vue.set(vm.$data, 'errors', error.response.data)
                    })
            }
        }
    }
</script>
