import "./bootstrap";

import Alpine from "alpinejs";
import Trix from "trix";

window.Alpine = Alpine;
window.Trix = Trix;

Alpine.start();

document.addEventListener("trix-before-initialize", () => {
    // Change Trix.config if you need
});
