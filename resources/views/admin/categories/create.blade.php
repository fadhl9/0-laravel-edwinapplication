@extends('layouts.admin')

@section('content')
<h1>Create Category</h1>

<div class="row">
    {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}
    
    <div class='form-group'>
        {!! Form::label('name', 'Category:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
    
    <div class='form-group'>
        {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
    </div>
    
    {!! Form::close() !!}

</div>

<div class="row">
    @include('includes.form_error')
</div>

@endsection