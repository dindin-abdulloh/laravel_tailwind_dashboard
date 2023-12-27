<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;
use Illuminate\Http\Response;
use App\Sale;

class StoreSalesRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sales_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'product_id'       => [
                'integer',
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'sale_date' => [
                'required',
                'string',
            ],
            'quantity' => [
                'required',
                'integer',
            ],
            'unit_price' => [
                'required',
                'string',
            ],
            'total_amount' => [
                'required',
                'integer',
            ],
        ];
    }
}
