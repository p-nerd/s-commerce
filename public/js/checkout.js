document.addEventListener("DOMContentLoaded", function () {
    const CSRF_TOKEN = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    const DIVISIONS = {
        barisal: [
            { label: "Barisal", value: "barisal" },
            { label: "Bhola", value: "bhola" },
            { label: "Jhalokathi", value: "jhalokathi" },
            { label: "Patuakhali", value: "patuakhali" },
            { label: "Pirojpur", value: "pirojpur" },
            { label: "Barguna", value: "barguna" },
        ],
        chittagong: [
            { label: "Chittagong", value: "chittagong" },
            { label: "Comilla", value: "comilla" },
            { label: "Cox's Bazar", value: "coxsbazar" },
            { label: "Feni", value: "feni" },
            { label: "Khagrachari", value: "khagrachari" },
            { label: "Lakshmipur", value: "lakshmipur" },
            { label: "Bandarban", value: "bandarban" },
            { label: "Noakhali", value: "noakhali" },
            { label: "Rangamati", value: "rangamati" },
            { label: "Brahmanbaria", value: "brahmanbaria" },
            { label: "Chandpur", value: "chandpur" },
        ],
        dhaka: [
            { label: "Dhaka", value: "dhaka" },
            { label: "Faridpur", value: "faridpur" },
            { label: "Gazipur", value: "gazipur" },
            { label: "Gopalganj", value: "gopalganj" },
            { label: "Kishoreganj", value: "kishoreganj" },
            { label: "Madaripur", value: "madaripur" },
            { label: "Manikganj", value: "manikganj" },
            { label: "Munshiganj", value: "munshiganj" },
            { label: "Narayanganj", value: "narayanganj" },
            { label: "Narsingdi", value: "narsingdi" },
            { label: "Rajbari", value: "rajbari" },
            { label: "Shariatpur", value: "shariatpur" },
            { label: "Tangail", value: "tangail" },
            { label: "Jamalpur", value: "jamalpur" },
        ],
        khulna: [
            { label: "Khulna", value: "khulna" },
            { label: "Bagerhat", value: "bagerhat" },
            { label: "Chuadanga", value: "chuadanga" },
            { label: "Jessore", value: "jessore" },
            { label: "Jhenaidah", value: "jhenaidah" },
            { label: "Kushtia", value: "kushtia" },
            { label: "Magura", value: "magura" },
            { label: "Meherpur", value: "meherpur" },
            { label: "Narail", value: "narail" },
            { label: "Satkhira", value: "satkhira" },
        ],
        mymensingh: [
            { label: "Mymensingh", value: "mymensingh" },
            { label: "Netrokona", value: "netrokona" },
            { label: "Sherpur", value: "sherpur" },
            { label: "Jamalpur", value: "jamalpur" },
        ],
        rajshahi: [
            { label: "Rajshahi", value: "rajshahi" },
            { label: "Bogra", value: "bogra" },
            { label: "Chapainawabganj", value: "chapainawabganj" },
            { label: "Joypurhat", value: "joypurhat" },
            { label: "Naogaon", value: "naogaon" },
            { label: "Natore", value: "natore" },
            { label: "Pabna", value: "pabna" },
            { label: "Sirajganj", value: "sirajganj" },
        ],
        rangpur: [
            { label: "Rangpur", value: "rangpur" },
            { label: "Dinajpur", value: "dinajpur" },
            { label: "Gaibandha", value: "gaibandha" },
            { label: "Kurigram", value: "kurigram" },
            { label: "Lalmonirhat", value: "lalmonirhat" },
            { label: "Nilphamari", value: "nilphamari" },
            { label: "Panchagarh", value: "panchagarh" },
            { label: "Thakurgaon", value: "thakurgaon" },
        ],
        sylhet: [
            { label: "Sylhet", value: "sylhet" },
            { label: "Habiganj", value: "habiganj" },
            { label: "Maulvibazar", value: "maulvibazar" },
            { label: "Sunamganj", value: "sunamganj" },
        ],
    };

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

                    document.querySelector("#total-price").textContent =
                        data.amount;

                    successMessage.textContent = data.message;
                    errorMessage.textContent = "";

                    document.querySelector("#coupon-input").value = coupon;
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    };

    const setupSelectDivisionEventListener = () => {
        const selectDivision = document.querySelector(
            "#select-division-option",
        );
        const selectDistrict = document.querySelector(
            "#select-district-option",
        );
        selectDivision.addEventListener("change", function (event) {
            console.log("changed", event.target.value);
            selectDistrict.disabled = false;
            DIVISIONS[event.target.value]?.forEach(({ label, value }) => {
                const option = document.createElement("option");
                option.value = value;
                option.textContent = label;
                selectDistrict.appendChild(option);
            });
        });
    };

    setupApplyCouponEventListener();
    setupSelectDivisionEventListener();
});
