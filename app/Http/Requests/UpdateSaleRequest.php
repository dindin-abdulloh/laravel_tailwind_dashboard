<?php

namespace App\Http\Requests;

use App\Sale;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSaleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sales_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'change_due' => [
                'required',
                // 'string',
            ],
            'amount_paid' => [
                'required',
                // 'string',
            ],
            'grand_total' => [
                'required',
                // 'string',
            ],
            'sold_product' => [
                'required',
                // 'string',
            ],
        ];
    }
}
