<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        @include('layouts.status_info')
                        <button onclick="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add New Product Category
                        </button>
                        <!-- Modal -->
                        <div id="categoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
                            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                                <div class="mt-3">
                                    <h3 class="text-lg font-bold text-gray-900 mb-4">Add New Product Category</h3>
                                    <form action="{{ route('product-categories.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                                            <input type="text" id="name" name="name" required 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <button type="button" onclick="closeModal()" 
                                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                                Cancel
                                            </button>
                                            <button type="submit" 
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @push('scripts')
                        <script>
                            function openModal() {
                                document.getElementById('categoryModal').classList.remove('hidden');
                            }

                            function closeModal() {
                                document.getElementById('categoryModal').classList.add('hidden');
                            }

                            // Close modal when clicking outside
                            window.onclick = function(event) {
                                const modal = document.getElementById('categoryModal');
                                if (event.target == modal) {
                                    closeModal();
                                }
                            }
                        </script>
                        @endpush
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse border border-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Total Product</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Total Stock</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Total Price</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-2">{{ $category->id }}</td>
                                        <td class="border border-gray-300 px-4 py-2 font-medium">{{ $category->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $category->products_count }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $category->products_sum_stock ?? 0 }}</td>
                                        <td class="border border-gray-300 px-4 py-2">Rp {{ number_format(($category->products_sum_price*$category->products_sum_stock ) ?? 0, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <div class="flex space-x-2">
                                                <button onclick="openEditModal({{ $category->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                    Edit
                                                </button>
                                                <!-- Edit Modal -->
                                                <div id="editCategoryModal{{ $category->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
                                                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                                                        <div class="mt-3">
                                                            <h3 class="text-lg font-bold text-gray-900 mb-4">Edit Product Category</h3>
                                                            <form action="{{ route('product-categories.update', $category) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-4">
                                                                    <label for="editName{{ $category->id }}" class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                                                                    <input type="text" id="editName{{ $category->id }}" name="name" 
                                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                                                                           value="{{ old('name', $category->name) }}"
                                                                           required>
                                                                </div>
                                                                <div class="flex justify-end space-x-2">
                                                                    <button type="button" onclick="closeEditModal({{ $category->id }})" 
                                                                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                                                        Cancel
                                                                    </button>
                                                                    <button type="submit" 
                                                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                                        Update
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="{{ route('product-categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product category: {{ $category->name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="border border-gray-300 px-4 py-8 text-center text-gray-500">
                                            No products found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
<script>
    function openEditModal(categoryId) {
        document.getElementById('editCategoryModal' + categoryId).classList.remove('hidden');
    }

    function closeEditModal(categoryId) {
        document.getElementById('editCategoryModal' + categoryId).classList.add('hidden');
    }

    // Close edit modal when clicking outside
    // window.onclick = function(event) {
    //     const editModal = document.getElementById('editCategoryModal' + categoryId);
    //     if (event.target == editModal) {
    //         closeEditModal(categoryId);
    //     }
    // }
</script>
@endpush
</x-app-layout>
