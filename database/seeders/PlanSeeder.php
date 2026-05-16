<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Plan::create([
            'name' => 'Básico',
            'slug' => 'basico',
            'price' => 99.90,
            'max_vehicles' => 5,
            'max_users' => 2,
            'max_trips_monthly' => 50,
        ]);

        \App\Models\Plan::create([
            'name' => 'Profissional',
            'slug' => 'profissional',
            'price' => 199.90,
            'max_vehicles' => 20,
            'max_users' => 5,
            'max_trips_monthly' => 200,
        ]);

        \App\Models\Plan::create([
            'name' => 'Premium',
            'slug' => 'premium',
            'price' => 399.90,
            'max_vehicles' => 100,
            'max_users' => 20,
            'max_trips_monthly' => 1000,
        ]);
    }
}
