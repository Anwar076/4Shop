@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categorieën</h1>
    <ul class="list-group">
        @foreach ($categories as $category)
            <li class="list-group-item">
                <a href="{{ route('products.category', $category->id) }}">{{ $category->name }}</a>
            </li>
        @endforeach
    </ul>
</div>

<div class="products">
    @foreach($products as $product)
    <a class="product-row no-link" href="{{ route('products.show', $product) }}">
        <img src="{{ url($product->image ?? 'img/placeholder.jpg') }}" alt="{{ $product->title }}" class="rounded">
        <div class="product-body">
            <div>
                <h5 class="product-title"><span>{{ $product->title }}</span><em>&euro;{{ $product->getPriceWithDiscountAttribute() }}</em></h5>
                @unless(empty($product->description))
                <p>{{ $product->description }}</p>
                @endunless

                <!-- Voeg de kortingstekst toe als $product->discount groter is dan 0 -->
                @if($product->discount > 0)
                <p class="discount-text">Korting: {{ $product->discount }}%</p>
                @endif
            </div>
            <button class="btn btn-primary">Meer info &amp; bestellen</button>
        </div>
    </a>
    @endforeach
</div>

@endsection
