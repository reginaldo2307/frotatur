<?php

/**
 * Script de ajuda para deploy no cPanel (sem SSH)
 * 
 * Como usar:
 * 1. Suba este arquivo para a raiz do seu site.
 * 2. Acesse: seudominio.com.br/cpanel_setup.php
 * 3. Delete este arquivo após o uso por segurança!
 */

use Illuminate\Support\Facades\Artisan;

// Carregar o framework Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

echo "<h1>Frota Setup Helper</h1>";

function runCommand($command) {
    echo "Executando: <code>php artisan $command</code>... ";
    try {
        Artisan::call($command);
        echo "<span style='color:green'>Sucesso!</span><br>";
        echo "<pre>" . Artisan::output() . "</pre>";
    } catch (\Exception $e) {
        echo "<span style='color:red'>Erro: " . $e->getMessage() . "</span><br>";
    }
}

// 1. Criar link simbólico da storage
runCommand('storage:link');

// 2. Rodar migrações
runCommand('migrate --force');

// 3. Limpar caches
runCommand('config:cache');
runCommand('route:cache');
runCommand('view:cache');

echo "<br><strong style='color:orange'>IMPORTANTE: Delete este arquivo (cpanel_setup.php) agora mesmo!</strong>";
