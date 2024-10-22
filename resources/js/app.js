import "./bootstrap";
import Swal from "sweetalert2";

// Confirm Delete
window.confirmDelete = function (data, deleteUrl) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            // Buat form secara dinamis
            const form = document.createElement("form");
            form.method = "POST";
            form.action = deleteUrl;

            // Tambahkan input hidden untuk metode DELETE
            const methodInput = document.createElement("input");
            methodInput.type = "hidden";
            methodInput.name = "_method";
            methodInput.value = "DELETE";
            form.appendChild(methodInput);

            // Tambahkan input hidden untuk token CSRF
            const tokenInput = document.createElement("input");
            tokenInput.type = "hidden";
            tokenInput.name = "_token";
            tokenInput.value = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");
            form.appendChild(tokenInput);

            // Tambahkan form ke body dan submit
            document.body.appendChild(form);
            form.submit();
        }
    });
};
