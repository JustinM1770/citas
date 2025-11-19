<?php

namespace App\Policies;

use App\Models\Profesional;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProfesionalPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Solo admin puede ver lista de profesionales
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Profesional $profesional): bool
    {
        // Admin y el propio profesional pueden ver
        return $user->isAdmin() || ($user->isProfesional() && $user->profesional->id === $profesional->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Solo admin puede crear profesionales
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Profesional $profesional): bool
    {
        // Solo admin puede actualizar profesionales
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Profesional $profesional): bool
    {
        // Solo admin puede eliminar profesionales
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Profesional $profesional): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Profesional $profesional): bool
    {
        return $user->isAdmin();
    }
}
