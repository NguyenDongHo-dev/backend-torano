<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class WishlistRequest extends BaseRequest
{

    public function rules()
    {
        $Wishlist = $this->route('id');

        if ($this->isMethod('post')) {
            return [
                'product_id' => 'nullable|exists:products,id',
                'user_id' => 'nullable|exists:users,id'
            ];
        }

        if ($this->isMethod('put') && $Wishlist) {
            return [
                Rule::unique('sizes', 'name')->ignore($Wishlist, 'id'),
            ];
        }


        return [];
    }
}
