export default {
    getShopProducts() {
        return axios.get('/products');
    },
    getProducts() {
        return axios.get('/api/v1/products');
    },
    getProduct(id) {
        return axios.get(`/api/v1/products/${id}`);
    },
    createProduct(payload) {
        return axios.post('/api/v1/products', payload);
    },
    updateProduct(id, payload) {
        return axios.put(`/api/v1/products/${id}`, payload);
    },
    deleteProduct(id) {
        return axios.delete(`/api/v1/products/${id}`);
    },
    addProductToCart(payload) {
        return axios.post('/add-product-to-cart', payload);
    },
    getProductsFromCartSession() {
        return axios.get('/get-cart-session');
    },
    deleteProductFromCartSession(id) {
        return axios.delete(`/delete-product-session/${id}`);
    },
    storeSale(payload) {
        return axios.post('/store-sale', payload);
    }
};