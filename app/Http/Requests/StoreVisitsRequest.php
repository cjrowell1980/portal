<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'job'       => 'required',
            'engineer'  => 'nullable',
            'scheduled' => 'nullable',
            'attended'  => 'nullable',
            'status'    => 'boolean|required',
            'outcome'   => 'integer|required',
        ];
    }
}
