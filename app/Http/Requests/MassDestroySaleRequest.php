<?php

namespace App\Http\Requests;

use App\Sale;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySaleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sales_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sales,id',
        ];
    }
}
