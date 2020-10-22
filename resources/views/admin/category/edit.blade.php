@extends('layouts.admin-default')
@section('content')
  <div class="page-title-box">
    <div class="row align-items-center">
      <!-- Breadcrumbs-->
      <div class="col-sm-6">
        <h4 class="page-title">Edit Category</h4>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/admin/categories">Categories</a></li>
          <li class="breadcrumb-item active">Edit Category</li>
        </ol>
      </div>
      <!--menu-->
    </div>

    <!-- add main form-->
    {!! Form::model($category, ['url' => '/admin/categories/'.$category->id, 'method'=>'PATCH', 'files'=>true]) !!}
      @include('admin.category.form', ['submitButtonText' => 'Update'])
    {!! Form::close() !!}
  </div>
@endsection