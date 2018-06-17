@extends('layouts.admin')

@section('content')


@if(count($comments) > 0)

<h1> Comments for post name '{{ $post->title }}'</h1>

<table class='table table-hover'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Post ID</th>
            <th>Comment</th>
            <th>Author</th>
            <th>Email</th>
            <th>Status</th>
            <th>Remove</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($comments as $comment)
        <tr>
            <td>{{ $comment->id }}</td>
            <td><a href="{{ route('home.post', $comment->post_id) }}">{{ $comment->post_id }}</a></td>
            <td>{{ $comment->body }}</td>
            <td>{{ $comment->author }}</td>
            <td>{{ $comment->email }}</td>
            <td>
            @if($comment->is_active == 0)
                {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}               
                <input name="is_active" type="hidden" value="1">
                <div class='form-group'>
                    {!! Form::submit('Active', ['class'=>'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            @else
                {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}               
                <input name="is_active" type="hidden" value="0">
                <div class='form-group'>
                    {!! Form::submit('Deactivate', ['class'=>'btn btn-warning']) !!}
                </div>
                {!! Form::close() !!}
            @endif
            </td>
            <td>
                {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}               
                <div class='form-group'>
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
            </td>
            <td>{{ $comment->created_at->diffForHumans() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@else

<h1 class="text-center">No Comments</h1>

@endif

@endsection