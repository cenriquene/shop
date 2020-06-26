import Vue from 'vue';
import VueRouter from 'vue-router';

import HomeComponent from "./components/home/HomeComponent";
import DashboardComponent from "./components/home/DashboardComponent";

import PageNotFound from "./components/errors/404";


Vue.use(VueRouter);

const routes = [
    {
        path: '/admin',
        name: 'home',
        component: HomeComponent,
        children: [{
            path: 'dashboard',
            component: DashboardComponent
        }]
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