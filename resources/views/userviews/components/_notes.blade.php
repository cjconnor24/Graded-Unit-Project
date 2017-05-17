@component('components.panel',['id'=>'note-panel'])
    @slot('title')
        <span class="fi-misc-chat-1 fi-misc"></span> Order Notes
    @endslot

    {!! Form::open(['action' => ['Admin\OrderController@addNote',$order],'method'=>'POST']) !!}

    <div class="form-group">
        <label for="note">New Note</label>
        <textarea name="content" id="note" class="form-control" placeholder="Add New Note"></textarea>

    </div>

    <button class="btn btn-success" type="submit"><span class="fi-misc-chat fi-misc"></span> Add Note</button>

    {!! Form::close() !!}

    <hr>

    @if($order->notes->count()>0)

    @foreach($order->notes as $note)

        <div class="note">

            <p class="lead">{{$note->content}}<p>
            <p class="text-right"><em>{{$note->created_at->diffForHumans()}} {{$note->user->full_name}}</em></p>
            <hr>
        </div>
    @endforeach

    @else

        <p><em>There are currently no notes</em></p>

    @endif

@endcomponent