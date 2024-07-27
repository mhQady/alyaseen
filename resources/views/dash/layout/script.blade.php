<script src="{{ asset('dashboard/js/core/popper.min.js') }}"></script>
<script src="{{ asset('dashboard/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('dashboard/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dashboard/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('dashboard/js/plugins/choices.min.js') }}"></script>
<script src="{{ asset('dashboard/js/plugins/dragula/dragula.min.js') }}"></script>
<script src="{{ asset('dashboard/js/plugins/jkanban/jkanban.js') }}"></script>
<script src="{{ asset('dashboard/js/plugins/jquery/jquery.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    window.toast = Swal.mixin({
            toast: true,
            position: "{{ app()->getLocale()=='ar'?'top-start':'top-end' }}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
               toast.addEventListener('mouseenter', Swal.stopTimer)
               toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
         })
</script>

@stack('script')

<script src="{{ asset('dashboard/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>

@include('sweetalert::alert')
