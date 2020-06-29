window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    /* window.$ = window.jQuery = require('jquery');

    require('bootstrap'); */
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

    token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYWJjZTgwZWQ3MzI5ZWI0OTIwMjk5OGZmMDBiNzc5NmEwM2QyNTIzNDBkOGMzYjNlOTFiMTE4MjVjYmVjMDliMWUzYjY2MTBhYjVlZGM4MzkiLCJpYXQiOjE1OTM0MDg1NTIsIm5iZiI6MTU5MzQwODU1MiwiZXhwIjoxNjI0OTQ0NTUxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.wQ3jCzYSy_zxTj2s5NFey780_ZkdpeXWji7qgk1eRyMKSklhL7T6mmPVrILBPFSxdSvOBREXWhtvSBDSERMHEMFV7PxzJAPwaMAZTG4deTbWR3ieVksuXio5mMe2JyJwyTz7M9yJvbb3HP8WobwgqaRGzgoCpo7VxBU4lcE3RPAm5OAtlKXNZV-DZ2E2CfpjUReUAC3u-WZlX76lr9zqnHiAE6hHxUw1SOAVSC-H8UonYYTtyb3yPlYKY-NCWabQgQUOWdrb1Cg6QFkzYzvn5aEoqZl-2Aurjw5n2WgHmu3fqCZ7uK5i4pmnITEZIpBxYaXCpRvnG2Ao6rZEecQ5ustnWrantKj7S0fGrT5q1R8KS9wIDqJHf5HC9hpDUU8BGIWI4tOOdzqC9Mx9LCqcMw8ZxuGZbP1ZVgSymOPqkkQVSSmT0a8kxEQLec2yAC2MNSCQIdBTdDPseJQOchshMiV10kQDbS27-SywCUV659qKKKFIxgom--lbF5E96HkA8MMN6ufl0P6eyp_bSwFPv8HAtDyrdRJ6hxtUDJ5nJghT2CdLyeBpp-NfX4pD6-YTU7FP6o9eOfuKBxStQVqLG2O54DmuQPH46pDiOg-fOjsywcxvkxT6JypDp059vIOu1-KdA9ToOF-sqDmLAOnygQPzZfHmULQvgiU1yDBXYdk";
    window.axios.defaults.headers.Authorization = `Bearer ${token}`;

} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
