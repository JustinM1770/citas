<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfesionalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('profesionale'));
    }

    public function rules(): array
    {
        return [
            'especialidad' => 'sometimes|required|string|max:100',
            'telefono' => 'nullable|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'especialidad.required' => 'La especialidad es obligatoria.',
            'especialidad.max' => 'La especialidad no puede exceder 100 caracteres.',
            'telefono.max' => 'El teléfono no puede exceder 20 caracteres.',
        ];
    }
}
