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
            'transmittalno' => 'required|max:255',
            'purpose' => 'required|max:255',
            'datesubmitted' => 'required',
            'timesubmitted' => 'required',
            'date_needed' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'email_address' => 'required|email',
            'source' => 'required|max:255',
            'cocFile' => 'required|mimes:pdf,png,docx,doc,jpg,jpeg,zip|max:5120',
        ];
    }
}
