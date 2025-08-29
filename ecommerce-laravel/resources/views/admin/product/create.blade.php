<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @include('layouts.status_info')
                    <form id="product-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description (CKEditor) -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" step="1000" min="0"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                   required>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stock -->
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                   required>
                            @error('stock')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                            <input type="file" name="image" id="image" accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category_id" id="category_id" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                    required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('products.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <!-- CKEditor CDN (latest secure version) -->
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize CKEditor for description textarea
            if (document.getElementById('description')) {
                CKEDITOR.replace('description', {
                    toolbar: [
                        ['Bold', 'Italic', 'Underline', 'Strike']
                    ]
                });
            }
            // ...existing code for form validation...
            const form = document.getElementById('product-form');
            if (!form) return;
            form.addEventListener('submit', function (event) {
                let isValid = true;
                document.querySelectorAll('.error-message').forEach(el => el.remove());
                const nameInput = document.getElementById('name');
                if (!nameInput.value.trim()) {
                    isValid = false;
                    showError(nameInput, 'Product name is required.');
                }
                // Validate Description (get CKEditor data)
                if (CKEDITOR.instances.description) {
                    var descValue = CKEDITOR.instances.description.getData().replace(/<[^>]*>/g, '').trim();
                    if (!descValue) {
                        isValid = false;
                        showError(document.getElementById('description'), 'Description is required.');
                    }
                } else {
                    const descriptionInput = document.getElementById('description');
                    if (!descriptionInput.value.trim()) {
                        isValid = false;
                        showError(descriptionInput, 'Description is required.');
                    }
                }
                const priceInput = document.getElementById('price');
                if (!priceInput.value.trim() || isNaN(priceInput.value) || parseFloat(priceInput.value) <= 0) {
                    isValid = false;
                    showError(priceInput, 'Price must be a positive number.');
                }
                const stockInput = document.getElementById('stock');
                if (!stockInput.value.trim() || isNaN(stockInput.value) || parseInt(stockInput.value) < 0) {
                    isValid = false;
                    showError(stockInput, 'Stock must be a non-negative number.');
                }
                const categoryInput = document.getElementById('category_id');
                if (!categoryInput.value.trim()) {
                    isValid = false;
                    showError(categoryInput, 'Please select a category.');
                }
                const imageInput = document.getElementById('image');
                if (!imageInput.value.trim()) {
                    isValid = false;
                    showError(imageInput, 'Product image is required.');
                }
                if (!isValid) {
                    event.preventDefault();
                }
            });
            function showError(input, message) {
                const error = document.createElement('p');
                error.className = 'error-message mt-1 text-sm text-red-600';
                error.textContent = message;
                input.insertAdjacentElement('afterend', error);
            }
        });
    </script>
    @endpush
</x-app-layout>
