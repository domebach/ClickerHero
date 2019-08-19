<?php

namespace App\Http\Controllers;

use App\User;
use App\Clicker;
use Illuminate\Http\Request;

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
        $request->validate([
            'name'      => 'required',
            'password'  => 'required',
            'email'     => 'required',
            'region'     => 'required'
        ]);

        User::create($request->all());

        return response()->json(['success' => 'Done!']);
    }

    public function login()
    {
        return view('login');
    }

    public function loginRequest(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'password'  => 'required'
        ]);

        $user = User::where('name', $request->name)->get()->first();

        if ($user && $request->name === $user->name && $request->password === $user->password) {
            $clicker = Clicker::where('user_id', $user->id)->get();

            return response()->json($clicker);
        }


        return response()->json(false);
    }

    public function show($id)
    {
        //
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
