<?php

namespace App\Http\Requests;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class SizeRequest extends BaseRequest
{

    public function rules()
    {

        $sizeId = $this->route('id');

        if ($this->isMethod('post')) {
            return [
                'name' => 'required|string|unique:sizes',
            ];
        }

          if ($this->isMethod('put') && $sizeId ) {
            return [
                Rule::unique('sizes', 'name')->ignore($sizeId, 'id'),
            ];
        }

        return [];
    }
}
