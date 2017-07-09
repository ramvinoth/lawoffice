
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 

require('./bootstrap');

Vue.component('init', require('./components/Init.vue'));
Vue.component('feed', require('./components/Feed.vue'));
Vue.component('userfeed', require('./components/UserFeed.vue'));
Vue.component('post', require('./components/Post.vue'));
Vue.component('comment', require('./components/Comment.vue'));
Vue.component('search', require('./components/Search.vue'));
Vue.component('friend', require('./components/Friend.vue'));
Vue.component('unread', require('./components/UnreadNots.vue'));
Vue.component('notification', require('./components/Notification.vue'));
Vue.component('caselist', require('./components/CaseList.vue'));

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

import { store } from './store'

const app = new Vue({
    el: '#app',
    store
});

*/

require('./bootstrap');

require('../../../node_modules/jquery-ui-dist/jquery-ui.min.js');

import Vue from 'vue'
import App from './App.vue'
import { store } from './store'
import router from './router'
import axios from 'axios'

axios.interceptors.request.use(function (config) {
    store.state.ajax.is_loading = true;
    return config;
}, function (error) {
    store.state.ajax.is_loading = false;
    return Promise.reject(error);
});

axios.interceptors.response.use(function (response) {
    store.state.ajax.is_loading = false;
    return response;
}, function (error) {
    store.state.ajax.is_loading = false;
    return Promise.reject(error);
});

Vue.component('init', require('./components/Init.vue'));
Vue.component('topnav', require('./components/inner/TopNav.vue'));
Vue.component('leftnav', require('./components/inner/LeftNav.vue'));
Vue.component('select2', require('./components/Select2.vue'));

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
); 


Vue.http.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
const app = new Vue({
    el: '#root',
    components: { App },
    template: '<app></app>',
    router,
    store
})