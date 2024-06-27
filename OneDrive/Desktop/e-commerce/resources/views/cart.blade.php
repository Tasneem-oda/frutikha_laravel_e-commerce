@extends('layouts.main')
@section('content')
    
	<!-- cart -->
	<div class="cart-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				@if (isset($cart))
				<div class="col-lg-8 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th  class="product-remove"></th>
									<th class="product-image">Product Image</th>
									<th class="product-name">Name</th>
									<th class="product-price">Price</th>
									<th class="product-quantity">Quantity</th>
									<th class="product-total">Total</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($cart as $id => $details)	
								<tr class="table-body-row">upda
									<td  onclick="removeFromCart({{ $id }})" class="product-remove"><a href="#"><i class="far fa-window-close"></i></a></td>
									<td class="product-image"><img src="{{$details['image']}}" alt=""></td>
									<td class="product-name">{{ $details['name'] }}</td>
									<td class="product-price">${{ $details['price'] }}</td>
									<td class="product-quantity"><input type="number" placeholder="{{ $details['quantity'] }}"></td>
									<td class="product-total">1</td>
								</tr>
								
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				@endif
				
				<div class="col-lg-4">
					<div class="total-section">
						<table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th>Total</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								<tr class="total-data">
									<td><strong>Subtotal: </strong></td>
									<td></td>
								</tr>
								<tr class="total-data">
									<td><strong>Shipping: </strong></td>
									<td>$45</td>
								</tr>
								<tr class="total-data">
									<td><strong>Total: </strong></td>
									<td>$545</td>
								</tr>
							</tbody>
						</table>
						<div class="cart-buttons">
							<a href="{{route('shop')}}" class="boxed-btn">Update Cart</a>
							<a href="checkout.html" class="boxed-btn black">Check Out</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end cart -->

@endsection
<script>
	function removeFromCart(productId) {
		fetch('{{ route('remove.from.cart') }}', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			},
			body: JSON.stringify({ product_id: productId })
		})
		.then(response => response.json())
		.then(data => {
			location.reload();
		});
	}
</script>