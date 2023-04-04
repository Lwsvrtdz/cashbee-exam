import axios from "axios";

const BASE_URL = `/api/companies`

const axiosInstance = axios.create({
    baseURL: window.location.origin + BASE_URL,
    headers: {
        "Authorization": `Bearer ${localStorage.getItem('token')}`
    }
});

const state = {
    companies: [],
    company: {},

    loading: false,
    totalRows: 0,
};

const getters = {
    companies: state => state.companies,
    company: state => state.company,

    loading: state => state.loading,
    totalRows: state => state.totalRows
};

const actions = {
    fetchCompanies({ commit }, filters) {
        axiosInstance.get('', { params: filters })
            .then((res) => {
                commit('setCompanies', res.data.data)
                commit('setTotalRows', res.data.meta.total)
            })
            .catch((error) => {
                console.log(error)
            })
    },

    fetchCompany({ commit }, id) {
        axiosInstance.get(`${id}`)
            .then((res) => {
                commit('setCompany', res.data.data)
            })
            .catch((error) => {

            })
    },

    saveCompany({ commit }, data) {
        return axiosInstance.post('', data)
    },

    updateCompany({ commit }, data) {
        return axiosInstance.patch(`${data.id}`, data)
    },

    deleteCompany({ commit }, id) {
        return axiosInstance.delete(`${id}`)
    }
};

const mutations = {
    setCompanies(state, companies) {
        return state.companies = companies
    },

    setCompany(state, company) {
        return state.company = company
    },

    setLoading(state, loading) {
        return state.loading = loading
    },

    setTotalRows(state, totalRows) {
        return state.totalRows = totalRows
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}