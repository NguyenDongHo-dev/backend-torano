<?php

namespace App\Http\Requests;


class UserRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        $userId= $this->route('id');


         if ($this->isMethod('post')) {
            return [
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ];
        };



        if ($this->isMethod("put" || $this->isMethod("patch"))) {
            return [
                'email'=>'sometimes|email|unique:user,email,' . $userId,

            ];
        };


        return [];
    }
}
