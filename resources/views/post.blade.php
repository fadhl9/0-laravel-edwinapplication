@extends('layouts.blog-post')

@section('content')

<!-- Blog Post -->

<!-- Title -->
<h1>{{ $post->title }}</h1>

<!-- Author -->
<p class="lead">
    by <a href="#">{{ $post->user->name }}</a>
</p>

<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->diffForHumans() }}</p>

<hr>

<!-- Preview Image -->
<img class="img-responsive" src="{{ $post->photo->file }}" alt="">

<hr>

<!-- Post Content -->
<p class="lead">{{ $post->body }}</p>

<hr>

@if(Session::has('comment_added'))
{{ session('comment_added') }}
@endif

<!-- Blog Comments -->

@if(Auth::check())
<!-- Comments Form -->
<div class="well">
    {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
    <input name="post_id" type="hidden" value="{{ $post->id }}">
    <div class='form-group'>
        {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>'1', 'placeholder'=>'Add a comment']) !!}
    </div>
    <div class='form-group'>
        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>

@else
<h2>Log in to comment</h2>
@endif

<!-- Posted Comments -->

<!-- Comment -->

@if(count($comments) > 0)
<hr>

@foreach($comments as $comment)
<div class="media">
    <a class="pull-left" href="#">
        <img height="64px" width="64px" class="media-object" src="{{ $comment->photo }}" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">{{ $comment->author }}
            <small>{{ $comment->created_at->format('F j, \\ Y \\a\\t h:i A') }}</small>
        </h4>
        <p>{{ $comment->body }}</p>
        

        @if(count($comment->replies) > 0)
        @foreach($comment->replies()->whereIsActive(1)->get() as $reply)

        <!-- Nested Comment -->
        
        <div id="nested-comment" class="media">

                <a class="pull-left" href="#">
                    <img height="64px" width="64px" class="media-object" src="{{ $reply->photo }}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{ $reply->author }}
                        <small>{{ $reply->created_at->format('F j, \\ Y \\a\\t h:i A') }}</small>
                    </h4>
                    <p>{{ $reply->body }}</p>
                </div>
                
            <div class="comment_reply_container">
                <button class="toggle-reply btn btn-primary pull-right">Replay</button>
                <div class="comment_reply col-sm-6">
                    @if(Auth::check())
                    <!-- Reply Comment Form -->
                    <div class="well">
                        {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                        <input name="comment_id" type="hidden" value="{{ $comment->id }}">
                        <div class='form-group'>
                            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>'1', 'placeholder'=>'Add a comment']) !!}
                        </div>
                        <div class='form-group'>
                            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                </div>
            </div>
        <!-- End Nested Comment -->
        </div>
        @endforeach
        @endif
    </div>
</div>
@endforeach

@endif

@endsection

@section('scripts')

<script>
    $('.comment_reply_container .toggle-reply').click(function(){
        $(this).next().slideToggle('slow');
    });
</script>

@endsection