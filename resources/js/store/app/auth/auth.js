import axios from "axios";

const BASE_URL = `/api/auth`
const state = {

};

const getters = {

};

const actions = {
    login({ commit }, data) {
        return axios.post(`${BASE_URL}/login`, data)
    }
};

const mutations = {

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}