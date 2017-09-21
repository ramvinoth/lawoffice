<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Upload File</label>  
                    <input type="file" name="upload" @change="filesChange($event.target.name, $event.target.files,$event.target.files.length);" accept="image/*" class="form-control" id="uploadFile">
                </div>
            </div>
        </div>
        <button class="btn btn-success">Save</button>
    </div>
</template>
<script>
    import mixin from '../../mixins/mixin'
export default{
    name: 'DocsForm',
    mixins: [ mixin ],
    data(){
        return{
            caselist: [],
            uploadFiles: [],
        }
    },
    beforeMount(){
        this.sendAjax('api/caselist/cases','','','get',this.caselist,null);
    },
    methods:{
        saveDocument(){
            
        },
        filesChange: function(name, files, count){
            this.uploadFiles = new FormData();
            for (var i = 0; i < files.length; i++) {
                let file = files.item(i);
                this.uploadFiles.append('files[' + i + ']', file, file.name);
            }
        },
    }
}
</script>