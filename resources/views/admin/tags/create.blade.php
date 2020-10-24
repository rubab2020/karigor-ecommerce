@extends('layouts.admin-default')

@section('content')
  <div class="page-title-box">
    @include('partials.admin.form.create-breadcrumbs', ['featureName' => 'tag'])

    {!! Form::open(['url' => '/admin/tags']) !!}
      @include('admin.tags.form', ['submitButtonText' => 'Save'])
    {!! Form::close() !!}
  </div>
@endsection