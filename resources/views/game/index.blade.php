<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/6.0.4/math.js"></script>
<script src="https://kit.fontawesome.com/7d929768ff.js"></script>

<html lang="de-DE">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>ClickerHero</title>
        <link rel="stylesheet" href="{{mix('css/app.css')}}">

        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <link type="text/css" href="/css/support.css" rel="stylesheet">

    </head>
    <body class="bg-gray-400">
        <div class="globalW mx-auto flex items-center m-0 p-7">
            <div class="w-1/3 p-2">
                <p class="text-xs shadow-none text-black italic">Sponsored by </p>
                <img class="svg" src="/images/logo.svg">
            </div>

            <div class="w-1/3">

            </div>

            <div class="w-1/3 flex justify-end">
                <a class="btnReg text-xl hover:text-white hover:bg-blue-700 hover:no-underline" href="{{ route('logout', ['id' => $id]) }}">Logout</a>
            </div>
        </div>

        <div class="base-img">
            <div id="app" class="basement" >
                <clickers user_id="{{ $id }}" logged_in="{{ $logged_in }}"></clickers>
            </div>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>

    </body>
</html>
