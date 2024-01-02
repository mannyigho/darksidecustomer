import CustomersList from '../components/pages/CustomersList';
import CustomerCreate from '../components/pages/CustomerCreate';
import CustomerEdit from '../components/pages/CustomerEdit';
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
        path: '/edit/:id?',
        component: CustomerEdit
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

export default router;