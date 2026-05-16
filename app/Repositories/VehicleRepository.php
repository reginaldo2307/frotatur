<?php

namespace App\Repositories;

use App\Models\Vehicle;

class VehicleRepository
{
    public function getAll($perPage = 10)
    {
        return Vehicle::latest()->paginate($perPage);
    }

    public function create(array $data)
    {
        return Vehicle::create($data);
    }

    public function update(Vehicle $vehicle, array $data)
    {
        $vehicle->update($data);
        return $vehicle;
    }

    public function delete(Vehicle $vehicle)
    {
        return $vehicle->delete();
    }
}
