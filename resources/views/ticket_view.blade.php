@extends('master')

@section('title', $title)

@section('body')
    <h1 class="mb-3">Ticket - {{$ticket->name}}</h1>
    <div class="row text-dark">
        <div class="col-12 col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    General Information
                </div>
                <div class="card-body py-0">
                    <div class="row py-3 border-bottom">
                        <div class="col-4">Ticket Name</div>
                        <div class="col-8">{{$ticket->name}}</div>
                    </div>
                    <div class="row py-3 border-bottom">
                        <div class="col-4">Ticket Priority</div>
                        <div class="col-8">{{$ticket_map_text[$ticket->priority]}}</div>
                    </div>
                    <div class="row py-3 border-bottom">
                        <div class="col-4">Client</div>
                        <div class="col-8">{{$client->name}}</div>
                    </div>
                    <div class="row py-3 border-bottom">
                        <div class="col-4">Created At</div>
                        <div class="col-8">{{$ticket->created_at->format('Y-m-d H:i:s')}}</div>
                    </div>
                    <div class="row py-3 border-bottom">
                        <div class="col-4">Ticket Information</div>
                        <div class="col-8">{{nl2br($ticket->details)}}</div>
                    </div>
                    <div class="py-3">
                        <form class="mb-2" method="post" action="{{route('ticket.complete', ['id' => $ticket->id])}}">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-block btn-success">Mark as Complete</button>
                        </form>
                        <form method="post" action="{{route('ticket.delete', ['id' => $ticket->id])}}">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-block btn-danger">Delete Ticket</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <div class="card comments" data-comment-card="">
                <div class="card-header">
                    Comments
                </div>
                @if($comments->isEmpty())
                    <div class="card-body ">

                        <div class="alert alert-info mb-0">
                            No comments yet!
                        </div>
                    </div>
                @else
                    @foreach ($comments as $comment)
                        <div class="card-body border-bottom">
                            <div class="d-flex justify-content-between border-bottom mb-3">
                                <h5>{{$comment->name}}</h5>
                                <small class="d-block text-muted">{{$comment->created_at->format('Y-m-d H:i')}}</small>
                            </div>
                            <p>{{$comment->details}}</p>
                        </div>
                    @endforeach
                @endif
                <div class="card-footer">
                    <form method="post" action="{{route('ticket.new_comment', ['id' => $ticket->id])}}">
                        {{csrf_field()}}
                        <input type="text" placeholder="Your Name" class="form-control mb-3" name="comment_name"
                               required>

                        <div class="input-group">
                            <textarea type="text" class="form-control" placeholder="Type comment"
                                      name="comment_details"></textarea>
                            <span class="input-group-append"><button class="btn btn-secondary"
                                                                     type="submit">+</button></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
