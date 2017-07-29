<template>
    <div id="calendar_div" class="" style="height:100vh">
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h4 class="box-title">Draggable Events</h4>
                        </div>
                        <div class="box-body">
                            <!-- the events -->
                            <div id="external-events">
                                <div v-for="type in eventTypes" class="external-event" v-bind:id="'eventtype_'+type.id" v-bind:style="{ background: type.color, color: '#fff'}">
                                    <span>{{type.name}}</span>
                                    <span class="fr pointer fs12px ml5" @click="removeEventType(type.id)">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                    <span class="fr pointer fs12px" @click="editEventType(type.id)">
                                        <i class="ion ion-edit"></i>
                                    </span>
                                </div>
                                <div class="checkbox" style="display:none;">
                                    <label for="drop-remove">
                                        <input type="checkbox" id="drop-remove">
                                        remove after drop
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Event</h3>
                        </div>
                        <div class="box-body">
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
                            <!-- /btn-group -->
                            <div class="input-group">
                                <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                                <div class="input-group-btn">
                                    <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
                                </div>
                                <!-- /btn-group -->
                            </div>
                            <!-- /input-group -->
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-body no-padding">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <slide>
                <component :is="currentView" :data="compdata"></component>
            </slide>
        </section>
        <!-- /.content -->
    </div>
</template>

<script>    
import axios from "axios"
import fullCalendar from "fullcalendar"
import createEvent from "../event/form.vue"
import createEventType from "../eventType/form.vue"
import slide from "../../components/Slide.vue"
    
export default{
    name: 'CalendarIndex',
    components:{
        'create-event': createEvent,
        'eventtype_form': createEventType,
        //mpopup,
        slide
    },
    data(){
        return{
            initialize: '/api/calendar/',
            eventTypes: [],
            events: [],
            currentView: 'create-event',
            compdata: {'mode' : '', 'id' : ''},
        }
    },
    watch:{
        events: function(){
            $('#calendar').fullCalendar('addEventSource', this.events, true);
        }
    },
    beforeMount() {
        if(this.$route.meta.mode === 'edit') {
            this.title = 'Edit'
            this.initialize = '/api/event/' + this.$route.params.id + '/edit'
            this.store = '/api/event/' + this.$route.params.id
            this.method = 'put'
        }
        this.fetchData('/api/event/','events');
        this.fetchData('/api/eventtype/','eventTypes').then((response) => {
            this.ini_events($('#external-events div.external-event')); // gets here when the promise is resolved
        }, (error) => {
            console.error(error); // gets here when the promise is rejected
        });
        //this.fetchData('/api/eventtype/getEventTypes','eventTypes');
    },
    mounted(){
        var vm =this;
        $(function(){
            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date();
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
            $('#calendar').fullCalendar({
              header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
              },
              buttonText: {
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
              },
              //Random default events
              events: vm.events,
              editable: true,
              droppable: true, // this allows things to be dropped onto the calendar !!!
              drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                copiedEventObject.backgroundColor = $(this).css("background-color");
                copiedEventObject.borderColor = $(this).css("border-color");

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                  // if so, remove the element from the "Draggable Events" list
                  $(this).remove();
                }

              },
              dayClick: function (date, jsEvent, view) {
                  $(".fc-state-highlight").removeClass("fc-state-highlight");
                  $(jsEvent.target).addClass("fc-state-highlight"); 
                  vm.showSlide();
               }
            });
            /*END-----------------------------------------------------------------*/


            /* ADDING EVENTS  
            -----------------------------------------------------------------*/

            var currColor = "#3c8dbc"; //Red by default
            //Color chooser button
            var colorChooser = $("#color-chooser-btn");
            $("#color-chooser > li > a").click(function (e) {
              e.preventDefault();
              //Save color
              currColor = $(this).css("color");
              //Add color effect to button
              $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
            });
            $("#add-new-event").click(function (e) {
              e.preventDefault();
              //Get value and make sure it is not null
              var val = $("#new-event").val();
              if (val.length == 0) {
                return;
              }
                if(curColor == ''){
                    curColor = '#00c0ef';
                }
                var params = 'name='+val+'&color='+currColor;
                vm.saveData('/api/eventtype/',params).then((response) => {
                    //this.ini_events($('#external-events div.external-event')); // gets here when the promise is resolved
                }, (error) => {
                    console.error(error); // gets here when the promise is rejected
                    return;
                });
              //Create events
              var event = $("<div />");
              event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
              event.html(val);
              $('#external-events').prepend(event);

              //Add draggable funtionality
              vm.ini_events(event);

              //Remove event from text input
              $("#new-event").val("");
            });
            /*END-----------------------------------------------------------------*/
        });

    },
    methods: {
        remove(url) {
                var vm = this;
                axios.delete(url)
                    .then(function(response) {
                        if (response.data.deleted) {
                            //vm.$router.push(vm.redirect)
                        }
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
        },
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
        saveData(url, params) {
            return new Promise((resolve, reject) => {
                var vm = this
                axios.post(url+"?"+params)
                    .then(function(response) {
                        //Vue.set(vm.$data, data_var , response.data);
                        resolve(response); // the request was successfull
                    })
                    .catch(function(error) {
                        console.log(error);
                        reject(error); // the request failed
                    })
            });
        },
        showPopUp(){
            this.$store.commit('set_ispopshow', true);  
        },
        showSlide(){
            this.$store.commit('set_isslide', true);
        },
        /* initialize the external events
         -----------------------------------------------------------------*/
        ini_events(ele) {
          ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
              title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
              zIndex: 1070,
              revert: true, // will cause the event to go back to its
              revertDuration: 0  //  original position after the drag
            });

          });
        },
        /*END-----------------------------------------------------------------*/
        editEventType(id){
            this.compdata.mode = 'edit';
            this.compdata.id = id;
            this.currentView = 'eventtype_form';
            this.showSlide();
        },
        
        removeEventType(id){
            this.remove('/api/eventtype/'+id);
            this.removeElement('eventtype_'+id);
        },
        removeElement(id){
            var elem = document.getElementById(id);
            elem.parentElement.removeChild(elem);
        }
    },
}

</script>
<style>
@import '~fullcalendar/dist/fullcalendar.css';
</style>