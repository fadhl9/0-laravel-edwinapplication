@extends('layouts.admin')

@section('content')
<h1>Categories</h1>

<table class='table table-hover'>
    <thead>
        <tr>
            <th>Id</th>
            <th>name</th>
            <th>Created_at</th>
            <th>Updated_at</th>
        </tr>
    </thead>
    <tbody>
        @if($categories)
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td><a href="{{ route('admin.categories.edit', $category->id) }}">{{ $category->name }}</a></td>
            <td>{{ $category->created_at }}</td>
            <td>{{ $category->updated_at }}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

@endsection