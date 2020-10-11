@extends('layouts.admin-default')

@section('content')
  <div class="page-title-box">
    <div class="row align-items-center">
      <!-- Breadcrumbs-->
      <div class="col-sm-6">
        <h4 class="page-title">Edit Blog Catgory</h4>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/admin/blog-category">Blog Category</a></li>
          <li class="breadcrumb-item active">Edit Blog Category</li>
        </ol>
      </div>
    </div>

    {!! Form::model($bcategory, ['url' => '/admin/blog-category/'.$bcategory->id, 'method'=>'PATCH', 'files' => 'true']) !!}
      @include('admin.blog-category.form', ['submitButtonText' => 'Update'])
    {!! Form::close() !!}
  </div>
@endsection