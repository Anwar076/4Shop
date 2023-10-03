@extends('layouts.admin')

@section('content')

	<div class="d-flex justify-content-between align-items-center my-4">
		<h4>Categorieën</h4>
		<div>
			<a href="{{ route('admin.categories.create') }}">Nieuwe categorie toevoegen</a>
		</div>
	</div>

	<table class="table table-striped table-hover">
		<tr>
			<th>Naam</th>
			<th>Actief</th>
			<th colspan="2">&nbsp;</th>
		</tr>
		@foreach($categories as $category)
			<tr>
				<td>{{ $category->name }}</td>
				<td>
					@if($category->active)
						<span class="badge badge-success">Actief</span>
					@else
						<span class="badge badge-light">Inactief</span>
					@endif
				</td>
				<td>
					<a href="{{ route('admin.categories.edit', $category->id) }}">Bewerken</a>
				</td>
				<td>
					<a href="{{ route('admin.categories.products', $category->id) }}">Producten</a>
				</td>
			</tr>
		@endforeach
	</table>
@endsection
