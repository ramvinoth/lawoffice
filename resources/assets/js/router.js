import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


const router = new VueRouter({
    routes: [
        {path: '/', redirect: '/dashboard'},
        {path: '/dashboard', component: require('./views/dashboard/index.vue'), meta: { requiresAuth: true }},
        {path: '/register', name: 'register', component: require('./components/Register.vue')},
        {path: '/login', name: 'login', component: require('./components/Login.vue')},
        {path: '/diary', component: require('./views/diary/index.vue'), meta: { requiresAuth: true }},
        {path: '/diary/create', component: require('./views/diary/form.vue'), meta: { requiresAuth: true }},
        {path: '/diary/:id/edit', component: require('./views/diary/form.vue'), meta: {mode: 'edit', requiresAuth: true }},
        {path: '/diary/:id', component: require('./views/diary/show.vue'), meta: { requiresAuth: true }},
        {path: '/caselist', component: require('./views/caselist/index.vue'), meta: { requiresAuth: true }},
        {path: '/caselist/create', component: require('./views/caselist/form.vue'), meta: { requiresAuth: true }},
        {path: '/caselist/:id/edit', component: require('./views/caselist/form.vue'), meta: {mode: 'edit', requiresAuth: true }},
        {path: '/caselist/:id', component: require('./views/caselist/index.vue'), meta: {mode: 'show', requiresAuth: true }},
        {path: '/calendar/', component: require('./views/calendar/index.vue'), meta: { requiresAuth: true }},
        {path: '/calendar/addevent', component: require('./views/calendar/index.vue') , meta: {mode: 'addevent', requiresAuth: true }},
        {path: '/users/', component: require('./views/users/index.vue'), meta: { requiresAuth: true }},
        {path: '/users/create', component: require('./views/users/form.vue'), meta: { requiresAuth: true }},
        {path: '/users/:id', component: require('./views/users/show.vue'), meta: { requiresAuth: true }},
        {path: '/users/:id/edit', component: require('./views/users/form.vue'), meta: { requiresAuth: true }},
    ],
    mode: 'history',
})

router.beforeEach((to, from, next) => {
    if(to.meta.requiresAuth){
        const authUser = window.Laravel.auth_user;
        if(authUser !== null){
            next()
        }else{
            next({name: 'login'});
        }
    }
    next()
})

export default router
