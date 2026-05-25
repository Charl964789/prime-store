<?php

namespace App\Models;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'stock',
        'description',
        'barcode',
        'supplier_id',
        'expiry_date',
        'manufacture_date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
    public function supplier()
{
    return $this->belongsTo(Supplier::class);
}

    public function stockLogs()
    {
        return $this->hasMany(StockLog::class);
    }
}