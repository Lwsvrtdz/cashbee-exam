/*
* This page will handle all the Vue routing within the application
*/

import App from '../App.vue';

// Vue and Vue Router
import Vue from 'vue'
import VueRouter from 'vue-router'

import company from './routes/company'
import department from './routes/department'
import employee from './routes/employee'
import sms from './routes/sms'



// Register Vue Router
Vue.use(VueRouter)

const routes = [
    ...sms,
    ...company,
    ...department,
    ...employee,
    {
        path: '/login',
        name: 'login',
        component: () => import('../components/Login.vue'),
    },

    {
        path: '/error-404',
        name: 'error-404',
        component: () => import('../components/Login.vue'),
        meta: {
            layout: 'full',
            requiresAuth: true
        },
    },
    {
        path: '*',
        redirect: 'error-404',
    },
]

export default new VueRouter({
    linkActiveClass: 'active',
    linkExactActiveClass: '',
    scrollBehavior() {
        return { x: 0, y: 0 }
    },
    mode: 'history',
    routes,
    components: {
        default: App
    }
})