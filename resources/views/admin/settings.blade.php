@extends('layouts.admin-default')
@section('content')
	<div class="page-title-box">
		<div class="row align-items-center">
      <!-- Breadcrumbs-->
      <div class="col-sm-6"><h4 class="page-title">Settings</h4>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Settings</li>
        </ol>
      </div>
    </div>

		<div class="row">
			<div class="col-1">
			</div>
			<div class="col-10">
				<div class="card">
					<div class="card-body">
						{!! Form::open(['url' => '/admin/settings/update', 'files'=>true]) !!}
							<!-- submit -->
							<div class="form-group row">
								<div class="col-lg-9"></div>
								<div class="col-lg-3 float-right">
									<button class="form-control btn btn-success" type="submit">Save</button>
								</div>
							</div>

							<nav>
							  <div class="nav nav-tabs" id="nav-tab" role="tablist">
							    <a class="nav-item nav-link active" id="nav-static-pages-tab" data-toggle="tab" href="#static-pages" role="tab" aria-controls="static-pages" aria-selected="true">pages</a>
							    <a class="nav-item nav-link" id="analytics-tab" data-toggle="tab" href="#analytics" role="tab" aria-controls="analytics" aria-selected="false">analytics</a>
							  </div>
							</nav>
							<div class="tab-content" id="nav-tabContent" style="padding: 15px;">
								<!-- static pages tab -->
							  <div class="tab-pane fade show active" id="static-pages" role="tabpanel" aria-labelledby="nav-static-pages-tab">
							  	<div class="form-group row">
										<label class="col-sm-2 col-form-label">About Us</label>
										<div class="col-sm-10">
											<textarea name="about_us" id="editorAboutUs">{{ $options['about_us'] }}</textarea>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Terms And Conditions</label>
										<div class="col-sm-10">
											<textarea name="term_and_conditions" id="editorTerms">{{ $options['term_and_conditions'] }}</textarea>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Privacy Policy</label>
										<div class="col-sm-10">
											<textarea name="privacy_policy" id="editorPrivacy">{{ $options['privacy_policy'] }}</textarea>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Faq</label>
										<div class="col-sm-10">
											<textarea name="faq" id="editorFaq">{{ $options['faq'] }}</textarea>
										</div>
									</div>
							  </div>
							  <!-- analytics -->
							  <div class="tab-pane fade" id="analytics" role="tabpanel" aria-labelledby="analytics-tab">
							  	<div class="form-group row">
										<label class="col-sm-2 col-form-label">FB Pixel Code</label>
										<div class="col-sm-10">
											<textarea name="fb_pixel_code" class="form-control">{{ $options['fb_pixel_code'] }}</textarea>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Google Analytics Code</label>
										<div class="col-sm-10">
											<textarea name="google_analytics" class="form-control">{{ $options['google_analytics'] }}</textarea>
										</div>
									</div>
							  </div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
  <!-- ck editor -->
	<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'editorAboutUs', {
			filebrowserUploadUrl: "{{route('editor-image-upload', ['_token' => csrf_token() ])}}",
			filebrowserUploadMethod: 'form'
		});
		CKEDITOR.replace( 'editorTerms', {
			filebrowserUploadUrl: "{{route('editor-image-upload', ['_token' => csrf_token() ])}}",
			filebrowserUploadMethod: 'form'
		});
		CKEDITOR.replace( 'editorPrivacy', {
			filebrowserUploadUrl: "{{route('editor-image-upload', ['_token' => csrf_token() ])}}",
			filebrowserUploadMethod: 'form'
		});
		CKEDITOR.replace( 'editorFaq', {
			filebrowserUploadUrl: "{{route('editor-image-upload', ['_token' => csrf_token() ])}}",
			filebrowserUploadMethod: 'form'
		});
	</script>
@endsection