<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clicker;

class ClickerController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create()
    {
        $clicker = new Clicker();

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
        return Clicker::find($id);
    }

    public function getAll()
    {
        return Clicker::select('id')->get()->pluck('id');
    }

    public function init()
    {
        return Clicker::latest('updated_at')->first();
    }


    public function delete($id)
    {
        Clicker::findOrFail($id)->delete();

        return response()->json('Successfully deleted');
    }

    public function support() {
        return view('support');
    }
}
