export default {
    getProducts() {
        return axios.get('/api/v1/products');
    },
    addProductToCart(payload) {
        return axios.post('/add-product-to-cart', payload);
    },
    getProductsFromCartSession() {
        return axios.get('/get-cart-session');
    },
    storeSale(payload) {
        return axios.post('/store-sale', payload);
    }
};