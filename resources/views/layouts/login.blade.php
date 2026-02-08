<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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

    <link href="{{ asset('login/login.css') }}" rel="stylesheet">
    <title>{{ @$title != '' ? "$title - " : '' }}{{ config('app.name') }}</title>
</head>
<body>
    @yield('body')

    <script src="{{ asset('login/login.js') }}"></script>
</body>
</html>