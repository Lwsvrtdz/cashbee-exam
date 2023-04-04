import axios from "axios";

const BASE_URL = `/api/departments`

const axiosInstance = axios.create({
    baseURL: window.location.origin + BASE_URL,
    headers: {
        "Authorization": `Bearer ${localStorage.getItem('token')}`
    }
});

const state = {
    departments: [],
    department: {},

    loading: false,
    totalRows: 0,
};

const getters = {
    departments: state => state.departments,
    department: state => state.department,

    loading: state => state.loading,
    totalRows: state => state.totalRows
};

const actions = {
    fetchDepartments({ commit }, filters) {
        axiosInstance.get('', { params: filters })
            .then((res) => {
                commit('setDepartments', res.data.data)
                commit('setTotalRows', res.data.meta.total)
            })
            .catch((error) => {
                console.log(error)
            })
    },

    fetchDepartment({ commit }, id) {
        axiosInstance.get(`${id}`)
            .then((res) => {
                commit('setDepartment', res.data.data)
            })
            .catch((error) => {
            })
    },

    saveDepartment({ commit }, data) {
        return axiosInstance.post('', data)
    },

    updateDepartment({ commit }, data) {
        return axiosInstance.patch(`${data.id}`, data)
    },

    deleteDepartment({ commit }, id) {
        return axiosInstance.delete(`${id}`)
    }
};

const mutations = {
    setDepartments(state, departments) {
        return state.departments = departments
    },

    setDepartment(state, department) {
        return state.department = department
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