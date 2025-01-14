<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($sparePart) ? 'Edit' : 'New' }} Sparepart
        </h2>
    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
        <div class="flex justify-start mb-4">
            <a href="{{ route('sparepart.index') }}" class="text-blue-500 hover:text-blue-700">
                &larr; Back to Sparepart List
            </a>
        </div>
        <form method="POST"
            action="{{ !isset($sparePart) ? route('sparepart.store') : route('sparepart.update', $sparePart->id) }}"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 space-y-4">
            @csrf
            @if (isset($sparePart))
                @method('PATCH')
            @endif
            <div class="flex flex-row space-x-4">
                <!-- Column 1 -->
                <div class="grow space-y-4">
                    <div>
                        <label for="name" class="text-sm font-medium text-gray-700">Name <span
                                class="text-red-600">*</span></label>
                        <input type="text" id="name" name="name"
                            value="{{ isset($sparePart) ? $sparePart->name : old('name') }}"
                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 {{ isset($readonly) ? 'bg-gray-100' : '' }}"
                            placeholder="Nama spare part" {{ isset($readonly) ? 'readonly' : '' }}>
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="code" class="text-sm font-medium text-gray-700">Code <span
                                class="text-red-600">*</span></label>
                        <input type="text" id="code" name="code"
                            value="{{ isset($sparePart) ? $sparePart->code : old('code') }}"
                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300  {{ isset($readonly) ? 'bg-gray-100' : '' }}"
                            placeholder="Kode" style="text-transform: uppercase;"
                            {{ isset($readonly) ? 'readonly' : '' }}>
                        @error('code')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                    </div>
                    <div>
                        <label for="price" class="text-sm font-medium text-gray-700">Price <span
                                class="text-red-600">*</span></label>
                        <input type="number" id="price" name="price"
                            value="{{ isset($sparePart) ? $sparePart->price : old('price') }}"
                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 {{ isset($readonly) ? 'bg-gray-100' : '' }}"
                            placeholder="Harga per unit" {{ isset($readonly) ? 'readonly' : '' }}>
                        @error('price')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="quantity" class="text-sm font-medium text-gray-700">Quantity <span
                                class="text-red-600">*</span></label>
                        <input type="number" id="quantity" name="quantity"
                            value="{{ isset($sparePart) ? $sparePart->quantity : old('quantity') }}"
                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 {{ isset($readonly) ? 'bg-gray-100' : '' }}"
                            placeholder="Jumlah stok saat ini" {{ isset($readonly) ? 'readonly' : '' }}>
                        @error('quantity')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="description" class="text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description"
                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 {{ isset($readonly) ? 'bg-gray-100' : '' }}"
                            placeholder="Deskripsi singkat spare part" {{ isset($readonly) ? 'readonly' : '' }}>{{ isset($sparePart) ? $sparePart->description : old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Column 2 -->
                <div class="grow space-y-4">
                    <div>
                        <label for="category_id" class="text-sm font-medium text-gray-700">Category <span
                                class="text-red-600">*</span></label>
                        <select id="category_id" name="category_id"
                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 {{ isset($readonly) ? 'bg-gray-100' : '' }}"
                            {{ isset($readonly) ? 'disabled' : '' }}>
                            <option value="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ isset($sparePart) && $sparePart->category_id == $category->id ? 'selected' : '' }}>
                                    {{ Str::ucfirst($category->name) }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="supplier_id" class="text-sm font-medium text-gray-700">Supplier <span
                                class="text-red-600">*</span></label>
                        <select id="supplier_id" name="supplier_id"
                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 {{ isset($readonly) ? 'bg-gray-100' : '' }}"
                            {{ isset($readonly) ? 'disabled' : '' }}>
                            <option value="">Select supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ isset($sparePart) && $sparePart->supplier_id == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->company_name }}</option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Button -->
            @if (!isset($readonly))
                <div class="w-full h-0.5 bg-gray-200"></div>
                <div class="flex items-center justify-end gap-4 mt-8">
                    @if (isset($sparePart))
                        <button class="bg-blue-500 px-4 py-2 rounded shadow-md text-white" type="submit">Edit</button>
                    @else
                        <button class="bg-blue-500 px-4 py-2 rounded shadow-md text-white" type="submit">Save</button>
                    @endif
                </div>
            @endif
        </form>
    </div>

</x-app-layout>
