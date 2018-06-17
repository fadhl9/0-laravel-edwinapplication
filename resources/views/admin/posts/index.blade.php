@extends('layouts.admin')

@section('content')
<h1>Posts</h1>

<table class='table table-hover'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>User</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>View</th>
            <th>Created_at</th>
            <th>Updated_at</th>
        </tr>
    </thead>
    <tbody>
        @if($posts)
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td><img height="50" src="{{ $post->photo ? $post->photo->file : '/images/No_image_available.jpg' }}" alt="" ></td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->category->name }}</td>
            <td><a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->title }}</a></td>
            <td>{{ str_limit($post->body, 7) }}</td>
            <td>
                <a href="{{ route('home.post', $post->id) }}">Post </a>
                <span> | </span>
                <a href="{{ route('admin.comments.show', $post->id) }}"> Comment</a>
            </td>
            <td>{{ $post->created_at->diffForhumans() }}</td>
            <td>{{ $post->updated_at->diffForhumans() }}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

@endsection