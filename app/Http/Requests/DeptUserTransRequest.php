<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeptUserTransRequest extends FormRequest
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
            'transmittalno' => 'required',
            'purpose' => 'required',
            'datesubmitted' => 'required',
            'timesubmitted' => 'required',
            'date_needed' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'email_address' => 'required|email',
            'source' => 'required',
            'cocFile' => 'required|mimes:pdf,',
        ];
    }
}
