<?php

namespace App\Http\Controllers;

use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Clicker;
use Illuminate\Support\Facades\Auth;

class ClickerController extends Controller
{
    public function index($id)
    {
        $logged_in = User::find($id)->logged_in;

        return view('game.index',compact('id'), compact('logged_in'));
    }

    public function create($id)
    {
        $clicker = new Clicker();

        $clicker->user_id = $id;

        $clicker->save();
        $clicker->refresh();

        return response()->json($clicker);
    }
    public function update($id, Request $request)
    {
        $clicker = Clicker::find($id);
        $clicker->update($request->all());

        return response()->json('Game has been successfully saved');
    }

    public function get($id)
    {
        return response()->json(Clicker::find($id));
    }

    public function getAllById($id)
    {

        return response()->json( Clicker::select('id')->where('user_id', $id)->get()->pluck('id') );


    }

    public function init($id)
    {
        $clicker = Clicker::where('user_id', $id)->latest('updated_at')->first();

        if ($clicker) {
            return response()->json( $clicker );
        }

        return response()->json('');
    }


    public function delete($id)
    {
        Clicker::findOrFail($id)->delete();

        return response()->json('Successfully deleted');
    }
}
