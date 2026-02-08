<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Website Desa Dotte" name="description">
    <meta content="Desa Dotte" name="keywords">
    <meta name="author" content="Desa Dotte">

    <!-- Favicons -->
     <link rel="icon" type="image/png" href="{{ asset('assets/ico/favicon-96x96.png') }}" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="{{ asset('assets/ico/favicon.svg') }}" />
<link rel="shortcut icon" href="{{ asset('assets/ico/favicon.ico') }}" />
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/ico/apple-touch-icon.png') }}" />
<meta name="apple-mobile-web-app-title" content="Dotte WebDes" />
<link rel="manifest" href="{{ asset('assets/ico/site.webmanifest') }}" />


    <title>{{ @$title != ''  ? "$title - " : '' }} Halaman Admin Website Desa Dotte</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.css') }}">
   
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('admin/css/app-dark.css') }}" id="darkTheme" disabled>
    {{-- ajax toster --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- lafleat --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>


    {{-- trix editor --}}
    <link rel="stylesheet" href="{{ asset('admin/css/trix.css') }}">
    <script type="text/javascript" src="{{ asset('admin/js/trix.js') }}"></script>
    <style>
        trix-toolbar [data-trix-button-group='file-tools'] {
            display: none;
        }
    </style>
</head>

<body class="vertical  light  ">
    @yield('body')
    <div class="wrapper">
        @yield('headerside')
        <main role="main" class="main-content">
            @yield('main')
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">

                        @yield('content')
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->
            @include('admin.layouts.footer')
        </main> <!-- main -->
    </div> <!-- .wrapper -->
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/simplebar.min.js') }}"></script>
    <script src='{{ asset('admin/js/daterangepicker.js') }}'></script>
    <script src='{{ asset('admin/js/jquery.stickOnScroll.js') }}'></script>
    <script src="{{ asset('admin/js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('admin/js/config.js') }}"></script>
    <script src='{{ asset('admin/js/jquery.dataTables.min.js') }}'></script>
    <script src='{{ asset('admin/js/dataTables.bootstrap4.min.js') }}'></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.2.js"></script> --}}



    <script>
        $('#dataTable-1').DataTable({
            autoWidth: true,
            "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });
    </script>
    <script src="{{ asset('admin/js/apps.js') }}"></script>
    @yield('scrip')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>
</body>

</html>
