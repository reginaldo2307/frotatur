<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar Roles
        $superAdminRole = \Spatie\Permission\Models\Role::create(['name' => 'Super Admin']);
        $adminRole = \Spatie\Permission\Models\Role::create(['name' => 'Administrador']);
        $operatorRole = \Spatie\Permission\Models\Role::create(['name' => 'Operador']);
        $driverRole = \Spatie\Permission\Models\Role::create(['name' => 'Motorista']);

        // Criar Empresa Inicial
        $company = \App\Models\Company::create([
            'name' => 'Agência Matriz',
            'email' => 'contato@agencia.com',
            'active' => true,
        ]);

        // Criar Super Admin
        $user = \App\Models\User::factory()->create([
            'name' => 'Reginaldo Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'company_id' => $company->id,
        ]);

        $user->assignRole($superAdminRole);
    }
}
