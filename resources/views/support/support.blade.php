@extends('layouts.header')

@section('title')
    Support
@endsection

@section('header')
    @if (isset($user) && $user->logged_in)
        <a class="btnReg text-xl hover:text-white hover:bg-blue-700 hover:no-underline my-3" href="{{ route('game', $user) }}">Play</a>
        <a class="btnReg text-xl hover:text-white hover:bg-blue-700 hover:no-underline my-3" href="{{ route('tickets', $user) }}">My tickets</a>
        <a class="btnLog text-xl hover:text-white hover:bg-blue-700 hover:no-underline my-3" href="{{ route('logout', $user) }}">Logout</a>
    @else
        <a class="btnReg text-xl hover:text-white hover:bg-blue-700 hover:no-underline my-3" href="{{ route('register') }}">Register for free</a>
        <a class="btnLog text-xl hover:text-white hover:bg-blue-700 hover:no-underline my-3" href="{{ route('login') }}">Login</a>
    @endif
@endsection

@section('content')
    <div id="app">
        <support user_id="{{ $user->id }}"></support>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
@endsection
