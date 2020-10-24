@extends('layouts.admin-default')

@section('content')
	<div class="page-title-box">
		@include('partials.admin.form.edit-breadcrumbs', ['featureName' => 'tag'])
	
		{!! Form::model($tag, ['url' => '/admin/tags/'.$tag->id, 'method'=>'PATCH', 'files'=>true]) !!}
			@include('admin.tags.form', ['submitButtonText' => 'Update'])
		{!! Form::close() !!}
	</div>
@endsection