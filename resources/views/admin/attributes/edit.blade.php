@extends('layouts.admin-default')

@section('content')
	<div class="page-title-box">
		@include('partials.admin.form.edit-breadcrumbs', ['featureName' => 'attribute'])
	
		{!! Form::model($attribute, ['url' => '/admin/attributes/'.$attribute->id, 'method'=>'PATCH', 'files'=>true]) !!}
			@include('admin.attributes.form', ['submitButtonText' => 'Update'])
		{!! Form::close() !!}
	</div>
@endsection