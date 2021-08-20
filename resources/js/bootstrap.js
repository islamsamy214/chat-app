window._ = require('lodash');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: "7d7d4d251143a66d3488",
    cluster: "mt1",
    forceTLS: true
});
