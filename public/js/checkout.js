document.addEventListener("DOMContentLoaded", function () {
    const CSRF_TOKEN = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    const selectDivision = document.querySelector("#select-division-option");
    const selectDistrict = document.querySelector("#select-district-option");
    const subtotalAmount = document.querySelector("#subtotal-amount");
    const deliveryAmount = document.querySelector("#delivery-amount");
    const totalAmount = document.querySelector("#total-amount");

    const setupApplyCouponEventListener = () => {
        const form = document.getElementById("apply-coupon-form");

        form.addEventListener("submit", function (event) {
            event.preventDefault();

            const coupon = form
                .querySelector('input[name="coupon"]')
                .value.trim();

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

                    const xAmount =
                        Number(totalAmount.getAttribute("data-total-amount")) -
                        data.amount;
                    totalAmount.textContent = xAmount.toFixed(2);
                    totalAmount.setAttribute("data-total-amount", xAmount);

                    successMessage.textContent = data.message;
                    errorMessage.textContent = "";

                    document.querySelector("#coupon-input").value = coupon;
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    };

    const setupLocationsSelectEventListener = () => {
        const divisions = JSON.parse(
            selectDistrict.getAttribute("data-divisions"),
        );

        divisions.forEach((division) => {
            const option = document.createElement("option");
            option.value = division.value;
            option.textContent = division.label;
            selectDivision.appendChild(option);
        });

        selectDivision.addEventListener("change", function (event) {
            selectDistrict.disabled = false;

            const division = divisions.find(
                (d) => d.value == event.target.value,
            );

            selectDistrict.innerHTML = "";

            const option = document.createElement("option");
            option.value = "";
            option.textContent = "Select District";
            selectDistrict.appendChild(option);

            division.districts?.forEach(({ label, value }) => {
                const option = document.createElement("option");
                option.value = value;
                option.textContent = label;
                selectDistrict.appendChild(option);
            });

            deliveryAmount.textContent = `--`;
            totalAmount.textContent =
                totalAmount.getAttribute("data-total-amount");
        });

        selectDistrict.addEventListener("change", function (event) {
            const district = divisions
                .find((d) => d.value === selectDivision.value)
                .districts.find((d) => d.value === event.target.value);

            deliveryAmount.textContent = `$${district.price}`;
            totalAmount.textContent = (
                district.price +
                Number(totalAmount.getAttribute("data-total-amount"))
            ).toFixed(2);
        });
    };

    setupApplyCouponEventListener();
    setupLocationsSelectEventListener();
});
