<template>
    <li class="notify-bell">
        <a href="#" @click="get_notifications()">
            <i class="fa fa-bell fs23rem"></i>
            <span class="badge" v-if="all_nots_count > 0">{{ all_nots_count }}</span>
        </a>
        <div id="notifications" class=""></div>
    </li>
</template>

<script>
      export default {
            mounted() {
                  this.get_unread()
            },
            data: function() {
                return {
                    noti_result: ''
                }
            },
            methods: {
                  get_unread() {
                        this.$http.get('/get_unread')
                            .then( (nots) => {
                                  nots.body.forEach( (not) => {
                                        this.$store.commit('add_not', not)
                                  })
                            })
                  },
                  get_notifications(){
                    this.$http.get('/notifications')
                        .then( (resp) => {
                            this.noti_result = resp.body;
                            $('#notifications').append(this.noti_result);
                        })
                  }
            },
            computed: {
                  all_nots_count() {
                        return this.$store.getters.all_nots_count
                  }
            }
      }
</script>

<style>
    .badge{
        position: absolute;
        top: 2px;
        left: 8px;
        font-size: 9px;
        color: #fff;
        background-color: #ff6f09;  
    }
    .notify-bell{
        position: relative;
        padding: 11px 10px;
    }
    .notify-bell a{
        padding: 0px !important;
    }
    #notifications{
        position: absolute;
        width: 400px;
        right: 0px;
        top: 50px;
    }
    #notifications .up-arrow:before{
        background: none repeat scroll 0 0 #f5f5f5;
    }
</style>