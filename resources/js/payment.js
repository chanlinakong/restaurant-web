import { showError } from "./utils/swal";

const stripe = Stripe(window.stripeKey);

let elements;

const checkoutData = JSON.parse(
    sessionStorage.getItem("checkout_cart") || "{}"
);

const subtotalEl = document.getElementById("summarySubtotal");
const totalEl = document.getElementById("summaryTotal");
const payBtn = document.getElementById("payBtn");
const taxEl = document.getElementById("summaryTax");


if (!checkoutData.total) {
    window.location.href = "/orders";
}


function updateSummary() {

    const amount = Number(checkoutData.total || 0);

    subtotalEl.textContent = `$${amount.toFixed(2)}`;
    taxEl.textContent = `$${(amount * 0.1).toFixed(2)}`; // Assuming 10% tax
    totalEl.textContent = `$${(amount + amount * 0.1).toFixed(2)}`;
}


async function initializePayment() {

    try {

        const response = await fetch("/payment/intent", {

            method: "POST",

            headers: {

                "Content-Type": "application/json",

                "Accept": "application/json",

                "X-CSRF-TOKEN":
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,

            },

            body: JSON.stringify({

                amount: checkoutData.total

            }),

        });


        const data = await response.json();


        if (!response.ok) {

            throw new Error(
                data.message || "Unable to create payment"
            );

        }


        elements = stripe.elements({

            clientSecret: data.clientSecret

        });


        const paymentElement =
            elements.create("payment");


        paymentElement.mount(
            "#payment-element"
        );


    } catch(error) {

        showError(
            "Payment Initialization Failed",
            error.message
        );

    }

}


payBtn?.addEventListener(
    "click",
    async () => {


        payBtn.disabled = true;
        payBtn.textContent = "Processing...";


        const result =
            await stripe.confirmPayment({

                elements,

                confirmParams: {

                    return_url:
                        window.location.origin +
                        "/payment/success"

                }

            });


        if (result.error) {

            showError(
                "Payment Failed",
                result.error.message
            );


            payBtn.disabled = false;
            payBtn.textContent =
                "Pay with Stripe";

        }


    }
);


updateSummary();

initializePayment();