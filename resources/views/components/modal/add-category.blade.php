<div id="addCategoryModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
  <div class="bg-white p-4 rounded-md shadow-lg w-full max-w-md">
    <h2 class="text-lg font-semibold mb-2">Add New Category</h2>
    <form action="{{ route('categories.store') }}" method="POST" id="addCategoryForm">
        @csrf
        <input type="text" id="newCategoryName" name="name" class="w-full border px-2 py-1 rounded mb-3" placeholder="Nama Kategori">
        <div class="flex justify-end">
            <button type="button" onclick="closeAddCategoryModal()" class="mr-2 text-gray-600">Cancel</button>
            <button type="submit" class="bg-amber-600 text-white px-3 py-1 rounded">Save</button>
        </div>
    </form>
  </div>
</div>
