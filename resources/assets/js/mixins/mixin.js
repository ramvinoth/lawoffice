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
        sendAjax(url, params, method, data_var) {
            var vm = this;
            axios[method](url + "?" + params)
                .then(function(response) {
                    Vue.set(vm.$data, data_var, response.data);
                })
                .catch(function(error) {
                    console.log(error)
                })
        },
        loadCase(caseId){
            //this.$router.push('/caselist/' + caseId);
            this.sendAjax('/api/caselist/' + caseId, '', 'get', 'case_data');
            this.setPopCurrentView('viewcase');
            this.showPopUp();
        },
    }
}