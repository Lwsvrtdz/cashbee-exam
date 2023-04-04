import axios from "axios";

const BASE_URL = `/api/employees`

const axiosInstance = axios.create({
    baseURL: window.location.origin + BASE_URL,
    headers: {
        "Authorization": `Bearer ${localStorage.getItem('token')}`
    }
});

const state = {
    employees: [],
    employee: {},

    loading: false,
    totalRows: 0,
};

const getters = {
    employees: state => state.employees,
    employee: state => state.employee,

    loading: state => state.loading,
    totalRows: state => state.totalRows
};

const actions = {
    fetchEmployees({ commit }, filters) {
        axiosInstance.get('', { params: filters })
            .then((res) => {
                commit('setEmployees', res.data.data)
                commit('setTotalRows', res.data.meta.total)
            })
            .catch((error) => {
                console.log(error)
            })
    },

    fetchEmployee({ commit }, id) {
        axiosInstance.get(`${id}`)
            .then((res) => {
                commit('setEmployee', res.data.data)
            })
            .catch((error) => {
            })
    },

    saveEmployee({ commit }, data) {
        return axiosInstance.post('', data)
    },

    updateEmployee({ commit }, data) {
        return axiosInstance.patch(`${data.id}`, data)
    },

    deleteEmployee({ commit }, id) {
        return axiosInstance.delete(`${id}`)
    }
};

const mutations = {
    setEmployees(state, employees) {
        return state.employees = employees
    },

    setEmployee(state, employee) {
        return state.employee = employee
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