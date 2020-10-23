@extends('layouts.admin-default')
@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<!-- add this style tag for previewing the image correctly in dropzone-->
<style>
	.dropzone .dz-preview .dz-image img {
		display: block;
		width: 120px;
		height: 120px;

	}

	.dz-max-files-reached {
		background-color: red
	}
</style>
@endsection

@section('content')
<div class="page-title-box">
	<div class="row align-items-center">
		<!-- Breadcrumbs-->
		<div class="col-sm-6">
			<h4 class="page-title">Create Slider</h4>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="/admin/blogs">Slider</a></li>
				<li class="breadcrumb-item active">Create Slider</li>
			</ol>
		</div>
	</div>
	{!! Form::open(['url' => '/admin/slider' ,'files'=>true]) !!}
	@include('admin.slider.form', ['submitButtonText' => 'Save'])
	{!! Form::close() !!}

</div>
@endsection

@section('scripts')

@endsection