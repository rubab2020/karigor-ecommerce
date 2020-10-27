@extends('layouts.admin-default')

@section('content')
<div class="page-title-box">
	@include('partials.admin.form.create-breadcrumbs', ['featureName' => 'blog'])

	{!! Form::open(['url' => '/admin/blogs', 'files' => 'true']) !!}
	@include('admin.blogs.form', ['submitButtonText' => 'Save'])
	{!! Form::close() !!}
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace('description', {
		filebrowserUploadUrl: "{{route('editor-image-upload', ['_token' => csrf_token() ])}}",
		filebrowserUploadMethod: 'form'
	});
</script>
@endsection