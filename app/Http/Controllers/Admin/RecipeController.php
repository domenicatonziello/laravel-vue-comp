<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::orderBy('updated_at', 'DESC')->get();

        return view('admin.recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $recipe = new Recipe();
        $recipe['ingredient'] = [];
        return view('admin.recipes.create', compact('recipe'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:50',
            'description' => 'required|string',
            'ingredient' => 'required|string',
            'number_of_person' => 'required|min:1',
            'number_of_person' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
        ],
        [   
            'name.required' => 'Il Nome è obbligatorio',
            'name.min' => 'Il Nome deve avere almeno 5 caratteri.',
            'description.required' => 'La Ricetta deve avere una descrizione',
            'image.image' => 'L\'immagine deve essere file di tipo immagine',
            'image.mimes' => 'Le estensioni accettate sono jpeg, jpg, png',
        ]);

        $data = $request->all();
        $recipe = new Recipe();
        $data['ingredient'] = explode(',', $data['ingredient']);
        if (array_key_exists('image', $data)){
            $image_url = Storage::put('recipes',$data['image']);
            $data['image'] = $image_url;
        }
        $recipe->fill($data);
        $recipe->save();
        return to_route('admin.recipes.show', $recipe->id)->with('type', 'success')->with('Nuova Ricetta creata con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        return view('admin.recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        return view('admin.recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:50',
            'description' => 'required|string',
            'ingredient' => 'required|string',
            'number_of_person' => 'required|min:1',
            'number_of_person' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
        ],
        [   
            'name.required' => 'Il Nome è obbligatorio',
            'name.min' => 'Il Nome deve avere almeno 5 caratteri.',
            'description.required' => 'La Ricetta deve avere una descrizione',
            'image.image' => 'L\'immagine deve essere file di tipo immagine',
            'image.mimes' => 'Le estensioni accettate sono jpeg, jpg, png',
        ]);

        $data = $request->all();
        $data['ingredient'] = explode(',', $data['ingredient']);
        if (Arr::exists($data, 'image')){
            if($recipe->image) Storage::delete($recipe->image);
            $image_url = Storage::put('recipes',$data['image']);
            $data['image'] = $image_url;
        }
        $recipe->fill($data);
        $recipe->save();
        return to_route('admin.recipes.show', $recipe->id)->with('type', 'success')->with('La ricetta è modificata con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        if ($recipe->image) Storage::delete($recipe->image);

        $recipe->delete();

        return to_route('admin.recipes.index')
            ->with('type', 'danger')
            ->with('msg', "Il recipe '$recipe->name' è stato cancellato con successo.");
    }
}
