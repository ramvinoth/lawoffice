<template>
    <div></div>
</template>

<script>
    import fullCalendar from "fullcalendar"
    export default{
        props: {
            events: {
              required: true
            },

            editable: {
              type: Boolean,
              required: false,
              default: false
            },

            droppable: {
              type: Boolean,
              required: false,
              default: false
            },
          },

          data: function()
          {
            return {
              cal: $(this.$el)
            }
          },
          mounted: function()
          {
            var self = this;
            self.cal = $(self.$el);
            console.log($(self.$el));


            var args = {
              lang: 'en',
              header: {
                left:   'prev,next today',
                center: 'title',
                right:  'month,agendaWeek,agendaDay'
              },
              height: "auto",
              allDaySlot: false,
              slotEventOverlap: false,
              timeFormat: 'HH:mm',

              events: self.events,

              dayClick: function(date)
                {
                    self.$emit('day::clicked', date);
                    self.cal.fullCalendar('gotoDate', date.start);
                    self.cal.fullCalendar('changeView', 'agendaDay');
              },

              eventClick: function(event)
                {
                        self.$emit('event::clicked', event);
                }
            }

            if (self.editable)
            {
              args.editable = true;
              args.eventResize = function(event)
              {
                self.$emit('event::resized', event);
              }

              args.eventDrop = function(event)
              {
                self.$emit('event::dropped', event);
              }
            }

            if (self.droppable)
            {
              args.droppable = true;
              args.eventReceive = function(event)
              {
                self.$emit('event::received', event);
              }
            }

            this.cal.fullCalendar(args);

          }
    }

</script>