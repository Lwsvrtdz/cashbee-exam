import axios from "axios";

const BASE_URL = `/api/sms`

const axiosInstance = axios.create({
    baseURL: window.location.origin + BASE_URL,
    headers: {
        "Authorization": `Bearer ${localStorage.getItem('token')}`
    }
});

const state = {

};

const getters = {

};

const actions = {
    send({ commit }, data) {
        return axiosInstance.post('', data)
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