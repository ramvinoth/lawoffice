import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


const router = new VueRouter({
    routes: [
        {path: '/', component: require('./views/caselist/index.vue')},
        {path: '/home', component: require('./views/caselist/index.vue')},
        {path: '/login', component: require('./components/Login.vue')},
        {path: '/caselist', component: require('./views/caselist/index.vue')},
        {path: '/caselist/create', component: require('./views/caselist/form.vue')},
        {path: '/caselist/:id/edit', component: require('./views/caselist/form.vue'), meta: {mode: 'edit'}},
        {path: '/caselist/:id', component: require('./views/caselist/show.vue')},
    ]
})

export default router
