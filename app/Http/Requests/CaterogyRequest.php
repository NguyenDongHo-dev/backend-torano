<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CaterogyRequest extends BaseRequest
{
    public function rules()
    {
        //create category
        $categoryId=$this->route("id");

         if ($this->isMethod('post')) {
            return [
                'name' => 'required|unique:categories',
                'parent_id' => 'nullable|exists:categories,id',
            ];
        }

          if ($this->isMethod('put') && $categoryId ) {
            return [
                'name' => [
                    'sometimes',
                    'string',
                    Rule::unique('categories', 'name')->ignore($categoryId, 'id'),
                    
                ],
                'parent_id' => 'sometimes|nullable|exists:categories,id',
                'status' => 'sometimes|in:0,1',
            ];
        }

        return [];
    }
}
