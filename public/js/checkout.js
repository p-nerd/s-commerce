document.addEventListener("DOMContentLoaded", function () {
    const CSRF_TOKEN = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    const selectDivision = document.querySelector("#select-division-option");
    const selectDistrict = document.querySelector("#select-district-option");
    const deliveryAmount = document.querySelector("#delivery-amount");
    const totalAmount = document.querySelector("#total-amount");

    if (
        !CSRF_TOKEN ||
        !selectDivision ||
        !selectDistrict ||
        !deliveryAmount ||
        !totalAmount
    ) {
        return;
    }

    const setupApplyCouponEventListener = () => {
        const form = document.getElementById("apply-coupon-form");

        if (!form) {
            return;
        }

        form.addEventListener("submit", function (event) {
            event.preventDefault();

            const coupon = form
                .querySelector('input[name="coupon"]')
                .value.trim();

            fetch("/checkout/coupon", {
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

        if (!divisions) {
            return;
        }

        const divisionValue = selectDivision.getAttribute("value");

        divisions.forEach(({ value, label }, index) => {
            const option = document.createElement("option");
            option.value = value;
            option.textContent = label;
            if (divisionValue === value) {
                option.selected = true;
            }

            selectDivision.appendChild(option);

            if (index === divisions.length - 1) {
                selectDivision.disabled = false;
            }
        });

        const division = divisions.find((d) => d.value == divisionValue);

        division?.districts?.forEach(({ label, value, price }, index) => {
            const option = document.createElement("option");
            option.value = value;
            option.textContent = label;
            if (selectDistrict.getAttribute("value") === value) {
                deliveryAmount.textContent = `$${price}`;
                totalAmount.textContent = (
                    price +
                    Number(totalAmount.getAttribute("data-total-amount"))
                ).toFixed(2);
                option.selected = true;
            }

            selectDistrict.appendChild(option);

            if (index === division?.districts.length - 1) {
                selectDistrict.disabled = false;
            }
        });

        selectDivision.addEventListener("change", function (event) {
            selectDistrict.disabled = event.target.value == "" ? true : false;

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
