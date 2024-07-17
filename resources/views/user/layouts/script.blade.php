<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>


<!-- Vendor JS Files -->
<script src="{{ asset('impact/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('impact/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('impact/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('impact/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('impact/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('impact/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('impact/assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('impact/assets/js/main.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- Bootstrap 5 CSS and JS includes -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<!-- End About Us Section -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        $(document).ready(function() {
            $('#questionModal').modal('show');
        });

        document.getElementById('PernahBtn').addEventListener('click', function() {
            $('#questionModal').modal('hide');
            $('#questionModal').on('hidden.bs.modal', function() {
                $('#detailModal').modal('show');
                $(this).off('hidden.bs.modal');
            });
        });

        document.getElementById('yaBtn').addEventListener('click', function() {
            $('#detailModal').modal('hide');
            $('#detailModal').on('hidden.bs.modal', function() {
                window.location.href = "#portfolio";
                $(this).off('hidden.bs.modal');
            });
        });
    });
</script>

@php
    $messageType = '';
    $message = '';

    if (Session::get('success')) {
        $messageType = 'success';
        $message = Session::get('success');
    } elseif (Session::get('failed')) {
        $messageType = 'error';
        $message = Session::get('failed');
    }
@endphp

@if ($message)
    <script>
        Swal.fire({
            title: '{{ $messageType === 'success' ? 'Success' : 'Error' }}',
            text: '{{ $message }}',
            icon: '{{ $messageType }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
