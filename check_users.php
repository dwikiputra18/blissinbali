<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

use App\Models\User;

$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$users = User::all();
echo "Total users: " . count($users) . "\n";
foreach ($users as $user) {
    echo "- ID: {$user->id}, Email: {$user->email}, Name: {$user->name}\n";
}

// Check config
echo "\nADMIN_EMAIL config: " . env('ADMIN_EMAIL') . "\n";
