import Vue from 'vue';
import Vuex from 'vuex';

import { generalModule } from "./modules/general";
import { warehouseModule } from "./modules/warehouse";

Vue.use(Vuex);

export default new Vuex.Store({
    strict: true, /* Prevents mutating the state directly */
    modules: {
        general: generalModule,
        warehouse: warehouseModule
    },
});