<?php

namespace App\Http\Controllers;

use App\Mail\TicketClosed;
use App\Mail\TicketReplyNotification;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('admin.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('admin.show', compact('ticket'));
    }

    public function close(Ticket $ticket)
    {
        $ticket->update(['status' => 'closed']);
        Mail::to(Auth::user()->email)->send(new TicketClosed($ticket));

        return redirect()->route('admin')->with('success', 'Ticket closed successfully!');
    }

    public function AdminReply(Request $request, $ticketId)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $ticket = Ticket::findOrFail($ticketId);


        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'user_type' => 'admin',
        ]);

        // Notify the customer via email simple mail transfer protocol use for mailtrap
        Mail::to($ticket->user->email)->send(new TicketReplyNotification($ticket));

        return redirect()->back()->with('success', 'Your reply has been sent.');
    }
}
