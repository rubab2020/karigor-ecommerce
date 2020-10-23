@extends('layouts.admin-default')

@include('partials.admin.table.header')

@section('content')
	<div class="page-title-box">
		@include('partials.admin.table.breadcrumbs', ['featureName' => 'blog'])

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<table 
							id="datatable" 
							class="table table-bordered dt-responsive nowrap"
							style="border-collapse: collapse; border-spacing: 0; width: 100%;"
						>
							<thead>
								<tr>
									<th>Category</th>
									<th>Title</th>
									<th>Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($blogs as $blog)
									<tr>
										<td>
											{{ App\Models\BlogCategory::getName($blog->category_id) }}
										</td>
										<td>
											<img src="{{ asset($blog->cover_photo) }}" style="width: auto; height: 30px;">
											{{ $blog->title }}
										</td>
										<td>{{ substr($blog->description, 0, 50) }}...</td>
										<td>
											<!-- Edit -->
											<a href="/admin/blogs/{{$blog->id}}/edit">
												<button type="submit" class="btn btn-default float-left"><i class="ti-pencil"></i></button>
											</a>


											<!-- delete -->
											<form action="{{ route('blogs.destroy', $blog->id)}}" method="POST">
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