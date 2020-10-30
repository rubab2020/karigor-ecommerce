@extends('layouts.admin-default')

@section('content')
  <div class="page-title-box">
    @include('partials.admin.form.edit-breadcrumbs', ['featureName' => 'blog'])

    {!! Form::model($blog, ['url' => '/admin/blogs/'.$blog->id, 'method'=>'PATCH', 'files' => 'true']) !!}
      @include('admin.blogs.form', ['submitButtonText' => 'Update'])
    {!! Form::close() !!}
  </div>
@endsection

@section('scripts')
  <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'description', {
      filebrowserUploadUrl: "{{route('editor-image-upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
    });
  </script>
@endsection