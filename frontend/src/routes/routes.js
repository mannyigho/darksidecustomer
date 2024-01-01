import CustomersList from '../components/pages/CustomersList';
import CustomerCreate from '../components/pages/CustomerCreate';
import CustomerEdit from '../components/pages/CustomerEdit';
import CustomerDelete from '../components/pages/CustomerDelete';
import { createRouter, createWebHashHistory } from 'vue-router';

const routes = [
    {
        name: 'CustomersList',
        path: '/customers',
        component: CustomersList
    },
    {
        name: 'CustomerCreate',
        path: '/create',
        component: CustomerCreate
    },
    {
        name: 'CustomerEdit',
        path: '/edit',
        component: CustomerEdit
    },
    {
        name: 'CustomerDelete',
        path: '/delete',
        component: CustomerDelete
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

export default router;