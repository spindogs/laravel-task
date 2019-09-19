@extends('master')

@section('title', 'Tickets')

@section('body')
    <h1>Ticket Listings</h1>
    <p class="lead text-muted">There are currently <strong>{{count($todo_tickets)}}</strong>
        pending {{Str::plural('ticket', count($todo_tickets))}}</p>
    <div class="row text-dark">
        <div class="col-12 mb-3">
            <form>
                <div class="row">
                    <div class="col-12"><h3 class="text-light">Filters</h3></div>

                    <div class="col-4">
                        <select class="form-control" name="f_sort">
                            <option value="">Sort By:</option>
                            <option value="created">Date Created</option>
                            <option value="updated">Date Updated</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <select class="form-control" name="f_client">
                            <option value="">Client Filter:</option>
                            @foreach (\App\Clients::all() as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-outline-success btn-block">Apply Filters</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Pending tickets:
                </div>
                <div class="card-body">
                    @if ($todo_tickets->isEmpty())
                        <div class="alert alert-success mb-0">
                            You're clear! No outstanding tickets!
                        </div>
                    @else
                        <ul id="ticket-list" class="list-group">
                            @foreach($todo_tickets as $ticket)
                                <li class="list-group-item {{$ticket_types[$ticket->priority]}}">
                                    <a href="{{route('ticket.view', ['id' => $ticket->id])}}">
                                        {{$ticket->name}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    Completed tickets:
                </div>
                <div class="card-body">
                    @if ($complete_tickets->isEmpty())
                        <div class="alert alert-success mb-0">
                            No cleared tickets? Fresh install!
                        </div>
                    @else
                        <ul id="ticket-list" class="list-group">
                            @foreach($complete_tickets as $ticket)
                                <li class="list-group-item {{$ticket_types[$ticket->priority]}}">
                                    <a href="{{route('ticket.view', ['id' => $ticket->id])}}">
                                        {{$ticket->name}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
