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
			<div class="col-sm-6"><h4 class="page-title">Blog Category</h4>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
					<li class="breadcrumb-item active">Contact Us Inbox
					</li>
				</ol>
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
									<th>Email</th>
									<th>Phone</th>
									<th>Message</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($inboxes as $inbox)
									<tr>
										<td>{{ $inbox->name }}</td>
										<td>{{ $inbox->email }}</td>
										<td>{{ $inbox->phone }}</td>
										<td>{{ $inbox->message }}</td>
										<td></td>
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