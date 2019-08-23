<html lang="de-DE">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <link type="text/css" href="/css/tailwind.min.css" rel="stylesheet">
    <link type="text/css" href="/css/support.css" rel="stylesheet">

</head>

<body >
    <div class="globalW mx-auto flex items-center m-0 p-7">
        <div class="w-1/3 p-2">
            <p class="text-xs shadow-none text-black italic">Sponsored by </p>
            <img class="svg" src="/images/logo.svg">
        </div>

        <div class="w-1/3">

        </div>

        <div class="w-1/3 flex justify-end">
            @yield('header')
        </div>
    </div>

    @yield('content')
</body>
</html>
