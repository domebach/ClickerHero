<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function support($id)
    {
        $user = User::find($id);

        return view('support.support', compact('user'));
    }

    public function index($id)
    {
        $user = User::find($id);

        return view('support.tickets', compact('user'));
    }

    public function store(Request $request, $id)
    {
        request()->validate([
            'topic'       => 'required',
            'title'       => 'required',
            'description' => 'required',
            'region'      => 'required'
        ]);

        $ticket = Ticket::create([
            'topic'       => request('topic'),
            'title'       => request('title'),
            'description' => request('description'),
            'other'       => request('other'),
            'region'      => request('region'),
        ]);

        $ticket->user_id = $id;
        $ticket->save();

        return response()->json(true);
    }

    public function get($id)
    {
        return response()->json( Ticket::findOrFail($id)->get());
    }

    public function getAll($id)
    {
        return response()->json( Ticket::where('user_id', $id)->get());
    }

    public function show($id)
    {
        $ticket = Ticket::find($id);
        $user = User::find($ticket->user_id);

        return view('support.ticketView', compact('user'), compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    public function destroy($id)
    {
        Ticket::findOrFail($id)->delete();

        return response()->json(true);
    }
}
