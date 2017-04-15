<template>
    <div class="feed-content-area">
        <div class="media feeds pb20">
            <div class="media-left feed-pic arrow_feed">
                <div class="pr10">
                    <a href="#">
                        <img class="media-object" :src="getUserAvatar.avatar" alt="" width="50px" height="50px">
                    </a>
                </div>
            </div>
            <div class="media-body feedbox">
                <div class="post-area">
                    <textarea rows="3" class="form-control" v-model="content"></textarea>
                    <br>
                    <button class="btn btn-success pull-right" :disabled="not_working" @click="create_post()">
                        Create a post
                    </button>
                <div>
            </div>
        </div>
    </div>
</template>

<script>
      export default {
            mounted() {
            },
            data() {
                  return {
                        content: '',
                        not_working: true
                  }
            },
            methods: {
                  create_post() {
                        this.$http.post('/create/post', { content: this.content })
                            .then((resp) => {
                                  this.content = ''
                                  noty({
                                          type: 'success',
                                          layout: 'bottomLeft',
                                          text: 'Your post has been published !'
                                  })
                                  console.log(resp)
                            })
                  }
            },
            watch: {
                  content() {
                        if(this.content.length > 0)
                              this.not_working = false
                        else
                              this.not_working = true
                  }
            },
            computed: {
                  getUserAvatar() {
                        return this.$store.getters.auth_user_data
                  }
            }

      }
</script>

<style>
    .post-area{
        display: inline-block;
        width: 100%;
        padding: 10px;
    }
</style>