import _ from 'lodash';
window._ = _;

import axios from 'axios';
let axiosInstance = axios.create();
axiosInstance.defaults.headers.common['X-Requested-With'] = 'X-Requested-With';
window.axios = axiosInstance;

export default {
    api: axiosInstance
}

