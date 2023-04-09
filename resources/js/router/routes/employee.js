export default [
    {
        path: '/employees',
        name: 'Employees',
        component: () => import('../../components/Employee/EmployeeIndex'),
        meta: {
            requiresAuth: true
        }
    },
]