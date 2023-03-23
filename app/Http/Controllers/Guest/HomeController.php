<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $recipes = Recipe::orderBy('updated_at', 'DESC');

        return view('guest.home', compact('recipes'));
    }
}
