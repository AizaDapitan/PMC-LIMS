<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users',
            'name' => 'required',
            'dept' => 'string|max:150',
            'active' => 'active',
            'imageFile' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'appRole' => 'required|string',
            'userPermissions' => 'required|string',
            'role_id'   => 'string',
        ];
    }
}
