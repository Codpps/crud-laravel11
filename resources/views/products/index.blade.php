@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class=" mx-auto px-8 py-5 bg-gradient-to-b from-blue-50 to-white min-h-screen">
        <h1 class="text-4xl font-bold  text-center text-blue-700 shadow-text">CRUD PRODUCTS LARAVEL 11</h1>
        <h1 class="text-xl font-bold mb-14 text-center text-blue-600 shadow-text">By Codpps</h1>

        @if (session('success'))
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg shadow-md mb-6 animate-fade-in">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('products.create') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">
                <i class="bi bi-plus-circle mr-2"></i> Add New Product
            </a>
            <div class="relative">
                <input type="text" placeholder="Search products..."
                    class="pl-10 pr-4 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-blue-400"></i>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Product</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Priceng</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-100">
                    @foreach ($products as $product)
                        <tr class="hover:bg-blue-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        @if ($product->photo)
                                            <img class="h-12 w-12 rounded-lg object-cover border-2 border-blue-200"
                                                src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}">
                                        @else
                                            <div
                                                class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-500">
                                                <i class="bi bi-camera text-xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                        <div class="text-sm text-gray-500">ID: {{ $product->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ ucfirst($product->category) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($product->stock > 10)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $product->stock }} in stock
                                    </span>
                                @elseif($product->stock > 0)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Low stock: {{ $product->stock }}
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Out of stock
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Sale: ${{ number_format($product->sale_price, 2) }}</div>
                                <div class="text-sm text-gray-500">Purchase:
                                    ${{ number_format($product->purchase_price, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Created: {{ $product->created_at }}</div>
                                <div class="text-sm text-gray-500">Updated: {{ $product->updated_at }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('products.show', $product) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a href="{{ route('products.edit', $product) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-blue-600 hover:text-blue-900"
                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .shadow-text {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
