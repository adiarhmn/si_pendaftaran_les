    @if (session('snapToken'))
        <script type="text/javascript">
            // Setelah Page di Load, Munculkan Midtrans Popup
            document.addEventListener('DOMContentLoaded', function() {
                window.snap.pay("{{ session('snapToken') }}", {
                    onSuccess: async function(result) {
                        console.log("success");
                        console.log(result);
                        // POST URL /peserta/finish-payment
                        try {
                            let response = await fetch('{{ route('peserta.finish.payment') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    id_peserta_kursus: '{{ session('id_peserta_kursus') }}',
                                    paymentResult: result
                                })
                            });

                            let data_result = await response.json();
                            if (data_result.status === 'success') {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "{{ session('success') }}",
                                }).then((result) => {
                                    window.location.reload();
                                });
                            } else {
                                console.error('Error:', data_result.message);
                            }
                        } catch (error) {
                            console.error('Error:', error);
                        }

                    },
                    onPending: function(result) {
                        console.log("pending");
                        console.log(result);
                    },
                    onError: function(result) {
                        console.log("error");
                        console.log(result);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Terjadi Kesalahan Saat Melakukan Pembayaran",
                        });
                    },
                    onClose: function() {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Anda Membatalkan Pembayaran",
                        });
                    },
                });
            });
        </script>
    @endif
