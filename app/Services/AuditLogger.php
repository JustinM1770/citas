<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class AuditLogger
{
    /**
     * Log de acción de creación
     */
    public static function created(string $model, int $id, array $data = [])
    {
        Log::channel('audit')->info("$model creado", array_merge([
            'model' => $model,
            'id' => $id,
            'user_id' => auth()->id(),
            'ip' => request()->ip(),
            'timestamp' => now()->toDateTimeString(),
        ], $data));
    }

    /**
     * Log de acción de actualización
     */
    public static function updated(string $model, int $id, array $changes = [])
    {
        Log::channel('audit')->info("$model actualizado", [
            'model' => $model,
            'id' => $id,
            'user_id' => auth()->id(),
            'changes' => $changes,
            'ip' => request()->ip(),
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    /**
     * Log de acción de eliminación
     */
    public static function deleted(string $model, int $id, array $data = [])
    {
        Log::channel('audit')->warning("$model eliminado", array_merge([
            'model' => $model,
            'id' => $id,
            'user_id' => auth()->id(),
            'ip' => request()->ip(),
            'timestamp' => now()->toDateTimeString(),
        ], $data));
    }

    /**
     * Log de acceso no autorizado
     */
    public static function unauthorized(string $action, array $data = [])
    {
        Log::channel('security')->warning("Acceso no autorizado: $action", array_merge([
            'user_id' => auth()->id(),
            'ip' => request()->ip(),
            'url' => request()->fullUrl(),
            'timestamp' => now()->toDateTimeString(),
        ], $data));
    }

    /**
     * Log de error de validación
     */
    public static function validationError(string $model, array $errors = [])
    {
        Log::channel('audit')->notice("Error de validación en $model", [
            'model' => $model,
            'user_id' => auth()->id(),
            'errors' => $errors,
            'ip' => request()->ip(),
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}
