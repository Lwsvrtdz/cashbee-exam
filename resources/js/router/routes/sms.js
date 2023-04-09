export default [
    {
        path: '/sms',
        name: 'Sms',
        component: () => import('../../components/Sms/SmsIndex'),
        meta: {
            requiresAuth: true
        }
    },
]