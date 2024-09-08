<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required|in:food,drinks,snacks',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'photo' => 'nullable|image|max:2048',
            'stock' => 'required|integer',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required|in:food,drinks,snacks',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'photo' => 'nullable|image|max:2048',
            'stock' => 'required|integer',
        ]);

        if ($request->hasFile('photo')) {
            if ($product->photo && Storage::disk('public')->exists('products/' . $product->photo)) {
                Storage::disk('public')->delete('products/' . $product->photo);
            }

            $validated['photo'] = $request->file('photo')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        if ($product->photo && Storage::disk('public')->exists('products/' . $product->photo)) {
            Storage::disk('public')->delete('products/' . $product->photo);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
