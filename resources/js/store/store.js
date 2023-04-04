import Vue from "vue"
import Vuex from 'vuex'

import Auth from './app/auth/Auth'
import Company from './app/company/Company'
import Department from './app/department/Department'
import Employee from './app/employee/Employee'


Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        Auth,
        Company,
        Department,
        Employee
    },
    strict: true,
    state: {

    },
    getters: {

    },
    mutations: {

    },
    actions: {

    }
})