<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Profesional;

class StoreProfesionalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Profesional::class);
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id|unique:profesionals,user_id',
            'especialidad' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Debe seleccionar un usuario.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
            'user_id.unique' => 'Este usuario ya es un profesional.',
            'especialidad.required' => 'La especialidad es obligatoria.',
            'especialidad.max' => 'La especialidad no puede exceder 100 caracteres.',
            'telefono.max' => 'El teléfono no puede exceder 20 caracteres.',
        ];
    }
}
