<?php

namespace App\Http\Controllers;

use App\Mail\TicketPosted;
use App\Mail\TicketReplyNotification;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())
            ->with('replies')
            ->get();

        foreach ($tickets as $ticket) {
            $ticket->replies = $ticket->replies->reverse();
        }

        return view('customer.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }
        return view('customer.show', compact('ticket'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => 'open',
        ]);


        // Notify the customer via email simple mail transfer protocol use for mailtrap
        Mail::to($ticket->user->email)->send(
            new TicketPosted($ticket)
        );

        return redirect('/')->with('success', 'Ticket created successfully!');
    }

    public function customerReply(Request $request, $ticketId)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $ticket = Ticket::findOrFail($ticketId);


        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'user_type' => 'customer',
        ]);

        // Notify the customer via email simple mail transfer protocol use for mailtrap
        Mail::to($ticket->user->email)->send(new TicketReplyNotification($ticket));

        return redirect()->back()->with('success', 'Your reply has been sent.');
    }
}
