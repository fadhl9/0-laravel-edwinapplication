@extends('layouts.admin')

@section('content')


@if(count($replies) > 0)

<table class='table table-hover'>
    <thead>
        <tr>
            <th>Comment ID</th>
            <th>Reply</th>
            <th>Author</th>
            <th>Email</th>
            <th>Status</th>
            <th>Remove</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($replies as $reply)
        <tr>
            <td><a href="{{ route('home.post', $reply->comment_id) }}">{{ $reply->comment_id }}</a></td>
            <td>{{ $reply->body }}</td>
            <td>{{ $reply->author }}</td>
            <td>{{ $reply->email }}</td>
            <td>
            @if($reply->is_active == 0)
                {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}               
                <input name="is_active" type="hidden" value="1">
                <div class='form-group'>
                    {!! Form::submit('Active', ['class'=>'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            @else
                {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}               
                <input name="is_active" type="hidden" value="0">
                <div class='form-group'>
                    {!! Form::submit('Deactivate', ['class'=>'btn btn-warning']) !!}
                </div>
                {!! Form::close() !!}
            @endif
            </td>
            <td>
                {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}               
                <div class='form-group'>
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
            </td>
            <td>{{ $reply->created_at->diffForHumans() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@else

<h1 class="text-center">No replies</h1>

@endif

@endsection