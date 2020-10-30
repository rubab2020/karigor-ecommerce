@extends('layouts.admin-default')

@section('content')
  <div class="page-title-box">
    @include('partials.admin.form.create-breadcrumbs', ['featureName' => 'product'])

    {!! Form::open(['url' => '/admin/products']) !!}
      @include('admin.products.form', ['submitButtonText' => 'Save'])
    {!! Form::close() !!}
  </div>
@endsection