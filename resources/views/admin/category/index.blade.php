@extends('layouts.admin-default')

@section('head')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- {{--data tables--}} -->
	<link href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
		  type="text/css">
	<link href="{{asset('admin/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
	<!-- {{-- Responsive datatable examples --}} -->
	<link href="{{asset('admin/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet"
		  type="text/css">
	<!-- {{--css for toggle --}} -->
	<link href="{{ asset('css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
	<style type="text/css">
		img {
			width: auto;
			height: 40px;
		}
	</style>
@endsection

@section('content')
	<div class="page-title-box">
		<div class="row align-items-center">
			<!-- Breadcrumbs-->
			<div class="col-sm-6"><h4 class="page-title">Categories</h4>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
					<li class="breadcrumb-item active">Categories
					</li>
				</ol>
			</div>
			<div class="col-sm-6">
				<div class="float-right d-none d-md-block">
					<div class="dropdown">
						<a 
							href="/admin/categories/create"
							class="btn btn-primary  arrow-none waves-effect waves-light"
							aria-haspopup="true"
							aria-expanded="false"
						>
						<i class="mdi mdi-plus mr-2"></i> New Category
						</a>
					</div>
				</div>
			</div>
		</div><!-- end row -->
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<table id="datatable" class="table table-bordered dt-responsive nowrap"
							   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
							<thead>
								<tr>
									<th>Name</th>
				                  	<th>Parent</th>
				                  	<th>Image</th>
				                  	<th>Description</th>
				                  	<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $category)
									<tr>
										<td>
											<img src="{{ asset($uplaodPath.$category->icon) }}" style="width: auto; height: 30px;">
											{{ $category->name }}
										</td>
                                        <td>{{ App\Models\Category::parentNames($category->parent_id) }}</td>
										<td>
											<img src="{{ asset($uplaodPath.$category->image_bg) }}" style="width: auto; height: 30px;">
										</td>
										<td>{{ \Str::limit($category->description, 50) }}</td>
										<td>
											<!-- Edit -->
											<a href="/admin/categories/{{$category->id}}/edit">
												<button type="submit" class="btn btn-default float-left"><i class="ti-pencil"></i></button>
											</a>

											<!-- delete -->
											<form action="{{ route('categories.destroy', $category->id)}}" method="POST">
												@method('DELETE')
   											@csrf
												<button type="submit" class="btn btn-default float-left" style="margin-left: 10px;">
													<i class="ti-trash"></i> 
												</button>
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div><!-- end col -->
		</div><!-- end row -->
	</div>
@endsection

@section('scripts')
	<!-- js for toggle -->
	<script src="{{ asset('js/bootstrap4-toggle.min.js') }}"></script>

	<!-- Required datatable js -->
	<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
	<!-- Buttons examples -->
	<script src="{{asset('admin/plugins/datatables/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables/jszip.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables/pdfmake.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables/vfs_fonts.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables/buttons.html5.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables/buttons.print.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables/buttons.colVis.min.js')}}"></script>
	<!-- Responsive examples -->
	<script src="{{asset('admin/plugins/datatables/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
	<!-- Datatable init js -->
	<script src="{{asset('admin/pages/datatables.init.js')}}"></script>
@endsection