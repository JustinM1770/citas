<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Horario;

class StoreHorarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Horario::class);
    }

    public function rules(): array
    {
        return [
            'profesional_id' => 'required|exists:profesionals,id',
            'dias' => 'required|array|min:1',
            'dias.*' => 'required|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo',
            'hora_inicio' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    if ($this->hora_fin && $value >= $this->hora_fin) {
                        $fail('La hora de inicio debe ser anterior a la hora de fin.');
                    }
                },
            ],
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'disponible' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'profesional_id.required' => 'Debe seleccionar un profesional.',
            'profesional_id.exists' => 'El profesional seleccionado no es válido.',
            'dias.required' => 'Debe seleccionar al menos un día de la semana.',
            'dias.array' => 'Los días deben ser un arreglo válido.',
            'dias.min' => 'Debe seleccionar al menos un día de la semana.',
            'dias.*.in' => 'Uno o más días seleccionados no son válidos.',
            'hora_inicio.required' => 'La hora de inicio es obligatoria.',
            'hora_inicio.date_format' => 'El formato de hora debe ser HH:MM.',
            'hora_fin.required' => 'La hora de fin es obligatoria.',
            'hora_fin.date_format' => 'El formato de hora debe ser HH:MM.',
            'hora_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio.',
        ];
    }
}
