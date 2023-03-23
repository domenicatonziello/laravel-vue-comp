@extends('layouts.app')

@section('title', 'Home')

@section('content')

  <header class="d-flex justify-content-end mt-5">
    {{-- @if ($recipes->hasPages())
      {{ $recipes->links() }}
    @endif --}}
  </header>
  <hr>
  @forelse($recipes as $recipe)
    <div class="card my-5">
      <div class="card-header">
        {{ $recipe->created_at }}
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title">{{ $recipe->name }}</h5>
            <p class="card-text">{{ $recipe->description }}</p>
          </div>
        </div>
      </div>
    </div>
  @empty
  @endforelse
@endsection
