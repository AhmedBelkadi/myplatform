<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Ticket System</title>

    <meta name="description" content="" />
    @include("layouts.templete-links")
    @yield('styles')

</head>

<body>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">

    <div class="layout-container">

        @include("components.sidebar")
        <!-- Layout page -->
        <div class="layout-page">
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-fluid px-4 py-4">
                    @yield("main")
                </div>
                <!-- / Content -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- / Content wrapper -->
        </div>
        <!-- / Layout page -->

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

</div>
<!-- / Layout wrapper -->


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@include("layouts.templete-scripts")
<!-- ApexCharts -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    // Global Toastr configuration
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "timeOut": "5000"
    };
</script>

@if(\Illuminate\Support\Facades\Session::has('success'))
    <script>
        toastr.success("{{\Illuminate\Support\Facades\Session::get('success')}}");
    </script>
@endif

@if(\Illuminate\Support\Facades\Session::has('error'))
    <script>
        toastr.error("{{\Illuminate\Support\Facades\Session::get('error')}}");
    </script>
@endif

@if(\Illuminate\Support\Facades\Session::has('warning'))
    <script>
        toastr.warning("{{\Illuminate\Support\Facades\Session::get('warning')}}");
    </script>
@endif

@if(\Illuminate\Support\Facades\Session::has('info'))
    <script>
        toastr.info("{{\Illuminate\Support\Facades\Session::get('info')}}");
    </script>
@endif

@yield("scripts")

</body>
</html>
