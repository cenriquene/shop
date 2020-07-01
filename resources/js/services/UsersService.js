export default {
    getUsers() {
        return axios.get('/api/v1/users');
    },
    getUser(id) {
        return axios.get(`/api/v1/users/${id}`);
    },
    createUser(payload) {
        return axios.post('/api/v1/users', payload);
    },
    updateUser(id, payload) {
        return axios.put(`/api/v1/users/${id}`, payload);
    },
    deleteUser(id) {
        return axios.delete(`/api/v1/users/${id}`);
    }
};