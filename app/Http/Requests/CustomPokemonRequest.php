<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomPokemonRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:custom_pokemon,name'],
            'description' => ['nullable', 'string'],
            'height' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'damage' => ['required', 'numeric'],
            'type' => ['required', 'string'],
        ];
    }
}
