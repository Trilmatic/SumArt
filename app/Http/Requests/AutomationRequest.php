<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutomationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'type' => 'required|max:100',
            'frequency' => 'required|max:100',
            'time_at' => 'exclude_unless:frequency,daily|required',
            'source' => 'required|array|max:10',
            'source.*.url' => 'required|active_url',
        ];
    }
}
