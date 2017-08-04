<template>
    <div class="panel panel-default">
        <div class="panel-heading bold">
            {{title}}
        </div>
        <div class="panel-body">
            <form class="form" @submit.prevent="save" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12">
                    <label>Event Type</label>
                        <div class="form-group">
                            <input type="text" placeholder="Event Title" class="form-control" v-model="form.name">
                            <small class="text-danger" v-if="errors.ctype">{{errors.ctype[0]}}</small>
                        </div>
                        <div class="form-group">
                            <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                                <ul class="fc-color-picker" id="color-chooser">
                                    <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                                </ul>
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
    
    export default {
        name: 'EventTypeForm',
        components: {
        },
        props: ['data'],
        data() {
            return {
                form: {},
                errors: {},
                option: {},
                title: 'Edit Event Type',
                initialize: '/api/eventtype/create',
                redirect: '/',
                store: '/api/eventtype',
                method: 'post',
                format: 'dd/MM/yyyy',
                disabled: {},
                eventMsg: null,
            }
        },
        beforeMount() {
            if(this.data.mode === 'edit') {
                this.title = 'Edit'
                this.initialize = '/api/eventtype/' + this.data.id + '/edit'
                this.store = '/api/eventtype/' + this.data.id
                this.method = 'put'
            }
            this.fetchData();
        },
        mounted() {
            var vm = this;
            var currColor = "#3c8dbc"; //Red by default
            //Color chooser button
            var colorChooser = $("#color-chooser-btn");
            $("#color-chooser > li > a").click(function (e) {
              e.preventDefault();
              //Save color
              currColor = $(this).css("color");
              //Add color effect to button
                $("#color-chooser > li > a > i").removeAttr('style');
              $(this).find('i').css({transform: "rotate(30deg)"});
            });
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
