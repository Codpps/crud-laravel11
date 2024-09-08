@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="container mx-auto px-4 py-8 bg-gradient-to-b from-blue-50 to-white min-h-screen">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="md:flex">
            <div class="md:flex-shrink-0">
                @if($product->photo)
                    <img class="h-48 w-full object-cover md:w-48" src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}">
                @else
                    <div class="h-48 w-full md:w-48 bg-blue-100 flex items-center justify-center">
                        <i class="bi bi-image text-blue-500 text-5xl"></i>
                    </div>
                @endif
            </div>
            <div class="p-8">
                <div class="uppercase tracking-wide text-sm text-blue-600 font-semibold">{{ ucfirst($product->category) }}</div>
                <h1 class="mt-2 text-3xl leading-8 font-bold text-gray-900">{{ $product->name }}</h1>
                <p class="mt-2 text-gray-600">Product ID: {{ $product->id }}</p>
                
                <div class="mt-4 flex flex-wrap">
                    <div class="mr-4 mb-4">
                        <span class="text-gray-600 font-semibold">Purchase Price:</span>
                        <span class="ml-2 text-blue-700">${{ number_format($product->purchase_price, 2) }}</span>
                    </div>
                    <div class="mr-4 mb-4">
                        <span class="text-gray-600 font-semibold">Sale Price:</span>
                        <span class="ml-2 text-blue-700">${{ number_format($product->sale_price, 2) }}</span>
                    </div>
                    <div class="mb-4">
                        <span class="text-gray-600 font-semibold">Stock:</span>
                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of stock' }}
                        </span>
                    </div>
                </div>

                <div class="mt-6 flex items-center">
                    <a href="{{ route('products.edit', $product) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700 transition duration-300 ease-in-out mr-4">
                        <i class="bi bi-pencil mr-2"></i> Edit Product
                    </a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600 transition duration-300 ease-in-out" onclick="return confirm('Are you sure you want to delete this product?')">
                            <i class="bi bi-trash mr-2"></i> Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mt-6 mx-8 mb-4 rounded animate-fade-in">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
    </div>
    
    <div class="mt-8 text-center">
        <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="bi bi-arrow-left mr-2"></i> Back to Products List
        </a>
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