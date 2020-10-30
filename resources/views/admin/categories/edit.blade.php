@extends('layouts.admin-default')
@section('content')
  <div class="page-title-box">
    @include('partials.admin.form.edit-breadcrumbs', ['featureName' => 'category'])

    {!! Form::model($category, ['url' => '/admin/categories/'.$category->id, 'method'=>'PATCH', 'files'=>true]) !!}
      @include('admin.categories.form', ['submitButtonText' => 'Update'])
    {!! Form::close() !!}
  </div>
@endsection