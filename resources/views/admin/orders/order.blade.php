@extends('layouts.admin-default')

@include('partials.admin.table.header')

@section('content')
	<div class="page-title-box">
		@include('partials.admin.table.breadcrumbs', ['featureName' => 'order'])
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Order Details</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h3>Order</h3>
                        <h4 class="mt-0 header-title">ID</h4>
                        <p class="text-info m-b-30">{{$order->id}}</p>
                        <h4 class="mt-0 header-title">CART ID</h4>
                        <p class="text-info m-b-30">{{$order->cart->id}}</p>
                        <h4 class="mt-0 header-title">USER NAME</h4>
                        <p class="text-info m-b-30">{{$order->user->name}}</p>
                        <h4 class="mt-0 header-title">CREATED AT</h4>
                        <p class="text-info m-b-30">{{$order->created_at}}</p>
                        <h4 class="mt-0 header-title">GRAND TOTAL</h4>
                        <p class="text-info m-b-30">{{$order->grand_total}}</p>
                        <h4 class="mt-0 header-title">SUBTOTAL</h4>
                        <p class="text-info m-b-30">{{$order->subtotal}}</p>
                        <h4 class="mt-0 header-title">DELIVERY CHARGE</h4>
                        <p class="text-info m-b-30">{{$order->delivery_charge}}</p>
                        <h4 class="mt-0 header-title">SUBTOTAL WITH DISCOUNT</h4>
                        <p class="text-info m-b-30">{{$order->subtotal_with_discount}}</p>
                        <h4 class="mt-0 header-title">SUBTOTAL WITH COUPON</h4>
                        <p class="text-info m-b-30">{{$order->subtotal_with_coupon ?? 'N/A'}}</p>
                        <h4 class="mt-0 header-title">COUPON CODE</h4>
                        <p class="text-info m-b-30">{{$order->coupon_code ?? 'N/A'}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h3>Delivery Details</h3>
                        <?php $delivery = $order->deliveryAddress ?>
                        <h4 class="mt-0 header-title">Address</h4>
                        <p class="text-info m-b-30">{{$delivery->address}}</p>
                        <h4 class="mt-0 header-title">APARTMENT</h4>
                        <p class="text-info m-b-30">{{$order->apartment}}</p>
                        <h4 class="mt-0 header-title">CITY</h4>
                        <p class="text-info m-b-30">{{$delivery->city}}</p>
                        <h4 class="mt-0 header-title">DISTRICT</h4>
                        <p class="text-info m-b-30">{{$delivery->district}}</p>
                        <h4 class="mt-0 header-title">ZIP CODE</h4>
                        <p class="text-info m-b-30">{{$delivery->zipcode}}</p>
                        <h4 class="mt-0 header-title">PHONE</h4>
                        <p class="text-info m-b-30">{{$delivery->phone}}</p>
                        <h4 class="mt-0 header-title">EMAIL</h4>
                        <p class="text-info m-b-30">{{$delivery->email}}</p>
                    </div>
                </div>
            </div>
        </div>    
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
                        <h3>ORDER ITEMS</h3>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap table-custom">
							<thead>
								<tr>
									<th>ID</th>
									<th>Product Name</th>
									<th>Qty</th>
									<th>Base Price</th>
                                    <th>Final Price</th>
                                    <th>Discount Amount</th>
                                    <th>Vendor</th>
								</tr>
							</thead>
							<tbody>
								@foreach($order->cart->items as $item)
									<tr>
										<td>
                                        <a href="/admin/orders/{{$item->id}}">{{$item->id}}</a>
										</td>
										<td>
											{{$item->product->name}}
                                        </td>
										<td>
											{{$item->qty}}
                                        </td>
                                        <td>
											{{$item->base_price}}
										</td>
										<td>
											{{$item->final_price}}
                                        </td>
                                        <td>
											{{$item->discount_amount}}
                                        </td>
                                        <td>
											{{\App\Models\Vendor::getVendorName($item->product->vendor_id)}}
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