@extends('layouts.app')

@section('title', 'Crea nuova Ricetta')

@section('content')
  <header class="my-5">
    <h1>Nuova Ricetta</h1>
  </header>
  <hr>

  @include('includes.recipes.form')

@endsection
