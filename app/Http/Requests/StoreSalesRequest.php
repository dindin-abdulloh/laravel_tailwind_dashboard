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

            'user_id' => [
                'required',
                'integer',
            ],
            'sale_date' => [
                'required',
                'string',
            ],
            'transaction_code' => [
                'required',
                'string',
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
