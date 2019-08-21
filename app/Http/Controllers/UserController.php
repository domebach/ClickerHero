<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('startpage');
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name'     => 'required',
            'password' => 'required',
            'email'    => 'required',
            'region'   => 'required'
        ]);

        $user = User::create([
            'name'      => strtolower(request('name')),
            'email'     => request('email'),
            'password'  => Hash::make(request('password')),
            'region'    => request('region'),
            'api_token' => Str::random(80)
        ]);


        return response()->json( $user->id);
    }

    public function login()
    {
        return view('login');
    }

    public function loginRequest(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'password' => 'required'
        ]);


        $user = User::where('name', strtolower($request->name))->get()->first();

        if ($user && strtolower($request->name) === $user->name && Hash::check($request->password, $user->password)) {
            $user_id = $user->id;
            return response()->json( $user_id );
        }

        return response()->json(false);
    }

    public function show($id)
    {
        $user = User::where('id', $id)->get();

        return response()->json($user);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
