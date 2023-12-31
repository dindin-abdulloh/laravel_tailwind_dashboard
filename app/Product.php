<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'product_name',
        'product_code',
        'expired_date',
        'category_id',
        'supplier_id',
        'unit_id',
        'price',
        'purchase_price',
        'stock_quantity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }



    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    // public function soldProducts()
    // {
    //     return $this->belongsToMany(SoldProduct::class);
    // }

    public function soldProducts()
    {
        return $this->belongsToMany(SoldProduct::class, 'product_sold_product');
    }


}
