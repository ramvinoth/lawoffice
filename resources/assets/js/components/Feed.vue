<template>
    <div class="">
    <!-- Post -->
    <div class="row" v-for="post in posts">
        <div class="col-md-8">
            <!-- Box Comment -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" :src="post.user.avatar" alt="User Image"/>
                        <span class="username"><a href="#">{{post.user.name}}</a></span>
                        <span class="description">Shared publicly - {{post.created_at}}</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read">
                            <i class="fa fa-circle-o"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimize">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove post">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="feed-content-area">
                        <p>{{post.content}}</p>
                    </div>
                    <!--a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a-->
                    <like :id="post.id"></like>
                    <span class="pull-right text-muted">127 likes - 3 comments</span>
                </div>
                <!-- /.box-body -->
                
                <comment></comment>
                <!-- /.box-footer -->
                <div class="box-footer">
                  <form action="#" method="post">
                    <img class="img-responsive img-circle img-sm" :src="getUserAvatar.avatar"  alt="Alt Text">
                    <!-- .img-push is used to add margin to elements next to floating images -->
                    <div class="img-push">
                      <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    </div>
                  </form>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
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
            getUserAvatar() {
                return this.$store.getters.auth_user_data
            }
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
    .feed-content-area {
        min-height: 50px;
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
    .feed-content-area {
    }
</style>