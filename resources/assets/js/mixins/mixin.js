import axios from 'axios'
import alertBox from '../components/AlertBox.vue'
import Hub from '../events/Hub';

module.exports = {
    data(){
        return{
            case_data: [],
        }
    },
    components:{
        alertBox,
    },
    methods: {
        isEmpty(obj){
            for(var key in obj) {
                if(obj.hasOwnProperty(key))
                    return false;
            }
            return true;
        },
        showPopUp(){
            this.$store.commit('set_ispopshow',true);  
        },
        showSmallPopUp() {
            this.$store.commit('set_spopshow', true);
        },
        closeSmallPopUp() {
            this.$store.commit("set_spopshow", false);
            //document.getElementsByTagName("body")[0].style.overflow = "";
        },
        closeMainPopUp() {
            this.$store.commit("set_ispopshow", false);
            document.getElementsByTagName("body")[0].style.overflow = "";
        },
        showSlide() {
            this.$store.commit('set_isslide', true);
        },
        closeSlide(){
            this.$store.commit("set_isslide", false);
        },
        getAuthUserData() {
            return this.$store.getters.auth_user_data;
        },
        setPopCurrentView(currentView){
              this.$store.commit("set_current_view", currentView);
        },
        getPopCurrentView(){
              return this.$store.getters.get_current_view;
        },
        openAlertBox(data, compTitle) {
            Hub.$emit('open-modal');
            Hub.$emit('set-modal-data', data, compTitle);
        },
        sendAjax(url, url_params, payload, method, data_var, callback, config) {
            var vm = this;
            axios[method](url + "?" + url_params, payload, config)
                .then(function(response) {
                    //notify('Success');
                    Vue.set(vm.$data, data_var, response.data);
                    if(typeof callback === 'function'){
                        callback(response);
                    }
                    return  response;
                })
                .catch(function(error) {
                    notify('Error. Please try after sometime');
                    console.log(error);
                    return error;
                })
        },
        loadCase(caseId){
            //this.$router.push('/caselist/' + caseId);
            this.sendAjax('/api/caselist/' + caseId, '', '', 'get', 'case_data');
            this.setPopCurrentView('viewcase');
            this.showPopUp();
        },
        loadHearing(hearingId){
            //this.$router.push('/caselist/' + caseId);
            var vm =this;
            this.sendAjax('/api/hearing/' + hearingId, '', '', 'get', 'case_data', function(){
                vm.setPopCurrentView('viewHearing');
                //this.showPopUp();

                //this.case_hearing[0] = obj;
                //this.case_hearing[0].title = this.model.petitioner+" Vs "+ this.model.respondant;
                vm.pop_data = vm.case_data;
                vm.pop_title = 'View hearing';
                vm.pop_mode = 'edit';
                vm.currentView = 'viewHearing';
                vm.showSmallPopUp(); 
            });
        },
        updateHearing(data){
            var vm =this;
            this.sendAjax('/api/hearing/'+data.id, '', data, 'put', '', function(response){
                console.log("res", response);
                if(response.data.updated) {
                    notify('Hearings Updated');
                }
            });
        },
        editHearingInline(){
            this.pop_mode = 'edit';
            this.currentView = 'hearingForm';
        },
        filesChange: function(name, files, count){
            var formData = new FormData()
            for (var i = 0; i < files.length; i++) {
                let file = files.item(i);
                formData.append('files[' + i + ']', file, file.name);
            }
            return formData;
        },
    }
}