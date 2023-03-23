@if ($recipe->exists)
  <form action="{{ route('admin.recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data" novalidate>
    @method('PUT')
  @else
    <form action="{{ route('admin.recipes.store') }}" method="POST" enctype="multipart/form-data" novalidate>
@endif

@csrf
<div class="row">

  {{-- Name --}}
  <div class="col-md-6">
    <div class="mb-3">
      <label for="name" class="form-label">Nome Ricetta</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        value="{{ old('name', $recipe->name) }}" required minlength="5" maxlength="50">
      @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
      @else
        <small class=" text-muted">Inserisci il nome</small>
      @enderror
    </div>
  </div>

  {{-- Number Of Person --}}
  <div class="col-md-6">
    <div class="mb-3">
      <label for="number_of_person" class="form-label">Per quante persone</label>
      <input type="number" class="form-control @error('number_of_person') is-invalid @enderror" id="number_of_person" name="number_of_person"
        value="{{ old('number_of_person', $recipe->number_of_person) }}" required step="1" min="1">
      @error('number_of_person')
        <div class="invalid-feedback">{{ $message }}</div>
      @else
        <small class=" text-muted">Inserisci per quante persone è la ricetta</small>
      @enderror
    </div>
  </div>

  {{-- Time --}}
  <div class="col-md-6">
    <div class="mb-3">
      <label for="time" class="form-label">Tempo di preparazione</label>
      <input type="time" class="form-control @error('time') is-invalid @enderror" id="time" name="time"
        value="{{ old('time', $recipe->time) }}" required min="00:01">
      @error('time')
        <div class="invalid-feedback">{{ $message }}</div>
      @else
        <small class=" text-muted">Inserisci il tempo necessario per eseguire la ricetta</small>
      @enderror
    </div>
  </div>

  {{-- Image --}}
  <div class="col-md-7">
    <div class="mb-3">
      <label for="image" class="form-label">Immagine</label>
      <input type="file" class="form-control" id="image"
        name="image">
    </div>
  </div>
  <div class="col-md-1">
    <img class="img-fluid" id="img-preview"
      src="{{ $recipe->image ? asset('storage/' . $recipe->image) : 'https://marcolanci.it/utils/placeholder.jpg' }}"
      alt="">
  </div>
</div>

<div class="row">

  {{-- Description --}}
  <div class="col">
    <div class="mb-3">
      <label for="description" class="form-label">Descrizione Ricetta</label>
      <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6">{{ old('description', $recipe->description) }}</textarea>
      @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>

  {{-- Ingredient --}}
  <div class="col">
    <div class="mb-3">
      <label for="ingredient" class="form-label">Ingredienti</label>
      <textarea class="form-control @error('ingredient') is-invalid @enderror" id="ingredient" name="ingredient" rows="6">{{ old('ingredient', implode(',', $recipe->ingredient)) }}</textarea>
      @error('ingredient')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>

</div>

<hr>
<div class="d-flex justify-content-between bg-white">
  <a href="{{ route('admin.recipes.index') }}" class="btn btn-secondary me-2"><i class="fas fa-arrow-left me-2"></i>
    Indietro</a>
  <button type="submit" class="btn btn-success"><i class="fas fa-floppy-disk me-2"></i> Salva</button>
</div>
</form>


@section('scripts')
  <script>
    // Preparo il placeholder
    const placeholder = 'https://marcolanci.it/utils/placeholder.jpg';

    // Prendo gli elementii dal dom
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('img-preview');

    // Ascolto il cambio del caricamento file
    imageInput.addEventListener('change', () => {
      // Controllo se hoo caricato un file
      if (imageInput.files && imageInput.files[0]) {
        const reader = new FileReader();
        reader.readAsDataURL(imageInput.files[0]);

        // Quando sei pronto (ossia quando hai preparato il dato)
        reader.onload = e => {
          imagePreview.src = e.target.result;
        }

      } else imagePreview.setAttribute('src', placeholder);
    });
  </script>
@endsection
