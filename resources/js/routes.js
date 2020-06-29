import Vue from 'vue';
import VueRouter from 'vue-router';

import HomeComponent from "./components/home/HomeComponent";
import DashboardComponent from "./components/home/DashboardComponent";
import ProductsComponent from "./components/products/ProductsComponent";
import SalesComponent from "./components/sales/SalesComponent";
import UsersComponent from "./components/users/UsersComponent";

import PageNotFound from "./components/errors/404";


Vue.use(VueRouter);

const routes = [
    {
        path: '/admin',
        name: 'home',
        component: HomeComponent,
        children: [
            {
                path: 'dashboard',
                component: DashboardComponent
            },
            {
                path: 'products',
                component: ProductsComponent
            },
            {
                path: 'sales',
                component: SalesComponent
            },
            {
                path: 'users',
                component: UsersComponent
            }
        ]
    },
    {
        path: '*',
        component: PageNotFound
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

export default router;