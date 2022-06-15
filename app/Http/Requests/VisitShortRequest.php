<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitShortRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return !false;
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge($this->route()->parameters);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'short_url' => 'required|string|exists:urls,short_url'
        ];
    }
}
