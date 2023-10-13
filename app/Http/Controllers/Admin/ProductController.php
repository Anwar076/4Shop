<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = new Product();
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->active = $request->input('active');
        $product->leiding = $request->input('leiding');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $product->image = str_replace('public/', '', $imagePath);
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product is succesvol toegevoegd.');
    }

    public function edit(Product $product)
    {
        // Haal de originele prijs op uit de database
        $originalPrice = $product->price;

        $categories = Category::all();

        // Bereken de prijs na korting
        $discountedPrice = $product->getPriceWithDiscountAttribute();

        // Passeer de originele prijs en de prijs na korting naar de weergave
        return view('admin.products.edit', compact('product', 'categories', 'originalPrice', 'discountedPrice'));
    }







    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'active' => 'required|boolean',
            'leiding' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'discount' => 'nullable|numeric|min:0', // Behoud kortingspercentage-validatie
        ]);

        // Update de attributen van het product, behalve de prijs
        $product->title = $request->input('title');
        $product->active = $request->input('active');
        $product->leiding = $request->input('leiding');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');
        $product->discount = $request->input('discount');

        // Bijwerken van het kortingspercentage (als het is ingediend)
        if ($request->has('discount')) {
            $product->discount = $request->input('discount');
        } else {
            // Als er geen kortingspercentage is ingediend, stel het in op null (optioneel)
            $product->discount = null;
        }

        // Upload en opslaan van de afbeelding (indien aanwezig)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $product->image = str_replace('public/', '', $imagePath);
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product is succesvol bijgewerkt.');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product is succesvol verwijderd.');
    }
}
