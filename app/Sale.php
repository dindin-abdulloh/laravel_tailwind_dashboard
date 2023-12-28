<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Sale extends Model
{
    use SoftDeletes;

    public $table = 'sales';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        // 'product_id',
        'user_id',
        'grand_total',
        'sale_date',
        'transaction_code',
        'change_due',
        'amount_paid',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function soldProducts()
    {
        return $this->hasMany(SoldProduct::class);
    }

}
