<template>
    <li class="top-search">
        <input type="text" class="form-control" placeholder="search for other users" v-model="query" @keyup.enter="search()">
        <div id="search-results" class="panel panel-default up-arrow" v-if="results.length">
              <div class="s-results" v-for="user in results">
                    <a :href="profile_url(user.slug)">
                        <img :src="user.avatar" alt="" width="50px" height="50px" class="searched-user">
                        <span class="">{{ user.name }}</span>
                    </a>
              </div>
        </div>
    </li>
</template>

<script>
      var algoliasearch = require('algoliasearch')
      var client = algoliasearch('4KBZGJG182', 'cdd77696df58101e5720f431c3ebc489')
      var index = client.initIndex('users')
      export default {
        mounted() {

        },
        data() {
              return {
                    query: '',
                    results: []
              }
        },
        methods: {
              search() {
                    index.search(this.query, (err, content) => {
                          this.results = content.hits
                    })
              },
                profile_url(slug) {
                     const url = "http://127.0.0.1:8000/profile/"
                     return url + slug
               }
        },
        computed: {
}
      }
</script>

<style>
    .searched-user{
        border-radius: 50%;
        padding-right: 10px;
    }
    .top-search{
        padding: 9px 10px;
    }
    .top-search input{
        font-size: 11px;
        height: 30px;
        border-radius: 0px;
    }
    #search-results{
        position: absolute;
        width: 400px;
        top: 50px;
        right: 0px;
    }
</style>