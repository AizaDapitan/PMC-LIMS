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
            'transmittalno' => 'required|max:255|unique:deptuser_trans,transmittalno',
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
    public function messages()
    {
        return [
            'transmittalno.required' => 'The Transmittal No field is required.',
            'transmittalno.unique' => 'The Transmittal No must be unique',
            'purpose.required' => 'The Purpose field is required.',
            'datesubmitted.required' => 'The Date Submitted field is required.',
            'timesubmitted.required' => 'The Time Submitted field is required.',
            'priority.required' => 'The Priority field is required.',
            'status.required' => 'The Status field is required.',
            'source.required' => 'The Source field is required.',
            'transmittalno.max' => 'The Transmittal No must not be greater than  255 characters.'
        ];
    }
}
