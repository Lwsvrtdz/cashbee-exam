export default [
    {
        path: '/companies',
        name: 'Companies',
        component: () => import('../../components/Company/CompanyIndex'),
        meta: {
            requiresAuth: true
        }
    },
]