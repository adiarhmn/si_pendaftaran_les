<script>
    function confirmDelete(data, deleteUrl) {
        Swal.fire({
            title: "Yakin Hapus?",
            text: "Data " + data + " akan dihapus !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus",
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
</script>
