@extends('layouts.app')

@section('content')

	<div class="products">
			<div class="product-row no-link" href="{{ route('products.show', $product) }}">
				<img src="{{ url($product->image ?? 'img/placeholder.jpg') }}" alt="{{ $product->title }}" class="rounded">
				<div class="product-body">
					<form action="{{ route('products.order', $product) }}" method="POST" data-controller="size">
						<h5 class="product-title"><span>{{ $product->title }}</span><em>&euro;{{ $product->getPriceWithDiscountAttribute() }}</em></h5>
						@unless(empty($product->description))
							<p>{{ $product->description }}</p>
						@endunless
						@if(count($product->types))
							<select name="type" id="type" class="form-control" data-action="change->size#update" data-target="size.type">
								@foreach($product->types as $type)
									<option value="{{ $type->id }}">{{ $type->title }}</option>
								@endforeach
							</select>
							<div data-target="size.sizes">
								@foreach($product->types as $type)
									<select class="form-control" data-type="{{ $type->id }}" style="display: none;">
										@foreach($type->sizes as $size)
											<option value="{{ $size->id }}">{{ $size->title }}</option>
										@endforeach
									</select>
								@endforeach
							</div>
							<button type="submit" class="btn btn-success form-control">Bestellen &gt;</button>
							{{ csrf_field() }}
						@endif
					</form>
				</div>
			</div>
	</div>

@endsection
