@extends('layouts.admin-default')

@section('content')
  <div class="page-title-box">
    @include('partials.admin.form.create-breadcrumbs', ['featureName' => 'attribute-option'])

    {!! Form::open(['url' => '/admin/attribute-options']) !!}
      @include('admin.attribute-options.form', ['submitButtonText' => 'Save'])
    {!! Form::close() !!}
  </div>
@endsection