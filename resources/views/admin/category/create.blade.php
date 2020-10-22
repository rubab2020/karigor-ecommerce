@extends('layouts.admin-default')
@section('content')
  <div class="page-title-box">
    <div class="row align-items-center">
      <!-- Breadcrumbs-->
      <div class="col-sm-6">
        <h4 class="page-title">Crete Category</h4>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/admin/categories">Categories</a></li>
          <li class="breadcrumb-item active">Create Category</li>
        </ol>
      </div>
      <!--menu-->
    </div>

    <!-- add main form-->
    {!! Form::open(['url' => '/admin/categories', 'files'=>true]) !!}
      @include('admin.category.form', ['submitButtonText' => 'Save'])
    {!! Form::close() !!}
  </div>
@endsection