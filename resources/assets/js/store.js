import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export const store = new Vuex.Store({
      state: {
            nots: [],
            posts: [],
            auth_user: {},
            popup: {ispopshow: false,is_spopshow: false},
            ajax: {isLoading: false},
            slide: {isslide: false},
      },
      getters: {
            all_nots(state) {
                  return state.nots
            },
            all_nots_count(state) {
                  return state.nots.length
            },
            all_posts(state) {
                  return state.posts
            },
            auth_user_data(state) {
                  return state.auth_user
            },
            is_popshow(state){
                return state.popup.ispopshow;
            },
            is_slide(state){
                return state.slide.isslide;
            },
            is_spopshow(state){
                return state.popup.is_spopshow;  
            },
            is_loading(state){
                return state.ajax.isLoading;
            }
      },
      mutations: {
            add_not(state, not) {
                  state.nots.push(not)
            },
            add_post(state, post) {
                  state.posts.push(post)
            },
            auth_user_data(state, user) {
                  state.auth_user = user
            },
            update_post_likes(state, payload)
            {
                  var post = state.posts.find( (p) => {
                        return p.id === payload.id
                  })

                  post.likes.push(payload.like)
            },
            unlike_post(state, payload) {
                  
                  var post = state.posts.find((p) => {
                        return p.id === payload.post_id
                  })

                  var like = post.likes.find( (l) => {
                        return l.id === payload.like_id
                  })

                  var index = post.likes.indexOf(like)

                  post.likes.splice(index, 1)
            },
            set_ispopshow(state, status){
                state.popup.ispopshow = status;  
            },
            set_loading(state, status){
                state.ajax.isLoading = status;
            },
            set_isslide(state, status){
                state.slide.isslide = status;
            },
            set_spopshow(state, status){
                state.popup.is_spopshow = status;  
            },
      }
})