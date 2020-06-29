import axios from 'axios';

let token = document.head.querySelector('meta[name="csrf-token"]');

let host        = 'http://shop.test/';

const apiPrefix = 'api/';
const version   = 'v1/';
const baseURL   = `${host}${apiPrefix}${version}`;

//let token = localStorage.getItem('token');

let headers = {
    'Content-Type': 'application/json',
    'Accept':'application/json',
    'Authorization':token ? `Bearer ${token}` : '',
};

let options = {
    headers,
    baseURL,
    host,

};

console.log(axios);
var Axios = axios.create(options)

Axios.create(options)

// Add request interceptor
Axios.interceptors.request.use( config => {
    config.headers.Authorization = `Bearer ${token}`;
    return config;
}, error => {
    return Promise.reject(error);
});

// Add a response interceptor
Axios.interceptors.response.use( response => {
    console.log("response: ",response);
    console.log('headers',response.headers);
    let mainResponse = null;
    if(response.headers && response.headers['content-type'] === "application/pdf"){
        mainResponse = {
            data:response.data.data,
            headers:response.headers,
        };
        return mainResponse
    }

    mainResponse = response.data;
    if( ! mainResponse.success ){
        throw new Error(`${response.data.msg} ${response.data.error}`);
    }
    return mainResponse;
}, error => {
    return Promise.reject(error);
});

export default Axios;