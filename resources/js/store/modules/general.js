function initState() {
    return {
        cart: {
            total: 0,
            products: []
        }
    };
};

export const generalModule = {
    state: initState(),
    mutations: {
        SET_INIT_STATE(state) {
            Object.assign(state, initState());
        },
        SET_PRODUCT_CART_SESSION(state, payload) {
            state.cart = payload;
            document.getElementById('total_cart_items').innerHTML = state.cart.total;
        }
    },
    actions: {
        setInitState({ commit }) {
            commit('SET_INIT_STATE');
        },
        setProductCartSession({ commit }, payload) {
            commit('SET_PRODUCT_CART_SESSION', payload);
        },
    },
    getters: {

    }
}