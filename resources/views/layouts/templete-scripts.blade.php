<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{asset("assets4")}}/vendor/libs/jquery/jquery.js"></script>
<script src="{{asset("assets4")}}/vendor/libs/popper/popper.js"></script>
<script src="{{asset("assets4")}}/vendor/js/bootstrap.js"></script>
<script src="{{asset("assets4")}}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="{{asset("assets4")}}/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{asset("assets4")}}/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="{{asset("assets4")}}/js/main.js"></script>

<!-- Page JS -->
<script src="{{asset("assets4")}}/js/dashboards-analytics.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if(\Illuminate\Support\Facades\Session::has("message"))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
            "positionClass": "toast-bottom-right",
        };

        // Ensure the session message is not empty
        var message = "{{ \Illuminate\Support\Facades\Session::get("message") }}";
        if (message.trim() !== "") {
            toastr.success(message);
        }
    </script>
@endif


<script async defer src="https://buttons.github.io/buttons.js"></script>
