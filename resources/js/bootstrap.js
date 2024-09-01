import 'trix/dist/trix.css';

import axios from 'axios';
import sweetalert from 'sweetalert';
import Alpine from 'alpinejs';
import Trix from 'trix';
import ApexCharts from 'apexcharts';

window.axios = axios;
window.sweetalert = sweetalert;
window.Alpine = Alpine;
window.Trix = Trix;
window.ApexCharts = ApexCharts;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Alpine.start();

document.addEventListener('trix-before-initialize', () => {
    // Change Trix.config if you need
});
