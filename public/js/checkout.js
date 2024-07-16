document.addEventListener("DOMContentLoaded", function () {
    const CSRF_TOKEN = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    const form = document.getElementById("apply-coupon-form");

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const coupon = form.querySelector('input[name="coupon"]').value.trim();

        fetch("/checkout/apply-coupon", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": CSRF_TOKEN,
            },
            body: JSON.stringify({ coupon }),
        })
            .then(async (response) => {
                const successMessage = document.querySelector(
                    "#coupon-success-message",
                );
                const errorMessage = document.querySelector(
                    "#coupon-error-message",
                );

                const data = await response.json();

                if (response.status === 400) {
                    successMessage.textContent = "";
                    errorMessage.textContent = data.message;
                    return;
                }

                document.querySelector("#total-price").textContent =
                    data.amount;

                successMessage.textContent = data.message;
                errorMessage.textContent = "";

                document.querySelector("#coupon-input").value = coupon;
                // history.pushState(null, "", addQuery({ coupon }));
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });
});
