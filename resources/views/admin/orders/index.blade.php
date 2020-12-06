@extends('layouts.admin-default')

@include('partials.admin.table.header')

@section('content')
	<div class="page-title-box">
		@include('partials.admin.table.breadcrumbs', ['featureName' => 'order'])

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap table-custom">
							<thead>
								<tr>
									<th>ID</th>
									<th>Cart ID</th>
									<th>User Name</th>
									<th>Grand Total</th>
									<th>ITEMS QUANTITY</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($orders as $order)
									<tr>
										<td>
                                        <a href="/admin/orders/{{$order->id}}">{{$order->id}}</a>
										</td>
										<td>
											{{$order->cart_id}}
										</td>
										<td>
											{{$order->user->name}}
										</td>
										<td>
											{{$order->grand_total}}
										</td>
										<td>
											{{$order->cart->items_qty}}
										</td>
										<td>
										<!-- Edit -->
                                        <a href="/admin/orders/{{$order->id}}/edit">
                                            <button type="submit" class="btn btn-default float-left"><i class="ti-pencil"></i></button>
                                        </a>

                                        <!-- delete -->
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
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