@extends('layouts.admin-default')

@include('partials.admin.table.header')

@section('content')
	<div class="page-title-box">
		@include('partials.admin.table.breadcrumbs', ['featureName' => 'blog-category'])

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
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($bcategories as $bcategory)
									<tr>
										<td>{{ $bcategory->name }}</td>
										<td>
											<!-- Edit -->
											<a href="/admin/blog-categories/{{$bcategory->id}}/edit">
												<button type="submit" class="btn btn-default float-left"><i class="ti-pencil"></i></button>
											</a>

											<!-- delete -->
											<form action="{{ route('blog-categories.destroy', $bcategory->id)}}" method="POST">
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