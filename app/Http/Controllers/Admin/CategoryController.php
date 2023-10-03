<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        // Validatie en opslaglogica hier
    }

    public function edit(Category $category)
    {
        $products = $category->products; // Haal producten op die tot deze categorie behoren
        return view('admin.categories.edit', compact('category', 'products'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Voeg hier de gewenste validatieregels toe
        ]);

        // Bijwerken van de categorie met de nieuwe naam
        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Categorie bijgewerkt.'); // Toon een succesbericht
    }


    public function destroy(Category $category)
    {
        // Verwijderen logica hier
    }
}
