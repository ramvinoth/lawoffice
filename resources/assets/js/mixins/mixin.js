import axios from 'axios'
module.exports = {    
    methods: {
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
            return this.$store.getters.auth_user_data
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
    }
}