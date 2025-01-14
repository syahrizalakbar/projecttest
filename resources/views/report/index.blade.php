<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Report
        </h2>
    </x-slot>

    <div class="py-12 space-y-4">
        <div class="flex flex-row max-w-7xl mx-auto sm:px-6 lg:px-8 space-x-4">
            <div class="grow bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 space-y-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-0 text-center">
                    Stock SpareParts Per Category
                </h2>
                <x-chartjs-component :chart="$stockPerCategoryChart" />
            </div>
        </div>
        <div class="flex flex-row max-w-7xl mx-auto sm:px-6 lg:px-8 space-x-4">
            <div class="grow bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 space-y-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-0">
                    Total SpareParts Per Category
                </h2>
                <x-chartjs-component :chart="$totalSparePartPerCategoryChart" />
            </div>
            <div class="grow bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 space-y-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-0">
                    Percentage SpareParts Per Category
                </h2>

                <x-chartjs-component :chart="$percentageTotalSparePartsChart" />
            </div>
        </div>
    </div>
</x-app-layout>
