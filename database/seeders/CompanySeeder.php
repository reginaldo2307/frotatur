<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plan = \App\Models\Plan::where('slug', 'basico')->first();

        $company = \App\Models\Company::create([
            'name' => 'Minha Agência de Turismo',
            'document' => '00.000.000/0001-00',
            'email' => 'contato@agencia.com',
            'phone' => '11999999999',
            'plan_id' => $plan->id,
            'subscription_status' => 'active',
        ]);

        $admin = \App\Models\User::where('email', 'admin@admin.com')->first();
        if ($admin) {
            $admin->update(['company_id' => $company->id]);
        }
    }
}
