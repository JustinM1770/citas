<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Servicio;

class StoreServicioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Servicio::class);
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100|unique:servicios,nombre',
            'descripcion' => 'nullable|string|max:500',
            'duracion' => 'required|integer|min:15|max:480',
            'precio' => 'required|numeric|min:0|max:999999.99',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del servicio es obligatorio.',
            'nombre.unique' => 'Ya existe un servicio con este nombre.',
            'nombre.max' => 'El nombre no puede exceder 100 caracteres.',
            'descripcion.max' => 'La descripción no puede exceder 500 caracteres.',
            'duracion.required' => 'La duración es obligatoria.',
            'duracion.min' => 'La duración mínima es 15 minutos.',
            'duracion.max' => 'La duración máxima es 8 horas (480 minutos).',
            'precio.required' => 'El precio es obligatorio.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',
            'precio.max' => 'El precio no puede exceder 999,999.99.',
        ];
    }
}
