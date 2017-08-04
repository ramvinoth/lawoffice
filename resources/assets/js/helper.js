import axios from 'axios';
var mixin = {
  methods: {
    showSmallPopUp(){
        this.$store.commit('set_spopshow',true);  
    },
    closeSmallPopUp(){
        this.$store.commit("set_spopshow", false);
        //document.getElementsByTagName("body")[0].style.overflow = "";
    },
    closeMainPopUp(){
        this.$store.commit("set_ispopshow", false);
        document.getElementsByTagName("body")[0].style.overflow = "";
    },
    get_auth_user_data() {
        this.$http.get('/get_auth_user_data')
            .then((resp) => {
                this.$store.commit('auth_user_data', resp.body);
                return resp.body;
            })
    },
  }
}