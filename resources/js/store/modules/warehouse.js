function initState() {
    return {

    };
};

export const warehouseModule = {
    state: initState(),
    mutations: {
        SET_INIT_STATE(state) {
            Object.assign(state, initState());
        }
    },
    actions: {
        setInitState({ commit }) {
            commit('SET_INIT_STATE');
        },
    },
    getters: {

    }
}