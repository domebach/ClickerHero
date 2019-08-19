@extends('layouts.header')

@section('title')
    Home
@endsection

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/6.0.4/math.js"></script>
    <div class="">

        <div id="app">
            <startpage></startpage>
        </div>


        <script src="{{ mix('js/app.js') }}"></script>

    </div>
@endsection

