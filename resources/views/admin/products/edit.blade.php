@extends('layouts.admin-default')

@section('content')
	<div class="page-title-box">
		@include('partials.admin.form.edit-breadcrumbs', ['featureName' => 'product'])
	
		{!! Form::model($product, ['url' => '/admin/products/'.$product->id, 'method'=>'PATCH', 'files'=>true]) !!}
			@include('admin.products.form', ['submitButtonText' => 'Update'])
		{!! Form::close() !!}
	</div>
@endsection