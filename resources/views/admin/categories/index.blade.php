@extends('layouts.admin')

@section('content')
<h1>Categories</h1>

<div class="col-sm-5">

    <div class="row">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}
        
        <div class='form-group'>
            {!! Form::label('name', 'Category:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
        
        <div class='form-group'>
            {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
        </div>
        
        {!! Form::close() !!}
    
    </div>
    
    <div class="row">
        @include('includes.form_error')
    </div>

</div>

<div class="col-sm-7">
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
                <td>{{ $category->created_at->diffForhumans() }}</td>
                <td>{{ $category->updated_at->diffForhumans() }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>



@endsection