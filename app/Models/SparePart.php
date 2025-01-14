<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    /** @use HasFactory<\Database\Factories\SparePartFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'price',
        'quantity',
        'description',
        'supplier_id',
        'category_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
