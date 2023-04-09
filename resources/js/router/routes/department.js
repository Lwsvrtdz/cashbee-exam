export default [
    {
        path: '/departments',
        name: 'Departments',
        component: () => import('../../components/Department/DepartmentIndex'),
        meta: {
            requiresAuth: true
        }
    },
]