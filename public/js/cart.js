// cart behaviors

document.addEventListener("DOMContentLoaded", function () {
    const CSRF_TOKEN = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    const updateHTMLHeaderCartDropdown = (html, cartItemCount) => {
        document.querySelector("#header-cart-drowdown").innerHTML = html;
        document.querySelector("#header-cart-count").innerHTML = cartItemCount;
        setupDeleteFromCartEventListeners();
    };

    const removeProductFromCartIndexPage = (cartId) => {
        console.log(cartId);
        document.querySelector(`#cart-index-item-${cartId}`)?.remove();
    };

    const setupDeleteFromCartEventListeners = () => {
        document
            .querySelectorAll("#delete-from-cart-button")
            .forEach((element) => {
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
                    removeProductFromCartIndexPage(cartId);
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
                    body: JSON.stringify({
                        product_id,
                        quantity,
                        addQuantity: 1,
                    }),
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

    // cart quantity

    function updateQuantity(productId, operation) {
        const quantityValueElements = document.querySelectorAll(
            `#quantity-value-${productId}`,
        );
        let currentQuantity = parseInt(quantityValueElements[0].textContent);

        if (operation === "increase") {
            currentQuantity += 1;
        } else if (operation === "decrease" && currentQuantity > 1) {
            currentQuantity -= 1;
        }

        quantityValueElements?.forEach((ele) => {
            ele.textContent = currentQuantity;
        });

        document
            .querySelectorAll(
                `#add-to-cart-button[data-product-id="${productId}"]`,
            )
            .forEach((ele) => {
                ele.setAttribute("data-product-quantity", currentQuantity);
            });
    }

    document.querySelectorAll("#quantity-up-button").forEach((button) => {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-product-id");
            updateQuantity(productId, "increase");
        });
    });

    document.querySelectorAll("#quantity-down-button").forEach((button) => {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-product-id");
            updateQuantity(productId, "decrease");
        });
    });
});
