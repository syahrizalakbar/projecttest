<x-app-layout>
    @if (session('success'))
        <div id="alert"
            class="fixed top-0 right-0 bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md"
            role="alert">
            <div class="flex">
                <p class="font-bold">{{ session('success') }}</p>
            </div>
        </div>

        <script>
            setTimeout(function() {
                document.getElementById("alert").style.display = "none";
            }, 3000);
        </script>
    @endif


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            List Sparepart
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 space-y-4">
                <!-- Search form and New Button -->
                <div class="flex flex-row space-x-2">
                    <div class="grow relative">
                        <form action="{{ route('sparepart.search') }}" method="GET">
                            <input type="text" name="q" id="search" value="{{ request('q') }}"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none"
                                placeholder="Search by name, code, or category">
                            <button type="submit"
                                class="absolute inset-y-0 right-0 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </form>

                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M15.5 11a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('sparepart.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded h-10 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        New Sparepart
                    </a>
                </div>

                <!-- Data Table -->
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Code
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quantity
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Supplier
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($spareParts as $sparepart)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ Str::ucfirst($sparepart->name) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ Str::limit($sparepart->description, 20) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $sparepart->code }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ 'Rp ' . number_format($sparepart->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $sparepart->quantity }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ Str::ucfirst($sparepart->category->name) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $sparepart->supplier->company_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex flex-col">
                                    <a href="{{ route('sparepart.show', $sparepart->id) }}"
                                        class="text-green-600 hover:text-green-900">View</a>
                                    <a href="{{ route('sparepart.edit', $sparepart->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('sparepart.destroy', $sparepart->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-right">
                                {{ $spareParts->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
