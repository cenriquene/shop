export default {
    getCategories() {
        return axios.get('/api/v1/categories');
    }
};