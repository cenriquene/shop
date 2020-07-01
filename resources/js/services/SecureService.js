export default {
    login(payload) {
        return axios.post('/api/login', payload);
    }
};