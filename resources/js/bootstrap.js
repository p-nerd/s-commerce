import axios from "axios";
import sweetalert from "sweetalert";

window.axios = axios;
window.sweetalert = sweetalert;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
