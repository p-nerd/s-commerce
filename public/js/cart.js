// cart behaviors
const CSRF_TOKEN = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

const updateHTMLHeaderCartDropdown = (html, cartItemCount) => {
    const headerCartDrowdown = document.querySelector("#header-cart-drowdown");
    const headerCartCount = document.querySelector("#header-cart-count");

    headerCartDrowdown.innerHTML = html;
    headerCartCount.innerHTML = cartItemCount;
    setupDeleteFromCartEventListeners();
};

const setupDeleteFromCartEventListeners = () => {
    document.querySelectorAll("#delete-from-cart-button").forEach((element) => {
        element.addEventListener("click", async () => {
            const cartId = element.getAttribute("data-cart-id");
            const response = await fetch(`/cart/${cartId}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": CSRF_TOKEN,
                },
            });
            updateHTMLHeaderCartDropdown(
                await response.text(),
                response.headers.get("X-Cart-Items-Quantity"),
            );
        });
    });
};

const setupAddToCartEventListeners = () => {
    const buttons = document.querySelectorAll("#add-to-cart-button");

    buttons.forEach((element) => {
        element.addEventListener("click", async () => {
            const product_id = element.getAttribute("data-product-id");
            const quantity = element.getAttribute("data-product-quantity");

            const response = await fetch("/cart", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": CSRF_TOKEN,
                },
                body: JSON.stringify({ product_id, quantity, addQuantity: 1 }),
            });
            updateHTMLHeaderCartDropdown(
                await response.text(),
                response.headers.get("X-Cart-Items-Quantity"),
            );
        });
    });
};

setupDeleteFromCartEventListeners();
setupAddToCartEventListeners();
