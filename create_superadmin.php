<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::updateOrCreate(
    ['email' => 'admin@admin.com'],
    [
        'name' => 'Super Admin',
        'password' => \Illuminate\Support\Facades\Hash::make('senha123'),
        'company_id' => null,
    ]
);

$role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Super Admin']);
$user->assignRole($role);

echo "Super Admin criado com sucesso!\n";
echo "Email: admin@admin.com\n";
echo "Senha: senha123\n";
