@extends('layouts.admin-default')

@include('partials.admin.table.header')

@section('content')
	<div class="page-title-box">
		@include('partials.admin.table.breadcrumbs', ['featureName' => 'product'])

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive nowrap table-custom">
							<thead>
								<tr>
									<th>Name</th>
									<th>SKU</th>
									<th>Stock</th>
									<th>Price</th>
									<!-- <th>Featured</th> -->
									<th>Vendor</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($products as $product)
									<tr>
										<td>
											<img src="{{ asset($product->thumbnail_sm) }}" style="width: auto; height: 30px;">
											{{ $product->name }}
										</td>
										<td>
											{{ $product->sku }}
										</td>
										<td>
											{{ $product->stock_quantity > 0 
												? 'In stock'.$product->stock_quantity
												: 'Out of stock (0)'
										  }}
										</td>
										<td>
											{{ $product->price }}
											<br>
											<span style="text-decoration: line-through;">
												{{ App\Models\Product::getSalePrice(
														$product->sale_price,
														$product->sale_price_from,
														$product->sale_price_to
													) 
												}}
											</span>
										</td>
										<td>
											{{ App\Models\Vendor::getVendorName($product->vendor_id) }}
										</td>
										<td>
											<!-- Edit -->
											<a href="/admin/products/{{$product->id}}/edit">
												<button type="submit" class="btn btn-default float-left"><i class="ti-pencil"></i></button>
											</a>

											<!-- delete -->
											<form action="{{ route('products.destroy', $product->id) }}" method="POST">
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