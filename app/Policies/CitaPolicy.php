<?php

namespace App\Policies;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CitaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Todos los usuarios autenticados pueden ver citas
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cita $cita): bool
    {
        // Admin puede ver todas las citas
        if ($user->isAdmin()) {
            return true;
        }
        
        // Profesional puede ver sus citas asignadas
        if ($user->isProfesional() && $cita->profesional_id === $user->profesional->id) {
            return true;
        }
        
        // Cliente puede ver solo sus propias citas
        return $user->id === $cita->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Todos los usuarios autenticados pueden crear citas
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cita $cita): bool
    {
        // Admin puede actualizar cualquier cita
        if ($user->isAdmin()) {
            return true;
        }
        
        // Profesional puede actualizar estado de sus citas
        if ($user->isProfesional() && $cita->profesional_id === $user->profesional->id) {
            return true;
        }
        
        // Cliente puede actualizar solo sus citas pendientes
        return $user->id === $cita->user_id && $cita->estado === 'pendiente';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cita $cita): Response
    {
        // Admin puede cancelar cualquier cita
        if ($user->isAdmin()) {
            return Response::allow();
        }
        
        // Verificar que sea el dueño de la cita
        if ($user->id !== $cita->user_id) {
            return Response::deny('No tienes permiso para eliminar esta cita.');
        }
        
        // Si la cita está confirmada, debe contactar al profesional
        if ($cita->estado === 'confirmada') {
            return Response::deny('Esta cita ya fue confirmada por el profesional. Por favor, contacta directamente con el especialista para cancelarla.');
        }
        
        // Puede eliminar citas pendientes, completadas o canceladas
        if (in_array($cita->estado, ['pendiente', 'completada', 'cancelada'])) {
            return Response::allow();
        }
        
        return Response::deny('No puedes eliminar esta cita.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cita $cita): bool
    {
        // Solo admin puede restaurar citas
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Cita $cita): bool
    {
        // Solo admin puede eliminar permanentemente
        return $user->isAdmin();
    }
}
