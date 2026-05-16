<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Auth\Access\Response;

class VehiclePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vehicle $vehicle): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $company = $user->company;
        
        // Se o usuário não tiver empresa, bloqueia (padrão SaaS)
        if (!$company) {
            return false;
        }

        // Se não houver plano definido, permite criar (ou você pode mudar para false se quiser obrigar ter plano)
        if (!$company->plan) {
            return true;
        }

        // Conta apenas os veículos da empresa atual
        $currentCount = Vehicle::where('company_id', $company->id)->count(); 
        
        return $currentCount < $company->plan->max_vehicles;
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vehicle $vehicle): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vehicle $vehicle): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vehicle $vehicle): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vehicle $vehicle): bool
    {
        return false;
    }
}
