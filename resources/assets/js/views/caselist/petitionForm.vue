<template>
<div class="row">
    <div class="col-sm-12">
        <label>Petition {{length+1}}</label>
        <div class="form-group form-inline-block form-box">
            <div class="row">
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="MP No" v-model="misc_pet[length].mpno">
                </div>
            </div>
            <div class="row mT10">
                <div class="col-sm-6">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="MP Prayer" v-model="misc_pet[length].mpprayer"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="MP Disposal Date" v-model="misc_pet[length].mpdisposal">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="MP Date of Returned" v-model="misc_pet[length].mpreturn">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="MP Date of Re-Presented" v-model="misc_pet[length].mprepresent">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
    import Datepicker from '../../components/DatePicker.vue'
    export default {
        name: 'PetitionForm',
        components: [Datepicker],
        props: ['case_data'],
        mounted() {
            if(this.case_data.petition == undefined || this.case_data.petition == ''){
                this.case_data.petition = ['category' => '', 'sr_no' => '', 'year' => '', 'date' => '',]
            }
        },
    }
</script>