<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriesSpareParts = Category::with(['spareparts'])->get();
        $totalAllSpareParts = 0;
        $categoryNames = $categoriesSpareParts->pluck('name')->toArray();

        // ChartJS Total SparePart Per Category
        $totalSparePartPerCategory = $categoriesSpareParts->map(function ($category) use (&$totalAllSpareParts) {
            $totalAllSpareParts += $category->spareparts->count();
            return $category->spareparts->count();
        })->all();
        $totalSparePartPerCategoryChart = Chartjs::build()
            ->name("TotalSparePartsPerCategory")
            ->type("bar")
            ->size(["width" => 400, "height" => 200])
            ->labels($categoriesSpareParts->pluck('name')->toArray())
            ->datasets([
                [
                    "label" => "Total SpareParts Per Category",
                    "backgroundColor" => [
                        "rgba(38, 185, 154, 0.31)",
                        "rgba(28, 200, 138, 0.31)",
                        "rgba(54, 162, 235, 0.31)",
                        "rgba(255, 99, 132, 0.31)",
                        "rgba(255, 205, 86, 0.31)",
                        "rgba(75, 192, 192, 0.31)",
                        "rgba(54, 162, 235, 0.31)",
                        "rgba(153, 102, 255, 0.31)",
                        "rgba(201, 203, 207, 0.31)",
                    ],
                    "borderColor" => [
                        "rgba(38, 185, 154, 0.7)",
                        "rgba(28, 200, 138, 0.7)",
                        "rgba(54, 162, 235, 0.7)",
                        "rgba(255, 99, 132, 0.7)",
                        "rgba(255, 205, 86, 0.7)",
                        "rgba(75, 192, 192, 0.7)",
                        "rgba(54, 162, 235, 0.7)",
                        "rgba(153, 102, 255, 0.7)",
                        "rgba(201, 203, 207, 0.7)",
                    ],
                    "data" => $totalSparePartPerCategory
                ]
            ])
            ->options([
                'scales' => [
                    'y' => [
                        'type' => 'linear',
                        'min' => 0,
                        'beginAtZero' => true,
                    ]
                ],
                'plugins' => [

                    'title' => [
                        'display' => true,
                        'text' => 'Total SpareParts Per Category'
                    ]
                ]
            ]);



        // ChartJS Percentage Total SparePart Per Category
        $percentageTotalSpareParts = $categoriesSpareParts->map(function ($category) use ($totalAllSpareParts) {
            return ($totalAllSpareParts > 0) ? ($category->spareparts->count() / $totalAllSpareParts) * 100 : 0;
        })->all();
        $percentageTotalSparePartsChart = Chartjs::build()
            ->name("PercentageSparePartsPerCategory")
            ->type("pie")
            ->size(["width" => 400, "height" => 200])
            ->labels($categoryNames)
            ->datasets([
                [
                    "label" => "Percentage SpareParts Per Category",
                    "backgroundColor" => [
                        "rgba(38, 185, 154, 0.31)",
                        "rgba(28, 200, 138, 0.31)",
                        "rgba(54, 162, 235, 0.31)",
                        "rgba(255, 99, 132, 0.31)",
                        "rgba(255, 205, 86, 0.31)",
                        "rgba(75, 192, 192, 0.31)",
                        "rgba(54, 162, 235, 0.31)",
                        "rgba(153, 102, 255, 0.31)",
                        "rgba(201, 203, 207, 0.31)",
                    ],
                    "data" => $percentageTotalSpareParts
                ]
            ])
            ->options([
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Percentage SpareParts Per Category'
                    ]
                ]
            ]);


        // ChartJS Stock Total SparePart Per Category
        $stockPerCategory = $categoriesSpareParts->mapWithKeys(function ($category) {
            return [$category->name => $category->spareparts->sum('quantity')];
        })->values()->toArray();
        $stockPerCategoryChart = Chartjs::build()
            ->name("StockSparePartsPerCategory")
            ->type("pie")
            ->size(["width" => 400, "height" => 200])
            ->labels($categoryNames)
            ->datasets([
                [
                    "label" => "Stock SpareParts Per Category",
                    "backgroundColor" => [
                        "rgba(38, 185, 154, 0.31)",
                        "rgba(28, 200, 138, 0.31)",
                        "rgba(54, 162, 235, 0.31)",
                        "rgba(255, 99, 132, 0.31)",
                        "rgba(255, 205, 86, 0.31)",
                        "rgba(75, 192, 192, 0.31)",
                        "rgba(54, 162, 235, 0.31)",
                        "rgba(153, 102, 255, 0.31)",
                        "rgba(201, 203, 207, 0.31)",
                    ],
                    "data" => $stockPerCategory
                ]
            ])
            ->options([

                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Stock SpareParts Per Category'
                    ]
                ]
            ]);


            return view('report.index', compact('totalSparePartPerCategoryChart', 'percentageTotalSparePartsChart', 'stockPerCategoryChart'));
    }
}
