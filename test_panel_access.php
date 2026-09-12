<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

use App\Models\User;
use Filament\Panel;

$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = User::find(1);
if ($user) {
    echo "User found: {$user->email}\n";
    echo "ADMIN_EMAIL: " . env('ADMIN_EMAIL') . "\n";
    echo "Password hashed: " . strlen($user->password) . " chars\n";
    
    // Check canAccessPanel
    $admin_panel = new \Filament\Panel('blissinbaliadmin');
    try {
        $result = $user->canAccessPanel($admin_panel);
        echo "canAccessPanel result: " . ($result ? 'true' : 'false') . "\n";
        echo "Email match: " . ($user->email === env('ADMIN_EMAIL') ? 'YES' : 'NO') . "\n";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
} else {
    echo "User not found!\n";
}
