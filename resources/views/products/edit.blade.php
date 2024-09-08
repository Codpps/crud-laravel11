@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="mx-auto px-4 py-4 bg-gradient-to-b from-blue-50 to-white min-h-screen">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-blue-800 text-center">Edit Product</h1>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6 animate-fade-in">
                <p class="font-bold">Please correct the following errors:</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" value="{{ old('name', $product->name) }}" required>
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category" id="category" class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" required>
                    <option value="">Select a category</option>
                    <option value="food" {{ old('category', $product->category) == 'food' ? 'selected' : '' }}>Food</option>
                    <option value="drinks" {{ old('category', $product->category) == 'drinks' ? 'selected' : '' }}>Drinks</option>
                    <option value="snacks" {{ old('category', $product->category) == 'snacks' ? 'selected' : '' }}>Snacks</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="purchase_price" class="block text-sm font-medium text-gray-700 mb-1">Purchase Price</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2 text-gray-500">$</span>
                        <input type="number" name="purchase_price" id="purchase_price" step="0.01" class="w-full pl-8 pr-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" value="{{ old('purchase_price', $product->purchase_price) }}" required>
                    </div>
                </div>
                <div>
                    <label for="sale_price" class="block text-sm font-medium text-gray-700 mb-1">Sale Price</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2 text-gray-500">$</span>
                        <input type="number" name="sale_price" id="sale_price" step="0.01" class="w-full pl-8 pr-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" value="{{ old('sale_price', $product->sale_price) }}" required>
                    </div>
                </div>
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                <input type="number" name="stock" id="stock" class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" value="{{ old('stock', $product->stock) }}" required>
            </div>

            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Product Photo</label>
                <input type="file" name="photo" id="photo" class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @if ($product->photo)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="h-24 w-24 object-cover rounded">
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-end mt-8">
                <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 mr-4">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-700 transition duration-300 ease-in-out flex items-center">
                    <i class="bi bi-check-circle mr-2"></i> Update Product
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
