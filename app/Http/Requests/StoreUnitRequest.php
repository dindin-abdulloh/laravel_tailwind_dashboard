<?php


namespace App\Http\Requests;

use App\Unit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUnitRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('units_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'    => [
                'string',
                'required',
            ],
            'description'    => [
                'string',
                // 'required',
            ],

        ];
    }
}
