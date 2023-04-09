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

const router = new VueRouter({
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

router.beforeEach((to, from, next) => {
    /**
   * If directly trying to access the login route.
   * Check if the User is Unauthenticated.
   * If yes, navigate to login
   */
    if (to.name == 'login' && !localStorage.getItem('token')) {
        console.log('1')
        next()
        return
    }

    /**
     * If the user tries to access page that requires an authentication
     * but doesn't have token and auth.
     * Redirect to Login page
     */
    if (to.matched.some(record => record.meta.requiresAuth) && !localStorage.getItem('token')) {
        console.log('2')
        next({ name: "login" });

        return
    }

    /**
     */
    if (to.matched.some(record => record.meta.requiresAuth) && localStorage.getItem('token')) {
        console.log('3')
        next()

        return
    }
})

export default router