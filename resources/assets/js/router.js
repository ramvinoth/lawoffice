import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


const router = new VueRouter({
    routes: [
        {path: '/', redirect: '/home'},
        {path: '/home',  redirect: '/dashboard'},
        {path: '/dashboard', component: require('./views/dashboard/index.vue')},
        {path: '/login', component: require('./components/Login.vue')},
        {path: '/diary', component: require('./views/diary/index.vue')},
        {path: '/diary/create', component: require('./views/diary/form.vue')},
        {path: '/diary/:id/edit', component: require('./views/diary/form.vue'), meta: {mode: 'edit'}},
        {path: '/diary/:id', component: require('./views/diary/show.vue')},
        {path: '/caselist', component: require('./views/caselist/index.vue')},
        {path: '/caselist/create', component: require('./views/caselist/form.vue')},
        {path: '/caselist/:id/edit', component: require('./views/caselist/form.vue'), meta: {mode: 'edit'}},
        {path: '/caselist/:id', component: require('./views/caselist/index.vue'), meta: {mode: 'show'}},
        {path: '/calendar/', component: require('./views/calendar/index.vue')},
        {path: '/calendar/addevent', component: require('./views/calendar/index.vue') , meta: {mode: 'addevent'}},
    ],
})

export default router
