@extends('layouts.admin-default')
@section('content')
  <div class="page-title-box">
    @include('partials.admin.form.create-breadcrumbs', ['featureName' => 'attribute'])

    {!! Form::open(['url' => '/admin/attributes']) !!}
      @include('admin.attribute.form', ['submitButtonText' => 'Save'])
    {!! Form::close() !!}
  </div>
@endsection