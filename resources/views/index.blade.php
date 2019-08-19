<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/6.0.4/math.js"></script>

<html>
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

    <body class="base-img">
        <div>
            <div id="app" class="basement">
                <clickers></clickers>
            </div>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>

    </body>
</html>
