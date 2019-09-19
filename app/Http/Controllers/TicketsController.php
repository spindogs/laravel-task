<?php

namespace App\Http\Controllers;

use App\Comments;
use Illuminate\Routing\Controller as BaseController;
use App\Tickets;
use App\Clients;

class TicketsController extends BaseController {
	private $ticket_map = [
		1 => 'list-group-item-success',
		2 => 'list-group-item-primary',
		3 => 'list-group-item-info',
		4 => 'list-group-item-warning',
		5 => 'list-group-item-danger'
	];

	private $ticket_map_text = [
		1 => 'Lowest',
		2 => 'Low',
		3 => 'Medium',
		4 => 'High',
		5 => 'Highest'
	];

	public function index() {
		$todo_tickets = Tickets::where('status', Tickets::STATUS_TODO);
		if (request('f_sort') && in_array(request('f_sort'), ['updated', 'created'])) {
			if (request('f_sort') == 'created') $todo_tickets->orderBy('created_at', 'desc');
			elseif (request('f_sort') == 'updated') $todo_tickets->orderBy('updated_at', 'desc');
		}

		if (request('f_client') && Clients::find(request('f_client'))) {
			$todo_tickets->where('client', request('f_client'));
		}

		$todo_tickets = $todo_tickets->get();
		$complete_tickets = Tickets::where('status', Tickets::STATUS_COMPLETE)->get();
		$ticket_types = $this->ticket_map;

		return view('tickets', compact('todo_tickets', 'complete_tickets', 'ticket_types'));
	}

	public function new() {
		$ticket = new Tickets();
		$ticket->name = request('ct_inputName');
		$ticket->priority = request('ct_ticketPriority');
		$ticket->client = request('ct_client');
		$ticket->details = request('ct_inputName');
		$ticket->status = Tickets::STATUS_TODO;
		$ticket->save();

		return redirect(route('tickets'));
	}

	public function view($id) {
		$ticket = Tickets::find($id);
		$ticket_map_text = $this->ticket_map_text;
		$client = Clients::find($ticket->client);
		$title = 'Ticket - ' . $ticket->name;

		$comments = Comments::where('ticket', $ticket->id)->get();

		return view('ticket_view', compact('ticket', 'title', 'ticket_map_text', 'client', 'comments'));
	}

	public function newComment($ticket_id) {
		$comment = new Comments();
		$comment->ticket = $ticket_id;
		$comment->name = request('comment_name');
		$comment->details = request('comment_details');
		$comment->save();
		Tickets::find($ticket_id)->touch();

		return redirect(route('ticket.view', ['id' => $ticket_id]));
	}

	public function deleteTicket($ticket_id) {
		$ticket = Tickets::find($ticket_id);
		if($ticket) $ticket->delete();

		return redirect(route('tickets'));
	}

	public function completeTicket($ticket_id) {
		$ticket = Tickets::find($ticket_id);
		if($ticket) {
			$ticket->status = Tickets::STATUS_COMPLETE;
			$ticket->save();
		}

		return redirect(route('ticket.view', ['id' => $ticket_id]));
	}
}
