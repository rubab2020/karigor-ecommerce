@extends('layouts.admin-default')

@include('partials.admin.table.header')

@section('content')
	<div class="page-title-box">
		@include('partials.admin.table.breadcrumbs', ['featureName' => 'attribute'])

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive nowrap table-custom">
							<thead>
								<tr>
									<th>Name</th>
									<th>Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($attributes as $attribute)
									<tr>
										<td>{{ $attribute->name }}</td>
										<td>{{ $attribute->description }}</td>
										<td>
											<!-- Edit -->
											<a href="/admin/attributes/{{$attribute->id}}/edit">
												<button type="submit" class="btn btn-default float-left"><i class="ti-pencil"></i></button>
											</a>

											<!-- delete -->
											<form action="{{ route('attributes.destroy', $attribute->id)}}" method="POST">
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
