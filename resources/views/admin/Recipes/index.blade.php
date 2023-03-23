@extends('layouts.app')

@section('title', 'Recipes')

@section('content')
  <header class="d-flex align-items-center justify-content-between">
    <h1 class="my-5">Ricette</h1>
    <a href="{{ route('admin.recipes.create') }}" class="btn btn-success ms-3">
      <i class="fas fa-plus me-2"></i> Crea nuovo
    </a>
  </header>

  <table class="table table-light table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Ingredient</th>
        <th scope="col">Number of person</th>
        <th scope="col">Time</th>
        <th scope="col">Updated at</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($recipes as $recipe)
        <tr>
          <th scope="row">{{ $recipe->id }}</th>
          <td>{{ $recipe->name }}</td>
          <td>{{ $recipe->description}}</td>
          <td>

          @foreach ($recipe->ingredient as $ingredient)
              {{$ingredient}} ,
          @endforeach
          </td>
          <td>{{ $recipe->number_of_person}}</td>
          <td>{{ $recipe->time}}</td>
          <td>{{ $recipe->updated_at }}</td>
          <td>
            <div class="d-flex justify-content-end align-items-center">

              <a href="{{ route('admin.recipes.show', $recipe->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-eye"></i></a>

                <a href="{{ route('admin.recipes.edit', $recipe->id) }}" class="btn btn-sm btn-warning ms-2 text-white">
                  <i class="fas fa-pencil"></i>
                </a>

                <form method="POST" action="{{ route('admin.recipes.destroy', $recipe->id) }}" class="delete-form"
                  data-entity="recipe">
                  @csrf
                  @method('DELETE')
                  <button class="ms-2 btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <th scope="row" colspan="9" class="text-center">Non ci sono ricette</th>
        </tr>
      @endforelse

    </tbody>
  </table>
  <hr>

  {{-- Pagination --}}
  {{-- <div class="d-flex justify-content-end">
    @if ($recipes->hasPages())
      {{ $recipes->links() }}
    @endif
  </div> --}}

@endsection
