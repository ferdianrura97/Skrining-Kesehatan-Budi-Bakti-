<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env("APP_NAME") }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href=" {{ asset('assets/images/favicon.ico') }} " />

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href=" {{ asset('assets/css/core/libs.min.css') }} " />

    <!-- Aos Animation Css -->
    <link rel="stylesheet" href=" {{ asset('assets/vendor/aos/dist/aos.css') }} " />

    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href=" {{ asset('assets/css/hope-ui.min.css?v=1.2.0') }} " />

    <!-- Custom Css -->
    <link rel="stylesheet" href=" {{ asset('assets/css/custom.min.css?v=1.2.0') }} " />

    <!-- Dark Css -->
    <link rel="stylesheet" href=" {{ asset('assets/css/dark.min.css') }} " />

    <!-- Customizer Css -->
    <link rel="stylesheet" href=" {{ asset('assets/css/customizer.min.css') }} " />

    <!-- RTL Css -->
    <link rel="stylesheet" href=" {{ asset('assets/css/rtl.min.css') }} " />

    <script src="https://kit.fontawesome.com/fd2604c75e.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-selection__rendered {
            line-height: 38px !important;
        }
        .select2-container .select2-selection--single {
            height: 40px !important;
        }
        .select2-selection__arrow {
            height: 34px !important;
        }
    }
    </style>
    @stack('styles')

</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->

    <!-- Sidebar Start -->
    @include('layouts._sidebar')
    <!-- Sidebar END -->

    <main class="main-content">
        <div class="position-relative iq-banner">

            <!--Header Start-->
            @include('layouts._header')
            <!--Header End-->
            
            <!-- Nav Header Component Start -->
            @yield('breadcrumb')
            <!-- Nav Header Component End -->
            <!--Nav End-->
        </div>

        <div class="conatiner-fluid content-inner mt-n5 py-0">
            @yield('content')
        </div>

        <!-- Footer Section Start -->
        @include('layouts._footer')
        <!-- Footer Section End -->
    </main>
    <!-- Wrapper End-->

    <!-- Library Bundle Script -->
    <script src=" {{ asset('assets/js/core/libs.min.js') }}"></script>

    <!-- External Library Bundle Script -->
    <script src=" {{ asset('assets/js/core/external.min.js') }}"></script>

    <!-- Widgetchart Script -->
    <script src=" {{ asset('assets/js/charts/widgetcharts.js') }}"></script>

    <!-- mapchart Script -->
    <script src=" {{ asset('assets/js/charts/vectore-chart.js') }}"></script>
    <script src=" {{ asset('assets/js/charts/dashboard.js') }}"></script>

    <!-- fslightbox Script -->
    <script src=" {{ asset('assets/js/plugins/fslightbox.js') }}"></script>

    <!-- Settings Script -->
    <script src=" {{ asset('assets/js/plugins/setting.js') }}"></script>

    <!-- Slider-tab Script -->
    <script src=" {{ asset('assets/js/plugins/slider-tabs.js') }}"></script>

    <!-- Form Wizard Script -->
    <script src=" {{ asset('assets/js/plugins/form-wizard.js') }}"></script>

    <!-- AOS Animation Plugin-->
    <script src=" {{ asset('assets/vendor/aos/dist/aos.js') }}"></script>

    <!-- App Script -->
    <script src=" {{ asset('assets/js/hope-ui.js') }}" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.min.js" integrity="sha512-hAJgR+pK6+s492clbGlnrRnt2J1CJK6kZ82FZy08tm6XG2Xl/ex9oVZLE6Krz+W+Iv4Gsr8U2mGMdh0ckRH61Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @include('layouts.include.message')

    @stack('scripts')
    <script>
        $(document).ready(function() {
            $('.money').mask('000.000.000.000.000', {reverse: true});
            $('.phone').mask('0000-0000-0000');
            $('.number').mask('0000000000000');

            $('.select2').select2();

            $('#datatable-print').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        });
    </script>

</body>

</html>