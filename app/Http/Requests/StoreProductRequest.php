<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;
use Illuminate\Http\Response;
use App\Product;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('products_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'product_name'       => [
                'string',
                'required',
            ],
            'product_code'       => [
                // 'string',
                'required',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
            'supplier_id' => [
                'required',
                'integer',
            ],
            'price' => [
                'required',
                // 'integer',
            ],
            'purchase_price' => [
                'required',
                // 'integer',
            ],
            'stock_quantity' => [
                'required',
                'integer',
            ],
            'expired_date' => [
                'required',
                // 'integer',
            ],
        ];
    }
}
