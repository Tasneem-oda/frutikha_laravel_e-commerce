@extends('layouts.main')
@section('content')
    
	<!-- products -->
	<div class="product-section mt-150 mb-150">
		<div class="container">

			<div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".strowburry">Strawberry</li>
                            <li data-filter=".burry">Burry</li>
                            <li data-filter=".lemon">Lemon</li>
                            <li data-filter=".apple">apple</li>
                        </ul>
                    </div>
                </div>
            </div>

			<div class="row product-lists">
				@foreach ($products as $product)
					
				<div class="col-lg-4 col-md-6 text-center {{$product->name}}">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.html"><img src="{{$product->image}}" alt=""></a>
						</div>
						<h3>{{$product->name}}</h3>
						<p class="product-price"><span>Per Kg</span> {{$product->price}}$ </p>
						<a href="{{route('cart')}}"  onclick="addToCart({{ $product->id }})" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
				
				@endforeach
			</div>

			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="pagination-wrap">
						<ul>
							<li><a href="#">Prev</a></li>
							<li><a href="#">1</a></li>
							<li><a class="active" href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">Next</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end products -->


@endsection
<script>
	function addToCart(productId) {
            fetch('{{ route('add.to.cart') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });
        }
</script>