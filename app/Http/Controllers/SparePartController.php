<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSparePartRequest;
use App\Http\Requests\UpdateSparePartRequest;
use App\Models\Category;
use App\Models\SparePart;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SparePartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spareParts = SparePart::with(['supplier', 'category'])
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('sparepart.index', compact('spareParts'));
    }

    public function search(Request $request)
    {
        $q = $request->input('q');

        $spareParts = SparePart::where(function($query) use ($q) {
            $query->where('name', 'ILIKE', "%{$q}%")
                    ->orWhere('code', 'ILIKE', "%{$q}%")
                    ->orWhereHas('category', function($query) use ($q) {
                        $query->where('name', 'ILIKE', "%{$q}%");
                    });
        })
        ->with(['supplier', 'category'])
        ->orderBy('id', 'desc')
        ->paginate(10);


        return view('sparepart.index', compact('spareParts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('sparepart.form', compact('categories', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSparePartRequest $request)
    {
        $validated = $request->validated();
        SparePart::create($validated);

        return redirect()->route('sparepart.index')->with('success', 'Sparepart created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sparePart = SparePart::with(['supplier', 'category'])->findOrFail($id);
        $categories = Category::all();
        $suppliers = Supplier::all();
        $readonly = true;

        return view('sparepart.form', compact('sparePart', 'categories', 'suppliers', 'readonly'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sparePart = SparePart::with(['supplier', 'category'])->findOrFail($id);
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('sparepart.form', compact('sparePart', 'categories', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSparePartRequest $request, $id)
    {
        $validated = $request->validated();
        $sparePart = SparePart::findOrFail($id);
        $sparePart->update($validated);
        return redirect()->route('sparepart.index')->with('success', 'Sparepart updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sparePart = SparePart::findOrFail($id);
        $sparePart->delete();
        return redirect()->route('sparepart.index')->with('success', 'Sparepart deleted successfully');
    }
}
