<template>
        <input class="form-control" />
</template>
<script>
    import Datepicker from 'bootstrap-datepicker'
    export default {
        name: 'datepicker',
        props: ['value'],
        mounted() {
            var vm = this;
            $(function() {
                $(vm.$el).datepicker({
                    autoclose: true,
                    format: 'dd/mm/yyyy',
                    todayHighlight: true,
                }).on('changeDate', function(e) {
                    //alert('date has changed!');
                    vm.$emit('input', $(vm.$el).val())
                });
            });
        },
        watch: {
            value: function(value) {
                //console.log(date)
                // update options
                $(this.$el).datepicker({
                    dateFormat: 'dd/mm/yy'
                })
            }
        },
        methods: {
            setDate(val) {
                $(this.$el).val(val);
            }
        }
    }
</script>