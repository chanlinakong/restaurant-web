import Swal from "sweetalert2";
const dark = () => document.documentElement.classList.contains("dark");
const options = { confirmButtonColor: "#f59e0b" };
export function showSuccess(title, text) {
    return Swal.fire({
        icon: "success",
        title,
        text,
        background: dark() ? "#1f2937" : "#ffffff",
        color: dark() ? "#f9fafb" : "#111827",
        ...options,
    });
}
export function showError(title, text) {
    return Swal.fire({
        icon: "error",
        title,
        text,
        background: dark() ? "#1f2937" : "#ffffff",
        color: dark() ? "#f9fafb" : "#111827",
        ...options,
    });
}
