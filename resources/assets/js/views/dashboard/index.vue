<template>
    <!-- Content Wrapper. Contains page content -->
    <div class="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row hide">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{count_data['all_cases']}}</h3>

                            <p>Total Cases</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>44</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion-android-clipboard"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Total Cases</span>
                  <span class="info-box-number">{{count_data['all_cases']}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion-alert-circled"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pending Cases</span>
                  <span class="info-box-number">{{count_data['all_pending']}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Events</span>
                  <span class="info-box-number">{{count_data['all_events']}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">New Members</span>
                  <span class="info-box-number">2</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Latest Cases</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Collapse" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div v-if="latest_cases.length > 0" class="table-responsive h300px">
                                        <table class="table no-margin">
                                            <thead>
                                                <tr>
                                                    <th>Case no</th>
                                                    <th>Case Title</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(caselist, index) in latest_cases">
                                                    <td><a href="javascript:;" @click="loadCase(caselist.id)">{{caselist.case_no}}</a></td>
                                                    <td v-if="caselist.case_title !== '' && caselist.case_title !== 'None'">{{caselist.case_title}}</td>
                                                    <td v-else>{{caselist.petitioner}}</td>
                                                    <td>
                                                        <span v-if="caselist.status !== ''" class="label label-success">{{caselist.status}}</span>
                                                        <span v-else class="label label-danger">Pending</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div v-else class="text-center h300px">
                                        <div class="emptycont">
                                            <i class="ion ion-android-clipboard fs5em"></i>
                                            <div class="mt5 mb5">There are no new case. Go ahead and add some</div>
                                            <button class="btn btn-success"><a href="#/caselist/create" class="" style="color:#fff">Create Case</a></button>
                                        </div>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <router-link to="caselist/create" class="btn btn-sm btn-info btn-flat pull-left">Add New Case</router-link>
                                    <router-link to="/caselist" class="btn btn-sm btn-default btn-flat pull-right">View All Cases</router-link>
                                </div>
                                <!-- /.box-footer -->
                            </div>
                            <!-- /.box -->
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Today's Events</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Collapse" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div v-if="todays_events.length > 0" class="table-responsive h300px">
                                        <table class="table no-margin">
                                            <thead>
                                                <tr>
                                                    <th>Event title</th>
                                                    <th>Start</th>
                                                    <th>End</th>
                                                    <th>Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(event, index) in todays_events">
                                                    <td>{{event.title}}</td>
                                                    <td>{{event.start}}</td>
                                                    <td>{{event.end}}</td>
                                                    <td>{{event.type_name}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div v-else class="text-center h300px">
                                        <div class="emptycont">
                                            <i class="ion ion-ios-calendar-outline fs5em"></i>
                                            <div>There are no Events for today</div>
                                        </div>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <router-link to="/create" class="btn btn-sm btn-info btn-flat pull-left hide">Add New Event</router-link>
                                    <router-link to="/calendar" class="btn btn-sm btn-default btn-flat pull-right">View All Events</router-link>
                                </div>
                                <!-- /.box-footer -->
                            </div>
                            <!-- /.box -->
                </section>
                <section class="col-lg-5 connectedSortable">
                    <!-- Calendar -->
                        <div class="box box-solid bg-green-gradient">
                            <div class="box-header">
                                <i class="fa fa-calendar"></i>

                                <h3 class="box-title">Calendar</h3>
                                <!-- tools box -->
                                <div class="pull-right box-tools">
                                    <!-- button with a dropdown -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li><a href="#/calendar/addevent">Add new event</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#/calendar">View calendar</a></li>
                                        </ul>
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <!--The calendar -->
                                <div id="calendar" style="width: 100%"></div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Case Status</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Collapse" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div v-if="count_data['all_cases'] > 0" id="chartdiv" class="">
                                    
                                </div>
                                <div v-else class="text-center h300px">
                                    <div class="emptycont">
                                        <i class="ion-ios-speedometer fs5em"></i>
                                        <div>No Available Data</div>
                                    </div>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                            <!-- /.box-footer -->
                        </div>
                            <!-- /.box -->
                </section>
                </div>
        </section>
        <mpopup><viewcase :model="case_data"></viewcase></mpopup>
    </div>
</template>

<script>
    import datepicker from 'bootstrap-datepicker'
    import axios from 'axios'
    import mpopup from '../../components/PopUp.vue'
    import viewcase from '../caselist/show.vue'
    
    export default{
        name:'DashboardIndex',
        data(){
            return{
                latest_cases: [],
                case_data: [],
                count_data: [],
                todays_events: [],
                case_status_count: [],
                chartData:{},
            }
        },
        components:{
            mpopup,
            viewcase
        },
        mounted(){
            var vm =this;
            $(function(){
                $(".connectedSortable").sortable({
                    placeholder: "sort-highlight",
                    connectWith: ".connectedSortable",
                    handle: ".box-header, .nav-tabs",
                    forcePlaceholderSize: true,
                    zIndex: 999999
                  });
                $("#calendar").datepicker({
                    todayHighlight: true,
                }); 
            });
            this.fetchData('api/dashboard','action=getlatestcases','latest_cases');
            this.fetchData('api/dashboard','action=gettodaysevents','todays_events');
            this.fetchData('api/dashboard','action=getcount','count_data');
            
            let myFirstPromise = this.fetchData('api/dashboard','action=getcasestatus','case_status_count');
            myFirstPromise.then(function(successMsg){
                
                vm.chartData = {
                        "type": "pie",
                        "theme": "light",
                        "dataProvider": [
                        ],
                        "valueField": "value",
                        "titleField": "title",
                        "outlineAlpha": 0.4,
                        "depth3D": 15,
                        "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                        "angle": 30,
                        "export": {
                            "enabled": true
                        },
                        "labelsEnabled": false,
                      "autoMargins": false,
                      "marginTop": 15,
                      "marginBottom": 15,
                      "marginLeft": 15,
                      "marginRight": 15,
                      "pullOutRadius": 15,
                    }
                    for(var i=vm.case_status_count.length-1; i >= 0; i--){
                        var status = vm.case_status_count[i].status;
                        var count = vm.case_status_count[i].count; 
                        var Obj = {'title' : status, 'value': count};
                        vm.chartData.dataProvider.push(Obj);
                    }
                    console.log(vm.chartData);
                    var chart = AmCharts.makeChart( "chartdiv", vm.chartData);
            });
            /*
            $(document).ready(function() { 
                var chart = AmCharts.makeChart( "chartdiv", vm.chartData);
            });
            */
        },
        methods:{
            fetchData(url, params, data_var) {
                var vm = this
                return new Promise( /* executor */ function(resolve, reject) {
                    axios.get(url + "?" + params)
                        .then(function(response) {
                            Vue.set(vm.$data, data_var, response.data);
                            resolve('success');
                        })
                        .catch(function(error) {
                            console.log(error)
                        })
                });
            },
            loadCase(caseId){
                //this.$router.push('/caselist/' + caseId);
                this.fetchData('/api/caselist/' + caseId,'','case_data');
                this.showPopUp();
            },
            showPopUp(){
                this.$store.commit('set_ispopshow',true);  
            },
        }
    }
</script>
<style src="../../../../../public/plugins/datepicker/datepicker3.css"></style>

<style>
    .ui-sortable-handle{
        cursor: move;
    }
    #chartdiv {
        height: 300px;
    }
</style>