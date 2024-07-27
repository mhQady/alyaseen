<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('dashboard/img/apple-icon.svg')}}">
    <link rel="icon" type="image/svg" href="{{asset('/favicon.svg')}}">
    <title>@yield('title') | Dearl</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{asset('dashboard/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard/css/nucleo-svg.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('dashboard/fonts/tajawal/tajawal.css') }}" />
    <!-- Font Awesome Icons -->
    <link href="{{asset('dashboard/css/nucleo-svg.css')}}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->

    @stack('style')

    <link id="pagestyle" href="{{asset('dashboard/css/soft-ui-dashboard.css?v=1.0.8')}}" rel="stylesheet" />

    @if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('dashboard/css/soft-ui-dashboard-rtl.css?v=1') }}">
    @endif

    <link href="{{asset('dashboard/css/style.css')}}" rel="stylesheet" />

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        let pusher = new Pusher('125939c2ea49d8c1c7f1', {
            cluster: 'eu'
            });

            let channel = pusher.subscribe('stock-channel');
            channel.bind('stock-changed', function(data) {
            Swal.mixin({
            toast: true,
            position: "{{ app()->getLocale()=='ar'?'top-start':'top-end' }}",
            showConfirmButton: false,
            timer: 6000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            }).fire({
            icon: 'warning',
            title: JSON.stringify(data.message)
            })
            });


    //   var channel = pusher.subscribe('notification-channel');
    //   channel.bind('product-created', function(data) {
    //      Swal.mixin({
    //         toast: true,
    //         position: "{{ app()->getLocale()=='ar'?'top-start':'top-end' }}",
    //         showConfirmButton: false,
    //         timer: 3000,
    //         timerProgressBar: true,
    //         didOpen: (toast) => {
    //            toast.addEventListener('mouseenter', Swal.stopTimer)
    //            toast.addEventListener('mouseleave', Swal.resumeTimer)
    //         }
    //      }).fire({
    //      icon: 'success',
    //      title: JSON.stringify(data.message)
    //      })
    //   });
    </script>
</head>