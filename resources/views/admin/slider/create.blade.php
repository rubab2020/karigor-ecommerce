@extends('layouts.admin-default')


@section('content')
<div class="page-title-box">
	@include('partials.admin.form.create-breadcrumbs', ['featureName'=> 'slider'])
	{!! Form::open(['url' => '/admin/sliders' ,'files'=>true]) !!}
	@include('admin.slider.form', ['submitButtonText' => 'Save'])
	{!! Form::close() !!}

</div>
@endsection

@section('scripts')

@endsection