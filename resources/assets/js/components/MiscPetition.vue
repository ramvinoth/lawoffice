<template>
    <div>
        <label>Petition {{length+1}}</label>
        <div class="form-group form-inline-block form-box">
            <div class="row">
                <div class="col-sm-6">
                    <div class="select-style">
                        <select name="mptype" class="form-control" v-model="misc_pet[length].mptype" placeholder="MP Type">
                            <option value="1">CMP</option>
                            <option value="2">CRL MP</option>
                            <option value="3">WRIT MP</option>
                            <option value="4">Sub Application</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="MP No" v-model="misc_pet[length].mpno">
                </div>
            </div>
            <div class="row mT10">
                <div class="col-sm-6">
                    <div class="form-group">
                        <textarea class="form-control medium-textarea" placeholder="MP Prayer" v-model="misc_pet[length].mpprayer"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="MP Filing Date" v-model="misc_pet[length].mpfiling">
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
</template>

<script>
    import Datepicker from '../components/DatePicker.vue'
    export default{
        name: "misc-petition",
        components: {
            Datepicker,
        },
        props: ['misc_pet','length'],
    }
</script>