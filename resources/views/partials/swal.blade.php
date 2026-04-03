<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showSwal(type, message, redirect = null) {
        Swal.fire({
            icon: type,
            text: message,
            confirmButtonText: 'OK',
        }).then((result) => {
            if (redirect && result.isConfirmed) {
                window.location.href = redirect;
            }
        });
    }
</script>
