@extends('layouts.admin-default')

@section('content')
  <div class="page-title-box">
    <div class="row align-items-center">
      <!-- Breadcrumbs-->
      <div class="col-sm-6"><h4 class="page-title">Edit Blog</h4>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/admin/blogs">Blog</a></li>
          <li class="breadcrumb-item active">Edit Blog</li>
        </ol>
      </div>
    </div>

    {!! Form::model($blog, ['url' => '/admin/blogs/'.$blog->id, 'method'=>'PATCH', 'files' => 'true']) !!}
    @include('admin.blog.form', ['submitButtonText' => 'Update'])
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