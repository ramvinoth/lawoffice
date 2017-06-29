<template>
        <input />
</template>
<script>
    import Datepicker from 'jquery-datepicker'
    export default{
        name: 'datepicker',
        props: ['value'],
        mounted() {
                    $(this.$el).datepicker({
                      onSelect: (val) => {
                          this.$emit('input', $(this.$el).val())
                      },
                      dateFormat: 'dd/mm/yy',
                      defaultDate: this.value,
                    });
        },
        watch: {
            value: function (value) {
                //console.log(date)
                // update options
                //$(this.$el).datepicker({dateFormat: 'dd/mm/yy'})
            }
        },
        methods: {
            setDate(val) { $(this.$el).val(val); }
        }
    }
</script>