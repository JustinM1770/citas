<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Horario;
use App\Models\Cita;

class StoreCitaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Cita::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'servicio_id' => 'required|exists:servicios,id',
            'profesional_id' => 'required|exists:profesionals,id',
            'fecha' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    $this->validateDisponibilidad($value, $fail);
                },
            ],
            'hora' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $this->validateHorarioDisponible($value, $fail);
                },
            ],
            'notas' => 'nullable|string|max:500',
        ];
    }

    /**
     * Validar que no exista cita duplicada
     */
    protected function validateDisponibilidad($fecha, $fail)
    {
        $exists = Cita::where('profesional_id', $this->profesional_id)
            ->where('fecha', $fecha)
            ->where('hora', $this->hora)
            ->where('estado', '!=', 'cancelada')
            ->exists();

        if ($exists) {
            $fail('Este horario ya está ocupado para el profesional seleccionado.');
        }
    }

    /**
     * Validar que el horario esté disponible
     */
    protected function validateHorarioDisponible($hora, $fail)
    {
        if (!$this->fecha || !$this->profesional_id) {
            return;
        }

        $diaSemana = date('l', strtotime($this->fecha));
        $dias = [
            'Monday' => 'lunes',
            'Tuesday' => 'martes',
            'Wednesday' => 'miercoles',
            'Thursday' => 'jueves',
            'Friday' => 'viernes',
            'Saturday' => 'sabado',
            'Sunday' => 'domingo',
        ];

        $horario = Horario::where('profesional_id', $this->profesional_id)
            ->where('dia_semana', $dias[$diaSemana])
            ->where('hora_inicio', '<=', $hora)
            ->where('hora_fin', '>=', $hora)
            ->where('disponible', true)
            ->first();

        if (!$horario) {
            $fail('El profesional no tiene disponibilidad en este horario.');
        }
    }

    /**
     * Mensajes de validación personalizados
     */
    public function messages(): array
    {
        return [
            'servicio_id.required' => 'Debe seleccionar un servicio.',
            'servicio_id.exists' => 'El servicio seleccionado no es válido.',
            'profesional_id.required' => 'Debe seleccionar un profesional.',
            'profesional_id.exists' => 'El profesional seleccionado no es válido.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'fecha.after_or_equal' => 'La fecha debe ser hoy o posterior.',
            'hora.required' => 'La hora es obligatoria.',
            'hora.date_format' => 'El formato de hora debe ser HH:MM.',
            'notas.max' => 'Las notas no pueden exceder 500 caracteres.',
        ];
    }
}
