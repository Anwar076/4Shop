@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Bewerk Categorie</h1>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Naam:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                </div>
            </div>

            <div class="col-md-6">
                <!-- Voeg de lijst met producten in deze categorie toe -->
                <div class="form-group">
                    <label for="products">Producten in deze categorie:</label>
                    <ul class="list-group">
                        @foreach ($products as $product)
                            <li class="list-group-item">{{ $product->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Opslaan</button>
            </div>
        </div>
    </form>
</div>
@endsection
