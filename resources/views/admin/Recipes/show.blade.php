@extends('layouts.app')

@section('title', $recipe->name)

@section('content')
  <header>
    <h1 class="my-5">{{ $recipe->name }}</h1>
  </header>
  <div class="clearfix">
    @if ($recipe->image)
      <img class="me-2 img-fluid float-start" src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}">
    @endif
    <p>{{ $recipe->description }}</p>
    <ul>
        @foreach ($recipe->ingredient as $ingredient)
        <li>
            {{$ingredient}}
        </li>
        @endforeach
    </ul>
    <div>

      <strong>Creato il: </strong><time>{{ $recipe->created_at }}</time> -
      <strong>Ultima modifica: </strong><time>{{ $recipe->updated_at }}</time> -
      
    </div>
  </div>
  <hr>
  <div class="d-flex justify-content-between">


    

    <div class="d-flex align-items-center justify-content-end">
        <a href="{{ route('admin.recipes.edit', $recipe->id) }}" class="btn btn-warning me-2 text-white">
          <i class="fas fa-pencil me-2"></i> Modifica
        </a>

        <form method="POST" action="{{ route('admin.recipes.destroy', $recipe->id) }}" class="delete-form"
          data-entity="recipe">
          @csrf
          @method('DELETE')
          <button class="me-2 btn  btn-danger" type="submit"><i class="fas fa-trash"></i> Elimina</button>
        </form>
      <a class="btn btn-secondary" href="{{ route('admin.recipes.index') }}"><i class="fas fa-arrow-left me-2"></i>Torna
        indietro</a>

    </div>
  </div>
@endsection
