import Vue from "vue"
import Vuex from 'vuex'

import Auth from './app/auth/Auth'
import Company from './app/company/Company'
import Department from './app/department/Department'
import Employee from './app/employee/Employee'
import Sms from "./app/sms/Sms"


Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        Auth,
        Company,
        Department,
        Employee,
        Sms
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