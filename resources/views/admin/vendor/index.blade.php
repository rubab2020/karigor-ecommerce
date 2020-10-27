@extends('layouts.admin-default')

@include('partials.admin.table.header')

@section('content')
<div class="page-title-box">
	@include('partials.admin.table.breadcrumbs', ['featureName' => 'vendor'])

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Photo</th>
								<th>Phone</th>
								<th>Is Activated?</th>
								<th>Is Featured?</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($vendors as $vendor)
							<tr>
								<td>{{ $vendor->name }}</td>
								<td>{{ $vendor->email }}</td>
								<td><img src="{{ asset($uplaodPath.$vendor->photo) }}" style="width: auto; height: 30px;"></td>
								<td>{{ $vendor->phone }}</td>
								<td>
									<!-- Ativator -->
									<button class="btn btn-default float-left vendor-activator-btn {{$vendor->is_active?'btn-danger':'btn-success' }}" is_active="{{$vendor->is_active}}" vendor_id="{{$vendor->id}}" style="margin-left: 10px;">
										{{$vendor->is_active?'Deactivate':'Activate' }}
									</button>

								</td>
								<td>
									<!-- Ativator -->
									<button class="btn btn-default float-left vendor-feature-btn {{$vendor->is_featured?'btn-danger':'btn-success' }}" is_featured="{{$vendor->is_featured}}" vendor_id="{{$vendor->id}}" style="margin-left: 10px;">
										{{$vendor->is_featured?'Stop Featuring':'Start Featuring' }}
									</button>
								</td>
								<td>
									<!-- Edit -->
									<a href="/admin/vendors/{{$vendor->id}}/edit">
										<button type="submit" class="btn btn-default float-left"><i class="ti-pencil"></i></button>
									</a>

									<!-- delete -->
									<form action="{{ route('vendors.destroy', $vendor->id)}}" method="POST">
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
		</div>
	</div>
</div>

@endsection

@include('partials.admin.table.scripts')