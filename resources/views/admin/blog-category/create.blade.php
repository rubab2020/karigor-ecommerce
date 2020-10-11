@extends('layouts.admin-default')

@section('content')
	<div class="page-title-box">
		<div class="row align-items-center">
			<!-- Breadcrumbs-->
			<div class="col-sm-6">
				<h4 class="page-title">Crete Blog Category</h4>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="/admin/blog-category">Blog Category</a></li>
					<li class="breadcrumb-item active">Create Blog Category</li>
				</ol>
			</div>
		</div>

		{!! Form::open(['url' => '/admin/blog-category', 'files' => 'true']) !!}
			@include('admin.blog-category.form', ['submitButtonText' => 'Save'])
		{!! Form::close() !!}
	</div>
@endsection