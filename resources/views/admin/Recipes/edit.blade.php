@extends('layouts.app')

@section('title', 'Modifica Ricetta')


@section('content')
  <header class="my-5">
    <h1>Modifica Ricetta</h1>
  </header>
  <hr>

  @include('includes.recipes.form')

@endsection
