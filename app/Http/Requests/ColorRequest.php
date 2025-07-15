<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;


class ColorRequest extends BaseRequest
{

    public function rules()
    {

         $colorId = $this->route('id');

        if ($this->isMethod('post')) {
            return [
                'name' => 'required|string|unique:colors',
            ];
        }

          if ($this->isMethod('put') && $colorId ) {
            return [
                Rule::unique('colors', 'name')->ignore($colorId, 'id'),
                'string',
            ];
        }

        return [];
    }
}
