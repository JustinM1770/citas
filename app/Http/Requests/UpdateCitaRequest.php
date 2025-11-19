<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCitaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('cita'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'estado' => 'sometimes|in:pendiente,confirmada,completada,cancelada',
            'notas' => 'nullable|string|max:500',
        ];
    }

    /**
     * Mensajes de validación personalizados
     */
    public function messages(): array
    {
        return [
            'estado.in' => 'El estado debe ser: pendiente, confirmada, completada o cancelada.',
            'notas.max' => 'Las notas no pueden exceder 500 caracteres.',
        ];
    }
}
