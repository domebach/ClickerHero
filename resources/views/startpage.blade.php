@extends('layouts.header')

@section('title')
    Home
@endsection

@section('header')
    @if (isset($user) && $user->logged_in)
        <a class="btnReg text-xl hover:text-white hover:bg-blue-700 hover:no-underline my-3" href="{{ route('game', $user) }}">Play</a>
        <a class="btnReg text-xl hover:text-white hover:bg-blue-700 hover:no-underline my-3" href="{{ route('register') }}">Profile</a>
        <a class="btnLog text-xl hover:text-white hover:bg-blue-700 hover:no-underline my-3" href="{{ route('logout', $user) }}">Logout</a>
    @else
        <a class="btnReg text-xl hover:text-white hover:bg-blue-700 hover:no-underline my-3" href="{{ route('register') }}">Register for free</a>
        <a class="btnLog text-xl hover:text-white hover:bg-blue-700 hover:no-underline my-3" href="{{ route('login') }}">Login</a>
    @endif
@endsection

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/6.0.4/math.js"></script>
    <div class="">

        <div id="app">
            @if (isset($user) && $user->logged_in)
                <startpage logged_in="{{ $user->logged_in }}" user_id="{{ $user->id }}"></startpage>
            @else
                <startpage></startpage>
            @endif
        </div>


        <script src="{{ mix('js/app.js') }}"></script>

    </div>
@endsection

