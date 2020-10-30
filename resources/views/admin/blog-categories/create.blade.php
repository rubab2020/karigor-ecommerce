@extends('layouts.admin-default')

@section('content')
<div class="page-title-box">
	@include('partials.admin.form.create-breadcrumbs', ['featureName' => 'blog-category'])

	{!! Form::open(['url' => '/admin/blog-categories', 'files' => 'true']) !!}
	@include('admin.blog-categories.form', ['submitButtonText' => 'Save'])
	{!! Form::close() !!}
</div>
@endsection