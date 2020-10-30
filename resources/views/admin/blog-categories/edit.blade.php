@extends('layouts.admin-default')

@section('content')
  <div class="page-title-box">
    @include('partials.admin.form.edit-breadcrumbs', ['featureName' => 'blog-category'])

    {!! Form::model($bcategory, ['url' => '/admin/blog-categories/'.$bcategory->id, 'method'=>'PATCH', 'files' => 'true']) !!}
      @include('admin.blog-categories.form', ['submitButtonText' => 'Update'])
    {!! Form::close() !!}
  </div>
@endsection