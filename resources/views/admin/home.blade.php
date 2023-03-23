@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <header class="d-flex justify-content-between mt-5">
            <h2>Le mie Ricette</h2>
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
                            <h5 class="card-title">{{ $recipe->title }}</h5>
                            <p class="card-text">{{ $recipe->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        
        @endforelse
    </div>
@endsection
