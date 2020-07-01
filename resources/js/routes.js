import Vue from 'vue';
import VueRouter from 'vue-router';

import HomeComponent from "./components/home/HomeComponent";
import ProductsComponent from "./components/products/ProductsComponent";
import NewProductComponent from "./components/products/NewProductComponent";
import EditProductComponent from "./components/products/EditProductComponent";
import SalesComponent from "./components/sales/SalesComponent";
import UsersComponent from "./components/users/UsersComponent";
import NewUserComponent from "./components/users/NewUserComponent";
import EditUserComponent from "./components/users/EditUserComponent";

import PageNotFound from "./components/errors/404";


Vue.use(VueRouter);

const routes = [
    {
        path: '/admin',
        name: 'home',
        component: HomeComponent,
        children: [
            {
                path: 'products',
                component: ProductsComponent
            },
            {
                path: 'products/new',
                component: NewProductComponent
            },
            {
                path: 'products/edit/:id',
                component: EditProductComponent
            },
            {
                path: 'sales',
                component: SalesComponent
            },
            {
                path: 'users',
                component: UsersComponent
            },
            {
                path: 'users/new',
                component: NewUserComponent
            },
            {
                path: 'users/edit/:id',
                component: EditUserComponent
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