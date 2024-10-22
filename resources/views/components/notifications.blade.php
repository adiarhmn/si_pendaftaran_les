@if (session('success'))
    <script>
        // Setelah Page di Load, Munculkan Toast
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "{{ session('success') }}",
            });
        });
    </script>
@endif
