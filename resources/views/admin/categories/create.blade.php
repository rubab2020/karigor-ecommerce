@extends('layouts.admin-default')
@section('content')
  <div class="page-title-box">
    @include('partials.admin.form.create-breadcrumbs', ['featureName' => 'category'])

    {!! Form::open(['url' => '/admin/categories', 'files'=>true]) !!}
      @include('admin.category.form', ['submitButtonText' => 'Save'])
    {!! Form::close() !!}
  </div>
@endsection