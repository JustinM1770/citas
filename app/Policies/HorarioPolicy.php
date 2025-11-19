<?php

namespace App\Policies;

use App\Models\Horario;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HorarioPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admin y profesionales pueden ver horarios
        return $user->isAdmin() || $user->isProfesional();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Horario $horario): bool
    {
        // Admin puede ver cualquier horario
        if ($user->isAdmin()) {
            return true;
        }
        
        // Profesional puede ver solo sus propios horarios
        return $user->isProfesional() && $horario->profesional_id === $user->profesional->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Admin y profesionales pueden crear horarios
        return $user->isAdmin() || $user->isProfesional();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Horario $horario): bool
    {
        // Admin puede actualizar cualquier horario
        if ($user->isAdmin()) {
            return true;
        }
        
        // Profesional solo puede actualizar sus propios horarios
        return $user->isProfesional() && $horario->profesional_id === $user->profesional->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Horario $horario): bool
    {
        // Admin puede eliminar cualquier horario
        if ($user->isAdmin()) {
            return true;
        }
        
        // Profesional solo puede eliminar sus propios horarios
        return $user->isProfesional() && $horario->profesional_id === $user->profesional->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Horario $horario): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Horario $horario): bool
    {
        return $user->isAdmin();
    }
}
