<template>
    <div class="">
    <!-- Post -->
    <div class="post" v-for="post in posts">
      <div class="user-block">
        <img class="img-circle img-bordered-sm" :src="post.user.avatar" alt="user image">
        <span class="username">
          <a href="#">{{ post.user.name }}</a>
          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
        </span>
        <span class="description">Shared publicly - {{ post.created_at }}</span>
      </div>
      <!-- /.user-block -->
      <p>
        {{ post.content }}
      </p>
      <ul class="list-inline">
        <li><like :id="post.id"></like></li>
        <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
        <li class="pull-right">
          <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
            (5)</a></li>
      </ul>

      <input class="form-control input-sm" type="text" placeholder="Type a comment">
    </div>
    <!-- /.post -->
    </div>
        
        
</template>

<script>

    import Like from './Like.vue'

    export default {
        mounted() {
            this.get_feed()
        },
        components: {
            Like
        },
        methods: {
            get_feed() {
                this.$http.get('/feed')
                    .then( (response) => {
                        response.body.forEach( (post) => {
                            this.$store.commit('add_post', post)
                        })
                    })
            }
        },

        computed: {
            posts() {
                return this.$store.getters.all_posts
            },
            likers() {
                var likers = []

                this.post.likes.forEach( (like) => {
                      likers.push(like.user.id)
                })

                return likers
            },
        }
    }
</script>



<style>
    .posts{
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .feedbox{
        position: relative;
        padding: 20px 0px 0px 20px;
        margin-right: 40px;
    }
    .feeds .media-body{
        border: 1px solid #cdd0d9;
        background-color: #fff;
        border-radius: 5px;
    }
    .feed-title{
        margin-bottom:25px;
        font-size: 16px;
    }
    .feedbtm{
        min-width:350px;
        float: left;
        margin-top:20px;
        margin-bottom: 10px;
    }
    .feeds {
        position: relative;
        width: 100%;
        margin: 0 auto;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        margin-bottom: 20px;
    }
    .fowner{
        position: absolute;
        left: -60px;
        top: -2px;
    }
    .left-arrow:before {
        -moz-transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        background: none repeat scroll 0 0 #fff;
        display: block;
        height: 14px;
        right: -8px;
        position: absolute;
        width: 12px;
        border-style: none;
        margin-top: 22px;
        border-width: 1px 1px 0 0;
        transform: rotate(137deg);
        box-shadow: 1px 1px 0 #e1e1e1;
        content: "";
    }
    .up-arrow:before {
        content: "";
        background: none repeat scroll 0 0 #FFF;
        height: 12px;
        position: absolute;
        width: 11px;
        box-shadow: 1px 1px 0 rgba(192,192,194,0.6);
        transform: rotate(-133deg);
        top: -6px;
        margin: 0 auto;
        right: 14px;
    }
    .feed-pic{
        position: relative;
        z-index:1;
    }
    .fowner-name{
        color: #0c7e8a;
        cursor: pointer;
    }
    .userfeed-content-area {
        width: 800px;
        margin: 0 auto;
    }
    .comment-section{
        color: #949596;
    }
    .comment-section:hover{
        color: #444;
    }
    div.likers{
        display: inline-block;
        background-color: #efefef;
        padding: 3px;
        width: 100%;
        height: 30px;
    }
    .likers-list{
        padding: 5px 20px;
    }
    .f-action{
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
        width: 30px;
        text-align: center;
    }
    @media only screen and (max-width: 1440px) and (min-width: 1350px)
    .userfeed-content-area {
        min-width: 750px;
        max-width: 750px;
    }
</style>