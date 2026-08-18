import { showSuccess, showError } from "./utils/swal";
async function completeOrder() {
    const checkoutData = JSON.parse(
        sessionStorage.getItem("checkout_cart") || "{}",
    );
    if (!checkoutData.items?.length) {
        window.location.href = "/orders";
        return;
    }
    try {
        const response = await fetch("/orders", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
            body: JSON.stringify(checkoutData),
        });

        const text = await response.text();

        console.log("STATUS:", response.status);
        console.log("RESPONSE:", text);

        let data;

        try {
            data = JSON.parse(text);
        } catch (error) {
            console.error("Server did not return JSON:", text);

            throw new Error(
                `Server returned HTML instead of JSON. HTTP ${response.status}`
            );
        }

        if (!response.ok) {
            throw new Error(
                data.message || "Failed to create order."
            );
        }

        sessionStorage.removeItem("checkout_cart");
        localStorage.removeItem("cart");

        await showSuccess(
            "Order Placed!",
            "Your payment was successful and the order has been created.",
        );

        window.location.href = `/orders/${data.order_id}`;
    } catch (error) {
        await showError("Order Error", error.message);
        window.location.href = "/orders";
    }
}
completeOrder();
