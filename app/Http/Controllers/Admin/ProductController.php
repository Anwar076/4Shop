<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'active' => 'required|boolean',
            'leiding' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Aanpasbaar aan je uploadvereisten
            'description' => 'nullable|string|max:1000', // Aanpasbaar aan je vereisten
            'category_id' => 'required|exists:categories,id', // Controleer of de geselecteerde categorie bestaat
        ]);

        // Maak een nieuw product met de ingediende gegevens
        $product = new Product();
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->active = $request->input('active');
        $product->leiding = $request->input('leiding');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');

        // Upload en opslaan van de afbeelding (indien aanwezig)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images'); // Aanpasbaar aan je opslagvereisten
            $product->image = str_replace('public/', '', $imagePath);
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product is succesvol toegevoegd.');
    }


    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Validatie en update logica hier
    }

    public function destroy(Product $product)
    {
        // Verwijderen logica hier
    }
}
