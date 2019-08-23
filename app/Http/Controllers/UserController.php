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

    public function sessionIndex($id)
    {
        $user = User::find($id);

        return view('startpage', compact( 'user' ));
    }

    public function register()
    {
        return view('validation.register');
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

        $user->logged_in = true;
        $user->save();


        return response()->json( $user->id );
    }

    public function login()
    {
        return view('validation.login');
    }

    public function logout($id)
    {
        $user = User::find($id);
        $user->logged_in = false;
        $user->save();

        return redirect('/');
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
            $user->logged_in = true;
            $user->save();
            return response()->json( $user_id );
        }

        return response()->json(false);
    }

    public function show($id)
    {
        return response()->json( User::where('id', $id)->get() );
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
