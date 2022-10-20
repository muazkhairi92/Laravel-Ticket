<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            //
            'name'=>'string|max:255',
            'email'=>'email',
            'password'=>['string','alpha_num','min:8'],
            'roles'=>'required|exists:roles,name',
            'category'=>'required|exists:categories,category',
        ];
    }
}
