<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\User;

class SaaSDataSeeder extends Seeder
{
    public function run()
    {
        // Planos
        $basic = Plan::firstOrCreate(['slug' => 'basic'], [
            'name' => 'Básico',
            'price' => 49.90,
            'max_vehicles' => 5,
            'max_users' => 2,
            'max_trips_monthly' => 50,
        ]);

        $pro = Plan::firstOrCreate(['slug' => 'pro'], [
            'name' => 'Profissional',
            'price' => 149.90,
            'max_vehicles' => 20,
            'max_users' => 10,
            'max_trips_monthly' => 200,
        ]);

        // Empresas
        for ($i = 1; $i <= 10; $i++) {
            $company = Company::create([
                'name' => "Agência Turismo $i",
                'plan_id' => ($i % 2 == 0) ? $pro->id : $basic->id,
                'active' => true,
                'email' => "contato$i@agencia.com",
            ]);

            // Pagamentos simulados
            Payment::create([
                'company_id' => $company->id,
                'amount' => ($i % 2 == 0) ? 149.90 : 49.90,
                'status' => 'completed',
                'payment_method' => 'pix',
            ]);
        }
    }
}
