<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketComment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Mail\SupportTicketEmail;
use App\Mail\TicketAdminReplyEmail;
use App\Mail\TicketCloseEmail;
use App\Mail\TicketOpenEmail;
use Mail;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','ckstatus']);
    }
    
    public function ticketIndex()
    {
        $all_ticket =Ticket::where('customer_id', Auth::user()->id)
                            ->orderBy('id', 'desc')->paginate(15);
        return view('client.support.support' , compact('all_ticket'));
    }

    public function ticketCreate()
    {
        return view('client.support.add_ticket');
    }

    public function ticketStore(Request $request)
    {
        $this->validate($request, [
            'subject' =>'required',
            'detail' => 'required'
        ]);

        $a = strtoupper(md5(uniqid(rand(), true)));

        $ticket = Ticket::create([
           'subject' => $request->subject,
           'ticket' => substr($a, 0, 8),
           'customer_id' => Auth::user()->id,
        ]);

        TicketComment::create([
           'ticket_id' => $ticket->ticket,
           'type' => 1,
           'comment' => $request->detail,
        ]);

        $email = Auth::user()->email;

        $objTicket = new \stdClass();
        $objTicket->first_name = Auth::user()->first_name;
        $objTicket->ticket_id = $ticket->ticket;
        $objTicket->subject = $request->subject;
        $objTicket->details = $request->detail;
        $objTicket->status = 'Open';

        Mail::to($email)->send(new SupportTicketEmail($objTicket));

        Session::flash('message', 'Ticket Successfully Created!');
        return redirect()->route('add.new.ticket');
    //    return redirect()->route('ticket.customer.reply',$ticket->ticket);


    }

    public function ticketReply($ticket)
    {
        $ticket_object = Ticket::where('customer_id', Auth::user()->id)
            ->where('ticket', $ticket)->first();
        $ticket_data = TicketComment::where('ticket_id', $ticket)->get();

        if ($ticket_object  == '')
        {
            return redirect()->route('pagenot.found');
        }else{
            return view('client.support.view_ticket', compact('ticket_data', 'ticket_object'));
        }
    }

    public function ticketReplyStore(Request $request, $ticket)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        TicketComment::create([
            'ticket_id' => $ticket,
            'type' => 1,
            'comment' => $request->comment,
        ]);

        Ticket::where('ticket', $ticket)
            ->update([
               'status' => 3
            ]);

        return redirect()->back()->with('message', 'Message Send Successful');
    }

    public function indexSupport()
    {
        $all_ticket = Ticket::orderBy('id', 'desc')->paginate(20);
        return view('admin.support.support', compact('all_ticket'));
    }

    public function adminSupport($ticket)
    {
        $ticket_object = Ticket::where('ticket', $ticket)->first();
        $ticket_data = TicketComment::where('ticket_id', $ticket)->get();
        return view('admin.support.view_reply', compact('ticket_object', 'ticket_data'));
    }

    public function adminReply(Request $request, $ticket)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        TicketComment::create([
            'ticket_id' => $ticket,
            'type' => 0,
            'comment' => $request->comment,
        ]);

        Ticket::where('ticket', $ticket)
            ->update([
                'status' => 2
            ]); 

        $customer_id = Ticket::where('ticket', $ticket)->value('customer_id');
        $customer_first_name = User::where('id', $customer_id)->value('first_name');
        $customer_email = User::where('id', $customer_id)->value('email');

        $objTicket = new \stdClass();
        $objTicket->first_name = $customer_first_name;
        $objTicket->ticket_id = $ticket;
        $objTicket->comment = $request->comment;
        $objTicket->status = 'Admin Reply';

        Mail::to($customer_email)->send(new TicketAdminReplyEmail($objTicket));

        return redirect()->back()->with('message', 'Message Send Successful');

    }

    public function ticketClose($ticket)
    {

        Ticket::where('ticket', $ticket)
            ->update([
                'status' => 9
            ]);

        $customer_id = Ticket::where('ticket', $ticket)->value('customer_id');
        $customer_first_name = User::where('id', $customer_id)->value('first_name');
        $customer_email = User::where('id', $customer_id)->value('email');

        $objTicket = new \stdClass();
        $objTicket->first_name = $customer_first_name;
        $objTicket->ticket_id = $ticket;
        $objTicket->status = 'Close';

        Mail::to($customer_email)->send(new TicketCloseEmail($objTicket));

      //  return redirect()->back()->with('message', 'Conversation closed, But you can start again');
          return response()->json(['success' => true]);
    }

    public function ticketReopen($ticket)
    {
        Ticket::where('ticket', $ticket)
            ->update([
                'status' => 1
            ]);

        $customer_id = Ticket::where('ticket', $ticket)->value('customer_id');
        $customer_first_name = User::where('id', $customer_id)->value('first_name');
        $customer_email = User::where('id', $customer_id)->value('email');

        $objTicket = new \stdClass();
        $objTicket->first_name = $customer_first_name;
        $objTicket->ticket_id = $ticket;
        $objTicket->status = 'Open';

        Mail::to($customer_email)->send(new TicketOpenEmail($objTicket));

      //  return redirect()->back()->with('message', 'Conversation closed, But you can start again');
          return response()->json(['success' => true]);   
    }


}
