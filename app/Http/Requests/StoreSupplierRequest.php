<?php

namespace App\Http\Requests;

use App\Category;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSupplierRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('categories_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'supplier_name'    => [
                'string',
                // 'required',
            ],
            'supplier_address'    => [
                'string',
                // 'required',
            ],
            'supplier_telp'    => [
                'string',
                // 'required',
            ],
        ];
    }
}
