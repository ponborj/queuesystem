<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    <title>{{ config('app.name', 'QueueSystem') }} {!! empty($subtitle) ? '' : ' &vellip; ' . $subtitle !!}</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-zinc-200">
    {{ $slot }}
</body>

</html>
