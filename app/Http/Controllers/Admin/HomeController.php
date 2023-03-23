<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;

class HomeController extends Controller
{
    public function index()
    {

        $recipes = Recipe::orderBy('updated_at', 'DESC');
        return view('admin.home', compact('recipes'));
    }
}
