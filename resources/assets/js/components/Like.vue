<template>
    <span class="link-black text-sm" v-if="!auth_user_likes_post" @click="like()">
        <i class="fa fa-thumbs-o-up margin-r-5"></i><span class="like">Like</span>
    </span>
    <span class="link-black text-sm" v-else @click="unlike()">
        <i class="fa fa-thumbs-o-up colred margin-r-5"></i><span class="like">Liked</span>
    </span>
</template>

<script>
      export default {
            mounted() {

            },
            props: ['id'],
            computed: {
                  likers() {
                        var likers = []
                        
                        this.post.likes.forEach( (like) => {
                              likers.push(like.user.id)
                        })

                        return likers
                  },
                  auth_user_likes_post() {
                        var check_index = this.likers.indexOf( 
                              this.$store.state.auth_user.id
                         )

                         if (check_index === -1)
                              return false
                        else 
                              return true
                  },
                  post() {
                        return this.$store.state.posts.find( (post) => {
                              return post.id === this.id
                        })
                  }
            },
            methods: {
                  like() {
                        this.$http.get('/like/' + this.id)
                            .then( (resp) => {
                                  this.$store.commit('update_post_likes', {
                                        id: this.id,
                                        like: resp.body
                                  })
                                  
                                  noty({
                                          type: 'success',
                                          layout: 'bottomLeft',
                                          text: 'You successfully liked the post!'
                                  })
                            })
                  },
                  unlike() {
                        this.$http.get('/unlike/' + this.id)
                            .then( (response) => {

                                  this.$store.commit('unlike_post', {
                                        post_id: this.id,
                                        like_id: response.body
                                  })

                                  noty({
                                          type: 'success',
                                          layout: 'bottomLeft',
                                          text: 'You successfully unliked the post!'
                                  })
                            })
                  }
            }
      }
</script>


<style>
      .avatar-like{
            border-radius: 50%;
      }
      .emptyheart{
        color: #949596;
      }
      .emptyheart:hover{
        color: #444;
      }
      .heart{
        cursor: pointer;
        padding-right: 10px;
      }
      .like{
        color: #949596;
      }
      .like:hover{
        color:#444;
        cursor: pointer;
      }
</style>