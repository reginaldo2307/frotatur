<?php

namespace App\Services;

use App\Repositories\VehicleRepository;
use App\Models\Vehicle;

class VehicleService
{
    public function __construct(
        protected VehicleRepository $repository
    ) {}

    public function listVehicles()
    {
        return $this->repository->getAll();
    }

    public function storeVehicle(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateVehicle(Vehicle $vehicle, array $data)
    {
        return $this->repository->update($vehicle, $data);
    }

    public function removeVehicle(Vehicle $vehicle)
    {
        return $this->repository->delete($vehicle);
    }
}
