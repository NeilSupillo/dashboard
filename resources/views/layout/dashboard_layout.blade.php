<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('JS/CSS')
</head>

<body>
    {{-- <x-navigation.navbar /> --}}
    @yield('content')
</body>

</html>