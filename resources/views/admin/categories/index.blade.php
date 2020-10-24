@extends('layouts.admin-default')

@include('partials.admin.table.header')

@section('content')
	<div class="page-title-box">
		@include('partials.admin.table.breadcrumbs', ['featureName' => 'category'])

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive nowrap table-custom">
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
			</div>
		</div>
	</div>
@endsection

@include('partials.admin.table.scripts')
